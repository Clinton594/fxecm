<?php

function prepare_new_member($post)
{
	global $uri;
	if (empty($post->id)) {
		if (!empty($post->from_admin) || ($post->password == $post->password2)) {
			if (empty($post->password)) $post->password = "DEFAULT";
			$post->password = password_hash($post->password, PASSWORD_DEFAULT);
			$post->username = substr(preg_replace("/[^a-zA-Z0-9]+/", "", explode("@", $post->email)[0]), 0, 7) . random(3);
			$post->picture_ref = "{$uri->backend}images/c_icon.png";
			$post->return_values = 1;

			// Lower case
			$post->username = strtolower($post->username);
			$post->first_name = ucwords(strtolower($post->first_name));
			$post->last_name = ucwords(strtolower($post->last_name));
			$post->email = strtolower($post->email);

			if (!empty($post->gender)) {
				if ($post->gender === "m") $post->picture_ref = "{$uri->site}assets/img/users/male-avatar.png";
				else $post->picture_ref = "{$uri->site}assets/img/users/female-avatar.png";
			}
		} else $post->error = "password does not match";
	}
	return $post;
}

function welcome($user)
{
	$response = site_login($user, "Registration");
	return $response;
}

function site_login($user, $action = 'Login')
{
	global $generic;
	$uri = $generic->getURIdata();
	require_once(absolute_filepath("{$uri->backend}/controllers/Messenger.php"));
	$response = new stdClass;
	$messenger = new Messenger($generic);
	$company = $generic->company();
	$messenger->pinAction = "login";
	if (!empty($user->primary_key)) $user->id = $user->primary_key;
	if ($action === "Registration") {
		if (!empty($user->referral)) {
			$ref = $generic->getFromTable("users", "username={$user->referral}");
			if (count($ref)) {
				$ref = reset($ref);
				$generic::$mydb->query("INSERT INTO referral SET referred_id='{$user->id}', referral_id='{$ref->id}'") or die($generic::$mydb->error);
			}
		}
		$welcome_mail = (object)[
			"subject" => "Welcome to {$company->name}",
			"body" => "hi",
			"to" => $user->email,
			"from" => $company->email,
			"from_name" => ucwords($company->name),
			"to_name" => "{$user->first_name}",
			"template" => "registeration",
		];
		$response = $messenger->sendMail($welcome_mail);
		$admin_notify = (object)[
			"subject" => "New Registration Alert ({$company->name})",
			"body" => "Hello admin, {$user->first_name} just created an account. Login to guide your client on how to proceed.",
			"to" => $generic->secondary_email,
			"from" => $company->email,
			"from_name" => ucwords($company->name),
			"to_name" => "Admin",
			"template" => "notify",
		];
		$messenger->sendMail($admin_notify);
		$_SESSION["greeting"] = "";
	} else {
		$_SESSION["greeting"] = "back";
	}
	$_SESSION["mloggedin"] = 1;
	$_SESSION["user_id"] = $user->id;
	$_SESSION["email"] = $user->email;
	$_SESSION["username"] = $user->username;

	$response->status = 1;
	$desc = ["Login" => "Welcome, {$user->first_name}", "Registration" => "Welcome, your registration was successful."];
	$response->message = $desc[$action];
	$response->id = $user->id;
	return $response;
}

