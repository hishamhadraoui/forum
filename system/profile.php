<?php


global $gets, $agets, $dbc, $topic_row,$pg,
$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,
$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$user ;


	$title = "صفحتي";
	$body = "profile";
	include ("system/header.php");	
?>



<div style="background: url(<?php echo $user_bg;?>); width:100%;">	
<br><br><br>
<div class="row form-home">        
       
	 
	<div class="col-lg-5 col-sm-5">	
		<span>	الاسم : <?php echo $username; ?></span>
		<br>
		<span> الاميل : <?php echo $useremail; ?></span>
		<br>
		<span> المواضيع : <?php echo $user_to; ?></span>
		<br>
		<span> الردود : <?php echo $user_re; ?></span>
		<br>
		<span>	الرتبة : <?php echo moderator($me); ?></span>
		<br>
		<span> المشاركات الكلية : <?php echo $my_posts; ?></span>
		<br>
		<span> الإنضمام : <?php echo $joining_date; ?></span>
		<br>
	
		
		
		
	</div>	 
	<div class="col-lg-5 col-sm-5">
	</div>
     <div class="col-lg-2 col-sm-2">
	 <a href="profile.php"><?php  echo "<img src='".avatar($useravatar,$usergender)."' class='img-rounded' width='100px' height='100px' />";?>
		</a>
	</div>		
</div>	

<br><br>
</div>
		<div class="jumbotron">
		<span> التوقيع : <br><?php echo html_entity_decode($my_sig); ?></span>
		</div>
	
	<div class="col-lg-6 col-xs-6 left">	
	<p class="page-header">
	<span><a href="profile.edit" title="click for edit"><span class="glyphicon glyphicon-edit"></span>&nbsp;تعديل البيانات الشخصية</a>&nbsp;</span>
	<br>
	<span><a href="edit.sig" title="click for edit"><span class="glyphicon glyphicon-edit"></span>&nbsp;تعديل التوقيع الشخصي</a>&nbsp;</span>
	</p>
	</div>	 



