<?php

/**
*

//bduss 贴吧类似cookies一样的东西
//fid 贴吧的编号
//tid 贴吧的帖子编号
//pid 帖子的回复楼层编号,
//cid 回复楼层的楼中楼编号
*
*
*/

	ini_set('default_charset','utf-8') ;

	define('SYSTEM_ROOT','App');
	include "class.misc.php" ;
	include "class.wcurl.php";
	include "sfc.functions.php";
	
	//贴吧账号的唯一标识
	$bduss=
	"请填入你的Budss";
	
if($_REQUEST["kw"]){
	$kw =$_REQUEST["kw"];
	if($kw=="like"){
		echo("获取喜欢的贴吧列表");
		Like($bduss);
	}else {
		echo("准备签到吧:".$_SERVER["kw"]);
		Sign($kw,$bduss);
	}
}else {
	echo("没有收到参数");
}


//Like($bduss);	
//Sign("我们都是超能2力者",$bduss);
	
//查询喜欢的贴吧列表
function Like($bduss) {
	$user['uid']=1;
	$user['bduss']=$bduss;
	$user['id']=1;
	$user['userid']=1;
	
	$mi = new misc();
	$mi->scanTiebaByPid($user);
}

//对具体某个贴吧签到
function Sign($kw,$bduss) {
	$uid = 1;
	$id = 1;
	$pid = $bduss;
	
	$mi = new misc();
	$fid = $mi->getFid($kw);
	$ck = $bduss;
	
	$result = json_decode($mi->DoSign_Client($uid,$kw,$id,$pid,$fid,$ck),true);

	print_r($result);

	if($result['error_code'] == $sucess_id){
		echo ($kw."吧-签到成功！");
	}else{
		echo ($kw.'吧-签到失败!');
	}
}	
	

?>