function sendCode($messenger, $user)
{
	global $generic;
	$actions 		= [
		"login" => "login",
		"code" => "reset password",
		"verify-email" => "verify your email",
		"wallet" => "modify your wallet",
		"update-profile" => "update your profile",
		"changeWallet" => "change wallet address",
		"withdrawal" => "authenticate your withdrawal",
	];

	$action 		= $messenger->pinAction;
	$title  		= $actions[$action];
	$company 		= $generic->company();
	if (empty($_SESSION[$action])) {
		$loginCode 	= rand(100000, 999999);
		$_SESSION[$action] = $loginCode;
	} else {
		$loginCode 	=  $_SESSION[$action];
	}
	$mail 			= (object)[
		'subject'		=>	"Token",
		'body'			=>	"Use this token to {$title}. \n $loginCode",
		'from'			=>	$company->email,
		'to'				=>	$user->email,
		'from_name'	=>	$company->name,
		'to_name'		=>	"{$user->first_name}",
		"template"  =>  "token",
		"token"     =>  $loginCode
	];
	$response 	= $messenger->sendMail($mail);
	if (in_array($generic->getServer(), $generic->getLocalServers())) {
		$response->{$action} = $loginCode;
	}
	return $response;
}

function manageAccount($post)
{ //Admin Confirm Payment of user
	global $generic;
	global $paramControl;
	$db = $generic->connect();
	$bonus = $paramControl->load_sources("referral-bonus");
	// see($post);
	$sel = 1;
	// Get the existing transaction
	$transaction = $generic->getFromTable("transaction", "id={$post}");
	$transaction = reset($transaction);
	// see($transaction);
	// If the transaction has been confirmed
	$message = "Successful";
	if (!empty($transaction->status)) {
		if (empty($transaction->notify)) {
			if ($transaction->tx_type == "deposit") {
				$sel
					= $db->query("UPDATE users SET balance=balance+{$transaction->amount} WHERE id='{$transaction->user_id}'");
				if ($sel) {
					notifyUser($transaction);
				}
				$referral = $generic->getFromTable("referral", "referred_id={$transaction->user_id}, status=0");
				if (count($referral)) {
					$referral = reset($referral);
					$tier1 = get_percent_of($bonus->tier1, $transaction->amount);

					$db->query("UPDATE referral SET status='1', amount='{$tier1}' WHERE id='{$referral->id}'");
					$upline1 = $referral->referral_id;
					$txn = uniqid($upline1);
					$db->query("UPDATE users SET balance=balance+{$tier1} WHERE id='{$upline1}'");
					$db->query("INSERT INTO transaction SET status='1', user_id='{$upline1}', tx_no='{$txn}', tx_type='bonus', amount='{$tier1}', account_id='0', description='Referral Bonus', paid_into='INTEREST WALLET'");
					$response = notifyUser(object(["user_id" => $upline1, "tx_type"  => 'Referral Bonus', "amount" => $tier1, "primary_key" => $db->insert_id, "status" => 1, "notify" => 0]));

					// Check for Upline 2
					$referral = $generic->getFromTable("referral", "referred_id={$upline1}");
					if (count($referral) && !empty($bonus->tier2)) {
						$tier2 = get_percent_of($bonus->tier2, $transaction->amount);
						$referral = reset($referral);
						$upline2 = $referral->referral_id;
						$txn = uniqid($upline2);
						$db->query("UPDATE users SET balance=balance+{$tier2} WHERE id='{$upline2}'");
						$db->query("INSERT INTO transaction SET status='1' user_id='{$upline2}', tx_no='{$txn}', tx_type='bonus', amount='{$tier2}', account_id='0', description='Referral Bonus', paid_into='INTEREST WALLET'");
						$response = notifyUser(object(["user_id" => $upline2, "tx_type"  => 'Referral Bonus', "amount" => $tier2, "primary_key" => $db->insert_id, "status" => 1, "notify" => 0]));
					}
					$message = $response->message;
				}
			} else {
				$exchange = new GeckoExchange;
				$_price = $exchange->coinGeckoRates(["bitcoin"]);
				if (count($_price)) {
					$_price = reset($_price);

					$amount = explode(" ", $transaction->description);
					$amount = str_replace("BTC", "", end($amount));
					$sel = $db->query("UPDATE users SET terra=terra+{$amount} WHERE id='{$transaction->user_id}'");
				}
			}
		}
	} else {
		$sel = $db->query("UPDATE accounts SET status='0' WHERE id='{$transaction->account_id}'") or die($db->error);
	}
	return object(["status" => $sel, "message" => $message]);
}

