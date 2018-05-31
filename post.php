<?php
include("global.php");
global $gets, $agets, $dbc, $topic_row,$pg,
$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,
$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts ;
$body = "post";



if($usergroup == 0){   
$user->redirect('index.php');
}
 
 	$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums  WHERE f_id=:id ");
	$stmt->execute(array(':id'=>id));
	$f_row=$stmt->fetch(PDO::FETCH_ASSOC);
	$numf = $stmt->rowCount();
	$f_name = $f_row['f_name'];
	$f_t = $f_row['f_t'];

			
	

if($type == "addtopic"){
				

	if($numf == 0){
		header("Location: home.php");
		//echo '<meta http-equiv="refresh" content="0" url="home.php">';
			        $error = "رقم المنتدى خاطئ";
					$body = "error";					
					$title = "خطأ";
	                include ("system/header.php");
					echo e_class($error,"danger","","","");

		
		
}elseif($numf == 1){
			
if($f_row['f_type'] == '0'){
					$title = "خطأ";
					$body = "error";					
	                include ("system/header.php");
		echo'	<br><br><br><br><br><br><br><br><br>
				<center><table><tr>
					<td class="alert alert-danger" colspan="4" width="600"><center>
					لايمكنك اضافة الموضوع لان : 
						 <a href="home.php?cat_id='.$f_row['f_id'].'">'.$f_row['f_name'].'</a>
						 قسم وليس منتدى 
							<br>
							<!-- <a href="javascript:history.back()">رجوع</a> -->
							<a href="home.php">العودة للرئيسية</a>
						</td>
					</tr>
				</table></tr>
		';
}else{
	
	//////	if($go == ""){
		
			$title = "اضافة موضوع";
			include ("system/header.php");	
			$stname = "عنوان الموضوع";
			$stimg = "رابط الصورة البارزة للموضوع";
						
			//  echo a7_editor($array);	
			echo	'<form method="post"  class="form-home">';
			echo	'<h4 class="form-signin-heading">'.$title.' لـ: '.$f_name.'</h4><hr />';
			echo	'<div class="col-lg-12"><div class="row">';
			echo	'<div class="form-group col-lg-8"><input type="text" class="form-control" name="tname" placeholder="'. $stname .'"/>';
			echo	'</div><div class="col-lg-4">';
			echo	'<div class="form-group col-lg-8"><input type="text" class="form-control" name="timg" placeholder="'. $stimg.'"/></div>';
			echo	'</div></div><div><textarea id="dja" name="tmsg" cols="180" rows="23" ></textarea>';
			echo	'<link rel="stylesheet" href="system/editor/skins/editor.css">';
			echo	'<script type="text/javascript" src="system/editor/editor-min.js"></script><script type="text/javascript">';	
			echo	'Editor.setStyle({"bgColor": "#FFD5B3","borderColor": "#c8c8c8","fontFamily": "tahoma"});';	
			echo	'Editor.run({"replace": "dja","height": 420,"width": 910,"path":"","mode": "advance"});</script>';
			echo	'</div></div><hr />';
			echo	'<center><button type="submit" class="btn btn-primary btn-center" name="btn-addtopic" onclick="myFunction()">';
			echo	'&nbsp;إدخال الموضوع</button>';
			echo	'<br /></form>';
			
			?><script>function myFunction() {   alert("هل أنت متاكد من المعلومات المدخلة؟"); } </script><?php

		
			if(isset($_POST['btn-addtopic'])){
			$nf_t = $f_t + 1;
			$nuser_to = $user_to + 1;
			$ntname = strip_tags($_POST['tname']);
			$ntimg = strip_tags($_POST['timg']);
			$ntmsg = htmlSpecialchars($_POST['tmsg']);
			$hntmsg	= html_entity_decode($ntmsg);
			if($ntname == "" || $ntimg == "" || $ntmsg == "&lt;br&gt;" ) {
			?><script>alert('يجب ملئ كل الخانات المطلوبة');/*window.location.href='post.php?type=addtopic&id=<?php echo id; ?>';*/</script><?php
					}else{		
								try
					{
						
					$fstmt = $dbc->runQuery("UPDATE ".prx."forums SET f_t=:nf_t WHERE f_id=:id ");
					$fstmt->execute( array(':nf_t'=>$nf_t,':id'=>id));
					$ustmt = $dbc->runQuery("UPDATE ".prx."users SET user_to=:nuser_to WHERE user_id=:me ");
					$ustmt->execute( array(':me'=>$me,':nuser_to'=>$nuser_to));
					$stmt = $dbc->runQuery("INSERT INTO ".prx."topics (t_name,f_id,user_id,t_msg,t_img,t_date) VALUES (:tname, :id, :me,:tmsg,:timg, :date)	");
					if($stmt->execute( array(':tname'=>$ntname,':id'=>id,':me'=>$me,':date'=>time(),':tmsg'=>$ntmsg,':timg'=>$ntimg))){
					?><script>/*alert('تم الادخال بنجاح');*/window.location.href='forum.php&id=<?php echo id;?>';</script><?php
					}
					else{$error = "حدث خطأ ما...";}
					}catch(PDOException $e)
					{echo $e->getMessage();	}					
					}
}

	//////////}
		}
	
	
	}
	
	
}elseif($type == "edittopic"){
	
		$stmt = $dbc->runQuery("SELECT * FROM ".prx."topics WHERE t_id=:id ");
		$stmt->execute(array(':id'=>id));
		$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);	
		$numt = $stmt->rowCount();
		
				$etid =  $topic_row['t_id'];
				$efid =  $topic_row['f_id'];
				$euid =  $topic_row['user_id'];
				$etd =  $topic_row['t_date'];
			
		if($numt == 0){
			        $error = "رقم الموضوع خاطئ";	
					$title = "خطأ";
	                include ("system/header.php");
		echo'	<br><br><br><br><br>
				<center><table><tr>
					<td class="alert alert-danger" colspan="4" width="600"><center>
						 '.$error.'
							<br>
							<!-- <a href="javascript:history.back()">رجوع</a> -->
							<a href="home.php">العودة للرئيسية</a>
						</td>
					</tr>
				</table></tr>
		';
		
		
		}elseif($numt == 1){
	
	//
				if($go == ""){
			
			
			$title = "تعديل موضوع";
			include ("system/header.php");	
			$stname = topic_row(id,'name');
			//$stimg = $topic_row['t_img'];
			//$stmsg =  $topic_row['t_msg'];
			$xtname = $topic_row['t_name'];
			$xtimg = $topic_row['t_img'];
			$xtmsg = $topic_row['t_msg'];		
			
			//echo a7_editor($array);	
			
			// action="editpost.php?type=edittopic&go=edit&id='.id.'"
			
			echo	'<form method="post" action="post.php?type=edittopic&go=edit&id='.id.'" class="form-editor">';
			echo	'<h4 class="form-signin-heading">'.$title.' : '.$stname.'</h4><hr />';
			echo	'<div class="col-lg-12"><div>';
			echo	'<div class="col-lg-6"><input type="text" class="form-control" name="etname" placeholder="'. $xtname .'" value="'.  $xtname .'" /></div>';
			echo	'<div class="col-lg-6"><div class="form-group col-lg-8"><input type="text" class="form-control" name="etimg" placeholder="'. $xtimg.'" value="'. $xtimg .'" /></div>';
			echo	'</div></div><div><br><br>';
			echo	'<textarea id="dja" name="etmsg" cols="180" rows="23" >'. $xtmsg .'</textarea>';
			echo	'<link rel="stylesheet" href="system/editor/skins/editor.css">';
			echo	'<script type="text/javascript" src="system/editor/editor-min.js"></script><script type="text/javascript">';	
			echo	'Editor.setStyle({"bgColor": "#FFD5B3","borderColor": "#c8c8c8","fontFamily": "tahoma"});';	
			echo	'Editor.run({"replace": "dja","height": 420,"width": 910,"path":"","mode": "advance"});</script>';
			echo	'</div></div><hr />';
			echo	'<center><button type="submit" class="btn btn-primary btn-center" name="btn-edittopic"  onclick="myFunction()">';
			echo	'<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال</button>';
			echo	'<br /></form>';
			?><script>function myFunction() {   alert("هل أنت متاكد من المعلومات المدخلة؟"); } </script><?php
		/*	*/
			  
}elseif($go == "edit" && isset($_POST['btn-edittopic'])){		
		
		
	  	// 	if(isset($_POST['btn-edittopic'])){
			
					$tname = strip_tags($_POST['etname']);
					$tmsg = htmlSpecialchars($_POST['etmsg']);
					$timg = strip_tags($_POST['etimg']);	
					$tid = trim($_REQUEST['id']);

				
						

			if(empty($tname)) {
			$title = "رسالة ادارية";
			include ("system/header.php");
			?>
				<script>
				alert('لم تدخل العنوان');
				window.location.href='post.php?type=edittopic&id=<?php echo id; ?>';
				</script>
            <?php
			}
			else if($tmsg == "&lt;br&gt;") {
		
			$title = "رسالة ادارية";
			include ("system/header.php");
			?><script>alert('لايمكن ادخال موضوع فارغ');window.location.href='post.php?type=edittopic&id=<?php echo id; ?>';</script><?php
			}
			else
			{
				if($topic->edittopic($tname,$tmsg,$timg,$tid)){	
					$title = "رسالة ادارية";
	                include ("system/header.php");
				echo'	<br><br><br><br><br><br>
						<center><table><tr>
					<td class="alert alert-success" colspan="4" width="600"><center>
					تم تعديل الموضوع بنجاح		<br>
							<a href="topic.php&id='.id.'">العودة للموضوع</a>
							<br>
							<a href="home.php">العودة للرئيسية</a>
						</td>
					</tr>
				</table></tr>';
				
				//echo '<meta http-equiv="refresh" content="5" url="topic.php&id=id">'; 
				
				
				//$user->redirect("topic.php?id=".id."");
				
				}else{
					$error = "حدث خطأ ما...";
				}
			}
}
		

	}
		


			

				
				
				
				
				
				
				
			
			
}elseif($type == "addreply"){

						
			
	if($go == ""){
	$title = "إضافة رد";
	include ("system/header.php");	
		$tid = strip_tags($_POST['tid']);
		$fid = trim($_REQUEST['fid']);
		$ruser = $me;
		$rmsg = htmlSpecialchars($_POST['xrmsg']);
		$ure = $user_re + 1;
		$tre = trim($_REQUEST['tre']);
		$fre = trim($_REQUEST['fre']);
		}elseif($go == "insert"){
			 if(isset($_POST['btn-addreply'])){
					
				$tid = strip_tags($_POST['tid']);
				$fid = strip_tags($_POST['fid']);
				$ruser = $me;
				$rmsg = htmlSpecialchars($_POST['xrmsg']);
				$ure = $user_re + 1;
				$tre = strip_tags($_POST['tre']);
				$fre = strip_tags($_POST['fre']);
					
							
					
					
				if($rmsg == "&lt;br&gt;") {
				?><script>alert('أنت لم اكتب شيء ؟؟');window.location.href='topic.php&id=<?php echo id; ?>';</script><?php
				}else{
						try
						{
							if($topic->addreply($tid,$fid,$ruser,$rmsg,$ure,$tre,$fre)){
							//إرسال إشعار للعضو بأنه تم الرد على موضوعه
							$t_id=$tid;$n_type=2; 
							like_n($t_id,$me,$n_type);
							$user->redirect('topic.php&id='.id.'');
							}else{	$error = "حدث خطأ ما...";}
						}catch(PDOException $e){echo $e->getMessage();}							

				}
			}
		}
				
			
			
			
			
				
}elseif($type == "editreply"){   //تعديل رد
			


		$stmt = $dbc->runQuery("SELECT * FROM ".prx."replys WHERE r_id=:id ");
		$stmt->execute(array(':id'=>id));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);	
		$numr = $stmt->rowCount();
		
				$rid =  $id;
				$tid =  $row['t_id'];
				$rmsg =  $row['r_msg'];
				$ruser =  $row['user_id'];
				$rdate =  $row['r_date'];
			
		if($numr == 0){
			        $error = "رقم الرد خاطئ";	
					$title = "خطأ";
	                include ("system/header.php");
		echo'	<br><br><br><br><br>
				<center><table><tr>
					<td class="alert alert-danger" colspan="4" width="600"><center>
						 '.$error.'
							<br>
							<!-- <a href="javascript:history.back()">رجوع</a> -->
							<a href="home.php">العودة للرئيسية</a>
						</td>
					</tr>
				</table></tr>
		';
		
		
		}elseif($numr == 1){
	
	//
				if($go == ""){
			
			
			$title = "تعديل  الرد";
			include ("system/header.php");	
			/*
			$rid =  $id;
			$tid =  $row['t_id'];
			$rmsg =  $row['r_msg'];
			$ruser =  $row['user_id'];
			$rdate =  $row['r_date'];	
			*/
			
			
			// action="editpost.php?type=edittopic&go=edit&id='.id.'"
			
			echo	'<form method="post" action="post.php?type=editreply&go=edit&id='.id.'" class="form-editor">';
			echo	'<h4 class="form-signin-heading">'.$title.'</h4>';
			echo	'<div>';
			echo	'<textarea id="dja" name="rmsg" cols="180" rows="23" >'. $rmsg .'</textarea>';
			echo	'<link rel="stylesheet" href="system/editor/skins/editor.css">';
			echo	'<script type="text/javascript" src="system/editor/editor-min.js"></script><script type="text/javascript">';	
			echo	'Editor.setStyle({"bgColor": "#FFD5B3","borderColor": "#c8c8c8","fontFamily": "tahoma"});';	
			echo	'Editor.run({"replace": "dja","height": 420,"width": 910,"path":"","mode": "advance"});</script>';
			echo	'</div>';
			echo	'<div><button type="submit" class="btn btn-primary btn-center" name="btn-editreply"  onclick="myFunction()">';
			echo	'<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال</button></div>';
			echo	'<br /></form>';
			?><script>function myFunction() {   alert("هل أنت متاكد من المعلومات المدخلة؟"); } </script><?php
		/*	*/
			  
}elseif($go == "edit" && isset($_POST['btn-editreply'])){		
		
		
			$rmsg = htmlSpecialchars($_POST['rmsg']);

			
			if($rmsg == "&lt;br&gt;") {
			$title = "رسالة ادارية";
			include ("system/header.php");
			?><script>alert('لايمكن ادخال رد فارغ');	window.location.href='post.php?type=edittopic&id=<?php echo id; ?>';</script><?php
			}
			else
			{
				if($topic->editreply($rmsg,$rid)){	
					$title = "رسالة ادارية";
	                include ("system/header.php");
				echo'	<br><br><br><br><br><br>
						<center><table><tr>
					<td class="alert alert-success" colspan="4" width="600"><center>
					تم تعديل الرد بنجاح		<br>
							<a href="topic.php&id='.$tid.'">العودة للموضوع</a>
							<br>
							<a href="home.php">العودة للرئيسية</a>
						</td>
					</tr>
				</table></tr>';
				
				}else{
					$error = "حدث خطأ ما...";
				}
			}
}
		

	}
		


			

				
				
				
				
				
				
				
	



















			
				
			}elseif($type == "delete"){
					
						$delete = 1;
						$stmt=$dbc->runQuery("UPDATE ".prx."topics SET t_delete =:delete WHERE t_id=:id");
						$stmt->execute(array(':id'=>id));
						$user->redirect('forum.php&id='.topic_row(id,"f_id").'');						
					
				
			}elseif($type == "sticky"){
					
						$stic = 1;
						$stmt=$dbc->runQuery("UPDATE ".prx."topics SET t_sticky =:stic WHERE t_id=:id");
						$stmt->execute(array(':id'=>$id , ':stic'=>$stic));
						$user->redirect('forum.php&id='.topic_row(id,"f_id").'');
					
							
			}elseif($type == "dsticky"){
					
						$dstic = 0;
						$stmt=$dbc->runQuery("UPDATE ".prx."topics SET t_sticky =:dstic WHERE t_id=:id");
						$stmt->execute(array(':id'=>$id , ':dstic'=>$dstic));
						$user->redirect('forum.php&id='.topic_row(id,"f_id").'');						
					
							
			}elseif($type == "lock"){
					
						$lock = 1;
						$stmt=$dbc->runQuery("UPDATE ".prx."topics SET t_locked =:lock WHERE t_id=:id");
						$stmt->execute(array(':id'=>id , ':lock'=>$lock));	
						$user->redirect('forum.php&id='.topic_row(id,"f_id").'');
					
							
			}elseif($type == "unlock"){
					
						$unlock = 0;
						$stmt=$dbc->runQuery("UPDATE ".prx."topics SET t_locked =:unlock WHERE t_id=:id");
						$stmt->execute(array(':id'=>id , ':unlock'=>$unlock));
						$user->redirect('forum.php&id='.topic_row(id,"f_id").'');						
					
							
			}elseif($type == "hidd"){
					
						$hidd = 1;
						$stmt=$dbc->runQuery("UPDATE ".prx."topics SET t_hidden =:hidd WHERE t_id=:id");
						$stmt->execute(array(':id'=>$id , ':hidd'=>$hidd));	
						$user->redirect('forum.php&id='.topic_row(id,"f_id").'');
					
							
			}elseif($type == "show"){
					
						$show = 0;
						$stmt=$dbc->runQuery("UPDATE ".prx."topics SET t_hidden =:show WHERE t_id=:id");
						$stmt->execute(array(':id'=>id , ':show'=>$show));
						$user->redirect('forum.php&id='.topic_row(id,"f_id").'');						
					
							
			}elseif($type == "readit"){
					if($_POST['read_id']){
						$id == $_POST['read_id'];
						$user->notifi_hide($id);
						/*?><script>window.location.href='notifications.html';	</script><?php*/
					}
			}

	
	
	
	
	
	
	
	
	
	
	
	

$tpl->indexFooter();