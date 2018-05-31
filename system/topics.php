<?php


global $gets, $agets, $dbc, $topic_row,$pg,$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$user, $topic, $n;

$error = array();
$body = "topic";
$topic_id 			= id;
$topic_name 		= topic_row(id,"name");
$topic_img 			= topic_row(id,"img");
$topic_msg 			= topic_row(id,"msg");
$author_id 			= topic_row(id,"user_id");
$author 			= topic_row(id,"user_name");
$author_gender 		= topic_row(id,"user_gender");
$author_avatar 		= avatar(topic_row(id,"user_avatar"),$author_gender);
$author_post 		= topic_row(id,"user_post");
$author_group 		= topic_row(id,"user_group");
$forum_id 			= topic_row(id,"f_id"); 
$forum_name 		= topic_row(id,"f_name");
$forum_icon 		= topic_row(id,"f_icon");
$topic_cr 			= topic_row(id,"t_cr"); 
$topic_date 		= topic_row(id,"t_date");
$topic_hidden 		= topic_row(id,"hidden");
$topic_locked 		= topic_row(id,"locked");
$title 				= $topic_name; $numt = topic_row(id,"num"); 
$views 				= topic_row(id,"views") +1;	
$likes 				= topic_row(id,"t_cl");
$tfr				= forum_row($forum_id,"freplys");
$topic->incr_topic(topic_row(id,"views"),id);		
	
