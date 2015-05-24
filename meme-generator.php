<?php
#author: https://github.com/mperezcol
require_once("memes.php");

# Grab some of the values from the slash command, create vars for post back to Slack
$command = $_POST['command'];
$token = $_POST['token'];
$username = $_POST['user_name'];
$channel = $_POST['channel_name'];
$text = $_POST['text'];

# Check the token and make sure the request is from our team 
if($token != 'oM3SUcVS3rjTDjjpcLjv39iW'){ 
  $msg = "The token for the slash command doesn't match. Check your script.";
  die($msg);
  echo $msg; 
}
# User agent
$user_agent = "Slack Meme generator/1.0 (https://github.com/mperezcol/meme_generator; oscarmp80@gmail.com)";

#Param validation
if( is_null($username) || empty($username) ){
  $username = "@slackbot";
}

#Split the parameters from slack text
$paramArray = explode(",", $text);
if((!is_null($paramArray)) && (!empty($paramArray)) ){
  $pattern = $paramArray[0];
  $upText = $paramArray[1];
  $downText = $paramArray[2];
  $channel = $paramArray[3];
  $upText = str_replace(" ", "%20", $upText);
  $downText = str_replace(" ", "%20", $downText);  
}
#Get Meme's id from the array
if( (is_null($pattern)) || (empty($pattern)) ){
  $pattern = "One Does Not Simply";
  $claveMeme = "61579";
}else{
  $claveMeme = null;
  if(!is_numeric($pattern)){
    //$claveMeme = array_search($pattern, $memesArray);
    $claveMeme = array_search(strtolower($pattern),array_map('strtolower',$memesArray));
  }else{
    $claveMeme = $pattern;
  }
}

if(is_null($upText) || empty($upText) ){
  $upText = "%20";
}
if(is_null($downText) || empty($downText) ){ 
  $downText = "%20";
}
if(is_null($channel) || empty($channel) ){
  $channel = "#random";
}

#Generating Meme's image using imgflip API and CURL
$imageUrl = "https://api.imgflip.com/caption_image?username=imgflip_hubot&password=imgflip_hubot&template_id=" . $claveMeme . 
            "&text0=". $upText ."&text1=" . $downText;
$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$imageUrl);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
$result=curl_exec($ch);
curl_close($ch);
$final = json_decode($result);

#Use Meme's image as the slack text
$finalText = "<".$final->data->url.">";

if((is_null($finalText)) || (empty($finalText))){
  $msg = "There has been a problem with imgflip API :" . $final->error_message;
  die($msg);
  echo $msg;
}

#Post to slack hook, using CURL
$data = array("channel"     => $channel,
              "username"    => "Hodor",
              "text"        => $finalText,
              "icon_emoji"  => ":hodor:");
$data_string = json_encode($data);
#Slack configured hook
$ch = curl_init('https://hooks.slack.com/services/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');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($ch);

#Print response to slack user
echo "Your MEME has been published: " . $channel;
?> 