function verifyWalletCode($post)
{
	if (empty($_SESSION["changeWallet"]) || ($_SESSION["changeWallet"] != $post->code)) {
		$post->error = "Code incorrect";
	} else {
		$post->id = $_SESSION["user_id"];
		// activity([
		// 	"user_id" => $post->id,
		// 	"action" => "Change Wallet",
		// 	"location" => "users",
		// 	"submitType" => "insert",
		// 	"type" => 1,
		// 	"description" => "{$_SESSION["user_name"]} changed wallet to {$post->bitcoin} Plan"
		// ]);
	}
	return $post;
}

function verifyPassword($post)
{
	if (empty($_SESSION["resetPassword"]) || ($_SESSION["resetPassword"] != $post->code)) {
		$post->error = "Code incorrect";
	} else {
		if ($post->pwd == $post->pwd2) {
			$post->id = $_SESSION["user_id"];
			$post->pwd = password_hash($post->pwd, PASSWORD_DEFAULT);
			// activity([
			// 	"user_id" => $post->id,
			// 	"action" => "Change Password",
			// 	"location" => "users",
			// 	"submitType" => "insert",
			// 	"type" => 1,
			// 	"description" => "{$_SESSION["user_name"]} Changed Password"
			// ]);
		} else {
			$post->error = "Passwords Dont match";
		}
	}
	return $post;
}

function updateProfile($post)
{
	// activity([
	// 	"user_id" => $_SESSION["user_id"],
	// 	"action" => "Profile Update",
	// 	"location" => "users",
	// 	"submitType" => "insert",
	// 	"type" => 1,
	// 	"description" => "{$_SESSION["user_name"]} Upadated Profile"
	// ]);
	return ["status" => 1, "message" => "Successful"];
}

function loadcoins($generic)
{
	$uri = $generic->getURIData();
	require_once(absolute_filepath($uri->backend) . "controllers/GeckoExchange.php");
	$exchange = new GeckoExchange($generic);
	// see($generic);
	$coins = $exchange->coinGeckoList();
	$coins = array_map(function ($coin) {
		$coin->coin_id = $coin->id;
		$coin->symbol = strtoupper($coin->symbol);
		unset($coin->id);
		return $coin;
	}, $coins);
	return $coins;
}

function getCoinImage($coin)
{
	global $generic;
	$uri = $generic->getURIData();
	require_once(absolute_filepath($uri->backend) . "controllers/GeckoExchange.php");
	$exchange = new GeckoExchange();

	if (empty($coin->logo)) {
		$_coin = $exchange->coinGeckoRates([$coin->coin_id], !$generic->islocalhost());
		$_coin = reset($_coin);
		$coin->logo = $_coin->image;
	}

	return $coin;
}

function getCountries($uri = false, $object = true, $createOnly = false)
{
	global $generic;
	if (empty($uri)) global $uri;
	if (!empty($uri)) {
		$dir = absolute_filepath($uri->site) . "cache/";
		$file = "{$dir}countries.json";

		$build = json_decode(_readFile($file));

		if ($object === false) $build = json_encode($build);
		return $build;
	}
}

function get_param_countries($data)
{
	$list = [];
	foreach ($data as $key => $value) {
		$list[mb_strtolower($key)] = $value["name"];
	}
	return $list;
}

function sendmail($post)
{
	if (gettype($post) == "object") {
		global $generic;
		$company = $generic->company();
		$messenger = new Messenger($generic);
		$post->message = "{$post->message} \r\n sent from : $post->email";
		$notify_mail = (object)[
			"subject" => $post->title,
			"body" => $post->message,
			"to" => $company->email,
			"from" => $company->email,
			"replyTo" => $post->email,
			"from_name" => ucwords($post->user_name),
			"to_name" => $company->name,
			"template" => "notify",
		];
		$post = $messenger->sendMail($notify_mail);
	}
	return $post;
}

