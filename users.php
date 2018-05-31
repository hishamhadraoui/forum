<?php
include("global.php");
if($usergroup > 0){

if(op == ""){
				
				if(u == ""){

				$title = "قائمة الاعضاء";
				$body = "users";
				include ("system/header.php");
				$stmt = $dbc->runQuery("select * from ".prx."users ORDER BY user_id desc");
				$stmt->execute();
				echo'
				<ul class="list-group"><li class="list-group-item active"><font color="#fff">&nbsp; قائمة الاعضاء</font></li>
				<div class="form-home">
				<div class="row">';
				while($user_row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$u_posts = $user_row['user_to'] + $user_row['user_re'];
				?>
							<div class="col-lg-2 form-signin">
							
							<div class="img-circle">
							   <img alt="" src="<?php echo avatar($user_row['user_avatar'],$user_row['user_gender']); ?>" <?php echo wh('90','90'); ?>>
							</div>
							<div>
							الاسم : <?php echo $user_row['user_name'];    ?><br>
							المشاركات : <?php echo $u_posts;    ?><br>
							الأصدقاء : <?php echo $fr->my_friends($user_row['user_id'],'num');   ?><br>
							<?php echo moderator($user_row['user_id']);    ?><br>
							</div>							
									<?php if($me != $user_row['user_id']){    ?>
									<?php if($fr->check_friends($me,$user_row['user_id']) == 0){    ?>
									<a class="btn btn-warning btn-sm" title="أضف كصديق" href="users.php?op=friends&type=add&u=<?php echo $user_row['user_id'];?>"><i class="fa fa-user-plus"></i></a>
									<?php }elseif($fr->check_friends($me,$user_row['user_id']) == 1){    ?>
									<a href="msg.php?u=<?php echo $user_row['user_id'];?>">
									<i class="btn btn-success btn-sm fa fa-comment" title="صديق"></i></a>
									<?php }elseif($fr->check_friends($me,$user_row['user_id']) == 2){    ?>
									<i class="btn btn-warning btn-sm fa fa-clock-o" title="طلب صداقة في الإنتظار"></i>
									<?php } ?>
									<?php } ?>
								
							
							</div>
					<?php 	} 	?> 
					</div>
					</tbody></table></div></div><br />
				<?php 

					}else{
		
$stmt = $dbc->runQuery("select * from ".prx."users WHERE user_id=:u");
$stmt->execute(array(':u'=>$u));
$numu = $stmt->rowCount();
									if($numu == 0){	
									$title = "خطأ";
									$body = "users";
									include ("system/header.php");
									echo'<tr><center><table>
											<tr>
												<td class="alert alert-danger" colspan="4" width="600"><center><br>رقم العضوية خاطئ<br><br>
													<a href="home.php">العودة للرئيسية</a>
												</td>
											</tr>
										</table></tr>';		
													}else{		

$user_row=$stmt->fetch(PDO::FETCH_ASSOC);	
$u_posts = $user_row['user_to'] + $user_row['user_re'];	
$title = $user_row['user_name'];
$body = "users";
include ("system/header.php");		
?>
	     </div>
	<div class="container">	 
		 <div class="row">	
	<div class="col-lg-3 form-signin">
            <div class="card hovercard">
              <div class="cardheader" style="background: url(<?php echo " ".($user_row['user_bg'] != "" ? "".$user_row['user_bg']."" : "img/bg_x.png")." "; ?>);">
                </div>
                <div class="avatar">
                <img alt="" src="<?php echo avatar($user_row['user_avatar'],$user_row['user_gender']); ?>">
                </div>
                <div class="info">
                    <div class="title">
                        <a href="users.php?u=<?php echo $user_row['user_id'];?>"><?php echo $user_row['user_name'];?></a>
                    </div>
                    <div class="desc"><?php echo moderator($user_row['user_id']); ?></div>
                    <div class="desc"><?php echo $user_row['user_email']; ?></div>
					
                    <div class="desc">المشاركات <span class="badge"><?php echo $u_posts; ?></span></div>
					
                </div>
				     

				<div class="info">
				<div class="desc">تاريخ التسجيل : <?php echo $user_row['joining_date']; ?></div>
				</div>
            </div>
			
	     </div>		
	<div class="col-lg-9 form-home">
<ul class="list-group">
<li class="list-group-item active"><font color="#fff">&nbsp; مواضيع <?php echo $user_row['user_name'];?></font></li>


<?php

		$tstmt = $dbc->runQuery("SELECT t.t_id, t.f_id, t.t_name, t.t_date, t.t_img,  t.t_msg,t.user_id, u.user_id, u.user_name, u.user_avatar, u.user_gender 
									FROM ".prx."topics as t 
									inner join ".prx."users as u 
									on(t.user_id = u.user_id) WHERE t.user_id=:u order by t.t_date desc limit 5");
		$tstmt->execute(array(':u'=>$u));
		//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);	
		$numt = $tstmt->rowCount();
		
		
			echo '<table class="form-home"  width="100%">';
		
		if($numt == 0){
			
		echo	 '<tr>
		<td width="100%"><p>هذا العضو لم يطرح اي موضوع للآن...</p>
			</td></tr>
		</table>
		';	
		
		}else{
	
		echo '<tr>
		<td class="btn-default btn-sm" width="40%" colspan="2">المواضيع</td>
		<td class="btn-default btn-sm" width="40%">أعضاء شاركو بالموضوع</td>
			</tr>';

while($topic_row = $tstmt->fetch(PDO::FETCH_ASSOC)){
		//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);
		$t = $topic_row['t_id'];
		$tname = $topic_row['t_name'];
		$timg = $topic_row['t_img'];
		//$topicsinf = $topic_row['topicsinf'];
		$tmsg = $topic_row['t_msg'];	
		
		echo '
		<tr>
		<td class="topic" width="1%"><a href="users.php?u='.$topic_row['user_id'].'"><img src="'.avatar($topic_row['user_avatar'],$topic_row['user_gender']).'"  title="'.$topic_row['user_name'].'" width="40" height="40" style="border-radius:50%;"></a></td>
		<td width="40%" align="right">
		<table><tr>
		
		<td width="90%">
		<a href="topics.php?id='.$topic_row['t_id'].'">'.$topic_row['t_name'].'</a> 
				<br>
		<span style="font-size:13px;">الكاتب : <a href="users.php?u='.$topic_row['user_id'].'">'.$topic_row['user_name'].'</a></span>	
		
			</td></tr>
		</table></td>	
			
			
			
			<td width="40%"><table>					';
			////////replys
			
							$stmt = $dbc->runQuery("SELECT distinct r.user_id,  u.user_id, u.user_name, u.user_avatar, u.user_gender  FROM ".prx."replys as r left join ".prx."users as u on(u.user_id = r.user_id) WHERE r.t_id=:t  ORDER BY t_id DESC limit 5");
							
							//$stmt = $dbc->runQuery("SELECT distinct user_id FROM replys WHERE t_id=:t limit 5");
							
														
							/**/
							
							$stmt->execute(array(':t'=>$t));							
							

							//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);	
							$numr = $stmt->rowCount();

							if($numr == 0){
								
							echo	$no_reply = "لا أحد قام بالرد على الموضوع";	
							
							}else{
							
							



					while($reply_row = $stmt->fetch(PDO::FETCH_ASSOC)){
							//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);
							//$r = $reply_row['r_id'];
							//$t = $reply_row['t_id'];
							$ruser = $reply_row['user_id'];
							
				echo '
					<td><a href="users.php?u='.$reply_row['user_id'].'"><img src="'.avatar($reply_row['user_avatar'],$reply_row['user_gender']).'" title="'.$reply_row['user_name'].'" width="36" height="36" style="border-radius:50%;"></a>&nbsp;&nbsp;</td>
					';
					}	
								}
			
			////////replys
			echo'			</table></td>

			</tr>
			';
		//echo'<table>';	
		
		
		
		}			
		
		echo'</table>';
		
		
		}





?>
</ul>






<ul class="list-group">
<li class="list-group-item active"><font color="#fff">&nbsp; مشاركات <?php echo $user_row['user_name'];?></font></li>

<?php



$rstmt = $dbc->runQuery("SELECT r.r_id,r.r_msg,r.t_id, r.r_date, r.user_id, t.t_id,t.t_name
								 FROM ".prx."replys as r left join ".prx."topics as t on (t.t_id = r.t_id) 
								 WHERE r.user_id=:u order by r.r_date desc limit 5");
		$rstmt->execute(array(':u'=>$u));
		//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);	
		$numr = $rstmt->rowCount();
		
		
			echo '<table class="form-home top"  width="100%">';
		
		if($numr == 0){
			
		echo	 '<tr>
		<td width="100%"><p>هذا العضو لم يطرح اي رد للآن...</p>
			</td></tr>
		</table>
		';	
		
		}else{
	
		//echo '<tr><td class="btn-primary btn-sm" width="40%" colspan="2">المواضيع</td></tr>';

while($reply_row = $rstmt->fetch(PDO::FETCH_ASSOC)){
		//$reply_row = $stmt->fetch(PDO::FETCH_ASSOC);
		$r = $reply_row['r_id'];
		$rmsg = $reply_row['r_msg'];	
		$t_id = $reply_row['t_id'];
		$t_name = $reply_row['t_name'];
		
		echo '
		<tr>
		<td class="topic" width="1%"><a href="users.php?u='.$user_row['user_id'].'"><img src="'.avatar($user_row['user_avatar'],$user_row['user_gender']).'"  title="'.$user_row['user_name'].'" width="32" height="32" style="border-radius:50%;"></a></td>
		<td width="30%" align="right">&nbsp;'.html_entity_decode($reply_row['r_msg']).'&nbsp;</td>
		<td width="69%" align="right"><a href="topic.php&id='.$t_id.'">'.$t_name.'</a></td>
		</tr>';
			

}

		echo'</table>';
}

 ?>
</ul>


<ul class="list-group">
<li class="list-group-item active"><font color="#fff">&nbsp; أصدقاء : <?php echo $user_row['user_name'];?></font></li>

		<div class="">
		<span>  <?php echo $fr->my_friends($user_row['user_id'],'list'); ?></span>
		</div>

</ul>


<ul class="list-group">
<li class="list-group-item active"><font color="#fff">&nbsp; التوقيع</font></li>

		<div class="jumbotron">
		<span>  <?php echo html_entity_decode($user_row['user_sig']); ?></span>
		</div>

</ul>

<ul class="list-group">
<li class="list-group-item active"><font color="#fff">&nbsp; الاتصال بـ: <?php echo $user_row['user_name'];?></font></li>
</ul>
	
					<div class="bottom">
                    <a target="_blank"  class="btn btn-primary btn-twitter btn-sm" href="<?php echo $user_row['user_mtw'];?>">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a target="_blank"  class="btn btn-danger btn-sm" rel="publisher" href="<?php echo $user_row['user_mgp'];?>">
                        <i class="fa fa-google-plus"></i>
                    </a>
                    <a target="_blank"  class="btn btn-primary btn-sm" rel="publisher" href="<?php echo $user_row['user_mfb'];?>">
                        <i class="fa fa-facebook"></i>
                    </a>
                   <a class="btn btn-danger btn-sm" rel="publisher" href="<?php echo $user_row['user_myo'];?>">
                        <i class="fa fa-youtube-play"></i> 
                    </a>
                </div>
	
	
	
	     </div>
		      </div>
	
	<?php
	
	
	
	
	
	}

}


}elseif(op == "profile"){
	$body = "profile";
	$tpl->MYprofile();
	
}elseif(op == "edit.profile"){
	$body = "profile";
	$tpl->eMYprofile();
	$body = "post";
}elseif(op == "edit.sig"){
	$tpl->eMYprofileSig();
}elseif(op == "friends"){
	$tpl->friends();
}



}else{
	$user->redirect('index.php');
}


$tpl->indexFooter();
?>

