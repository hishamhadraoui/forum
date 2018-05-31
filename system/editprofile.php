<?php

global $gets, $agets, $dbc, $topic_row,$pg,
$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,
$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$user ;	
	$title = "تعديل صفحتي";
	$body = "sig";
	include ("system/header.php");
	
	
				if(isset($_POST['btn-editprofile'])){
			$uavatar = strip_tags($_POST['txt_avatar']);	
			$ubg = strip_tags($_POST['txt_userbg']);
			$ufb = strip_tags($_POST['txt_mfb']);	
			$utw = strip_tags($_POST['txt_mtw']);	
			$ugp = strip_tags($_POST['txt_mgp']);	
			$uyo = strip_tags($_POST['txt_myo']);	
			$id = $me;
			if($uavatar == "") {
						$error[] = "فضلا ادخل رابط الصورة الشخصية";
			}else if($ubg == "") {
						$error[] = "انت لم تدخل رابط صورة غلافك";
			}else if($id != $me) {
						$error[] = "لقد غيرت رقم عضويتك فكيف تريد التغيير ؟";
			}else
					{
			try
				{
				if($user->editprofile($uavatar,$ubg,$ufb,$utw,$ugp,$uyo,$id)){	
				$title = "رسالة ادارية";
				//include ("system/header.php");
			?><tr>
			<td class="alert alert-info" colspan="4" width="600"><center>
			  <div class="alert alert-info">
				تم التعديل بنجاح....
					<br>
					<a href="profile.php">العودة للبروفيل</a>
					<br>
					<a href="home.php">العودة للرئيسية</a>
				  </div></center></td>
			</tr>
			</table></tr>
			<?php	
				}
					
				}
				catch(PDOException $e)
				{
					echo $e->getMessage();
				}
			}
			}
	        
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
	
	// action="chkpost.php?type=editprofile"
?>

<form method="post" class="form-home">
<div style="background: url(<?php echo $user_bg;?>); width:100%;">	
<br><br></span>

<div class="row form-home">        
       

صورة الغلاف	   <input type="text" class="form-control" name="txt_userbg"  value="<?php echo $user_bg;?>" />
الصورة الرمزية		<input type="text" class="form-control" name="txt_avatar"  value="<?php echo $useravatar;?>" />
فيسبوك	   <input type="text" class="form-control" name="txt_mfb"  value="<?php echo $my_mfb;?>" />
تويتر		<input type="text" class="form-control" name="txt_mtw"  value="<?php echo $my_mtw;?>" />	 
جوجل +	   <input type="text" class="form-control" name="txt_mgp"  value="<?php echo $my_mgp;?>" />
يوتيوب		<input type="text" class="form-control" name="txt_myo"  value="<?php echo $my_myo;?>" />	



	
</div>	
<br><br><br>
</div>	
	            <div class="clearfix"></div><hr />
            <div class="form-group"><center>
            	<button type="submit" class="btn btn-primary" name="btn-editprofile">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />
 
        </form>




			
			<?php
				
	
	

	
	
		