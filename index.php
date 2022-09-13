<?php
session_start();
require_once("admin/controllers/Controllers.php");
require_once("admin/controllers/GeckoExchange.php");

$generic = new Generic;
$generic->connect();
$company = $generic->company();
$uri = $generic->getURIdata();

if (!empty($company->lock_site)) die("The website is currently unavailable");

$paramControl = new ParamControl($generic);
$session = object($_SESSION);

$forExchange = new GeckoExchange;
$currency = $paramControl->load_sources("currency");

$ext = pathinfo($uri->page_source, PATHINFO_EXTENSION);
if (!empty($ext)) {
  $url = $_SERVER['REQUEST_URI'];
  $url = str_replace(".$ext", "", $url);
  header("Location: $url");
}
$fmn = new NumberFormatter("en", NumberFormatter::DECIMAL);
$fmn->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);

$valid_pages = [
  '' => "views/home.php",
  'markets' => "views/markets.php",
  'education' => "views/education.php",
  'home2' => "views/home1.php",
  'faq' => "views/faq.php",
  'contact' => "views/contact.php",
  'about' => "views/about.php",
  'terms' => "views/terms-and-conditions.php",
  'sign-in' => "views/signin.php",
  'sign-up' => "views/signup.php",
  'referral' => "views/signup.php",

  'confirm-email' => "{$generic->dashboard}views/client-confirm-email.php",
  'kyc-verification' => "{$generic->dashboard}views/client-kyc.php",
  // 'sign-up' => "{$generic->dashboard}views/client-signup.php",
  // 'sign-in' => "{$generic->dashboard}views/client-signin.php",
  'sign-out' => "views/client-auth-redirect.php",
  'account' => "{$generic->dashboard}views/client-dashboard.php",
  'trading' => "{$generic->dashboard}views/client-trading.php",
  'invest' => "{$generic->dashboard}views/client-invest.php",
  'fund-account' => "{$generic->dashboard}views/client-funding.php",
  'payment' => "{$generic->dashboard}views/client-payment.php",
  'withdraw' => "{$generic->dashboard}views/client-withdraw.php",
  'settings' => "{$generic->dashboard}views/client-settings.php",
  'wallets' => "{$generic->dashboard}views/client-settings.php",
  'transactions' => "{$generic->dashboard}views/client-transactions.php",
  'operations' => "{$generic->dashboard}views/client-payment.php",
  'join-affiliate' => "{$generic->dashboard}views/client-settings.php",
];
$cache_control = "?rul";
$company->logo_ref .= $cache_control;
$company->favicon .= $cache_control;
$company->favicon2 .= $cache_control;

$page_exists = isset($valid_pages[$uri->page_source]);
if ($page_exists == true) {
  require_once("{$valid_pages[$uri->page_source]}");
} else {
  require_once("{$generic->dashboard}views/client-errors-404.php");
}
