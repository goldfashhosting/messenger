<?php

/**
 * @package glow
 * @version 2.0
 */
/*
Plugin Name: Messenger
Plugin URL: http://goldfash.com?plugins
Description: GLOW provides various functions for GMWP+. GLOW is also the heartbeat of using GMWP+.
Version: 2.0
Author: GOD1ST.Cloud Developers
Author URI:        http://GOD1st.Cloud
Contributors:      raceanf
Domain Path:       /languages
Text Domain:       glow
GitHub Plugin URI: https://github.com/goldfashhosting/messenger
GitHub Branch:     master
*/

function messenger(){

// parameters
$hubVerifyToken = 'goldmanagement';
$accessToken =   "EAAB7UP1IpbEBAEn68IYYm1tEt5RdZCSlZAje0X0Jz4MMlUzf9ZCdZBivXeC01q0LdrrZC3P6mtfcKffEKPkhplSEhSldZBGLMPolRWxRG9hj9v3eQ8p0ZCfKw4xyuaVntCGrE1ZBo0TMoEcmoHSvj7l6SQpWjphSuhWipZCy0b8jplAZDZD";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}
// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];
$response = null;
//set Message
if($messageText == "hi") {
    $answer = "Hello";
}
//send message to facebook bot
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
if(!empty($input)){
$result = curl_exec($ch);
}
curl_close($ch);
}
add_shortcode('messenger', 'messenger');