<?php


global $gets, $agets, $dbc, $topic_row,$pg,$username,$useremail,$useravatar,$usergroup,$usergender,$userage,$joining_date,$me,$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,$user_bg,$user_to,$user_re,$my_posts;
$error = array(); $count_page = 6; $get_page = (page == "" || !is_numeric(page) ? 1 : page);	$limit_page = (($get_page * $count_page) - $count_page);
	
		$numf = forum_row(id, "num");
		if($numf == 0){	$error[] = "رقم المنتدى خاطئ";	}elseif($numf == 1){
		$forum_id = id;                             // $forum_row['f_id'];
		$forum_name = forum_row(id, "name"); 		 // $forum_name = $forum_row['f_name'];
		$forum_icon = forum_row(id, "icon"); 		 // $forum_name = $forum_row['f_icon'];
		$forum_type = forum_row(id, "type");		 // $forum_name = $forum_row['f_type'];
		$forum_cat = forum_row(id, "cat");  		 // $forum_name = $forum_row['f_cat'];
		$forum_bgc = forum_row(id, "bgc");  		 // $forum_name = $forum_row['f_bgc'];
		$forum_bg = forum_row(id, "bg");  		 // $forum_name = $forum_row['f_bg'];
		$forum_blog = forum_row(id, "blog"); 		 // $forum_name = $forum_row['f_blog'];
			
		?>
		<style>
		body{
			background: url(<?php echo $forum_bg;?>);
			background-repeat: no-repeat;
			background-size: 100% 100%;
			}
		</style>
		<?php
if($usergroup == 0){echo'<div class="form-editor">';}			
				
		echo'
		<ul class="list-group"><li class="list-group-item active">';	 
if(is_admin($me) == 1){
		echo' <span class="badge">
			<a href="admin.php?op=forums&type=edit&id='.$forum_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			 </span>';
}	
		echo'<a href="forum.php&id='.$forum_id.'"><img src="'.$forum_icon.'" width="32" height="32"><font color="#fff">&nbsp; '.$forum_name.'</font></a></li>';	
		
		// echo go2forum($array);
		echo '<br />
		<ul class="nav nav-pills walet" role="tablist">
		<li role="presentation" class="active disabled"><a href="#">المواضيع <span class="badge">'.topics_count_in_forum($forum_id).'</span></a></li>
		<li role="presentation" class="active disabled">';
		echo'</li>';
if(group_op($usergroup,"add_topic") == 1){
		echo'<li role="presentation"  class="active  navbar-left"><a href="post.php?type=addtopic&id='.id.'">موضوع جديد</a></li>';	
}
		echo'</ul></ul>';	


		$tstmt = $dbc->runQuery("SELECT t.t_id, t.f_id, t.t_name, t.t_msg, t.t_date, t.t_img, t.user_id, t.t_locked, t.t_sticky, t.t_hidden, 
		u.user_id, u.user_name, u.user_avatar, u.user_gender   FROM ".prx."topics as t inner join ".prx."users as u on(t.user_id = u.user_id) 
		WHERE t.f_id=:f order by t_sticky DESC, t_date DESC limit ".$limit_page.",".$count_page." ");
		$tstmt->execute(array(':f'=>$forum_id));
		$numt = $tstmt->rowCount();
	
if($numt == 0){	$error[] = "لم يتم طرح مواضيع بالمنتدى بعد...";	 }else{


if($forum_blog == 0){  echo'<ul class="w3-ul w3-card-4" style="100%">';	




while($topic_row = $tstmt->fetch(PDO::FETCH_ASSOC)){
		
		$topic_id = $topic_row['t_id'];		$topic_name = $topic_row['t_name'];
		$topic_img = $topic_row['t_img'];		$author_id = $topic_row['user_id'];
		$author = $topic_row['user_name'];		$author_avatar = $topic_row['user_avatar'];
		$author_gender = $topic_row['user_gender'];		$topic_date = $topic_row['t_date'];
		$topic_msg = $topic_row['t_msg'];		$topic_sticky = $topic_row['t_sticky'];		
		$topic_hidden = $topic_row['t_hidden'];		$topic_locked = $topic_row['t_locked'];	

		
		// المواضيع المخفية
if($topic_hidden == 1 && ($author_id == $me || group_op($usergroup,"unhidde_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ))
{
echo'<li class="w3-bar  bg-danger" style="1%">';
if($topic_hidden == 1 && (group_op($usergroup,"unhidde_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 )){
echo'<div class="w3-bar-item w3-right"><span class="w3-small "><a href="post.php?type=show&id='.$topic_id.'" title="إظهار"><i class="fa fa-eye" aria-hidden="true"></i></a></span></div>';		
}
		if($topic_sticky == 1){
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-thumb-tack" aria-hidden="true" title="الموضوع مثبت"></i></div>';	
		}else{
		
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-folder" aria-hidden="true" title="الموضوع مثبت"></i></div>';				
		}		

echo'<div class="w3-bar-item w3-right"><a href="topic.php&id='.$topic_id.'">'.$topic_name.'</a></div>';
echo '	<div class="w3-bar-item w3-right">
        &nbsp;&nbsp;<span class="w3-right"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;:&nbsp;<a href="users.php?u='.$author_id.'">'.$author.'</a></span>
		&nbsp;:&nbsp;<span class=""><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;:&nbsp;'.normal_time($topic_date).'</span>
		</div>';

}elseif($topic_hidden == 0){   // مواضيع غير مخفية
	
	
echo'<li class="w3-bar" style="1%">';
		if($topic_sticky == 1){
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-thumb-tack" aria-hidden="true" title="الموضوع مثبت"></i></div>';	
		if($topic_locked == 1){
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-lock" aria-hidden="true" title="الموضوع مثبت"></i></div>';				
		}
		}else{
		if($topic_locked == 0){
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-folder" aria-hidden="true" title="الموضوع مثبت"></i></div>';				
		}else{
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-lock" aria-hidden="true" title="الموضوع مغلق"></i></div>';						
		}
		}		


echo '	<div class="w3-bar-item w3-right"><a href="topic.php&id='.$topic_id.'">'.$topic_name.'</a></div>
		';
	
//echo'<a data-toggle="tab" class="w3-small w3-left" href="#mod_'.$topic_id.'"><span class="caret"></span></a>
//id="mod_'.$topic_id.'" class="tab-pane fade w3-bar-item "
echo'<div class="w3-small w3-left">';

if($usergroup > 0 && ($author_id == $me && group_op($usergroup,"edit_mytopic") == 1) || group_op($usergroup,"edit_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){
echo'<span class="w3-small "><a href="post.php?type=edittopic&id='.$topic_id.'" title="تعديل"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span>';
}


if($topic_sticky == 0){
if(group_op($usergroup,"stick_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=sticky&id='.$topic_id.'" title="تثبيث"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a></span>';	
}
}elseif($topic_sticky == 1){
if(group_op($usergroup,"unstick_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=dsticky&id='.$topic_id.'" title="إلغاء التثبيث"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a></span>';	
}
}
if($topic_hidden == 0){
if(group_op($usergroup,"hidde_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){		
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=hidd&id='.$topic_id.'" title="إخفاء"><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>';	
}
}elseif($topic_hidden == 1){
if(group_op($usergroup,"unhidde_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=show&id='.$topic_id.'" title="إظهار"><i class="fa fa-eye" aria-hidden="true"></i></a></span>';		
}
}
if($topic_locked == 0){
if(group_op($usergroup,"lock_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){		
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=lock&id='.$topic_id.'" title="غلق"><i class="fa fa-lock" aria-hidden="true"></i></a></span>';		
}
}elseif($topic_locked == 1){
if(group_op($usergroup,"unlock_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=unlock&id='.$topic_id.'" title="فتح"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a></span>';			
}
}

if(group_op($usergroup,"del_mytopic") == 1 || group_op($usergroup,"del_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=delete&id='.$topic_id.'" title="حذف نهائي"><i class="fa fa-close" aria-hidden="true"></i></a></span>';			
}
echo'</div>	';

echo'</li>';		
echo'<li class="w3-bar" style="99%">';

		
echo '		
		<a href="users.php?u='.$author_id.'">	
		<img src="'.avatar($author_avatar,$author_gender).'" title="'.$author.'" class="w3-bar-item w3-circle w3-hide-small  w3-right" style="width:50px">
		</a>
		';
		
echo '	<div class="w3-bar-item w3-right">
        <span class="w3-right"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;:&nbsp;<a href="users.php?u='.$author_id.'">'.$author.'</a></span>
		<br><span class=""><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;:&nbsp;'.normal_time($topic_date).'</span>
		</div>';
		/*
		if($topic_sticky == 1){
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-thumb-tack" aria-hidden="true" title="الموضوع مثبت"></i></div>';	
		}else{
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-thumb-tack" aria-hidden="true" title="الموضوع مثبت"></i></div>';				
		}*/
		
echo'	<div class="w3-bar-item">
        <span class="w3-large">
        ';		

			////////replys
			
							$rstmt = $dbc->runQuery("SELECT distinct r.user_id,  u.user_id, u.user_name, u.user_avatar, u.user_gender  FROM ".prx."replys as r left join ".prx."users as u on(u.user_id = r.user_id) WHERE r.t_id=:t  ORDER BY t_id DESC limit 5");
							$rstmt->execute(array(':t'=>$topic_id));							
							$numr = $rstmt->rowCount();
if($numr == 0){	echo $no_reply = "بدون ردود";	
}else
{

				while($reply_row = $rstmt->fetch(PDO::FETCH_ASSOC)){

				$replyer_id = $reply_row['user_id'];	$replyer = $reply_row['user_name'];
				$replyer_avatar = $reply_row['user_avatar'];	$replyer_gender = $reply_row['user_gender'];

echo '<a href="users.php?u='.$replyer_id.'">
<img src="'.avatar($replyer_avatar,$replyer_gender).'" title="'.$replyer.'" class="w3-bar-item w3-circle w3-hide-small  w3-right" style="width:40px">
</a>';
									
				}			 // end while reply
				}            // end else reply
			
			////////replys
			
echo'</span></div></li>';

}


		
		
		
	            }			 // end while topic
		
echo'    </ul>';



}elseif($forum_blog == 1){ 





echo'<div class="col-sm-12 col-lg-12"><div class="row">';   // as blog
	
	
	
	

while($topic_row = $tstmt->fetch(PDO::FETCH_ASSOC)){
		
		$topic_id = $topic_row['t_id'];		$topic_name = $topic_row['t_name'];
		$topic_img = $topic_row['t_img'];		$author_id = $topic_row['user_id'];
		$author = $topic_row['user_name'];		$author_avatar = $topic_row['user_avatar'];
		$author_gender = $topic_row['user_gender'];		$topic_date = $topic_row['t_date'];
		$topic_msg = $topic_row['t_msg'];		$topic_sticky = $topic_row['t_sticky'];		
		$topic_hidden = $topic_row['t_hidden'];		$topic_locked = $topic_row['t_locked'];	


		// المواضيع المخفية
if($topic_hidden == 1 && ($author_id == $me || group_op($usergroup,"unhidde_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ))
{

echo'<div class="xcard col-sm-4 col-lg-4 bg-danger"  style="height: 280px;"><div class="xcard hovercard">';
if($topic_hidden == 1 && (group_op($usergroup,"unhidde_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 )){
echo'<div class=""><span class="w3-small "><a href="post.php?type=show&id='.$topic_id.'" title="إظهار"><i class="fa fa-eye" aria-hidden="true"></i></a></span></div>';		
}
echo'  <div class="cardheader" style="background: url('.$topic_img.');background-repeat: no-repeat;background-size: 100% 100%;">';
if($topic_sticky == 1){echo'<i class="w3-left fa fa-thumb-tack" aria-hidden="true" title="الموضوع مثبت"></i>';}
echo'  </div>';

echo '		
<div class="xavatar">
		<a href="users.php?u='.$author_id.'">	
		<img src="'.avatar($author_avatar,$author_gender).'" title="'.$author.'">
		</a>
</div>';
		
echo '		
		<div class="info navbar navbar-default">
        <div class="xtitle" style="padding:2px; height:50px; overflow:auto"><a href="topic.php&id='.$topic_id.'">'.$topic_name.'</a>
		</div>
        <div class="xdesc"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;:&nbsp;'.normal_time($topic_date).'</div>
		';
		echo'<div class="desc"><center>-- هذا الموضوع مخفي --</center></div>';		






echo'</div></div></div>';



/*
		if($topic_sticky == 1){
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-thumb-tack" aria-hidden="true" title="الموضوع مثبت"></i></div>';	
		}else{
			echo'<div class="w3-bar-item w3-right"><i class="fa fa-folder" aria-hidden="true" title="الموضوع مثبت"></i></div>';				
		}		

echo'<div class="w3-bar-item w3-right"><a href="topic.php&id='.$topic_id.'">'.$topic_name.'</a></div>';
echo '	<div class="w3-bar-item w3-right">
        &nbsp;&nbsp;<span class="w3-right"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;:&nbsp;<a href="users.php?u='.$author_id.'">'.$author.'</a></span>
		&nbsp;:&nbsp;<span class=""><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;:&nbsp;'.normal_time($topic_date).'</span>
		</div>';

*/
		
		
		
		
		
		
		
		
		
		
		
}elseif($topic_hidden == 0){   // مواضيع غير مخفية
		
		
		
		
		
		
		
		
echo'<div class="xcard col-sm-4 col-lg-4"  style="height: 280px;"><div class="xcard hovercard">';
echo'<div>';
if(($author_id == $me && group_op($usergroup,"edit_mytopic") == 1) || group_op($usergroup,"edit_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){
echo'<span class="w3-small "><a href="post.php?type=edittopic&id='.$topic_id.'" title="تعديل"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span>';
}
if($topic_sticky == 0){
if(group_op($usergroup,"stick_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){		
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=sticky&id='.$topic_id.'" title="تثبيث"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a></span>';	
}
}elseif($topic_sticky == 1){
if(group_op($usergroup,"unstick_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=dsticky&id='.$topic_id.'" title="إلغاء التثبيث"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a></span>';	
}
}
if($topic_hidden == 0){
if(group_op($usergroup,"hidde_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){		
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=hidd&id='.$topic_id.'" title="إخفاء"><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>';	
}
}elseif($topic_hidden == 1){
if(group_op($usergroup,"unhidde_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=show&id='.$topic_id.'" title="إظهار"><i class="fa fa-eye" aria-hidden="true"></i></a></span>';		
}
}
if($topic_locked == 0){
if(group_op($usergroup,"lock_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){		
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=lock&id='.$topic_id.'" title="غلق"><i class="fa fa-lock" aria-hidden="true"></i></a></span>';		
}
}elseif($topic_locked == 1){
if(group_op($usergroup,"unlock_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=unlock&id='.$topic_id.'" title="فتح"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a></span>';			
}
}
if(group_op($usergroup,"del_mytopic") == 1 || group_op($usergroup,"del_topic") == 1 || is_admin($me) == 1 || is_super_mode($me) == 1 || is_moderator($me,$forum_id) == 1 ){	
echo'&nbsp;&nbsp;<span class="w3-small "><a href="post.php?type=delete&id='.$topic_id.'" title="حذف نهائي"><i class="fa fa-close" aria-hidden="true"></i></a></span>';			
}
echo'</div>	';
	


echo'  <div class="cardheader" style="background: url('.$topic_img.');background-repeat: no-repeat;background-size: 100% 100%;">';
if($topic_sticky == 1){echo'<i class="w3-left fa fa-thumb-tack" aria-hidden="true" title="الموضوع مثبت"></i>';}
echo'  </div>';

	
echo '		
<div class="xavatar">
		<a href="users.php?u='.$author_id.'">	
		<img src="'.avatar($author_avatar,$author_gender).'" title="'.$author.'">
		</a>
</div>';
		
echo '		
		<div class="info navbar navbar-default">
        <div class="xtitle" style="padding:2px; height:50px; overflow:auto"><a href="topic.php&id='.$topic_id.'">'.$topic_name.'</a>
		</div>
        <div class="xdesc"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;:&nbsp;'.normal_time($topic_date).'</div>
		';

		

		echo'<div class="desc">';		

			////////replys
			
							$rstmt = $dbc->runQuery("SELECT distinct r.user_id,  u.user_id, u.user_name, u.user_avatar, u.user_gender  FROM ".prx."replys as r left join ".prx."users as u on(u.user_id = r.user_id) WHERE r.t_id=:t  ORDER BY t_id DESC limit 5");
							$rstmt->execute(array(':t'=>$topic_id));							
							$numr = $rstmt->rowCount();
if($numr == 0){	echo $no_reply = "بدون ردود";	
}else
{

				while($reply_row = $rstmt->fetch(PDO::FETCH_ASSOC)){

				//$reply_id = $reply_row['r_id'];
				$replyer_id = $reply_row['user_id'];
				$replyer = $reply_row['user_name'];
				$replyer_avatar = $reply_row['user_avatar'];
				$replyer_gender = $reply_row['user_gender'];

				echo '<a href="users.php?u='.$replyer_id.'">
							<img src="'.avatar($replyer_avatar,$replyer_gender).'" title="'.$replyer.'" width="32" height="32" style="border-radius: 50%;">
					 </a>';
									
				}			 // end while reply
				}            // end else reply
			
			////////replys
			
echo'</div></div></div></div>';




	}	
		
		
	            }			 // end while topic
		
echo'</div></div>';
}



echo'<div>';		
echo xpage("topics", $forum_id, $count_page, $get_page, "forum.php&id=".$forum_id."&");	
echo'</div>';
//echo ypage($numt, $count_page, $get_page, "home.php?op=forum&id=".$forum_id."&");			
				}




				// end else topic


		}
		
		
		
		if(isset($error)){
foreach($error as $error){
                		?><tr>
                		<table  width="100%">
                		<tr>
                		<td class="alert alert-danger" colspan="4"><center><?php echo $error; ?><br><a href="home.php">العودة للرئيسية</a></td>
                		</tr>
                		</table>
                		</tr><?php	
			 	        }	
		                }
	
	
	
?>
<script type="text/javascript" src="system/js/topic_crud.js"></script>
	



<?php
/*
	define('APP_PATH',dirname(realpath(__FILE__)));
	define('DS',DIRECTORY_SEPARATOR);
	define('PS',PATH_SEPARATOR);
	define('SYSTEM_PATH',APP_PATH . DS . 'systeme');
	define('INCLUDE_PATH',APP_PATH .DS . 'inc____');
	define('CSS_PATH',APP_PATH . DS . 'systeme' . DS . 'css');
	define('JS_PATH',APP_PATH . DS . 'systeme' . DS . 'js');
	
	
	$paths = get_include_path() . PS . SYSTEM_PATH . PS . INCLUDE_PATH . PS . CSS_PATH . PS . JS_PATH;
	set_include_path($paths);
	//echo get_include_path();
	//echo SYSTEM_PATH . DS . 'style' ;
*/	
//include ("footer.php");
