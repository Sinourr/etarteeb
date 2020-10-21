<?php 
require_once('common.php');

require("connection.php");


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php?undefined=");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, TRUE);

curl_setopt($ch, CURLOPT_POST, TRUE);

$fields = <<<EOT
{
  "userName": "sinourr",
  "numbers": "966597832290",
  "userSender": "xxxxxx",
  "apiKey": "02bd2baaf5f2f6deb680258a047c529c",
  "msg": "This is test"
}
EOT;
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",));

$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

var_dump($info["http_code"]);
var_dump($response);