function notifyUser($post)
{
	global $generic;
	$tx = $post;
	if (!empty($post->status) && empty($post->notify)) {
		$user = $generic->getFromTable("users", "id={$post->user_id}");
		$user = reset($user);

		$messenger = new Messenger($generic);
		$company = $generic->company();
		$notify_mail = object([
			"subject" => ucwords("{$post->tx_type} Approved"),
			"body" => "Hi {$user->first_name}, your {$post->tx_type} of $ {$post->amount} has been approved.",
			"to" => $user->email,
			"from" => $company->email,
			"from_name" => $company->name,
			"to_name" => $user->first_name,
			"template" => "success",
		]);
		$post = $messenger->sendMail($notify_mail);
		if (!empty($post->status)) {
			$db = $generic->connect();
			if (empty($tx->primary_key) && !empty($tx->id)) $tx->primary_key = $tx->id;
			$db->query("UPDATE transaction SET notify='1' WHERE id='{$tx->primary_key}'");
		}
	}
	return $post;
}

function notify_admin($primary_key)
{
	global $generic;

	$user = $generic->getFromTable("users", "id={$primary_key}");
	$user = reset($user);

	$messenger = new Messenger($generic);
	$company = $generic->company();
	$notify_mail = object([
		"subject" => "New KYC Submission",
		"body" => "{$user->first_name} {$user->last_name} has upload a KYC document and is ready for approval.",
		"to" => $generic->secondary_email,
		"from" => $company->email,
		"from_name" => $company->name,
		"to_name" => "Admin",
		"template" => "notify",
	]);
	$post = $messenger->sendMail($notify_mail);
	$post->message = "Document under Review";
	return $post;
}

function get_percent($amount, $total)
{
	return empty($total) ? 0 : ($amount * 100) / $total;
}

function get_percent_of($percent, $amount)
{
	return ($amount * $percent) / 100;
}

function number_abbr__($number)
{
	$abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'k', 0 => ''];

	foreach ($abbrevs as $exponent => $abbrev) {
		if (abs($number) >= pow(10, $exponent)) {
			$display = $number / pow(10, $exponent);
			$decimals = ($exponent >= 3 && round($display) < 100) ? 2 : 0;
			$number = number_format($display, $decimals) . $abbrev;
			break;
		}
	}

	return $number;
}

function myround($number)
{
	$fmn = new NumberFormatter("en", NumberFormatter::DECIMAL);

	return "$" . $fmn->format(round($number, 2));
}

