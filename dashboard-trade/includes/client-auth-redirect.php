<?php
if ($uri->page_source === "sign-in") {
  if (!empty($session->mloggedin)) {
    header("Location: {$uri->site}account");
    die();
  }
} else if ($uri->page_source === "sign-up") {
  if (!empty($session->mloggedin)) {
    header("Location: {$uri->site}account");
    die();
  }
} else if ($uri->page_source === "sign-out") {
  unset($_SESSION["mloggedin"]);
  unset($_SESSION["user_id"]);
  unset($_SESSION["email"]);
  unset($_SESSION["username"]);
  header("Location: {$uri->site}sign-in");
  die();
} else if ($uri->page_source === "confirm-email") {
  if (!empty($user->status)) {
    header("Location: {$uri->site}account");
    die();
  }
}
