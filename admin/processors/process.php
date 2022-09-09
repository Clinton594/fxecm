<?php
session_start();
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Content-Type');
if (!empty($_GET["format"])) {
	header('Content-Type: application/json');
}
require_once("../controllers/Controllers.php");
$post 						= object(array_merge($_POST, $_GET));
$session  				=  ADMIN_SESSION();
$response 				= new stdClass;
$generic 			    = new Generic;
$paramControl 		= new ParamControl($generic);
$db 							= $generic->connect();
$uri 							= $generic->getURIdata();
$company 					= $generic->company();
$response->status = 0;

$case = $uri->page_source;
if (!empty($generic->backend)) { //If it has backend url
	if ($generic->islocalhost() || empty($generic->isReact)) { //If it's localhost or not react
		$case = $uri->event;
	} else if (!empty($generic->isReact)) {
		$case = $uri->content_id;
	}
}
$case = explode("?", $case);
if (gettype($case) == "array") $case = reset($case);

// Redirects
$valid_pages 			= [
	"list" 			=> "process_ajax.php",
	"delete" 		=> "process_ajax.php",
	"void"		 	=> "process_ajax.php",
	"loadform" 	=> "process_ajax.php",
	"social" 	=> "process_ajax.php",
	"login" 	=> "process_ajax.php",
	"emails" 	=> "process_ajax.php",
	"forgot-password" 	=> "process_ajax.php",
	"reset-password" 	=> "process_ajax.php",
	"submit" 	=> "process_ajax.php",
	"update-cart" 	=> "process_ajax.php",
	"delete-pin" 	=> "process_ajax.php",
	"getParameters" 	=> "process_ajax.php",
	"startUp" 	=> "process_ajax.php",
	"dropdown" 	=> "process_ajax.php",
	"dialog" 		=> "process_files.php",
	"files" 		=> "process_files.php",
	"upload" 		=> "process_files.php",
	"download" 	=> "process_download.php",
	"saveform"	=> "process_generic.php",
	"payment"  	=> "process_paystack.php",
	"reset"  		=> "process_prepare.php",
	"custom"  	=> "../backendProject/functions/process.php",
	"report"  	=> "../reports/run_report.php",
	"controllers"  		=> "process_controllers.php",
	"transaction"			=> "process_transactions.php",
	"transportation"	=> "process_transportation.php",
];

$page_exists = isset($valid_pages[$case]);

if ($page_exists == true) {
	require_once($valid_pages[$case]);
} else {
	$response->message = "Page not found";
}
$db->close();
echo json_encode($response);
