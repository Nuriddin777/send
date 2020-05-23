<?php

$type = $_GET['type'];
$token = $_GET['token'];
$text = urldecode($_GET['text']);
$idbaza = $_GET['id'];
$pic = $_GET['pic'];
$caption = urldecode($_GET['caption']);
$fid = $_GET['fid'];
$mid = $_GET['mid'];
$ok=0;
$no=0;
$id = file_get_contents($idbaza);
$id=explode("\n",$id);
$c = count($id);


if(isset($type) and isset($token)){



if($type == "sendMessage" and isset($text)){
$s = time();
foreach ($id as $user){
if(empty($user)) continue;
$data = [
'chat_id' => $user,
'text' => $text,
'parse_mode' => 'html',
];
$j = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?" . http_build_query($data)));
if($j->ok == "true"){
$ok= $ok+1;
}else{
$no = $no+1;
}
}
$e = time();
$n = $e-$s;
$n = date("i:s",$n);
}



if($type == "sendPhoto" and isset($pic)){
$s = time();
foreach ($id as $user){
if(empty($user)) continue;
$data = [
'chat_id' => $user,
'photo' => $pic,
'caption' => $caption,
'parse_mode' => 'html',
];
$j = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/sendPhoto?" . http_build_query($data)));
if($j->ok == "true"){
$ok= $ok+1;
}else{
$no = $no+1;
}
}
$e = time();
$n = $e-$s;
$n = date("i:s",$n);
}



if($type == "forwardMessage" and isset($fid) and isset($mid)){
$s = time();
foreach ($id as $user){
if(empty($user)) continue;
$data = [
'chat_id' => $user,
'from_chat_id' => $fid,
'message_id' => $mid,
];
$j = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/forwardMessage?" . http_build_query($data)));
if($j->ok == "true"){
$ok= $ok+1;
}else{
$no = $no+1;
}
}
$e = time();
$n = $e-$s;
$n = date("i:s",$n);
}
$result = base64_encode("<b>Jami azolar:</b> $c ta
<b>Yuborildi:</b> $ok ta
<b>Yuborilmadi:</b> $no ta
<b>Yuborish uchun sarflangan vaqt:</b> $n s");
print $result;

}else{
echo "<h1>XATO</h1>";
}