/*		if(topic_row($_GET["id"],"num") == 0){	$error[] = "رقم الموضوع خاطئ";	
		$title = "رسالة خطأ";
		include ("system/header.php");				
		//echo e_class($error,"danger",$forum_id,"","");
		}*/
		
		if($numt == 0 || $topic_hidden == 1){	$error[] = "رقم الموضوع خاطئ";	}elseif($numt == 1){
			
			
include ("system/header.php");		

if($usergroup == 0){echo'<div class="form-editor">';}			
		echo '<ul class="list-group"><li class="list-group-item active">';	
		echo '		<a href="forum.php&id='.$forum_id.'"><img src="'.$forum_icon.'" width="32" height="32"><font color="#fff">&nbsp; '.$forum_name.'</font></a>';	
		echo '		</li>';	
//echo go2forum($array);
		
		echo '<br><ul class="nav nav-pills" role="tablist">';	
		echo '		<li role="presentation" class="active disabled"><a href="#">الردود <span class="badge">'.replys_count_in_topic($topic_id).'</span></a></li>';	
		echo '		<li role="presentation" class="active info disabled"><a href="#">المشاهدات<span class="badge">'.$views.'</span></a></li>';	
		echo '		<li role="presentation" class="active disabled"><a href="#">الاعجابات <span class="badge">'.$likes.'</span></a></li>';
		//echo '		<li role="presentation"  class="active  navbar-left"><a href="post.php?type=addreply&id='.$topic_id.'">إضافة رد</a></li>';		
		echo '	  </ul> </ul>';		
		
		echo '<table class="form-home"  width="100%">';
		//echo '<tr><td class="btn-default btn-sm" width="80%" colspan="3">الموضوع</td></tr>';
		echo '<tr><td  colspan="4"><table>';
		echo '<center><p><h3>	<a href="topic.php&id='.$topic_id.'">'.$topic_name.'</a></h3>
<span class=""><h5><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;:&nbsp;'.times_date("date", $topic_date).'</h5></span>

		</p></center><hr />';

		echo'<ul class="w3-ul w3-card-4" style="100%">';
		echo'<li class="w3-bar" style="100%;   background-color:#ffecff;">';

echo '		
		<a href="users.php?u='.$author_id.'">	
		<img src="'.avatar($author_avatar,$author_gender).'" title="'.$author.'" class="w3-bar-item w3-circle w3-hide-small  w3-right" style="width:90px">
		</a>
		';
		
echo '		
		<div class="w3-bar-item w3-right">
        <span class="w3-large">
		<span class="w3-right"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;:&nbsp;<a href="users.php?u='.$author_id.'">'.$author.'</a></span>
		&nbsp;
		<span class="w3-left"><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;المشاركات:&nbsp;<a href="users.php?u='.$author_id.'">'.$author_post.'</a></span>
		</span><br>
        <span class="w3-right"><h5><i class="fa fa-star" aria-hidden="true"></i>&nbsp;:&nbsp;'.moderator($author_id).'</h5></span>
		&nbsp;&nbsp;<span class="">&nbsp;&nbsp;&nbsp;</span>
		</div>
		';
		
		
		if($usergroup == 7){ echo'<div class="w3-bar-item w3-left"><a href="post.php?type=edittopic&id='.$topic_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="float:left;"></i></a></div>';	}	
		echo'</li>';
		echo'</ul>';
		
		echo'</table></td></tr><tr><td width="90%"  colspan="4" ><hr />';
		if($topic_img != ""){echo '<center><img src="'.$topic_img.'" width="520" height="320">';}
		echo '	<hr />'.html_entity_decode($topic_msg).'';
		echo '			<br></td></tr></table>';
		
		
		
		
		$lstmt = likes_stmt($topic_id);
		$numl = $lstmt->rowCount();

		echo'<hr /><td><table width="100%">';    // topics_likes
		echo'<td width="90%">';	
		
		if($numl == 0){	echo	$no_likes = "";	}else{
															
			while($likeRow = $lstmt->fetch(PDO::FETCH_ASSOC)){
			$liker_id = $likeRow['user_id'];
			$liker = $likeRow['user_name'];
			$tlike = $likeRow['t_like'];
				if($tlike == 1){
				echo '&nbsp;<a href="users.php?u='.$liker_id.'">'.$liker.'</a>&nbsp;';
				}
			}
		}	
			
		echo '</td>';	
		echo '<td width="10%">';
		
		if($me !== $author_id  && ($usergroup > 0)){
			if(is_liker($topic_id,$me) == 1){
			echo	'<a href="home.php?op=topic&id='.$topic_id.'&go=deslike" title="إلغاء الإعجاب"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>';
			}else{
			echo	'<a href="home.php?op=topic&id='.$topic_id.'&go=like" title="أعجبني"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>';
			}
		
			////////////////////
			if(go == "like"){ try	{  if(like_topic($topic_id,$me)){?><script> /*alert('تم الاعجاب بنجاح');*/ window.location.href='topic.php&id=<?php echo id;?>';  	</script><?php	}}catch(PDOException $e)	{echo $e->getMessage();	}				}
			////////////////////
			if(go == "deslike"){ try 	{	if(des_like_topic($topic_id,$me)){ ?><script>/*alert('تم إلغاء الاعجاب بنجاح');*/	window.location.href='topic.php&id=<?php echo id;?>';	</script><?php	}	}catch(PDOException $e)	{ echo $e->getMessage();}}
			/////////////////////
		}
		
		
		
		
		echo '</td>
		</table></td><hr />';	// topics_likes	ends
if($usergroup > 0){
echo'<tr><td><table width="100%">';			////////replys الردود

		
			
			$rstmt = replys_stmt($topic_id);$numr = $rstmt->rowCount();

if($numr == 0){	echo	$no_reply = "لا أحد قام بالرد على الموضوع";	}else{
							
				while($reply_row = $rstmt->fetch(PDO::FETCH_ASSOC)){
				$r = $reply_row['r_id'];
				$t = $reply_row['t_id'];
				$ruser = $reply_row['user_id'];
					if(isset($_POST['btn-xrmsg_'.$r.'']))
					{
						$xrmsg = strip_tags($_POST['txt_xrmsg']);
						$xruser = $me;	
						//$rid = $reply_row['r_id'];
						if($xrmsg == "")	{
						$error[$r] = "لا يمكن ادخال رد فارغ";	
						}
						else
						{
						try
						{   $stmt = $dbc->runQuery("INSERT INTO ".prx."xreplys (xr_msg,r_id,user_id) VALUES (:xrmsg, :r, :xruser)	");
							if($stmt->execute( array(':xrmsg'=>$xrmsg,':r'=>$r,':xruser'=>$xruser))){
							?><script>window.location.href='topic.php&id=<?php echo id;?>';</script><?php
							}else{	$error[] = "لا يمكن ادخال رد فارغ";	}
						}catch(PDOException $e)
							{
								echo $e->getMessage();
							}
						}	
					}
						
echo '<tr><td><form method="post">';
//إظهار الاخطاء		
if(isset($error)){	foreach($error as $error)	{	 ?><div class="alert alert-danger">&nbsp; <?php echo $error; ?> </div>  <?php }}
//
			

					
							
							
echo'<div class="form-home">';
if(group_op($usergroup,"edit_myreply") == 1 || group_op($usergroup,"edit_reply") == 1){
echo	'<a href="post.php?type=editreply&id='.$r.'" title="تعديل"><i class="w3-bar-item w3-left fa fa-edit" aria-hidden="true"></i></a>';
}  		
		
		// الإعجاب بالرد
		$lstmt = rlikes_stmt($r);
		$numl = $lstmt->rowCount();
		if($me !== $ruser  && ($usergroup > 0)){
			if(is_rliker($r,$me) == 1){
			echo	'<a href="home.php?op=topic&id='.$topic_id.'&go=rdeslike_'.$r.'" title="إلغاء الإعجاب"><i class="w3-bar-item w3-left fa fa-thumbs-o-down" aria-hidden="true"></i></a>';
			}else{
			echo	'<a href="home.php?op=topic&id='.$topic_id.'&go=rlike_'.$r.'" title="أعجبني"><i class="w3-bar-item w3-left fa fa-thumbs-o-up" aria-hidden="true"></i></a>';
			}
		
			////////////////////
			if(go == "rlike_".$r.""){ try	{  if(like_reply($r,$me)){?><script> /*alert('تم الاعجاب بنجاح');*/ window.location.href='topic.php&id=<?php echo id;?>';	</script><?php	}}catch(PDOException $e)	{echo $e->getMessage();	}				}
			////////////////////
			if(go == "rdeslike_".$r.""){ try 	{	if(des_like_reply($r,$me)){ ?><script>/*alert('تم إلغاء الاعجاب بنجاح');*/	window.location.href='topic.php&id=<?php echo id;?>';	</script><?php	}	}catch(PDOException $e)	{ echo $e->getMessage();}}
			/////////////////////
		}
		
echo'<div class="media"><div class="media-right">
	<img src="'.avatar($reply_row['user_avatar'],$reply_row['user_gender']).'" 
	class="media-object" style="width:40px;height:40px;border-radius:30%;"></div>
    <div class="media-body  ">
    <h4 class="media-heading media-right">'.$reply_row['user_name'].'    
	<h5 class="media-heading  media-left">'.times_date("date", $reply_row['r_date']).'</h5></h4>
	<p>'.html_entity_decode($reply_row['r_msg']).'</p>';
 
		echo'<div><div class="row">';    // repls_likes
		echo'<div class="col-lg-10 col-sm-10">';	
		
		if($numl == 0){	echo	$no_likes = "";	}else{
		echo'المعجبين:';													
			while($likeRow = $lstmt->fetch(PDO::FETCH_ASSOC)){
			$liker_id = $likeRow['user_id'];
			$liker = $likeRow['user_name'];
			$tlike = $likeRow['r_like'];
				if($tlike == 1){
				echo '&nbsp;<a href="users.php?u='.$liker_id.'">'.$liker.'</a>&nbsp;';
				}
			}
		}	
			
		echo '</div>';	
		

echo '</div></div><hr />';	// replys_likes	ends	
  
  
$xrstmt = xreplys_stmt($r);	$numxr = $xrstmt->rowCount();

echo'<ul class="nav nav-tabs">
	   <a data-toggle="tab" class="btn btn-primary btn-xs" href="#home_'.$r.'">
	   <i class="fa fa-comment"></i> ('.$numxr.') </a>&nbsp;&nbsp;
	   <a data-toggle="tab" class="btn btn-success btn-xs" href="#menu_'.$r.'">
	   <span class="glyphicon glyphicon-pencil" style="float:left;"></a>  
	</ul>
<div class="tab-content">
<div id="home_'.$r.'" class="tab-pane fade">';
	
    if($numxr == 0){  echo	$no_reply = "لاتوجد إقتباسات هنا ، كن أول من يضع تعليق على الرد";	
	}else{
			while($xreply_row = $xrstmt->fetch(PDO::FETCH_ASSOC)){

				echo'<div class="media">
					<div class="media-left">
					<img src="'.avatar($xreply_row['user_avatar'],$xreply_row['user_gender']).'" 
					class="media-object" style="width:28px;height:28px;border-radius:30%;">
					</div>
					<div class="media-body">
					<h4 class="media-heading">'.$xreply_row['user_name'].'<small>
					<i>'.$xreply_row['xr_date'].'</i></small></h4>
					<p>'.html_entity_decode($xreply_row['xr_msg']).'</p>
					</div>
					</div>';

			}
	}		  
echo'	  
</div>';
echo'<div id="menu_'.$r.'" class="tab-pane fade">
		<div class="media">
		<div class="media-body">
		<input type="text" class="col-lg-10" name="txt_xrmsg" />
		<input type="hidden" class="btn btn-primary btn-sm  col-lg-2" name="btn-xrmsg_'.$r.'">
		</div>
		</div>
     </div>
</div>

	 </div>
  </div>
</div>
		</form>';

					
					}	
								}		////////replys
			


$fid = $topic_row['f_id'];	  $tre = $topic_cr + 1;  $fre = $tfr + 1;

	echo '	</td></tr><hr />';





	
if($topic_locked == 1){
	
	$error[] = "إيــــــه الموضوع مغلق لايمكنك الرد عليه";	
	
}else{	

if(group_op($usergroup,"add_reply") == 1){
	
echo '	<tr><td>';
	echo'
	<div class="tab-content">
	<table  width="80%">
	<tr><td colspan="2"><h4 class="list-group-item active btn-sm"><center>إضافة رد</h4></td></tr>
	<tr><td>';
	

	echo'
	</td></tr><tr>';
	
	
	
	
			echo'<td width="80%">';
			echo'<form method="post" action="post.php?type=addreply&go=insert&id='.id.'" class="">';
			echo'<input type="hidden" name="tid" value="'.  id .'" />';
			echo'<input type="hidden" name="tre" value="'.  $tre .'" />';
			echo'<input type="hidden" name="fre" value="'. $fre .'" />';
			echo'<input type="hidden" name="fid" value="'. $fid .'" />';
			echo'<div id="pro" class="tab-pane fade in active" valign="top">';
			echo'<textarea id="dja" name="xrmsg" cols="180" rows="23" ></textarea>';
			echo'<link rel="stylesheet" href="system/editor/skins/editor.css">';
			echo'<script type="text/javascript" src="system/editor/editor-min.js"></script><script type="text/javascript">';
			echo'Editor.setStyle({"bgColor": "#2C699F","borderColor": "#c8c8c8","fontFamily": "tahoma"});';
			echo'Editor.run({"replace": "dja","height": 120,"width": 800,"path":"","mode": "small"});</script>';
			echo'<center><button type="submit" class="btn btn-primary btn-center" name="btn-addreply">';
			echo'<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال</button>';
			echo'</div>';

			echo	'</form>';
			echo'			</td>';
			echo'			</tr></table></div></td></tr>';
			
			}}					
echo'</table></td>';
		
		
		}   



						}      // end else numt
		
		if(isset($error)){
foreach($error as $error){
$title = "رسالة خطأ";
		include ("system/header.php");
                		?><tr>
                		<table  width="100%">
                		<tr>
                		<td class="alert alert-danger" colspan="4"><center><?php echo $error; ?><br><a href="home.php">العودة للرئيسية</a></td>
                		</tr>
                		</table>
                		</tr><?php	
			 	        }	
		                }
	
	
	
	

//$n = trim($_GET['n']);	//define("n" , $n);
$n != "" ? $user->notifi_hide($n) : "" ;  // مسح الاشعارات
//include ("footer.php");
?>