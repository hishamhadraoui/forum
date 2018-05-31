<?php
global $gets, $agets, $dbc, $topic_row,$pg,$body,
$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,
$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$fr,$is_admin,$notifications ;
$body = "friends";
$title = "الأصدقاء";
include ("system/header.php");
if($usergroup == 0){
	$user->redirect('index.php');
}else{
	


echo'<br><br>';
echo'<ul class="list-group">
		<li class="list-group-item active"><font color="#fff">&nbsp;قائمة أصدقائي ('; echo $fr->my_friends($me,'num'); echo')</font></li>
		<div class="">
		<span>'; echo $fr->my_friends($me,'list'); echo' </span>
		</div>
	</ul>';			
echo'<br><br>';


if(type == 'add'){
	echo'<center><tr><table><tr><td class="alert alert-info" colspan="4" width="800"><center>';
		echo $fr->requiest_friend(u);
			echo'<br><a href="home.php">العودة للرئيسية</a>';
		echo'<br><a href="users.php?u='.u.'">أنقر هنا للرجوع للبروفايل</a>';
	echo'</td></tr></table></tr>';
}


if(type == 'accept'){
	echo'<center><tr><table><tr><td class="alert alert-info" colspan="4" width="800"><center>';
		echo $fr->accept_fr(u);
			echo'<br><a href="home.php">العودة للرئيسية</a>';
		echo'<br><a href="users.php?u='.u.'">أنقر هنا للرجوع للبروفايل</a>';
	echo'</td></tr></table></tr>';	
}
echo'<br><br><br><br>';





}include('system/footer.php');

?>