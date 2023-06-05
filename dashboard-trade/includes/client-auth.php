<?php

if (!empty($session->mloggedin)) {
  $users = $generic->getFromTable("users", "id={$session->user_id}");
  if (count($users)) {

    $user = reset($users);
    if (empty($user->status) && $uri->page_source !== "confirm-email") {
      header("Location: {$uri->site}confirm-email?redir={$_SERVER['REQUEST_URI']}");
      die();
    }
    // see($user);
    if ($user->kyc_status != 1 && $uri->page_source != "kyc-verification" && $uri->page_source !== "confirm-email") {
      header("Location: {$uri->site}kyc-verification");
      die();
    }

    //Coins
    $coins  = $generic->getFromTable("coins");

    // check for USDT
    if (!in_array("USDT", array_column($coins, "symbol"))) {
      die("USDT must bee added for card payment to work");
    } else {
      $usdt = array_filter($coins, function ($coin) {
        return $coin->symbol == "USDT";
      });
      $usdt = reset($usdt);
    }

    $_price = $forExchange->getRates(array_column($coins, "symbol"));
    $coins  = array_map(function ($coin) use ($_price) {
      $coin->price = $_price[$coin->symbol]->price;
      $coin->qr_code = str_replace("tbn/", "", $coin->qr_code);
      return $coin;
    }, $coins);
  } else {
    header("Location: {$uri->site}sign-out");
    die();
  }
} else {
  header("Location: {$uri->site}sign-in?redir={$_SERVER['REQUEST_URI']}");
  die();
}
