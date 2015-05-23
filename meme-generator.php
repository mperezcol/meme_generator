<?php

# Grab some of the values from the slash command, create vars for post back to Slack
$command = $_POST['command'];
$text = $_POST['text'];
$token = $_POST['token'];
# Check the token and make sure the request is from our team 
if($token != 'oM3SUcVS3rjTDjjpcLjv39iW'){ 
  $msg = "The token for the slash command doesn't match. Check your script.";
  die($msg);
  echo $msg;
}
# User agent
$user_agent = "Slack Meme generator/1.0 (https://github.com/mperezcol/meme_generator; oscarmp80@gmail.com)";


$array = array( 61579 => 'one does not simply', 
                438680 => 'batman slapping', 
                101470 => 'ancient aliens', 
                61532 => 'i dont always', 
                61520 => 'skeptical fry',
                347390 => 'everywhere', 
                61527 => 'y u no',
                61585 => 'bad luck',
                5496396 => 'dicaprio cheers',
                61546 => 'brace yourselves');
$upText = urldecode($_REQUEST["up"]);
$downText = urldecode($_REQUEST["down"]);
$pattern = strtolower(urldecode($_REQUEST["msj"]));

$upText = str_replace(" ", "%20", $upText);
$downText = str_replace(" ", "%20", $downText);

$clave = array_search($pattern, $array);
if($clave == null){
  $clave = "61579";
}

$imageUrl = "https://api.imgflip.com/caption_image?username=imgflip_hubot&password=imgflip_hubot&template_id=" . $clave . "&text0=". $upText ."&text1=" . $downText;
$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$imageUrl);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
$result=curl_exec($ch);
curl_close($ch);
$final = json_decode($result);

$var = $final->data->url;

?> 
<html>
  <head></head>
  <body>
      <img src="<?php echo $var; ?>" alt="meme"/>
  </body>
</html>