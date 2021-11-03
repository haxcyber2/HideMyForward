<?php

$BOT_TOKEN = "ENTER YOUR BOT TOKEN HERE"; 

$path = "https://api.telegram.org/bot".$BOT_TOKEN;
$update = json_decode(file_get_contents("php://input"),TRUE);

require_once('allFunction.php');

$channelForward = $update["channel_post"]["forward_date"];
$botForward = $update["message"];
$botcaption = $update["message"]["reply_to_message"];
$channelCaption = $update["channel_post"]["reply_to_message"];


/***************Channel Forward***********************/

if($channelForward) {
    $fileType = $update["channel_post"];
    $chatId = $update["channel_post"]["chat"]["id"];
    $forwadMsgId = $update["channel_post"]["message_id"];
    
    //video
     if($fileType["video"]){
         $fileId = $update["channel_post"]["video"]["file_id"];
         sendVideo($chatId, $fileId);
    }
    
    //document 
    if($fileType["document"]) {
        $fileId = $update["channel_post"]["document"]["file_id"];
        sendDocument($chatId, $fileId);
    }
    
    //audio
    if($fileType["audio"]) {
        $fileId = $update["channel_post"]["audio"]["file_id"];
        sendAudio($chatId, $fileId);
    }
    
    //voice 
       if($fileType["voice"]) {
        $fileId = $update["channel_post"]["voice"]["file_id"];
        sendVideoNote($chatId, $fileId);
    }
    
    //photo
    
    if($fileType["photo"]) {
        $fileId = $update["channel_post"]["photo"][1]["file_id"];
        sendPhoto($chatId, $fileId);
    }
    //text
    if($fileType["text"]) {
        $fileId = $update["channel_post"]["text"];
        sendText($chatId, $fileId);
    }

    deleteMessage($chatId, $forwadMsgId);
}

/***************Bot Forward***********************/

if($botForward && !$botcaption) {
    $chatId = $update["message"]["chat"]["id"]; 
    $fileType = $update["message"];
    if($fileType["video"]){
         $fileId = $update["message"]["video"]["file_id"];
         sendVideo($chatId, $fileId);
    }
    
    if($fileType["document"]) {
        $fileId = $update["message"]["document"]["file_id"];
        sendDocument($chatId, $fileId);
    }
    
    if($fileType["audio"]) {
        $fileId = $update["message"]["audio"]["file_id"];
        sendAudio($chatId, $fileId);
    }
    
    if($fileType["voice"]) {
        $fileId = $update["message"]["voice"]["file_id"];
        sendVideoNote($chatId, $fileId);
    }
    
    if($fileType["photo"]) {
        $fileId = $update["message"]["photo"][1]["file_id"];
        sendPhoto($chatId, $fileId);
    }

    if($fileType["sticker"]) {
        $fileId = $update["message"]["sticker"]["file_id"];
        sendSticker($chatId, $fileId);
    }

    if($fileType["animation"]) {
        $fileId = $update["message"]["animation"]["file_id"];;
        sendAnimation($chatId, $fileId);
    }
    
    if($fileType["text"]) {
        $fileId = $update["message"]["text"];
        sendText($chatId, $fileId);
    }
}

/***************Caption on Bot***********************/

if($botcaption) {
    $chatId = $update["message"]["chat"]["id"]; 
    $fileCaption = urlencode($update["message"]["text"]);
    $fileType = $update["message"]["reply_to_message"];
    
    if($fileType["video"]){
         $fileId = $update["message"]["reply_to_message"]["video"]["file_id"];
         sendCaption("sendVideo", $chatId, $fileId, $fileCaption);
    }
    
    if($fileType["document"]) {
        $fileId = $update["message"]["reply_to_message"]["document"]["file_id"]; 
        sendCaption("sendDocument", $chatId, $fileId, $fileCaption);
    }
    
    if($fileType["audio"]) {
        $fileId = $update["message"]["reply_to_message"]["audio"]["file_id"];
        sendCaption("sendAudio", $chatId, $fileId, $fileCaption); 
    }
    
    if($fileType["voice"]) {
        $fileId = $update["message"]["reply_to_message"]["voice"]["file_id"]; 
        sendCaption("sendVoice", $chatId, $fileId, $fileCaption);
    }
    
    if($fileType["photo"]) {
        $fileId = $update["message"]["reply_to_message"]["photo"][1]["file_id"];
        sendCaption("sendPhoto", $chatId, $fileId, $fileCaption); 
    }
    
}

/***************Caption on Channel***********************/

if($channelCaption) {
    $chatId = $update["channel_post"]["chat"]["id"];
    $fileCaption = urlencode($update["channel_post"]["text"]);
    $fileType = $update["channel_post"]["reply_to_message"];
    $forwadMsgId = $update["channel_post"]["message_id"];
    
    //video
     if($fileType["video"]){
         $fileId = $update["channel_post"]["reply_to_message"]["video"]["file_id"];
         sendCaption("sendVideo", $chatId, $fileId, $fileCaption);
    }
    
    //document 
    if($fileType["document"]) {
        $fileId = $update["channel_post"]["reply_to_message"]["document"]["file_id"];
        sendCaption("sendDocument", $chatId, $fileId, $fileCaption);
    }
    
    //audio
    if($fileType["audio"]) {
        $fileId = $update["channel_post"]["reply_to_message"]["audio"]["file_id"];
        sendCaption("sendAudio", $chatId, $fileId, $fileCaption);
    }
    
    //voice 
       if($fileType["voice"]) {
        $fileId = $update["channel_post"]["reply_to_message"]["voice"]["file_id"];
        sendCaption("sendVoice", $chatId, $fileId, $fileCaption);
    }
    
    //photo
    
    if($fileType["photo"]) {
        $fileId = $update["channel_post"]["reply_to_message"]["photo"][1]["file_id"];
        sendCaption("sendPhoto", $chatId, $fileId, $fileCaption);  
    }
    deleteMessage($chatId, $forwadMsgId);
    
}

?>