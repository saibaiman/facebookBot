<?php
$token = "##################";

$json_string = file_get_contents("php://input");
$fb_message = json_decode($json_string);
$id = $fb_message->entry[0]->messaging[0]->sender->id; //Sender's ID
$msg= $fb_message->entry[0]->messaging[0]->message->text; //Sender's Message

$data_to_send = array(
	'recipient' => array('id' => $id), //ID to reply
	'message' => array('text' => $msg) //Message to reply
);

$options_header = array ( //Necessary Headers
	'http' => array(
		'method' => 'POST',
		'content' => json_encode($data_to_send),
		'header' => "Content-Type: application/json"
	)
);
$context = stream_context_create($options_header);
file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token", false, $context);
?>


