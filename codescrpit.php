<?php
//color
$reset = "\033[0m";  // Text Reset

function black($a){
if($a==1){
return"\033[1;30m";// BLACK Bold
}
if($a==0){
return"\033[0;30m"; // BLACK
}}
function red($a){
if($a==1){
return"\033[1;31m";//red Bold
}
if($a==0){
return"\033[0;31m";//red
}}
function green($a){
if($a==1){
return"\033[1;32m";//green Bold
}
if($a==0){
return"\033[0;32m";//green
}}
function yellow($a){
if($a==1){
return"\033[1;33m";//YELLOW Bold
}
if($a==0){
return"\033[0;33m";  //YELLOW
}}
function blue($a){
if($a==1){
return"\033[1;34m";    // BLUE Bold
}
if($a==0){
return"\033[0;34m";    // BLUE
}}
function purple($a){
if($a==1){
return"\033[1;35m";  // PURPLE Bold
}
if($a==0){
return"\033[0;35m";  // PURPLE
}}
function cyan($a){
if($a==1){
return"\033[1;36m";    // CYAN Bold
}
if($a==0){
return"\033[0;36m";    // CYAN 
}}
function white($a){
if($a==1){
return"\033[0;37m";   // WHITE Bold
}
if($a==0){
return"\033[0;37m";   // WHITE
}}


//stater_line
function stater_line(){
$green = "\e[1;32m";$blue = "\e[1;34m";
$red = "\e[1;31m";$white = "\33[37;1m";
$yellow = "\e[1;33m";$cyan = "\e[1;36m";
$purple = "\e[1;35m";$gray = "\e[1;30m";
return $red . '|' . $green . '==' . $blue . '==' . $white . '==' . $yellow . '==' . $cyan . '==' . $purple . '==' . $gray . '==' . $red . '==' . $green . '==' . $blue . '==' . $white . '==' . $yellow . '==' . $cyan . '==' . $purple . '==' . $gray . '==' . $red . '==' . $green . '==' . $blue . '==' . $white . '==' . $yellow . '==' . $cyan . '==' . $purple . '==' . $gray . '==' . $green . '|' ."\n";
}
//slow stater_line
function slow_stater_line(){
return slow(stater_line(),9000);
}
//slow
function slow($str,$t){
  $arr = str_split($str);
  foreach ($arr as $az)
  {echo $az;usleep($t);}
}
//slow1sec
function slow_onesec($str){
slow($str,10000);
usleep(100000);
echo"\r                          \r";
slow("\033[0;31mDelecet.....\033[0m",10000);
usleep(100000);
echo"\r                          \r";
}
//save
function save($data, $data_post){
if (!file_get_contents($data)) {
file_put_contents($data, "[]");}
$json = json_decode(file_get_contents($data), 1);
$arr = array_merge($json, $data_post);
file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));}

//curl 
function curl($url, $post = 0, $httpheader = 0, $proxy = 0)
{  
$ch = curl_init();
curl_setopt($ch
  ,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch
  ,CURLOPT_TIMEOUT, 60);
curl_setopt($ch
  ,CURLOPT_COOKIE, true);
curl_setopt($ch
  ,CURLOPT_ENCODING, "");
curl_setopt($ch
  ,CURLOPT_COOKIEFILE,"cookie.txt");
curl_setopt($ch
  ,CURLOPT_COOKIEJAR,"cookie.txt");
if($post) 
{
curl_setopt($ch
  ,CURLOPT_POST, true);
curl_setopt($ch
  ,CURLOPT_POSTFIELDS, $post);
}
if($httpheader) 
{
curl_setopt($ch
  ,CURLOPT_HTTPHEADER, $httpheader);
}
if($proxy) 
{
curl_setopt($ch
  ,CURLOPT_HTTPPROXYTUNNEL, true);
curl_setopt($ch
  ,CURLOPT_PROXY, $proxy);
curl_setopt($ch,CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
}
curl_setopt($ch
  ,CURLOPT_HEADER, true);
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch);
if(!$httpcode) 
{
return "Curl Error : " . curl_error($ch);
} else {
$header = substr($response, 0,curl_getinfo($ch,CURLINFO_HEADER_SIZE));
$body = substr($response,curl_getinfo($ch, CURLINFO_HEADER_SIZE));
curl_close($ch);
return array($header,$body);}
}

