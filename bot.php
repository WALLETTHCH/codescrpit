<?php

include("codescrpit.php");
noerror();
savefile("cfg.json");
$rd=1;
RD:
//if($xx==xx){$xx;}
function rd($rd){
return$rd;
}
function httpheader_get(){
$h[]="user-agent:".json_decode(file_get_contents("cfg.json"),1)["useragent"]["0"]["useragent1"];
$h[]="cookie:".json_decode(file_get_contents("cfg.json"),1)["cookie"]["0"]["cookie1"];
$h[]="Host:btccanyon.com";
$h[]="upgrade-insecure-requests:1";
$h[]="accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7";
return $h;
}
function httpheader_post(){
$h[]="user-agent:".json_decode(file_get_contents("cfg.json"),1)["useragent"]["0"]["useragent1"];
$h[]="cookie:".json_decode(file_get_contents("cfg.json"),1)["cookie"]["0"]["cookie1"];
$h[]="Host:btccanyon.com";
$h[]="accept:application/json, text/javascript, */*; q=0.01";
$h[]="content-type:application/x-www-form-urlencoded; charset=UTF-8";
$h[]="x-requested-with:XMLHttpRequest";
$h[]="sec-gpc:1";
return $h;
}


function account(){
return curl("https://btccanyon.com/account.html",'',httpheader_get())[1];
}

function url(){
return explode('"',explode('<base href="',account())[1])[0];}

$name=explode('<',explode('<font class="text-success">',account())[1])[0];
function bal(){
return explode('<',explode('<div class="col-9 no-space">Account Balance <div class="text-primary"><b>',account())[1])[0];}
function visit_url(){
return curl(url()."/ptc.html",'',httpheader_get())[1];}

//dashborad

system("clear");
showdate();
slow_stater_line();
loading(10,100000);
slow(white(1)."[URL WEBSITE]".red(1)."===>".green(0)." ".url()."\n",10000);
slow(white(1)."[NAME]".red(1)."===>".green(0)." ".$name."\n",10000);
slow(white(1)."[Balance]".red(1)."===>".green(0)." ".bal()."\n",10000);
slow_stater_line();
loading(10,10000);
while(1){
$visit_url=visit_url();
$hhh=explode("<",explode('<div class="alert alert-info" role="alert">',$visit_url)[6])[0];
if($hhh=="There is no website available yet!"){
  slow(white(1).$hhh.$reset,100000);
  sleep(2);
  slow("\r                                         \r",1000);
  tims(25);
  $rd=$rd+1;
  goto RD;
}
$sid=explode('"',explode('<div class="website_block" id="',$visit_url)[1])[0];
slow_onesec(white(0)."Sid:".$sid);
$key=explode("',",explode("'&key=",$visit_url)[1])[0];
$key1=str_split($key,15);
slow_onesec(white(0)."Key:".$key1[0]);
echo"\r                          \r";
$url1=url()."/surf.php?sid=".$sid."&key=".$key;
$surf_url=curl($url1,'',httpheader_get())[1];
$time=explode(";",explode("var secs =",$surf_url)[1])[0];
slow_onesec(white(0)."Time:".$time);
$token=explode("';",explode("var token = '",$surf_url)[1])[0];
$token1=str_split($token,15);
slow_onesec(white(0)."Token:".$token1[0]);
echo"\r                        \r";
if($time){
  tims($time);
}

CAP:
$data="cID=0&rT=1&tM=light";
$r_url=curl(url()."/system/libs/captcha/request.php",$data,httpheader_post())[1];
$test=$r_url;
$cap1=explode('"',explode('"',$test)[1])[0];
$cap2=explode('"',explode('"',$test)[3])[0];
$cap3=explode('"',explode('"',$test)[5])[0];
$cap4=explode('"',explode('"',$test)[7])[0];
$cap5=explode('"',explode('"',$test)[9])[0];
$cap51=str_split($cap5,10);
slow_onesec(white(0)."Captcha...".$cap51[1]);
echo"\r                         \r";
$data="cID=0&pC=".$cap5."&rT=2";
$r2_url=curl(url()."/system/libs/captcha/request.php",$data,httpheader_post())[1];

$data="a=proccessPTC&data=".$sid."&token=".$token."&captcha-idhf=0&captcha-hf=".$cap5;
$ajax=curl(url()."/system/ajax.php",$data,httpheader_post())[1];
$status=json_decode($ajax,1)["status"];
if($status==200){
$mass=json_decode($ajax,1)["message"];
$msg=explode("<",explode('<b>SUCCESS<\/b>',$ajax)[1])[0];
loading(5,10000);
slow("\r                                \r",1000);
slow("\033[1;37;41m".$msg.$reset."\n",100000);
slow("\033[1;37;46mBalance:".bal().$reset."\n",100000);
echo$reset;
slow_stater_line();
}else{
goto CAP;
}
}