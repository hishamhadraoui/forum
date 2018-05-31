<?php
//namespace main\inc;

?>
<script>function getst(s){top.location.href = s.options[s.selectedIndex].value;return 1;}</script>
<script>function agetst(z){top.location.href = z.div[z.div].a;return 1;}</script>
<?php
	
	
	require_once 'class.database.php';
	//$dbc = new Database();

	$ostmt = $dbc->runQuery("SELECT * FROM ".prx."options");
	$ostmt->execute();
	$num_o = $ostmt->rowCount();
	if($num_o != false){
		while($o_row=$ostmt->fetch(PDO::FETCH_ASSOC)){
			define($o_row['option_name']."_nm" , $o_row['option_name']);
			define($o_row['option_name']."_op" , $o_row['option_value']);
		}
	}	
	
	
	
/*	
function update_option($op_name,$op_value){
try{
	$stmt = $this->conn->prepare('UPDATE options SET option_value=:op_value WHERE option_name=:op_name ');
	$stmt->bindparam(":op_value", $op_value);
	$stmt->bindparam(":op_name", $op_name);
	$stmt->execute();	
	return $stmt;	
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}				
}
*/	
	
	
	
	
function n__types($type){	
	
	if($type == 1){	$noti_type = "أعجب بموضوعك";$noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 2){$noti_type = "قام بالرد في موضوعك";	$noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 3){$noti_type = "أعجب بردك في الموضوع"; $noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 4){$noti_type = "قام بالتعليق على ردك";$noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 5){$noti_type = "أعجب بتعليقك";$noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 6){$noti_type = "قام بالرد على تعليقك"; $noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";}

	 echo $noti_type;  echo':22'; echo $noti_in;
	
	
}	
	
function notifications($user_in){
	global $gets, $agets, $dbc , $topic_row;
	$in_hide = 0;
	
$stmt = $dbc->runQuery("SELECT n.n_id, n.user_in, n.user_out, n.n_type, n.n_hide, n.t_id, n.r_id, n.xr_id,
									u1.user_id as user_in_id, u1.user_name as user_in_name, u1.user_avatar as user_in_avatar, u1.user_gender as user_in_gender,
									u2.user_id as user_out_id, u2.user_name as user_out_name, u2.user_avatar as user_out_avatar, u2.user_gender as user_out_gender
									FROM ".prx."notifications as n left join ".prx."users as u1 on (u1.user_id = n.user_in)
									left join ".prx."users as u2 on (u2.user_id = n.user_out)
									WHERE n.n_hide=:n_hide AND n.user_in=:user_in");
$stmt->execute(array('user_in'=>$user_in, 'n_hide'=>$in_hide));
$notifications = $stmt->rowCount();
$notifi ='';
			$notifi .='<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-bell"></i>';
if($notifications > 0){ $notifi .='<span id="notification_count">'.$notifications.'</span>';}
$notifi .=' &nbsp;<span class="caret"></span></a><ul class="dropdown-menu dropn"  style="padding:2px; height:300px; overflow:auto">
<li><a href="notifications.html"><center>مشاهدة الكل </a></li>
';
while($noti_row=$stmt->fetch(PDO::FETCH_ASSOC)){
	
	$user_in_id = $noti_row['user_in_id'];		$user_in_name = $noti_row['user_in_name'];	
	$user_in_avatar = $noti_row['user_in_avatar'];		$user_in_gender = $noti_row['user_in_gender'];	
	
	$user_out_id = $noti_row['user_out_id'];		$user_out_name = $noti_row['user_out_name'];	
	$user_out_avatar = $noti_row['user_out_avatar'];	$user_out_gender = $noti_row['user_out_gender'];	
	$n_id = $noti_row['n_id'];		$hide = $noti_row['n_hide'];		$type = $noti_row['n_type'];	
	$t_id = $noti_row['t_id'];		$r_id = $noti_row['r_id'];		$xr_id = $noti_row['xr_id'];
$t_img = topic_row($t_id,"img");	

	
	if($type == 1){	$noti_type = "أعجب بموضوعك";$noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 2){$noti_type = "قام بالرد في موضوعك";	$noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 3){$noti_type = "أعجب بردك في الموضوع"; $noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 4){$noti_type = "قام بالتعليق على ردك في الموضوع"; $noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 5){$noti_type = "أعجب بتعليقك"; $noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>";
	}elseif($type == 6){$noti_type = "قام بالرد على تعليقك"; $noti_in = "<a href='topic.php&id=".$t_id."&n=".$n_id."'>".topic_row($t_id,"name")."</a>"; }
if($hide ==0){
$notifi .= '					
			<li>	  
					  <div class="media">
					  <div class="media-left">
						<a href="#">
						  <img class="media-object" src="'.avatar($user_out_avatar,$user_out_gender).'" '.wh("36","36").'  style="border-radius:50%;">
						</a>
					  </div>
					  <div class="media-body">
						<h6 class="media-heading"><a href="users.php?u='.$user_out_id.'">'.$user_out_name.'</a> '.$noti_type.'</h6>
						&nbsp;&nbsp;'.$noti_in.'
					  </div>
					<div class="media-right">
						<a href="#">
						 <img class="media-object" src="'.$t_img.'" '.wh("28","32").'  style="border-radius:50%;">
						</a>
					  </div>
					   </div>
					</li>		  
					';
}else{
$notifi .= '<li class="media">لا توجد إشعارات</li>';	
}
		
}

$notifi .='	 </ul></li>';	
		return $notifi;
}	
	
	
	
	
	
	
function notifi_hide_all($user_in){
global $gets,$agets,$dbc,$topic_row,$pg,$body,$username,$useremail,$useravatar,$usergroup,$usergender,$userage,$me,
	$joining_date,$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,$user_bg,$user_to,$user_re,$my_posts,$is_admin,$notifications,
		$user;


		
$in_hide = 0;
$n_hide = 1;

$stmt = $dbc->runQuery("SELECT n.n_id, n.user_in, n.user_out, n.n_type, n.n_hide, n.t_id, n.r_id, n.xr_id,
									u1.user_id as user_in_id, u1.user_name as user_in_name, u1.user_avatar as user_in_avatar, u1.user_gender as user_in_gender,
									u2.user_id as user_out_id, u2.user_name as user_out_name, u2.user_avatar as user_out_avatar, u2.user_gender as user_out_gender
									FROM ".prx."notifications as n left join ".prx."users as u1 on (u1.user_id = n.user_in)
									left join ".prx."users as u2 on (u2.user_id = n.user_out)
									WHERE n.n_hide=:n_hide AND n.user_in=:user_in");
$stmt->execute(array('user_in'=>$user_in, 'n_hide'=>$in_hide));
$nfs = $stmt->rowCount();
$i = 1;	


while($noti_row=$stmt->fetch(PDO::FETCH_ASSOC)){

$n_id = $noti_row['n_id'];
$hide = $noti_row['n_hide'];
	
if($hide ==0){
$user->notifi_hide($n_id);
}
	
	
}
	


return 1;
}	
	
	

function forum_error($id,$row)
{
	global $gets,$agets,$dbc,$topic_row,$pg,$body,$username,$useremail,$useravatar,$usergroup,$usergender,$userage,$me,
	$joining_date,$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,$user_bg,$user_to,$user_re,$my_posts,$is_admin,$notifications ;
			
	$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_id=:id");
	$fstmt->execute(array(':id'=>$id));
	$forum_row = $fstmt->fetch(PDO::FETCH_ASSOC);	

if(group_user == 0){

$errorop = "المشاركة للأعضاء المسجلين فقط";

}elseif($forum_object->cat_lock == 1 && $moderatget1 == false){

$errorop = "الفئة مغلوقة";

}elseif($forum_object->forum_lock == 1 && $moderatget1 == false){

$errorop = "المنتدى مغلوق";

}elseif($catpost[group_user] == 0 && $moderatget1 == false){

$errorop = "المجموعة التي تنتمي إليها غير مسموح لها بالمشاركة في هذه الفئة";

}elseif($forumpost[group_user] == 0 && $moderatget1 == false){

$errorop = "المجموعة التي تنتمي إليها غير مسموح لها بالمشاركة في هذا المنتدى";

}elseif($forum_object->forum_sex == 1 && sex_user == 2 && $moderatget1 == false){

$errorop = "المشاركة للذكور فقط";

}elseif($forum_object->forum_sex == 2 && sex_user == 1 && $moderatget1 == false){

$errorop = "المشاركة للإيناث فقط";

}elseif($totaltopicsnew >= $forum_object->forum_totaltopic && $moderatget1 == false){

$errorop = "تجاوزت الحد المسموح من المواضيع لك اليوم";

}else{

$errorop = "";

}

}		

	function e_class($error,$class,$forum_id,$topic_id,$u){
	global $gets, $lvl, $dbc, $id;
	$go2__  = "";
	$tstmt = $dbc->runQuery("SELECT * FROM ".prx."topics");
	$tstmt->execute();
	$total_topics = $tstmt->rowCount();
	$rstmt = $dbc->runQuery("SELECT * FROM ".prx."replys");
	$rstmt->execute();
	$total_replys = $rstmt->rowCount();
	$ustmt = $dbc->runQuery("SELECT * FROM ".prx."users");
	$ustmt->execute();
	$total_users = $ustmt->rowCount();
	$go2__  .= '
		<tr><table>
		<tr>
		<td class="alert alert-'.$class.'" colspan="4" width="800"><center>
		'.$error.'
		<br>
		<a href="home.php">العودة للرئيسية</a>';
		
	if($forum_id != ""){
	$go2__  .= '	<br>
		<a href="topic.php&id='.$topic_id.'">أنقر هنا للرجوع للموضوع</a>';
		}	
	if($topic_id != ""){	
	$go2__  .= '	<br>
		<a href="forum.php&id='.$forum_id.'">أنقر هنا للرجوع للمنتدى</a>';
		}
	if($u != ""){	
	$go2__  .= '	<br>
		<a href="users.php?u='.$u.'">أنقر هنا للرجوع للبروفايل</a>';
		}
		
	$go2__  .= '	</td>
		</tr>
		</table></tr>	';
	return $go2__;
}	

	
	
	
	
function forum_row($id,$row)
{
	global $gets, $dbc;
	$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_id=:id");
	$fstmt->execute(array(':id'=>$id));
	$forum_row = $fstmt->fetch(PDO::FETCH_ASSOC);	
	

	if($row == "name"){
	return $forum_row['f_name'];	// forum_row($id,"name") عنوان المنتدى
	}elseif($row == "desc"){
	return $forum_row['f_desc'];
	}elseif($row == "msg"){
	return $forum_row['t_msg'];
	}elseif($row == "type"){
	return $forum_row['f_type']; 
	}elseif($row == "cat"){
	return $forum_row['f_cat'];
	}elseif($row == "icon"){
	return $forum_row['f_icon'];
	}elseif($row == "ftopics"){
	return $forum_row['f_t'];
	}elseif($row == "freplys"){
	return $forum_row['f_r']; 
	}elseif($row == "f_name"){
	return $forum_row['f_name']; 
	}elseif($row == "bgc"){
	return $forum_row['f_bgc'];
	}elseif($row == "bg"){
	return $forum_row['f_bg'];
	}elseif($row == "blog"){
	return $forum_row['f_blog'];
	}elseif($row == "gender"){
	return $forum_row['f_gender']; 
	}elseif($row == "num"){
	return $numf = $fstmt->rowCount();
	}
	
}		
	

	
function topic_row($id,$row)
{
	global $gets, $dbc;
	$tstmt = $dbc->runQuery("SELECT 	t.t_id, t.f_id, t.t_name, t.t_date, t.t_hidden, t.t_locked, t.t_cr, t.t_cl, t.t_img, t.t_msg, t.user_id, t.t_views,
										u.user_id, u.user_name, u.user_avatar, u.user_gender, u.user_to, u.user_re, u.user_group,
										f.f_id, f.f_name, f.f_icon, f.f_type, f.f_cat, f.f_r
										FROM ".prx."topics as t inner join ".prx."users as u on(t.user_id = u.user_id) 
										left join ".prx."forums as f on(f.f_id = t.f_id) 
										WHERE t.t_id=:t");
	$tstmt->execute(array(':t'=>$id));
	$topic_row = $tstmt->fetch(PDO::FETCH_ASSOC);	
	
	$user_to = $topic_row['user_to'];
	$user_re = $topic_row['user_re'];

	if($row == "name"){
	return $topic_name = $topic_row['t_name'];	// topic_row($id,"name") عنوان الموضوع
	}elseif($row == "img"){
	return $topic_img = $topic_row['t_img'];
	}elseif($row == "msg"){
	return $topic_msg = $topic_row['t_msg'];
	}elseif($row == "user_id"){
	return $author_id = $topic_row['user_id']; 
	}elseif($row == "user_name"){
	return $author = $topic_row['user_name'];
	}elseif($row == "user_gender"){
	return $author_gender = $topic_row['user_gender'];
	}elseif($row == "user_avatar"){
	return $author_avatar = $topic_row['user_avatar'];
	}elseif($row == "user_post"){
	return $author_post = $user_to + $user_re;
	}elseif($row == "user_group"){
	return $author_group = $topic_row['user_group'];
	}elseif($row == "f_id"){
	return $forum_id = $topic_row['f_id']; 
	}elseif($row == "f_name"){
	return $forum_name = $topic_row['f_name']; 
	}elseif($row == "f_icon"){
	return $forum_icon = $topic_row['f_icon'];
	}elseif($row == "t_cr"){
	return $topic_cr = $topic_row['t_cr']; 
	}elseif($row == "t_cl"){
	return $topic_cl = $topic_row['t_cl']; 
	}elseif($row == "t_date"){
	return $topic_date = $topic_row['t_date'];
	}elseif($row == "views"){
	return $topic_views = $topic_row['t_views'];
	}elseif($row == "hidden"){
	return $topic_hidden = $topic_row['t_hidden'];
	}elseif($row == "locked"){
	return $topic_locked = $topic_row['t_locked'];
	}elseif($row == "num"){
	return $numt = $tstmt->rowCount();
	}
	
}


	
function reply_row($id,$row)
{
	global $gets, $dbc;
	$tstmt = $dbc->runQuery("SELECT 	r.r_id, r.t_id, r.r_msg, r.r_date, r.r_cl, r.user_id,
										t.t_id, t.f_id, t.t_name, t.t_date, t.t_cr, t.t_cl, t.t_img, t.t_msg, t.user_id, t.t_views,
										u.user_id, u.user_name, u.user_avatar, u.user_gender, u.user_to, u.user_re, u.user_group
										FROM ".prx."replys as r inner join ".prx."topics as t on(t.t_id = r.t_id) inner join ".prx."users as u on(r.user_id = u.user_id) 
										WHERE r.r_id=:r");
	$tstmt->execute(array(':r'=>$id));
	$reply_row = $tstmt->fetch(PDO::FETCH_ASSOC);	
	
	$user_to = $reply_row['user_to'];
	$user_re = $reply_row['user_re'];

	if($row == "name"){
	return $topic_name = $reply_row['t_name'];	// reply_row($id,"name") عنوان الموضوع
	}elseif($row == "img"){
	return $topic_img = $reply_row['t_img'];
	}elseif($row == "msg"){
	return $topic_msg = $reply_row['r_msg'];
	}elseif($row == "user_id"){
	return $author_id = $reply_row['user_id']; 
	}elseif($row == "user_name"){
	return $author = $reply_row['user_name'];
	}elseif($row == "user_gender"){
	return $author_gender = $reply_row['user_gender'];
	}elseif($row == "user_avatar"){
	return $author_avatar = $reply_row['user_avatar'];
	}elseif($row == "user_post"){
	return $author_post = $user_to + $user_re;
	}elseif($row == "user_group"){
	return $author_group = $reply_row['user_group'];
	}elseif($row == "t_id"){
	return $forum_id = $reply_row['t_id']; 
	}elseif($row == "t_msg"){
	return $forum_name = $reply_row['t_msg']; 
	}elseif($row == "date"){
	return $forum_icon = $reply_row['r_date'];
	}elseif($row == "r_cl"){
	return $topic_cr = $reply_row['r_cl']; 
	}elseif($row == "t_cl"){
	return $topic_cl = $reply_row['t_cl']; 
	}elseif($row == "t_date"){
	return $topic_date = $reply_row['t_date'];
	}elseif($row == "views"){
	return $topic_views = $reply_row['t_views'];
	}elseif($row == "num"){
	return $numr = $tstmt->rowCount();
	}
	
}




function group_op($group_l,$row)
{
global $gets, $dbc;
						$gstmt = $dbc->runQuery("SELECT g.group_name,g.group_color,g.group_id, 
						t.add_topic,t.edit_mytopic,t.edit_topic,t.del_mytopic,t.del_topic,t.lock_topic,
						t.unlock_topic,t.stick_topic,t.unstick_topic,t.hidde_topic,t.unhidde_topic,t.group_l,
						r.add_reply,r.edit_myreply,r.edit_reply,r.del_myreply,r.del_reply,r.hidde_reply,r.unhidde_reply,r.group_l
						FROM ".prx."ugroups as g 
						left join ".prx."topics_op as t on(t.group_l = g.group_l) 
						left join ".prx."replys_op as r on(r.group_l = g.group_l)
						WHERE g.group_l=:group_l");
						$gstmt->execute(array(':group_l'=>$group_l));

	$group_op = $gstmt->fetch(PDO::FETCH_ASSOC);	
	

	if($row == "add_topic"){
	return $topic_name = $group_op['add_topic'];	// group_op($id,"name") عنوان المجموعة
	}elseif($row == "edit_mytopic"){
	return $topic_img = $group_op['edit_mytopic'];
	}elseif($row == "edit_topic"){
	return $topic_msg = $group_op['edit_topic'];
	}elseif($row == "del_mytopic"){
	return $author_id = $group_op['del_mytopic']; 
	}elseif($row == "del_topic"){
	return $author = $group_op['del_topic'];
	}elseif($row == "lock_topic"){
	return $author_gender = $group_op['lock_topic'];
	}elseif($row == "unlock_topic"){
	return $author_avatar = $group_op['unlock_topic'];
	}elseif($row == "stick_topic"){
	return $forum_id = $group_op['stick_topic']; 
	}elseif($row == "unstick_topic"){
	return $forum_name = $group_op['unstick_topic']; 
	}elseif($row == "hidde_topic"){
	return $forum_icon = $group_op['hidde_topic'];
	}elseif($row == "unhidde_topic"){
	return $topic_cr = $group_op['unhidde_topic']; 
	}elseif($row == "add_reply"){
	return $topic_cl = $group_op['add_reply']; 
	}elseif($row == "edit_myreply"){
	return $topic_date = $group_op['edit_myreply'];
	}elseif($row == "edit_reply"){
	return $topic_views = $group_op['edit_reply'];
	}elseif($row == "del_myreply"){
	return $topic_views = $group_op['del_myreply'];
	}elseif($row == "del_reply"){
	return $topic_views = $group_op['del_reply'];
	}elseif($row == "hidde_reply"){
	return $topic_views = $group_op['hidde_reply'];
	}elseif($row == "unhidde_reply"){
	return $topic_views = $group_op['unhidde_reply'];
	}elseif($row == "id"){
	return $topic_views = $group_op['group_id'];
	}elseif($row == "name"){
	return $topic_views = $group_op['group_name'];
	}elseif($row == "color"){
	return $topic_views = $group_op['group_color'];
	}elseif($row == "num"){
	return $numg = $gstmt->rowCount();
	}
	
	
	
	
}
	











	
	
function replys_stmt($t_id){	
	global $dbc;
$rstmt = $dbc->runQuery("SELECT  r.r_id, r.t_id, r.user_id, r.r_msg, r.r_date, r.user_id,  u.user_id, u.user_name, u.user_avatar, u.user_gender  FROM ".prx."replys as r inner join ".prx."users as u on(u.user_id = r.user_id) WHERE r.t_id=:t  ORDER BY t_id DESC");
$rstmt->execute(array(':t'=>$t_id));		
return $rstmt;	
}	

function xreplys_stmt($r_id){	
global $dbc;
$xrstmt = $dbc->runQuery("SELECT  xr.xr_id,xr.user_id,xr.xr_msg,xr.xr_date,  u.user_id, u.user_name, u.user_avatar, u.user_gender  FROM ".prx."xreplys as xr left join ".prx."users as u on(u.user_id = xr.user_id) WHERE xr.r_id=:r");
$xrstmt->execute(array(':r'=>$r_id));	
return $xrstmt;	
}	


//عدد المواضيع الموجودةفي منتدى	
function topics_count_in_forum($forum_id){
	global $dbc;
	$stmt = $dbc->runQuery("SELECT * FROM ".prx."topics WHERE f_id=:f ");
	$stmt->execute(array(':f'=>$forum_id));
	return $topics_cont = $stmt->rowCount();	
}	


//عدد الردود الموجودة في موضوع
function replys_count_in_topic($topic_id){
	global $dbc;
	$stmt = $dbc->runQuery("SELECT * FROM ".prx."replys WHERE t_id=:t ");
	$stmt->execute(array(':t'=>$topic_id));
	return $replys_cont = $stmt->rowCount();	
}	




//الإحصائيات العامة
function all_stats($array){
	global $gets, $lvl, $dbc, $id;
	$go2__  = "";
	$tstmt = $dbc->runQuery("SELECT * FROM ".prx."topics");
	$tstmt->execute();
	$total_topics = $tstmt->rowCount();
	$rstmt = $dbc->runQuery("SELECT * FROM ".prx."replys");
	$rstmt->execute();
	$total_replys = $rstmt->rowCount();
	$ustmt = $dbc->runQuery("SELECT * FROM ".prx."users");
	$ustmt->execute();
	$total_users = $ustmt->rowCount();
	$go2__  .= '
	<div class="">	
	<ul class="list-group">
	  <a href="#" class="list-group-item active disabled">الإحصائيات العامة</a>
		<li class="list-group-item"><span class="badge">'.$total_topics.'</span>المواضيع</li>
		<li class="list-group-item"><span class="badge">'.$total_replys.'</span>الردود</li>
		<li class="list-group-item"><span class="badge">'.$total_users.'</span>الأعضاء</li>
	</ul>
	</div>';
	return $go2__;
}	

//الصورة الرمزية للعضو
function avatar($avatar,$gender){
	$new_avatar = "";
    if($gender == 1){$new_avatar = "img/gender1.png";}
	elseif($gender == 2){$new_avatar = "img/gender2.png";}
	return ' '.($avatar != "" ? $avatar : $new_avatar ).' ';
}	


//مجموعات الأعضاء
function ul_group($user_id)
{
	global $gets, $lvl, $ul_group, $dbc, $id;
	$stmt = $dbc->runQuery("SELECT * FROM ".prx."users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	// $row=$stmt->fetch(PDO::FETCH_ASSOC);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$ug = $row['user_group'];
	return '<font color="'.group_op($ug,'color').'"><b>مجموعة '.group_op($ug,'name').'</b></font>';
		
}		
	
	
//مجموعات الأعضاء في قائمة منسدلة	
function groupuser($user_id){
	global $gets, $lvl, $ul_group, $dbc, $id;
	$go2__  = "";
	$go2__  .= '
	<div class="well">
	<fieldset>
	<div class="form-group">
	  <div class="col-md-12">
		<select id="selectbasic">';
	//$go2__  .= '<option><h6>إختر مجموعة من القائمة...</h6></option>';
	$stmt = $dbc->runQuery("SELECT * FROM ".prx."users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	// $row=$stmt->fetch(PDO::FETCH_ASSOC);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$ug = $row['user_group'];
	$i=1; 
	$go2__  .= '<option value="'.$ug.'">'.ul_group($ug).'</option>';	
	if($ug == 7){
	}elseif($ug <= 6){
	while($i <= 6){
	if($i == $ug){
	$i++; 
	}
	$go2__  .= '<option value="'.$i.'">'.ul_group($i).'</option>';	
	$i++;
	}
	}
	$go2__  .= '
				</select>
		  </div>
		</div>
	</fieldset>
	</div>';
	

	  
	  return $go2__;
}	
	
	
//اوصاف الإشراف للعضو	
function moderator($user_id){
	global $gets, $group_op, $dbc, $id;

$ustmt = $dbc->runQuery('select * from '.prx.'users WHERE user_id=:user_id');
$ustmt->execute(array(':user_id'=>$user_id));
$rowusers=$ustmt->fetch(PDO::FETCH_ASSOC);	
$ugroup = $rowusers['user_group']; 	
	
$stmt = $dbc->runQuery('select m.f_id,m.user_id, f.f_id, f.f_name from '.prx.'moderators as m left join '.prx.'forums as f on (m.f_id = f.f_id) WHERE m.user_id=:user_id');
$stmt->execute(array(':user_id'=>$user_id));
//$rowusers=$stmt->fetch(PDO::FETCH_ASSOC);
$go2__  = "";
//$go2__  .= group_op($ugroup,'name');
$go2__  .='<font color="'.group_op($ugroup,'color').'"><b><i class="fa fa-users"></i> '.group_op($ugroup,'name').'</b></font>';
while($mod=$stmt->fetch(PDO::FETCH_ASSOC)){
	
	if($mod['f_id'] == 0){
			$go2__  .='<br> على كل المنتديات';	
			}else{
		$go2__  .= '<br><a href="'. $mod['f_id'].'">'. $mod['f_name'].'</a>';
			}
}	
return $go2__;
}	


//الإنتقال السريع بين المنتديات	
function go2forum($array){
	global $gets, $lvl, $dbc, $id;
	$go2__  = "";
	$go2__  .= '
	<div class="well">
	<fieldset>
	<div class="form-group">
	  <div class="col-md-12">
		<select id="selectbasic"  onchange="getst(this)" class="form">';
	$go2__  .= '<option><h6>إختر منتدى من القائمة...</h6></option>';
	$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums");
	$stmt->execute();
	// $row=$stmt->fetch(PDO::FETCH_ASSOC);
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	$cid = $row['f_id'];
	if($row['f_type'] == '0'){
	$go2__  .= '<option disabled="disabled">'.$row['f_name'].'</option>';
	
	$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums where f_cat=:cid ");
	$fstmt->execute(array(':cid'=>$cid));
	while($frow=$fstmt->fetch(PDO::FETCH_ASSOC)){
	$go2__  .= '<option value="forum.php&id='.$frow['f_id'].'">'.$frow['f_name'].'</option>';	
	}
	
	}
	}
	$go2__  .= '
				</select>
		  </div>
		</div>
	</fieldset>
	</div>';
	

	  
	  return $go2__;
}
//التحكم في عدد الصفحات

function xpage($table, $id, $max, $page, $url){

global $getst, $dbc;

if($table == "replys"){
$fstmt = $dbc->runQuery("SELECT * FROM ".prx."replys  WHERE t_id=:id");
$fstmt->execute(array(':id'=>$id));
$page_num = $fstmt->rowCount();
$page_xx = "صفحات الردود";
}elseif($table == "topics"){
$fstmt = $dbc->runQuery("SELECT * FROM ".prx."topics  WHERE f_id=:id");
$fstmt->execute(array(':id'=>$id));
$page_num = $fstmt->rowCount();
$page_xx = "صفحات المواضيع";
}elseif($table == "users"){
$fstmt = $dbc->runQuery("SELECT * FROM ".prx."users  WHERE user_id=:id");
$fstmt->execute(array(':id'=>$id));
$page_num = $fstmt->rowCount();
$page_xx = "صفحات الأعضاء";
}elseif($table == "messages"){
$fstmt = $dbc->runQuery("SELECT * FROM ".prx."messages  WHERE id=:id");
$fstmt->execute(array(':id'=>$id));
$page_num = $fstmt->rowCount();
$page_xx = "صفحات الأعضاء";
}


$page_ceil = ceil($page_num / $max);

$page_ceil = ($page_ceil == 0 ? 1 : $page_ceil);

$textpage = "";

$textpage .= "<div class=\"pad\"><span style=\"color:black;font-size:12px;\">".$page_xx."</span>
<select class=\"inputselect\" onchange=\"getst(this)\">";

for($i = 1; $i <= $page_ceil; $i++){

$textpage .= "<option value=\"{$url}page={$i}\" ".(page == $i ? "selected" : "").">{$i} من {$page_ceil}</option>";

}

$textpage .= "</select></div>";

return $textpage;

}
	
	
function ypage($page_num, $max, $pg, $url){

global $getst, $dbc;

$page_ceil = ceil($page_num / $max);

$page_ceil = ($page_ceil == 0 ? 1 : $page_ceil);

$textpage = "";

$textpage .= "<div class=\"pad\"><span style=\"color:black;font-size:12px;\">الصفحات</span>
<select class=\"inputselect\" onchange=\"getst(this)\">";

for($i = 1; $i <= $page_ceil; $i++){

$textpage .= "<option value=\"{$url}pg={$i}\" ".($pg == $i ? "selected" : "").">{$i} من {$page_ceil}</option>";

}

$textpage .= "</select></div>";

return $textpage;

}	
	
	
	
	
	
	
//دالة الوقت مأخودة من نسخة عرب فوروم	
function times_date($get , $time1){

$days = array("Sun" => "الأحد" , "Mon" => "الإثنين" , "Tue" => "الثلاثاء" , "Wed" => "الأربعاء" , "Thu" => "الخميس" , "Fri" => "الجمعة" , "Sat" => "السبت");
$months = array("01" => "جانفي" , "02" => "فيفري" , "03" => "مارس" , "04" => "أفريل" , "05" => "ماي" , "06" => "جوان" , "07" => "جويلية" , "08" => "أوت" , "09" => "سبتمبر" , "10" => "أكتوبر" , "11" => "نوفمبر" , "12" => "ديسمبر");

$time1 = ($time1+(60 * 60 * 1));

$time = (time()+(60 * 60 * 1));

$y = gmdate("Y" , $time1);$m = gmdate("m" , $time1);$d = gmdate("d" , $time1);$h = gmdate("H" , $time1);$i = gmdate("i" , $time1);$s = gmdate("s" , $time1);

$ny = gmdate("Y" , $time);$nm = gmdate("m" , $time);$nd = gmdate("d" , $time);$nh = gmdate("H" , $time);$ni = gmdate("i" , $time);$ns = gmdate("s" , $time);

$history = "";

if($get == "time"){

$history .= "<span style=\"color:#490f71;\">{$h}:{$i}</span>";

}elseif($get == "date"){

$history .= "<span style=\"color:#531818;\">{$days[gmdate("D" , $time1)]}</span> <span style=\"color:#005d78;\">{$d}</span> <span style=\"color:#531818;\">{$months[$m]}</span> <span style=\"color:#005d78;\">{$y}</span>";

}elseif($get == "datetime"){

$history .= "<span style=\"color:#531818;\">{$days[gmdate("D" , $time1)]}</span> <span style=\"color:#005d78;\">{$d}</span> <span style=\"color:#531818;\">{$months[$m]}</span> <span style=\"color:#005d78;\">{$y}</span> - <span style=\"color:#490f71;\">{$h}:{$i}</span>";

}else{

$ye = ($y == $ny ? "" : "{$y}/");

if($d == $nd && $m == $nm && $y == $ny){

$history .= "<span style=\"color:#531818;\">اليوم - <span style=\"color:#490f71;\">{$h}:{$i}</span></span>";

}elseif($d == ($nd-1) && $m == $nm && $y == $ny){

$history .= "<span style=\"color:#531818;\">يوم أمس - <span style=\"color:#490f71;\">{$h}:{$i}</span></span>";

}else{

$history .= "<span style=\"color:#531818;\">{$ye}{$m}/{$d} - <span style=\"color:#490f71;\">{$h}:{$i}</span></span>";

}}

return $history;

}
	
	
function wh($w,$h){
return 'width="'.$w.'" height="'.$h.'"';
}	
	
//احصائيات الاعضاء المطورة	
	
function user_20($parm){
		global $gets, $lvl, $dbc, $id;
		if($parm == "last"){
			$title_top = "إحصائيات آخر المسجلين";	
			$where = "order by user_id desc limit 18";
			$array = array();
		
		}elseif($parm == "all"){
			$title_top = "إحصائيات آخر المسجلين";	
			$where = "WHERE f_id=:f";
			$array = array();
		}
		
	$ustmt = $dbc->runQuery("SELECT * FROM ".prx."users $where ");
	$ustmt->execute($array);
	//$total_users = $ustmt->rowCount();
	
	$ech0  = '';
	$ech0 .='<div class="">	
	<ul class="list-group">
	  <a href="#" class="list-group-item active disabled">'.$title_top.'</a>
		<li class="list-group-item"><div class="row">';
	while($urow=$ustmt->fetch(PDO::FETCH_ASSOC)){
	
	$ech0 .='<a href="users.php?u='.$urow['user_id'].'" title="'.$urow['user_name'].'">
	<img src="'.avatar($urow['user_avatar'],$urow['user_gender']).'" '.wh("32","32").' class="img-circle">
	</a>';
	
	}
	$ech0 .='</div></li></ul></div>';
	
	return $ech0;
	

}	
	
	

	

function show_in($body){
	
global $sb_home_op, $sb_users_op, $sb_profile_op, $sb_admin_op, $sb_forum_op, $sb_topic_op, $sb_post_op, $sb_login_op,
$h_blog_op, $h_forums_op, $h_mixt_op, $h_last_op, $h_sticky_op;


if($body == "home" ){
	return  sb_home_op;
}elseif($body == "users" ){
	return  sb_users_op;
}elseif($body == "profile" ){
	return  sb_profile_op;
}elseif($body == "admin" ){
	return  sb_admin_op;
}elseif($body == "forum" ){
	return  sb_forum_op;
}elseif($body == "topic" ){
	return  sb_topic_op;
}elseif($body == "login" ){
	return  sb_login_op;
}elseif($body == "post" ){
	return  sb_post_op;
}elseif($body == "blog" ){
	return  h_blog_op;
}elseif($body == "forums" ){
	return  h_forums_op;
}elseif($body == "mixt" ){
	return  h_mixt_op;
}elseif($body == "last" ){
	return  h_last_op;
}elseif($body == "sticky" ){
	return  h_sticky_op;
}

	
}	



	
	
function display_msg($msg,$type){
 $type === true ? $cssClass = "alert-success" :
   $cssClass = "alert-error";
 if($msg != ''){
 ?>
 <div class="alert <?php echo $cssClass; ?>">
 <?php echo $msg; ?>
 </div>
 <?php 
 }
}
	
	
	
	

//دالة الوقت	
function normal_time($times){
    
date_default_timezone_set('Africa/Algiers');
global $LOGIN_LEVEL;

    $year=date("Y/",$times);
    $NowYear=date("Y/");
    $month=date("m/",$times);
    $day=date("d",$times);
    $NowDay=date("d");
    $yesterday = time()-(60*1440);
    $NowDay2=date("d",$yesterday);
  if ($LOGIN_LEVEL > 2) {
    $DateTime=date("H:i",$times);
  }
  else {
    $DateTime=date("H:i",$times);
  }
    if($year==$NowYear){
        $NormalYear="";
    }
    else{
        $NormalYear=$year;
    }
    if($day==$NowDay && $year==$NowYear){
        $normal_time=$DateTime." - "."اليوم";
    }
    elseif($day==$NowDay2&&$year==$NowYear){
        $normal_time=$DateTime." - "."يوم أمس";
    }
    else{
        $normal_time=$DateTime." - ".$NormalYear.$month.$day;
    }
    return($normal_time);
}	

// دالة حساب الوقت منذ كذا..
function timeBetween($start,$end){
    	$time = $end - $start;
    
    	if($time <= 60){
    		return 'منذ بضعة ثواني';
    	}
    	if(60 < $time && $time <= 3600){
    		return round($time/60,0).' دقيقة مضت';
    	}
    	if(3600 < $time && $time <= 86400){
    		return round($time/3600,0).' ساعة مضت';
    	}
    	if(86400 < $time && $time <= 604800){
    		return round($time/86400,0).' أيام مضت';
    	}
    	if(604800 < $time && $time <= 2592000){
    		return round($time/604800,0).' أسابيع';
    	}
    	if(2592000 < $time && $time <= 29030400){
    		return round($time/2592000,0).' أشهر';
    	}
    	if($time > 29030400){
    		return date('M d y at h:i A',$start);
    	}
}	
	

	
//دالة الإعجاب بالمواضيع	
function like_topic($id,$user_id)
{
global $dbc, $me; $topic_row;

$tstmt = $dbc->runQuery("SELECT t_cl FROM ".prx."topics WHERE t_id=:id ");
$tstmt->execute(array(':id'=>$id));
$topicRow=$tstmt->fetch(PDO::FETCH_ASSOC);
$tcl = $topicRow['t_cl'];	
	
$lstmt = $dbc->runQuery("SELECT user_id FROM ".prx."topics_likes WHERE t_id=:id ");
$lstmt->execute(array(':id'=>$id));
$likeRow=$lstmt->fetch(PDO::FETCH_ASSOC);
if($lstmt->rowCount() == 1 && $likeRow['user_id'] == $user_id)
{
	
		//إعادة الإعجاب بالموضوع في حالة تم إلغاء الإعجاب من قبل
		$dl = 1;
		$date = time();
		$tstmt = $dbc->runQuery('UPDATE '.prx.'topics_likes  SET t_like=:dl, l_date=:date WHERE t_id=:id AND user_id=:user_id ');
		$tstmt->bindparam(":date", $date);
		$tstmt->bindparam(":user_id", $user_id);
		$tstmt->bindparam(":id", $id);
		$tstmt->bindparam(":dl", $dl);
		$tstmt->execute();
	
}else{
		//إضافة اعجاب جديد للموضوع
		$dl = 1;
		$date = time();
		$tstmt = $dbc->runQuery('INSERT INTO '.prx.'topics_likes (t_id, user_id, l_date, t_like) VALUES (:id, :user_id, :date, :dl)');
		$tstmt->bindparam(":date", $date);
		$tstmt->bindparam(":user_id", $user_id);
		$tstmt->bindparam(":dl", $dl);
		$tstmt->bindparam(":id", $id);
		$tstmt->execute();
		
		//إرسال إشعار للعضو بأنه تم الإعجاب بموضوعه
		$n_hide=0;$n_type=1; $r_id=0; $xr_id=0;$author_id = topic_row($id,'user_id');
		
		$tstmt = $dbc->runQuery('INSERT INTO '.prx.'notifications (t_id, user_in, user_out, n_type, r_id, xr_id, n_hide)
													 VALUES (:id, :user_in, :user_out, :n_type, :r_id, :xr_id, :n_hide)');
		$tstmt->bindparam(":n_type", $n_type);  $tstmt->bindparam(":user_out", $user_id);
		$tstmt->bindparam(":r_id", $r_id);  $tstmt->bindparam(":user_in", $author_id);
		$tstmt->bindparam(":xr_id", $xr_id); $tstmt->bindparam(":id", $id); $tstmt->bindparam(":n_hide", $n_hide);
		$tstmt->execute();
		
		
		

}
		//إحتساب عدد الإعجابات في الموضوع
		$tcl1 = $tcl + 1;
		$fstmt = $dbc->runQuery('UPDATE '.prx.'topics SET t_cl=:tcl1 WHERE t_id=:id ');
		$fstmt->bindparam(":tcl1", $tcl1);
		$fstmt->bindparam(":id", $id);
		$fstmt->execute();

return $tstmt;


}	


//دالة الإعجاب بالردود	
function like_reply($id,$user_id)
{
global $dbc, $me; $topic_row;

$tstmt = $dbc->runQuery("SELECT * FROM ".prx."replys WHERE r_id=:id ");
$tstmt->execute(array(':id'=>$id));
$replyRow=$tstmt->fetch(PDO::FETCH_ASSOC);
$rcl = $replyRow['r_cl'];	
$t_id = $replyRow['t_id'];
$replyer_id = $replyRow['user_id'];
	
$lstmt = $dbc->runQuery("SELECT user_id FROM ".prx."replys_likes WHERE r_id=:id ");
$lstmt->execute(array(':id'=>$id));
$likeRow=$lstmt->fetch(PDO::FETCH_ASSOC);
if($lstmt->rowCount() == 1 && $likeRow['user_id'] == $user_id)
{
	
		//إعادة الإعجاب بالرد في حالة تم إلغاء الإعجاب من قبل
		$dl = 1;
		$date = time();
		$tstmt = $dbc->runQuery('UPDATE '.prx.'replys_likes  SET r_like=:dl, l_date=:date WHERE r_id=:id AND user_id=:user_id ');
		$tstmt->bindparam(":date", $date);
		$tstmt->bindparam(":user_id", $user_id);
		$tstmt->bindparam(":id", $id);
		$tstmt->bindparam(":dl", $dl);
		$tstmt->execute();
	
}else{
		//إضافة اعجاب جديد للرد
		$dl = 1;
		$date = time();
		$tstmt = $dbc->runQuery("INSERT INTO ".prx."replys_likes (r_id, user_id, l_date, r_like) VALUES (:id, :user_id, :date, :dl)");
		$tstmt->bindparam(":date", $date);
		$tstmt->bindparam(":user_id", $user_id);
		$tstmt->bindparam(":dl", $dl);
		$tstmt->bindparam(":id", $id);
		$tstmt->execute();
		
		//إرسال إشعار للعضو بأنه تم الإعجاب برده
		$n_hide=0;$n_type=3; $xr_id=0;
		
		$tstmt = $dbc->runQuery("INSERT INTO ".prx."notifications (t_id, user_in, user_out, n_type, r_id, xr_id, n_hide)
													 VALUES (:t_id, :user_in, :user_out, :n_type, :r_id, :xr_id, :n_hide)");
		$tstmt->bindparam(":n_type", $n_type);
		$tstmt->bindparam(":user_out", $user_id);
		$tstmt->bindparam(":r_id", $id);
		$tstmt->bindparam(":user_in", $replyer_id);
		$tstmt->bindparam(":xr_id", $xr_id);
		$tstmt->bindparam(":t_id", $t_id);
		$tstmt->bindparam(":n_hide", $n_hide);
		
		$tstmt->execute();
		
		
		

}
		//إحتساب عدد الإعجابات في الرد
		$rcl1 = $rcl + 1;
		$fstmt = $dbc->runQuery("UPDATE ".prx."replys SET r_cl=:rcl1 WHERE r_id=:id ");
		$fstmt->bindparam(":rcl1", $rcl1);
		$fstmt->bindparam(":id", $id);
		$fstmt->execute();

return $tstmt;


}


//دالة إلغاء الإعجاب بالمواضيع
function des_like_topic($id , $user_id)
{
global $dbc, $topic_row;
	
	
		//تحديث عدد الإعجابات في الموضوع
		$tcl = topic_row($id,'t_cl');
		$tcl1 = $tcl - 1;
		$fstmt = $dbc->runQuery("UPDATE ".prx."topics SET t_cl=:tcl1 WHERE t_id=:id ");
		$fstmt->bindparam(":tcl1", $tcl1);
		$fstmt->bindparam(":id", $id);
		$fstmt->execute();

		// إلغاء الإعجاب بالموضوع.
		$dl = 0;
		$tstmt = $dbc->runQuery("UPDATE ".prx."topics_likes SET t_like=:dl WHERE t_id=:id AND user_id=:user_id ");
		
		$tstmt->bindparam(":user_id", $user_id);
		$tstmt->bindparam(":id", $id);
		$tstmt->bindparam(":dl", $dl);
		$tstmt->execute();
return 	$tstmt;	
	
}



//دالة إلغاء الإعجاب بالردود
function des_like_reply($id , $user_id)
{
global $dbc, $topic_row, $reply_row;
	
	
		//تحديث عدد الإعجابات في الموضوع
		$rcl = reply_row($id,"r_cl");
		$rcl1 = $rcl - 1;
		$fstmt = $dbc->runQuery("UPDATE ".prx."replys SET r_cl=:rcl1 WHERE r_id=:id ");
		$fstmt->bindparam(":rcl1", $rcl1);
		$fstmt->bindparam(":id", $id);
		$fstmt->execute();

		// إلغاء الإعجاب بالموضوع.
		$dl = 0;
		$tstmt = $dbc->runQuery("UPDATE ".prx."replys_likes SET r_like=:dl WHERE r_id=:id AND user_id=:user_id ");
		
		$tstmt->bindparam(":user_id", $user_id);
		$tstmt->bindparam(":id", $id);
		$tstmt->bindparam(":dl", $dl);
		$tstmt->execute();
return 	$tstmt;	
	
}


	
function likes_stmt($id){		
global $dbc;
$lstmt = $dbc->runQuery("SELECT l.t_id, l.user_id, l.l_date, l.t_like, u.user_id, u.user_name 	
										 FROM ".prx."topics_likes as l left join ".prx."users as u on(u.user_id = l.user_id)
										 WHERE t_id=:id ");
$lstmt->execute(array(':id'=>$id));
return $lstmt;	
}		

function rlikes_stmt($id){		
global $dbc;
$rlstmt = $dbc->runQuery("SELECT l.r_id, l.user_id, l.l_date, l.r_like, u.user_id, u.user_name 	
										 FROM ".prx."replys_likes as l left join ".prx."users as u on(u.user_id = l.user_id)
										 WHERE r_id=:id ");
$rlstmt->execute(array(':id'=>$id));
return $rlstmt;	
}		


function is_liker($id,$user_id)
{
	
	global $gets, $dbc;
	$tlike = 1;
	$lstmt = $dbc->runQuery("SELECT * FROM ".prx."topics_likes WHERE t_id=:id AND user_id=:user_id AND t_like=:tlike");
	$lstmt->execute(array(':id'=>$id,':user_id'=>$user_id,':tlike'=>$tlike));
	$num = $lstmt->rowCount() == 1;
	$likeRow=$lstmt->fetch(PDO::FETCH_ASSOC);
	if($num == 1)
	{		
		return true;
	}else{
		return false;
	}

}	

function is_rliker($id,$user_id)
{
	
	global $gets, $dbc;
	$rlike = 1;
	$lrstmt = $dbc->runQuery("SELECT * FROM ".prx."replys_likes WHERE r_id=:id AND user_id=:user_id AND r_like=:rlike");
	$lrstmt->execute(array(':id'=>$id,':user_id'=>$user_id,':rlike'=>$rlike));
	$rnum = $lrstmt->rowCount() == 1;
	$likeRow=$lrstmt->fetch(PDO::FETCH_ASSOC);
	if($rnum == 1)
	{		
		return true;
	}else{
		return false;
	}

}

function like_n($t_id,$me,$n_type)
{
	
	global $gets, $dbc;
//إرسال إشعار للعضو بأنه تم الرد على موضوعه
		$n_hide=0;
		$author_id = topic_row($t_id,'user_id');
		
		if($author_id != $me){
		$tstmt = $dbc->runQuery("INSERT INTO ".prx."notifications (t_id, user_in, user_out, n_type, n_hide)
													 VALUES (:id, :user_in, :user_out, :n_type, :n_hide)");
		$tstmt->bindparam(":n_type", $n_type);
		$tstmt->bindparam(":user_out", $me);
		$tstmt->bindparam(":user_in", $author_id);
		$tstmt->bindparam(":id", $t_id);
		$tstmt->bindparam(":n_hide", $n_hide);
		$tstmt->execute();
		}
		return true;
}		




	function cleanQuery($string){
		$hackerKeys=array(
			'chr(','chr=','chr%20','%20chr','wget%20','%20wget','wget(','cmd=','%20cmd','cmd%20','rush=','%20rush',
			'rush%20','union%20','%20union','union(','union=','echr(','%20echr','echr%20','echr=','esystem(',
			'esystem%20','cp%20','%20cp','cp(','mdir%20','%20mdir','mdir(','mcd%20','mrd%20','rm%20','%20mcd',
			'%20mrd','%20rm','mcd(','mrd(','rm(','mcd=','mrd=','mv%20','rmdir%20','mv(','rmdir(','chmod(',
			'chmod%20','%20chmod','chmod(','chmod=','chown%20','chgrp%20','chown(','chgrp(','locate%20','grep%20',
			'locate(','grep(','diff%20','kill%20','kill(','killall','passwd%20','%20passwd','passwd(','telnet%20',
			'vi(','vi%20','insert%20into','select%20','nigga(','%20nigga','nigga%20','fopen','fwrite','%20like',
			'like%20','$_request','$_get','$request','$get','.system','HTTP_PHP','&aim','%20getenv','getenv%20',
			'new_password','/etc/password','/etc/shadow','/etc/groups','/etc/gshadow','HTTP_USER_AGENT',
			'HTTP_HOST','/bin/ps','wget%20','uname\x20-a','/usr/bin/id','/bin/echo','/bin/kill','/bin/','/chgrp',
			'/chown','/usr/bin','g\+\+','bin/python','bin/tclsh','bin/nasm','perl%20','traceroute%20','ping%20',
			'.pl','/usr/X11R6/bin/xterm','lsof%20','/bin/mail','.conf','motd%20','HTTP/1.','.inc.php','config.php',
			'cgi-','.eml','file\://','window.open','<SCRIPT>','javascript\://','img src','img%20src','.jsp',
			'ftp.exe','xp_enumdsn','xp_availablemedia','xp_filelist','xp_cmdshell','nc.exe','.htpasswd','servlet',
			'/etc/passwd','wwwacl','~root','~ftp','.js','.jsp','.history','bash_history','.bash_history','~nobody',
			'server-info','server-status','reboot%20','halt%20','powerdown%20','/home/ftp','/home/www',
			'secure_site,ok','chunked','org.apache','/servlet/con','<script','/robot.txt','/perl',
			'mod_gzip_status','db_mysql.inc','.inc','select%20from','select from','drop%20','.system','getenv',
			'http_','_php','<?php','?>','sql=','_global','global_','global[','_server','server_','server[',
			'phpadmin','root_path','_globals','globals_','globals[','ISO-8859-1','http://www.google.de/search',
			'?hl=','.txt','.exe','union','google.de/search','yahoo.de','lycos.de','fireball.de','ISO-'
		);
		$string=@strtolower($string);
		$proString=@str_replace($hackerKeys,'******',$string);
		if($string!=$proString){
			$place=$_SERVER['REQUEST_URI'];
			$ip=ip;
			$date=$this->date(time,"",true,true,true);
			$file="crackerdetails.inc";
			$f=@fopen($file,"a");
			@chmod($file,0777);
			@fwrite($f,"$place{>:c:<}$ip{>:c:<}$date{>:r:<}\r\n");
			@fclose($f);
			$string=@htmlspecialchars($string);
			echo"
			<html dir=\"rtl\">
			<head>
			<title>عملية غير مصرح بها</title>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1256\" />
			<meta http-equiv=\"Content-Language\" content=\"ar-iq\" />
			<meta name=\"description\" content=\"Powered by DuhokForum 2.0\" />
			<meta name=\"copyright\" content=\"DuhokForum 2.0: Copyright © 2007-2010 Dilovan\" />
			<link rel=\"stylesheet\" href=\"styles/blue/blue.css\" />
			</head>
			<body>
			<center><br>
			<table width=\"99%\" border=\"1\">
				<tr>
					<td class=\"normalCenter\">
						<br><br><font size=\"2\" color=\"red\"><b>الرابط الدي اتبعثه غير صحيح أو بها عملية غير مصرحة.</b></font>
						<br><br>تم تشفير أكواد غير مصرحة بها:-<br><br>
						<span dir=\"ltr\">http://{$_SERVER['HTTP_HOST']}$proString</span><br><br>
						<hr width=\"60%\">{{ تم حفظ هذه العملية مع جميع معلوماتك, وإذا تتكرر مرة اخرى سيتم منعك من الموقع بأكمله }}<hr width=\"60%\">
						<br>قال الله تعالى : <font color=\"#000000\">((مايلفظ من قول إلا لديه رقيب عتيد ))</font> صدق الله العظيم.<br><br><br>
					</td>
				</tr>
			</table>
			</center>";
			exit();
		}
		return $proString;
	}
	
	
	function indexOf($txt,$find,$word=false,$case=false){
		$pos=stripos($txt,$find);
		$get=(is_int($pos)?$pos:-1);
		if($word){
			$sub=substr($txt,$get,strlen($find));
			return ($case?strtolower($sub):$sub);
		}
		else{
			return $get;
		}
	}
	
	function ip(){
		global $_SERVER;
		$adder='REMOTE_ADDR';
		$for='HTTP_X_FORWARDED_FOR';
		$client='HTTP_CLIENT_IP';
		if(isset($_SERVER)){
				if(isset($_SERVER["{$adder}"])){
				$ip=$_SERVER["{$adder}"];
			}
			elseif(isset($_SERVER["{$for}"])){
				$ip=$_SERVER["{$for}"];
			}
			elseif(isset($_SERVER["{$client}"])){
				$ip=$_SERVER["{$client}"];
			}
		}
		else{
				if(getenv($for)){
				$ip=getenv($for);
			}
			elseif(getenv($client)){
				$ip=getenv($client);
			}
			else{
				$ip=getenv($adder);
			}
		}
		return $ip;
	}


?>
