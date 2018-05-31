<script>function getst(s){top.location.href = s.options[s.selectedIndex].value;return 1;}</script>
<script>function agetst(z){top.location.href = z.div[z.div].a;return 1;}</script>
<?php
require_once 'class.database.php';
	
	
function is_moderator($user_id,$forum_id)
{
	global $gets, $dbc;
	
	$mstmt = $dbc->runQuery("SELECT * FROM ".prx."moderators WHERE user_id=:id AND f_id=:fid");
	$mstmt->execute(array(':id'=>$user_id, ':fid'=>$forum_id));
	if($mstmt->rowCount() == 1){
		return true;		
	}else{
		return false;
	}

}	

function is_super_mode($user_id){
	global $gets, $dbc;
	$ustmt = $dbc->runQuery("SELECT user_group FROM ".prx."users  WHERE user_id=:id");
	$ustmt->execute(array(':id'=>$user_id));
	$u_row = $ustmt->fetch(PDO::FETCH_ASSOC);
	$usergroup = $u_row['user_group'];
	if($usergroup > 1){
	
	$astmt = $dbc->runQuery("SELECT * FROM ".prx."moderators WHERE user_id=:id");
	$astmt->execute(array(':id'=>$user_id));
	$f_row = $astmt->fetch(PDO::FETCH_ASSOC);
	$fid = $f_row['f_id'];
	if($astmt->rowCount() == 1 && $fid = 0){
		return true;		
	}else{
		return false;
	}
	
	}
	
	
}	
	

function is_admin($user_id){
	global $gets, $dbc;
	$ustmt = $dbc->runQuery("SELECT is_admin FROM ".prx."users  WHERE user_id=:id");
	$ustmt->execute(array(':id'=>$user_id));
	$u_row = $ustmt->fetch(PDO::FETCH_ASSOC);
	$is_admin = $u_row['is_admin'];
	
	/*if($is_admin = 1){
		return true;		
	}elseif($is_admin = 0){
		return false;
	}*/
	return $is_admin;
	
	
	
}














?>
