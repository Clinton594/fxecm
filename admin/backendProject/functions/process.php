<?php

require_once("../controllers/Messenger.php");
require_once("../controllers/GeckoExchange.php");
// require_once("../controllers/NumberFormatter.php");
if (empty($post->case)) {
	$post = (!empty($post->case) && $post->case == "account-updates") ? $post : json_decode(file_get_contents('php://input'));
}

$currency = $paramControl->load_sources("currency");
$session = object($_SESSION);
$exclusions = ["account-updates", "getReferrals", "sendLoanRequest", "finance", "send-mail", "php-mailer"];

if (!in_array($post->case, $exclusions)) {
	if (empty($session->user_id)) die("Access Denied");
}
// $fmn = new NumberFormatter;
$fmn = new NumberFormatter("en", NumberFormatter::DECIMAL);
$fmn->setAttribute(NumberFormatter::FRACTION_DIGITS, 4);


switch ($post->case) {
	case "resendPin": //Resend Pin
		$messenger = new Messenger($generic);
		$messenger->pinAction = empty($post->pinAction) ? "login" : $post->pinAction;
		$user = $generic->getFromTable("users", "id={$session->user_id}", 1, 0)[0];
		$response = sendCode($messenger, $user);
		break;
	case "confirm-email": //Resend Pin
		// see($session);
		if (!empty($session->{$post->pinAction})) {
			if ($session->{$post->pinAction} == $post->pin) {
				unset($_SESSION[$post->pinAction]);
				$user = $generic->getFromTable("users", "id={$session->user_id}", 1, 0)[0];
				if (empty($user->status)) {
					$db->query("UPDATE users SET status='1' WHERE id='{$session->user_id}'");
				}
				$response->status = 1;
				$_SESSION["mloggedin"] = 1;
			} else $response->message = "Incorrect token";
		} else {
			$response->message = "Please Resend Code";
		}
		break;
	case "getReferrals": //
		$response->status = 1;
		$referredby = "NO ONE";
		$uplineId = "";

		$referals = $generic->getFromTable("referral", "referral_id={$post->id}", 1, 0);
		$referals = array_remap($referals, array_column($referals, "referred_id"));
		$theUpline = $generic->getFromTable("referral", "referred_id={$post->id}");
		$referalIds = implode(",", array_unique(array_keys($referals)));

		if (count($theUpline)) {
			$theUpline = reset($theUpline);
			if (count($referals)) $uplineId = ",{$theUpline->referral_id}";
			else $uplineId = $theUpline->referral_id;
		}

		$users 		= $generic->getFromTable("users", "id in ({$referalIds}{$uplineId}, $post->id)", 1, 0);
		$users 		= array_remap($users, array_column($users, "id"));

		// see($users);
		if (!empty($uplineId) && isset($users[str_replace(",", "", $uplineId)])) $referredby = $users[str_replace(",", "", $uplineId)]->username;
		$table = "<p>Referred By : <b>{$referredby}</b></p><hr/><h2>Referrals</h2>";
		$table .= "<table><thead><tr><th>S/N</th><th>Username</th><th>Date Reg</th></tr></thead>";
		foreach (array_values($referals) as $key => $x) {
			$c = $key + 1;
			if (isset($users[$x->referred_id])) {
				$user = $users[$x->referred_id];
				$date = new DateTime($user->date);
				$date = $date->format("jS M");
				$table .= "<tr><td>{$c}</td><td>{$user->username}</td><td>{$date}</td></tr>";
			}
		}
		$table .= "</td>";
		$response->data = $table;
		break;
	case "account-updates": //Resend Pin
		$increment = array_flip(arrray($paramControl->load_sources("increment")));
		$accounts = $generic->getFromTable("accounts", "id={$post->id}");
		$account = reset($accounts);
		$trade_object = json_encode(array_extract($post, ["increment", "trade_type", "trade_amount", "trade_amount", "take_profit", "stop_loss"], true));
		$transaction = (object)[
			"user_id" => $account->user_id,
			"tx_no" => uniqid($account->user_id),
			"status" => 1,
			"notify" => 1,
			"amount" => intval(str_replace("+", "", "{$increment[$post->increment]}{$post->amount}")),
			"paid_into" => "INTEREST WALLET",
			"snapshot" => "NULL",
			"temp" => $trade_object,
			"account_details" => "INTEREST WALLET",
			"account_id" => $account->id,
			"description" => "Trade {$post->increment} of {$currency}{$post->amount} from your {$account->name} account."
		];

		$response = $generic->insert($transaction, "interests");

		if ($transaction->amount > 0) {
			$response->status = $db->query("UPDATE users SET balance=balance+{$post->amount} WHERE id='{$account->user_id}'");
		} else {
			$response->status = $db->query("UPDATE accounts SET amount=amount-{$post->amount} WHERE id='{$account->id}'");
		}

		if (!empty($response->status)) {
			$messenger = new Messenger($generic);
			$switch = object(["-" => "<br/> Deducted from your {$account->name} trading capital", "+" => "<br/> Deposited into your interest wallet"]);
			$user = $generic->getFromTable("users", "id={$account->user_id}");
			$user = reset($user);
			$response = $messenger->sendMail(object([
				"subject" => "Trade Alert",
				"body" => "{$transaction->description} {$switch->{$increment[$post->increment]}}",
				"template" => "success",
				"to" => $user->email,
				"from" => $company->email,
				"from_name" => $company->name,
				"to_name" => $user->first_name,
			]));
		}
		break;
	case "convertCurrency": //Get Converstion Rates of local currencies and BTC against dollars
		require_once(absolute_filepath("{$uri->backend}controllers/GeckoExchange.php"));
		$post->coin = strtoupper($post->coin);
		$exchange = new GeckoExchange;

		$coin  	= $generic->getFromTable("coins", "symbol={$post->coin}");
		$coin 	= reset($coin);

		$usdRate  = $exchange->coinGeckoRates([$coin->coin_id]);
		$usdRate = reset($usdRate);
		$response->data = $fmn->format(($post->amount / $usdRate->price));
		$response->status = 1;
		$response->coin = $post->coin;
		break;
	case "calculator": //Serverside price calculation
		$response = ["value" => round(($post->amount / $post->rate), 2)];
		break;
	case "getCoins": //Serverside get coin prices
		$exchange = new GeckoExchange;
		$coins  = $generic->getFromTable("coins");
		$_price = $GeckoExchange->coinGeckoRates(array_column($coins, "coin_id"));

		$coins  = array_map(function ($coin) use ($_price) {
			$coin->price = $_price[$coin->symbol]->price;
			return $coin;
		}, $coins);
		$response->status = 1;
		$response->data = array_remap($coins, array_column($coins, "symbol"));
		break;
	case "withdrawal": //Serverside price calculation

		if ($post->pin == $session->withdrawal) {
			$user = $generic->getFromTable("users", "id={$session->user_id}");
			$user = reset($user);
			if ($company->other <= $post->amount) {
				if ($post->amount <= $user->balance) {
					$wallet = json_decode($user->wallet);
					$db->query("UPDATE users SET balance=balance-{$post->amount} WHERE id = {$user->id}");
					$sql =
						"INSERT INTO transaction
					(user_id, tx_no, tx_type, amount, description, account_id, paid_into, snapshot, account_details, status)
					VALUES
					(?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
					$investtr = $db->prepare($sql);

					$zero = 0;
					$amount = $fmn->format($post->amount);
					$post->description = "Withdrawal of {$currency}{$amount}";
					$post->trnx_no = uniqid($user->id);
					$post->tx_type = "withdrawal";

					$investtr->bind_param('issisisss', $user->id, $post->trnx_no, $post->tx_type, $post->amount, $post->description, $zero, $post->coin, $zero, $wallet->{$post->coin});
					if ($investtr->execute()) {
						$response->status = 1;
						$response->data = ["key" => $db->insert_id, "hash_key" => $post->trnx_no];

						// Notify Customer
						$messenger = new Messenger($generic);
						$mail = (object)[
							'subject' => "Withdrawal Alert from {$company->name}",
							'body' => "Hi, {$user->first_name}, a withdrawal request of {$currency}{$amount} has been placed on your account. \n If you did not initiate this, please contact the support immediately. Thank you for choosing {$company->name}.",
							'from' => $company->email,
							'to' => $user->email,
							'from_name' => $company->name,
							'to_name' => $user->first_name,
							'address' => $company->address,
							'user_id' => $user->id
						];
						$responseEmail = $messenger->sendMail($mail);
						$mail->to = $generic->secondary_email;
						$mail->to_name = "Administrator";
						$mail->body = "New Withdrawal request from {$user->first_name}. Login to View transaction details";
						$responseMail2 = $messenger->sendMail($mail);
					}
				} else $response->message = "Insuffient Balance";
			} else $response->message = "Amount is not up to minimum {$currency}{$company->other}";
			unset($_SESSION["withdrawal"]);
		} else $response->message = "Incorrect Token";

		break;
	case 'invest': //Create Invoice
		$user_id = $session->user_id;
		$plans = $generic->getFromTable("content", "id={$post->plan_id}, status=1");
		$user = $generic->getFromTable("users", "id={$session->user_id}, status=1")[0];
		if (count($plans)) {
			$thisplan = reset($plans);
			$zero = 0;

			$post->amount = intval($post->amount);
			$thisplan->business = intval($thisplan->business);
			if (($post->amount >= $thisplan->business && $post->amount <= $thisplan->label) || $thisplan->business === $post->amount && $post->amount <= $user->Balance) {
				$db->query("UPDATE users SET balance=balance-{$post->amount} WHERE id='{$user_id}'");

				$next_unlock = date("Y-m-d H:i:s", strtotime("+{$thisplan->view}", strtotime(date("Y-m-d H:i:s"))));
				$sql = "INSERT INTO accounts
				(user_id, plan, name, status, identify, roi, amount, duration, next_unlock, reoccur)
				VALUES
				(?, ?, ?, 1, ?, ?, ?, ?, ?, ?)";
				$invest = $db->prepare($sql) or die($db->error);

				$invest->bind_param('iisssssss', $user->id, $thisplan->id, $thisplan->title, $thisplan->type, $thisplan->auto, $post->amount, $thisplan->product, $next_unlock, $thisplan->view);


				if ($invest->execute()) {
					$sql =
						"INSERT INTO transaction
						(user_id, tx_no, tx_type, amount, description, account_id, status)
						VALUES
						(?, ?, ?, ?, ?, ?, 1)";
					$investtr = $db->prepare($sql);
					$post->description = $db->real_escape_string("{$thisplan->title} Investment");
					$post->trnx_no = uniqid($user_id);
					$post->tx_type = "invest";


					$investtr->bind_param('ississ', $user_id, $post->trnx_no, $post->tx_type, $post->amount, $post->description, $db->insert_id);
					if ($investtr->execute()) {
						$response->status = 1;
						$response->data = ["key" => $db->insert_id, "hash_key" => $post->trnx_no];
					} else $response->message = $db->error;
				} else $response->message = $db->error;
			} else $response->message = "Enter correct price range";
		} else $response->message = "Investment is currenly unavailable";
		break;

	case 'fund-account': //Fund Account
		if (!empty($post->PSys)) {
			$coin = $generic->getFromTable("coins", "id={$post->PSys}");
			$coin = reset($coin);
		} else {
			$bank = $paramControl->load_sources("wire-transfer");
			$coin = object(["symbol" => $bank->Currency, "qr_code" => "", "wallet" => $bank->{"Account Number"}]);
		}
		$post->trnx_no = uniqid($session->user_id);
		$post->tx_type = "invoice";
		$post->description = "Account Deposit of {$currency}{$post->amount}";
		$sql =
			"INSERT INTO transaction
					(user_id, tx_no, tx_type, amount, account_id, paid_into, snapshot, account_details, status, description)
					VALUES
					(?, ?, ?, ?, 0, ?, ?, ?, 0, ?)";
		$investtr = $db->prepare($sql);

		$investtr->bind_param('ississss', $session->user_id, $post->trnx_no, $post->tx_type, $post->amount, $coin->symbol, $coin->qr_code, $coin->wallet, $post->description);
		if ($investtr->execute()) {
			$response->status = 1;
			$response->data = ["key" => $db->insert_id, "hash_key" => $post->trnx_no];
		}
		break;

	case "notify-deposit":
		$transaction = $generic->getFromTable("transaction", "id={$post->InvID}, user_id='{$session->user_id}', tx_type=invoice");

		if (count($transaction)) {
			$transaction = reset($transaction);

			$user = $generic->getFromTable("users", "id={$transaction->user_id}");
			$user = reset($user);

			$update = $db->query("UPDATE transaction SET tx_type='deposit' WHERE id='{$transaction->id}'");

			if ($update) {
				$messenger = new Messenger($generic);
				$mail = (object)[
					'subject' => "New {$company->name} Investment !!!",
					'body' => "Hi, {$user->first_name},  we just recieved a payment notification of {$currency}{$transaction->amount}. \n Please be patient while our team verifies the payment, your account balance would be automatically updated as soon your payment verification is completed. Thank you for choosing {$company->name}.",
					'from' => $company->email,
					'to' => $user->email,
					'from_name' => $company->name,
					'to_name' => $user->first_name,
					'address' => $company->address,
					'template' => "notify"
				];
				$response = $messenger->sendMail($mail);
				// NOtify admin
				$mail->to = $generic->secondary_email;
				$mail->to_name = "Administrator";
				$mail->body = "New Payment from {$user->first_name}. Login to View transaction details";
				$responseMail2 = $messenger->sendMail($mail);
				$response->message = "Successful";
			} else $response->message = $db->error;
		} else $response->message = "Invoice is no longer available";
		break;

	case "confirm-investment":
		$duration = $paramControl->load_sources("lock_duration");
		$transaction = $generic->getFromTable("transaction", "id={$post->InvID}, tx_type=invoice");
		if (count($transaction)) {
			$transaction = reset($transaction);
			$zero = 0;

			// Get the plan info
			$thisplan = $generic->getFromTable("content", "id={$transaction->account_id}");
			$thisplan = reset($thisplan);

			// Get the user info
			$user = $generic->getFromTable("users", "id={$transaction->user_id}");
			$user = reset($user);

			if (($transaction->amount >= $thisplan->business && $transaction->amount <= $thisplan->label) || $thisplan->business === $transaction->amount) {

				$next_unlock = date("Y-m-d H:i:s", strtotime("+{$duration}", strtotime(date("Y-m-d H:i:s"))));
				$sql = "INSERT INTO accounts
				(user_id, plan, name, capital, status, paid, date_created, identify, roi, amount, duration, next_unlock, reoccur)
				VALUES
				(?, ?, ?, ?, 0, 1, now(), ?, ?, ?, ?, ?, ?)";
				$invest = $db->prepare($sql);
				$invest->bind_param('iissssssss', $user->id, $thisplan->id, $thisplan->title, $zero, $thisplan->type, $thisplan->auto, $transaction->amount, $thisplan->product, $next_unlock, $thisplan->view);
				if ($invest->execute()) {
					$update = $db->query("UPDATE transaction SET tx_type='deposit', account_id='{$db->insert_id}' WHERE id='{$transaction->id}'");
					if ($update) {
						$messenger = new Messenger($generic);
						$mail = (object)[
							'subject' => "New {$company->name} Investment !!!",
							'body' => "Hi, {$user->first_name},  we just recieved a payment notification of {$currency}{$transaction->amount} for {$thisplan->title}. \n Please be patient while our team verifies the payment, your investment would be active as soon as the verification is done. Thank you for choosing {$company->name}.",
							'from' => $company->email,
							'to' => $user->email,
							'from_name' => $company->name,
							'to_name' => $user->first_name,
							'address' => $company->address,
							'user_id' => $user->id
						];
						$responseEmail = $messenger->sendMail($mail);
						$mail->to = $generic->secondary_email;
						$mail->to_name = "Administrator";
						$mail->body = "New Payment from {$user->first_name}. Login to View transaction details";
						$responseMail2 = $messenger->sendMail($mail);
						$response->status = 1;
						$response->message = "Your payment for {$thisplan->title} has been recieved";
					}
				} else $response->message = $db->error;
			} else $response->message = "Please do not alter the price";
		} else $response->message = "This invoice is no longer available, kindly generate a new one.";
		break;

	case 'submitExchange':
		$GeckoExchange = new GeckoExchange;
		$tx_no = uniqid($session->user_id);

		$coins  	= $generic->getFromTable("coins");
		$coin 	= array_filter($coins, function ($coin) use ($post) {
			return $coin->symbol == $post->PSys;
		});
		$coin 	= reset($coin);

		$temp = array_filter($coins, function ($temp) use ($post) {
			return in_array($temp->symbol, [$post->PSys, $post->PSys2]);
		});
		$temp = array_column($temp, "coin_id");

		$_price = $GeckoExchange->coinGeckoRates($temp);

		$equivalence = ($post->amount * $_price[$post->PSys]->price) / $_price[$post->PSys2]->price;
		$equivalence = $fmn->format(round($equivalence, 4));
		$amount  = $fmn->format(round($post->amount, 4));

		$response = $generic->insert(
			object(["user_id" => $session->user_id, "tx_no" => $tx_no, "amount" => $post->amount, "description" => "Exchange of {$amount}{$post->PSys} to {$equivalence}{$post->PSys2}", "status" => 2, 'account_details' => $coin->wallet, "paid_into" => $post->PSys, "snapshot" => $coin->qr_code, "temp" => $post->PSys2]),
			"exchange"
		);
		if ($response->status) $response->tx_no = $tx_no;

		break;
	case 'confirm-exchange': //Clinent Confirms payment of exchange 
		$user = $generic->getFromTable("users", "id={$session->user_id}");
		$user = reset($user);
		$user->wallet = json_decode($user->wallet);
		$transaction = $generic->getFromTable("transaction", "id={$post->InvID}");
		if (count($transaction)) {
			$transaction = reset($transaction);
			$update = $db->query("UPDATE transaction SET account_details='{$user->wallet->{$transaction->temp}}', status='0' WHERE id='{$transaction->id}'");
			if ($update) $response->status = 1;
		} else $response->message = "This invoice is no longer available, kindly generate a new one.";

		break;
	case 'submit-wallet': // Client submit thier wallet address
		if (!empty($session->wallet) && $post->pin == $session->wallet) {
			$coins = $generic->getFromTable("coins");
			$coins = array_column($coins, "symbol");

			$addresses = json_encode(array_extract(array_filter(arrray($post)), $coins, true));
			$response->status = $db->query("UPDATE users SET wallet='{$addresses}' WHERE id='{$session->user_id}'");
			unset($_SESSION["wallet"]);
			break;
		} else $response->message = "Incorrect token";
		break;
	case 'reinvest': //Reinvest This investment
		// Get current user
		$user = $generic->getFromTable("users", "id={$session->user_id}");
		$user = reset($user);
		// Get the investement for reinvesting
		$account = $generic->getFromTable("accounts", "id={$post->plan}, user_id={$session->user_id}, status!=3");
		if (count($account)) {
			$account = reset($account);
			if ($account->amount <= $user->balance) {
				// Deduct the money from the user's balance
				$db->query("UPDATE users SET balance=balance-{$account->amount} WHERE id={$user->id}");
				$next_unlock = date("Y-m-d H:i:s", strtotime("+{$account->reoccur}", strtotime(date("Y-m-d H:i:s"))));
				// Restart the investment
				$db->query("UPDATE accounts SET date_created=now(), next_unlock='{$next_unlock}', status='1', reinvested=reinvested+{$account->amount} WHERE id={$account->id}");
				$response->status = 1;
				$response->message = "Investment restarted";
			} else $response->message = "Insufficient balance to complete operation.";
		} else $response->message = "An Error Occurred";

		break;
	case 'cancel-investment':
		// Get current user
		$user = $generic->getFromTable("users", "id={$session->user_id}");
		$user = reset($user);
		// Get the investement for reinvesting
		$account = $generic->getFromTable("accounts", "id={$post->plan}, user_id={$session->user_id}, status!=3");
		if (count($account)) {
			$account = reset($account);
			// Deduct the money from the user's balance
			$db->query("UPDATE users SET balance=balance+{$account->amount} WHERE id={$user->id}");
			// Cancel the investment
			$db->query("UPDATE accounts SET status='3' WHERE id={$account->id}");
			$response->status = 1;
			$response->message = "Investment Cancelled";
		} else $response->message = "An Error Occurred";

		break;

	case 'closeInvoice':
		$db->query("UPDATE transaction SET status='4', tx_type='cancelled' WHERE id='{$post->id}' AND user_id='{$session->user_id}'") or die($db->error);
		break;



	case "sendLoanRequest":
		$messenger = new Messenger($generic);
		$mail = (object)[
			'subject' => "New Loan Request",
			'body' => $post->msg,
			'from' => $post->email,
			'to' => $company->email,
			'from_name' => $post->name,
			'to_name' => $company->name,
			'address' => $company->address,
			'template' => "notify"
		];
		$response = $messenger->sendMail($mail);
		break;
	case 'closeInvoice':
		$db->query("UPDATE transaction SET status='4', tx_type='cancelled' WHERE id='{$post->id}' AND user_id='{$session->user_id}'") or die($db->error);
		break;

	case 'finance':
		$response->data = [];
		$sql =
			"SELECT amount, date, tx_type, user_id
			FROM transaction
			WHERE ((tx_type='deposit' OR tx_type='withdrawal') AND (cast(date as date) BETWEEN '{$post->start}' AND '{$post->stop}'))
			ORDER BY date DESC
		";
		$query = $db->query($sql) or die($db->error);
		if ($query->num_rows > 0) {
			$transactions = [];
			$users = $generic->getFromTable("users");
			$users = array_remap($users, array_column($users, "id"));
			while ($row = $query->fetch_object()) {
				$transactions[] = $row;
			}
			$grouped = array_group(array_map(function ($trx) use ($users) {
				$trx->mentor = $users[$trx->user_id]->terra;
				return $trx;
			}, $transactions), "mentor");
			$data = array_map(function ($trx, $mentor) use ($users, $fmn) {
				$return = new stdClass;
				$return->mentor = empty($users[$mentor]) ? "" : $users[$mentor]->first_name;
				$return->data = ["withdrawal" => $fmn->format(array_sum(array_column(array_filter($trx, function ($x) {
					return $x->tx_type == "withdrawal";
				}), "amount"))), "deposit" => $fmn->format(array_sum(array_column(array_filter($trx, function ($x) {
					return $x->tx_type == "deposit";
				}), "amount")))];
				return $return;
			}, $grouped, array_keys($grouped));

			$response->data = $data;
		}
		$response->status = 1;
		break;
	case 'send-mail':
		$response = sendmail($post);
		break;
	case 'php-mailer':
		$Mail = new PHPMailer();
		$response->status = 1;
		if (!in_array($generic->getServer(), $generic->getLocalServers())) {
			$subject = ucwords($post->subject);
			if (empty($post->replyTo)) $post->replyTo = $post->from;
			$Mail->AddReplyTo($post->replyTo, "RE: $subject");
			$Mail->From     = $post->from;
			$Mail->FromName = $post->from_name;
			$Mail->Body = $post->html;
			$Mail->AltBody = $post->body;
			$Mail->Subject = $subject;
			$Mail->AddAddress($post->to);
			$Mail->WordWrap = 50;
			$Mail->IsHTML(true);
			if (!empty($post->copy_to)) {
				foreach ($post->copy_to as $key => $value) {
					$Mail->AddCC = $value;
				}
			}
			if (!$Mail->send()) {
				$response->status = 0;
				$response->message = 'Error Sending email to ' . $post->to;
			} else $response->message = 'Mail Sent';
		} else $response->message = 'Mail Sent';
		break;

	default:
		return (false);
}