//loading
function loading($t,$ts){
$symbols = ['-', '\\', '|', '/'];
$symboled = ['(-)', '(\\)', '(|)', '(/)'];
$totalIterations = $t;
$sc=1;
for ($i = 0; $i < $totalIterations; $i++) {
$var=["\e[0;31m","\e[0;32m","\e[0;33m","\e[0;34m","\e[0;35m","\e[0;36m","\e[0;37m","\e[0;91m","\e[0;92m","\e[0;99m","\e[0;94m","\e[0;95m","\e[0;96m","\e[0;97m"];
$var1=count($var) - 1;
$var2=rand(0,$var1);
$var=$var[$var2];
if($sc>=6){$sc=1;}
$r=str_repeat("-",$sc);
$symbolIndex = $i % count($symbols);
echo($var.$symbols[$symbolIndex] . ' Loading'.$r.$symboled[$symbolIndex]);
usleep($ts);
echo"\r                          \r";
$sc=$sc+1;}}
//time
function tims($time){
$a=time() + $time;
$symbols = ['-', '\\', '|', '/'];
$symboled = ['(-)', '(\\)', '(|)', '(/)'];
for ($i = 0; $i < $time; $i++) {
  $res = $a - time();
  $var=["\e[0;31m","\e[0;32m","\e[0;33m","\e[0;34m","\e[0;35m","\e[0;36m","\e[0;37m","\e[0;91m","\e[0;92m","\e[0;99m","\e[0;94m","\e[0;95m","\e[0;96m","\e[0;97m"];
$var1=count($var) - 1;
$var2=rand(0,$var1);
$var=$var[$var2];
$symbolIndex = $i % count($symbols);
$sn=1000;
slow("               ".$var.'['.$res.']'.'Loading...'.$symboled[$symbolIndex]." \r",$sn);
usleep(900000);
echo "\r                                      \r";}}
//noerror
function noerror(){
return error_reporting(0);
}
//showtime
function showdate(){
  date_default_timezone_set("Asia/Jakarta");
     $date = date("d-F-Y");
     $time = date("H:i");
     $day = date("l");
slow("\033[3;97mDay:=> $day $date  Time :=> $time \n",10000);}
    
function savefile($namefile){
  global $reset;
system("clear");
USER:
if(!file_exists($namefile)){
$user=readline(white(0)."User-agent".yellow(1).":".$reset);
if($user>null){
  $user1["useragent"]=$user;
  save($namefile,$user1);
}else{system("clear"); goto USER;}
COOKIE:
$cookie=readline(white(0)."Cookie".yellow(0).":".$reset);
if($cookie>null){
  $cookie1["cookie"]=$cookie;
  save($namefile,$cookie1);
}else{system("clear"); goto COOKIE;}
}}

function randomapikey(){
  $a=rand(1,2);
  if($a==1){
  $b=rand(1,16);
  return json_decode(file_get_contents("apikeyocr.json"),1)["apikeymain"]["0"]["main$b"];
  }
  if($a==2){
  $c=rand(1,30);
  return json_decode(file_get_contents("apikeyocr.json"),1)["apikeygeneral"]["0"]["general$c"];
  }}
  
  function ocr($image,$text){
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.ocr.space/parse/image',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('language' => 'eng','isOverlayRequired' => 'false','filetype' => 'png','file'=> new CURLFILE($image),'OCREngine' => '2'),
        CURLOPT_HTTPHEADER => array('apikey:'.randomapikey()),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      if($text==1){
      $ocr=$response;
      $text1=explode('","',explode('"ParsedText":"',$ocr)[1])[0];
      $text1=str_replace('\n','',$text1);
      $text1=preg_replace("/[^a-zA-Z0-9]/", "", $text1);
      return $text1;
      }elseif($text==0){
      return $response;
      }
  }




