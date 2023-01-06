<?php
require_once "PHPMailer.php";
require_once "Curl.php";
require_once __DIR__ . '../../vendor/autoload.php';

use Twilio\Rest\Client;
// use MailchimpTransactional\ApiClient;

class Messenger
{
  public $email;
  public $name;
  static $generic;
  public function __construct($generic)
  {
    self::$generic = $generic;
  }

  public function sendMail($post)
  {
    if (gettype($post) !== 'object') {
      $post = (object) $post;
    }

    if (isset($post->process_url)) { //Send online
      $response = curl_post($post);
    } else {
      $response = new stdClass;
      $response->status = 1;

      $params = ['subject', 'body', 'from', 'to', 'from_name', 'to_name'];
      foreach ($params as $field) {
        if (!isset($post->{$field})) {
          return ("$field field is not defined for sending email parameters");
        }
      }
      $company = $this::$generic->company();
      $uridata = $this::$generic->getUriData();

      $company->site = $uridata->backend;
      $post    = object(array_merge((array)$company, (array)$post));
      // unset($post->branches);
      // Required fields for various templates
      if (empty($post->template)) $post->template = "default";
      if ($post->template == "link" && empty($post->link)) return "Template requires a `link` field";
      if ($post->template == "token" && empty($post->token)) return "Template requires a `token` field";

      // Map templates to their files
      $maps = ["default" => "basic-content", "basic" => "basic-content", "token" => "kyc-tokens", "link" => "click-link", "success" => "kyc-approved", "notify" => "kyc-notification", "info" => "kyc-notification", "warning" => "kyc-pending", "letter" => "letter-format", "registeration" => "welcome"];
      if (!in_array($post->template, array_keys($maps))) return "Invalid template, use any of these template; (" . implode(", ", array_keys($maps)) . ")";

      $post->html = curl_post("{$uridata->backend}includes/email-template/{$maps[$post->template]}.php", $post);

      return self::reroute($post);
    }
  }

  private static function sendGrid($post)
  {
    $response = new stdClass;
    $uridata = self::$generic->getUriData();


    if (!in_array(self::$generic->getServer(), self::$generic->getLocalServers())) {
      $mailKey = get_env($uridata->backend, "SENDGRID");
      $ch = curl_init();
      $headers = array(
        'authorization: Bearer ' . $mailKey,
        'content-type: application/json'
      );

      $data = array(
        "personalizations" => array(array(
          "to" => array(
            array(
              "email" => $post->to,
              "name" => $post->to_name
            )
          ),
          "subject" => $post->subject
        )),
        "content" => array(array(
          "type" => "text/html",
          "value" => $post->html
        )),
        "from" => array(
          "email" => $post->from,
          "name" => $post->from_name
        ),
        "reply_to" => array(
          "email" => $post->from,
          "name" => $post->from_name
        )

      );

      curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      $response = object(["status" => 1, "message" => "Successful"]);
      curl_close($ch);
    } else $response->message = 'Mail Sent';
    return ($response);
  }

  private static function phpMailer($post)
  {
    $response = new stdClass;
    $Mail = new PHPMailer();

    if (!in_array(self::$generic->getServer(), self::$generic->getLocalServers())) {
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
    return ($response);
  }

  private static function mailChimp($post)
  {
    $uridata = self::$generic->getUriData();
    $mailKey = get_env($uridata->backend, "MAILCHIMP");

    $response = new stdClass;
    $message = [
      "from_email" => $post->from,
      "subject" => $post->subject,
      "text" => $post->body,
      "to" => [
        [
          "email" => $post->to,
          "type" => "to"
        ]
      ]
    ];
    $response = Curl::post("https://mandrillapp.com/api/1.0/messages/send", ["message" => $message, "key" => $mailKey]);
    // try {
    //   $mailchimp = new MailchimpTransactional\ApiClient();
    //   $mailchimp->setApiKey($mailKey);
    //   $response = $mailchimp->messages->send(["message" => $message]);
    //   $response->status = 1;
    // } catch (Error $e) {
    //   $response->status = 0;
    //   $response->message = 'Error Sending email to ' . $post->to;
    //   echo 'Error: ', $e->getMessage(), "\n";
    // }
    return $response;
  }

  private static function reroute($post)
  {
    $url = json_encode($post);
    $response = curl_get_content("https://cronbackups.000webhostapp.com/send-mail/?{$url}");
    return $response;
  }



  public function sendSMS($post = [])
  {
    $params = ['message', 'phone'];
    if (gettype($post) !== 'object') {
      $post = (object) $post;
    }
    foreach ($params as $field) {
      if (!isset($post->{$field})) {
        return ("$field field is not defined for sending email parameters");
      }
    }

    // Your Account SID and Auth Token from twilio.com/console
    $twilio         = json_decode(json_encode($this::$generic::$twilio));
    $account_sid    = $twilio->ACCOUNT_SID;
    $auth_token     = $twilio->AUTH_TOKEN;
    if (empty($twilio->SMS_DEFAULT)) $twilio->SMS_DEFAULT = "PHONE";
    $twilio_phone   = $twilio->{$twilio->SMS_DEFAULT};
    // In production, these should be environment variables. E.g.:
    // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

    // A Twilio number you own with SMS capabilities
    $client = new Client($account_sid, $auth_token);
    $response = new stdClass;
    try {
      $msg = $client->messages->create(
        $post->phone,
        array(
          'from' => $twilio_phone,
          'body' => $post->message,
          "statusCallback" => "http://postb.in/1234abcd"
        )
      );
      $response->status = 1;
      $response->message = "Message sent to {$post->phone}";
    } catch (\Exception $e) {
      $response->status = 0;
      $response->message = "An Error Occured";
      $response->data = $e->xdebug_message;
    }
    return $response;
  }

  public function verifyPhone($phone_number)
  {
    $response = new stdClass;
    $twilio = json_decode(json_encode($this::$generic::$twilio));
    $account_sid = $twilio->ACCOUNT_SID;
    $auth_token = $twilio->AUTH_TOKEN;
    $Twilion = new Client($account_sid, $auth_token);
    try {
      $response = $Twilion->verify->v2->services(
        $twilio->services->verify->SID
      )->verifications->create($phone_number, "sms");
      $response->message = $response->status;
      $response->status = 1;
    } catch (\Exception $e) {
      $response->status = 0;
      $response->message = "An Error Occured";
      $response->error = $e;
    }
    return ($response);
  }

  public function confirmToken($token, $phone_number)
  {
    $response = new stdClass;
    $twilio = json_decode(json_encode($this::$generic::$twilio));
    $account_sid = $twilio->ACCOUNT_SID;
    $auth_token = $twilio->AUTH_TOKEN;
    $Twilion = new Client($account_sid, $auth_token);
    try {
      $response = $Twilion->verify->v2->services(
        $twilio->services->verify->SID
      )->verificationChecks->create($token, ["to" => $phone_number]);
      $response->message = $response->status;
      $response->status = 1;
    } catch (\Exception $e) {
      $response->status = 0;
      $response->message = "An Error Occured";
      $response->error = $e;
    }
    return ($response);
  }
}
