<?php

function sendText($chatID, $text) {
	file_get_contents($GLOBALS[path]."/sendMessage?chat_id=".$chatID."&text=".$text);
}

function sendPhoto($chatID, $text) {
	file_get_contents($GLOBALS[path]."/sendPhoto?chat_id=".$chatID."&photo=".$text);
}

function sendVideo($chatID, $text) {
	file_get_contents($GLOBALS[path]."/sendVideo?chat_id=".$chatID."&video=".$text);
}

function sendAnimation($chatID, $text) {
	file_get_contents($GLOBALS[path]."/sendAnimation?chat_id=".$chatID."&animation=".$text);
}

function sendAudio($chatID, $text) {
	file_get_contents($GLOBALS[path]."/sendAudio?chat_id=".$chatID."&audio=".$text);
}

function sendDocument($chatID, $text) {
	file_get_contents($GLOBALS[path]."/sendDocument?chat_id=".$chatID."&document=".$text);
}

function sendVideoNote($chatID, $text) {
	file_get_contents($GLOBALS[path]."/sendVideoNote?chat_id=".$chatID."&video_note=".$text);
}

function sendLocation($chatID, $lat , $lon ) {
	file_get_contents($GLOBALS[path]."/sendLocation?chat_id=".$chatID."&latitude=".$lat."&longitude=".$lon);
}

/********* DELETE *******/
function deleteMessage ($chatId, $messageId) {
  file_get_contents($GLOBALS[path]."/deleteMessage?chat_id=".$chatId."&message_id=".$messageId);
}


/********** SEND CAPTION **********************/
function sendCaption($sendType, $chatId, $fileId, $captionText){
	$send = strtolower(substr($sendType, 4));
	file_get_contents($GLOBALS[path]."/".$sendType."?chat_id=".$chatId."&".$send."=".$fileId."&caption=<b>".$captionText."</b>&parse_mode=html"); 
}

?>