<?php

	
	
global $gets, $agets, $dbc, $topic_row,$pg,
$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,
$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$user, $go ;
	
	
	$title = "تعديل التوقيع";
	$body = "sig";
	include ("system/header.php");	
			if(isset($_POST['btn-sig'])){		
			$nsig = htmlSpecialchars($_POST['nsig']);	
			$mid = $me;
			if($user->editsig($nsig,$mid)){	
				$title = "رسالة ادارية";
				include ("system/header.php");
			echo'	<br>
			<center><table><tr>
			<td class="alert alert-success" colspan="4" width="600"><center>
			<div class="alert alert-success">
			تم تعديل التوقيع بنجاح		<br>
			<a href="profile.php">العودة للبيانات</a>
			<br>
			<a href="home.php">العودة للرئيسية</a>
			</div>	</center>
			</td>
			</tr>
			</table></tr>';
			}else{
				$error = "حدث خطأ ما...";
			}
			}	
			

 //action="chkpost.php?type=sig" 
			$xsig = $my_sig;		
			

			
			echo	'<form method="post" class="form-editor">';
			echo	'<h4 class="form-signin-heading">'.$title.'</h4><hr />';

			echo	'<textarea id="dja" name="nsig" cols="180" rows="23" >'. $xsig .'</textarea>';
			echo	'<link rel="stylesheet" href="system/editor/skins/editor.css">';
			echo	'<script type="text/javascript" src="system/editor/editor-min.js"></script><script type="text/javascript">';	
			echo	'Editor.setStyle({"bgColor": "#FFD5B3","borderColor": "#c8c8c8","fontFamily": "tahoma"});';	
			echo	'Editor.run({"replace": "dja","height": 420,"width": 920,"path":"","mode": "advance"});</script>';
			echo	'</div></div><hr />';
			echo	'<center><button type="submit" class="btn btn-primary btn-center" name="btn-sig" onclick="return message("هل انت متأكد من ادخال المعلومات");">';
			echo	'<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال</button>';
			echo	'<br /></form>';
		/*	*/
			  
			  
			  
			  
			  
			  
			  
			  
		
		
		
		
		
		
		
	
		
		
		
		
		
		
		
		
		

//	include ("footer.php");

	
	
	
	
		