function create_transaction_record($post)
{
	if ($post->submitType == "insert") {
		global $generic;
		$db = $generic->connect();
		$company = $generic->company();

		$sql = "INSERT INTO transaction
		(user_id, tx_no, tx_type, amount, description, account_id, paid_into, account_details, status)
		VALUES
		(?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$investtr = $db->prepare($sql);
		$company_accounts = $generic->getFromTable("coins");
		$company_accounts = reset($company_accounts);
		$post->paid_into 	= $company_accounts->symbol;
		$post->account_details 	= $company_accounts->wallet;
		$post->description = "{$post->name} Investment";
		$account_id = $post->primary_key;
		$post->tx_type = "invest";
		$txref = uniqid($post->user_id);
		$investtr->bind_param('issisissi', $post->user_id, $txref, $post->tx_type, $post->amount, $post->description, $account_id, $post->paid_into, $post->account_details, $post->status);
		if (!$investtr->execute()) {
			$post->status = 0;
			$post->message = $db->error;
		}
	}
	return $post;
}

function calculate_roi($plan = null)
{
	$date = new DateTime();
	$next = new DateTime("+{$plan->view}");
	$stop = new DateTime("+{$plan->product}");

	$reoccurr = ($next->getTimestamp() - $date->getTimestamp()) / 60;
	$duration = ($stop->getTimestamp() - $date->getTimestamp()) / 60;

	return (($duration / $reoccurr) * $plan->auto);
}


function get_upline($id = null)
{
	$upline = object(["username" => "NONE"]);
	if (!empty($id)) {
		global $generic;
		$theUpline = $generic->getFromTable("referral", "referred_id={$id}");
		if (count($theUpline)) {
			$theUpline = reset($theUpline);
			$theUpline = $generic->getFromTable("users", "id={$theUpline->referral_id}");
			$upline = reset($theUpline);
		}
	}
	return $upline;
}

function get_referral_tree($id, $refss = [])
{
	$response = null;
	$referrals = array_values(array_filter($refss, function ($x) use ($id) {
		return $x->referral_id == $id;
	}));
	if (count($referrals)) {
		$list = [1 => $referrals];
		for ($i = 2; $i <= 10; $i++) {
			$found = [];
			$cur = $list[$i - 1];
			$referred_ids = array_column($cur, "referred_id");
			$found = array_values(array_filter($refss, function ($x) use ($referred_ids) {
				return in_array($x->referral_id, $referred_ids);
			}));
			if (empty($found)) break;
			$list[$i] = $found;
		}

		$response = implode(
			"",
			array_map(function ($x, $level) {
				$active = count(array_filter($x, function ($y) {
					return $y->amount > 0;
				}));
				$total = count($x);
				return "<small class='bg-default rounded text-white mr-1 mb-1 p-1'>{$active} active of {$total} on Tier {$level}</small>";
			}, $list, array_keys($list))
		);
	}
	return $response;
}

function delete_referral_record($post)
{
	global $generic;
	if (count($post)) {
		$ids = implode("','", array_column($post, "id"));
		$db = $generic->connect();
		$db->query("DELETE FROM referral WHERE referred_id IN ('{$ids}')") or die($db->error);
	}
	return object(["status" => true, "message" => "Deleted Successfuly"]);
}

function dashboard_data($user_id)
{
	global $generic;
	global $paramControl;
	$year = date("Y");
	$response = object(["bar" => 0, "line" => object([])]);
	$investments = $generic->getFromTable("accounts", "status=1, user_id={$user_id}");

	// Algo for bar chart
	if (count($investments)) {
		$investments = array_map(
			function ($inv) {
				$date = new DateTime();
				$start = new DateTime($inv->date_created);
				$stop = new DateTime($inv->date_created);
				$stop = $stop;
				return object(
					[
						"duration" => ($stop->modify($inv->duration)->getTimestamp() - $start->getTimestamp()) / (3600 * 24),
						"milestone" => round(($date->getTimestamp() - $start->getTimestamp()) / (3600 * 24), 2)
					]
				);
			},
			$investments
		);
		$min_milestone = min(array_column($investments, "milestone"));
		$max_duration = max(array_column($investments, "duration"));
		$response->bar = round(get_percent($min_milestone, $max_duration), 2);
	}

	// Algo for line chart
	$db = $generic->connect();
	$months = array_map(function ($k) {
		return substr($k, 0, 3);
	}, (array)$paramControl->load_sources("months"));
	$query = $db->query("SELECT ROUND(SUM(amount), 2) as amount, Month(date) as date FROM transaction WHERE tx_type='topup' AND status='1' AND user_id='{$user_id}' AND YEAR(date) = '{$year}' GROUP BY MONTH(date)") or die($db->error);
	$data = [];
	while ($row = $query->fetch_object()) {
		$data[] = $row;
	}
	$data = array_remap($data, array_column($data, "date"));
	$response->line->label = array_values($months);
	$response->line->data = array_map(function ($k, $i) use ($data) {
		return isset($data[$i]) ? intval($data[$i]->amount) : 0;
	}, range(1, 12), range(1, 12));



	return $response;
}

function strip_tbn($string)
{
	return str_replace("tbn/", "", $string);
}
