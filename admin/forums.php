<?php

?>
<script src="system/js/jscolor.js"></script>
<div class="list-group-item active"><center>هنا يمكنك إضافة تعديل أو حذف منتدى أو قسم</div>
 
    <div class="list-group col-md-2 col-lg-2">
      <a class="list-group-item <?php print "".($type == "add" ? "active" : "")." ";?>" href="admin.php?op=forums&type=add">إضافة منتدى أو قسم</a>
      <a class="list-group-item <?php print "".($type == "edit" ? "active" : "")." ";?>" href="admin.php?op=forums&type=edit">التحكم في المنتديات</a>
      <a class="list-group-item <?php print "".($type == "mod" ? "active" : "")." ";?>"  href="admin.php?op=forums&type=mod">إضافة مشرف أو مراقب</a>
 </div>
 
 
<div class="list-group form-home col-md-10 col-lg-10"> 
 
<?php





if(type == "add"){

	
if(isset($_POST['btn-signup']))
{
	//$uname = strip_tags($_POST['txt_uname']);
	//$umail = strip_tags($_POST['txt_umail']);
	//$upass = strip_tags($_POST['txt_upass']);	
	
	$fname = strip_tags($_POST['txt_fname']);
	$ficon = strip_tags($_POST['txt_ficon']);	
	$ftype = strip_tags($_POST['txt_ftype']);
	$fcat = strip_tags($_POST['txt_fcat']);	
	$fdesc = strip_tags($_POST['txt_fdesc']);
	$fbgc = strip_tags($_POST['txt_fbgc']);
	$fbg = strip_tags($_POST['txt_fbg']);	
	$fblog = strip_tags($_POST['txt_fblog']);
	try
		{
			$stmt = $dbc->runQuery("SELECT f_name FROM ".prx."forums WHERE f_name=:fname");
			$stmt->execute(array(':fname'=>$fname));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['f_name']==$fname) {
				$error[] = "يوجد منتدى بنفس الاسم مسبقا";
			}
			else if($fname == "") {
				$error[] = "يجب كتابة عنوان!";
			}
			else
			{
				if($user->addf($fname,$ficon,$ftype,$fcat,$fdesc,$fbgc,$fbg,$fblog)){	
					?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i>  &nbsp; تم ادخال المعلومات بنجاح <a href='admin.php?op=forums'>العودة</a> 
                 </div>
                 <?php
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
}



	

?>
<!--
<div class="signin-form">
<div class="container">
    -->	
        <form method="post" class="form-signin">
            <h4 class="form-signin-heading">إضافة منتدى أو قسم جديد</h4><hr />
            <?php
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
			else if(isset($_GET['ok']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i>  &nbsp; تم ادخال المعلومات بنجاح <a href='admin.php?op=forums'>العودة</a> 
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_fname" placeholder="عنوان القسم أو المنتدى"  />
            </div>
			<div class="form-group">
            <input type="text" class="form-control" name="txt_fdesc" placeholder="وصف المنتدى أو القسم" />
            </div>
			<div class="form-group">
            <input type="text" class="form-control input color" name="txt_fbgc" placeholder="" />
            </div>
		
			<div class="form-group">
            <input type="text" class="form-control" name="txt_fbg" placeholder="رابط صورة الخلفية" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_ficon" placeholder="أيقونة المنتدى أو القسم" />
            </div>
			<div class="form-group">
            <fieldset>
					<div class="form-group">
					  <select id="selectbasic" name="txt_ftype" class="form-control form-control-lg">
						  <option value="0"><strong>ماذا تريد أن تضيف؟</strong></option>
						  <option value="0">قسم</option>
						  <option value="1">منتدى</option>
						</select>
					 </div>
			</fieldset>
			</div>
            
			<div class="form-group">
            							<fieldset>
							<div class="form-group">
							  
							  <div class="">
								<select id="selectbasic" name="txt_fcat" class="form-control">
								  <option value="0">المنتدى تابع لـ:</option>
								  <option value="0">بدون أب</option>
								  
								  <?php
			$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type='0' ");
			$stmt->execute();
			// $row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			$fname==$row['f_name'];
							
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

			echo '<option value="'.$row['f_id'].'" "'.(id == $row['f_id'] ? "selected" : "").'">'.$row['f_name'].'</option>';

			}
								?>	
								
								</select>
							  </div>
							</div>

			</fieldset>

			
            </div>
							<div class="form-group">
							<fieldset>
										<select id="selectbasic" name="txt_fblog" class="form-control">
										  <option value="0">شكل عرض المنتديات أو المواضيع</option>
										  <option value="0">عادي</option>
										  <option value="1">مربعات</option>
										</select>
							</fieldset>
							</div>
							
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />
 
        </form>
<!--
</div>
</div>
-->

<?php








}



if(type == "edit"){
	
	
if($id == ""){	


				
				$ctype = 0;
				$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type=:ctype ");
				$stmt->execute(array(':ctype'=>$ctype));
				//$row = $stmt->fetch(PDO::FETCH_ASSOC);	
					
					echo	'<tr><table>';
				
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$cid = $row['f_id'];
				$ctype = $row['f_type'];
				$cat = $row['f_cat'];
				// <img src="'.$row['f_icon'].'" width="100%" height="100"><br>
				echo'
					<tr style="background-color:#'.$row['f_bgc'].';">
						<td class="btn-sm" colspan="4" width="600" ><center>
							<a href="?cat_id='.$row['f_id'].'" alt="'.$row['f_desc'].'" title="'.$row['f_desc'].'"><font color="#fff">'.$row['f_name'].'</a> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							';
							if($usergroup == 7){
						echo'<a href="admin.php?op=forums&type=edit&id='.$row['f_id'].'"><font color="#fff"><span class="glyphicon glyphicon-pencil"></span></a>';
							}	
						echo'
						</td>
					</tr>';

					$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_cat=:cid ");
				$fstmt->execute(array(':cid'=>$cid));
				while($frow = $fstmt->fetch(PDO::FETCH_ASSOC)){
				
				echo	'
					<tr   style="background-color:#'.$frow['f_bgc'].';">
						<td width="2%"><img src="'.$frow['f_icon'].'" width="28"></td> 
						<td align="right"><h5>
						<a href="forum.php?id='.$frow['f_id'].'">'.$frow['f_name'].'</a>
						<h6>'.$frow['f_desc'].'</h6> </h5></td>
						<td><h6>المواضيع '.$frow['f_t'].'</br> الردود '.$frow['f_r'].'</h6></td>';
						
						
						if($usergroup == 7){
						
				
						echo	'
							<td><a href="admin.php?op=forums&type=edit&id='.$frow['f_id'].'"><span class="glyphicon glyphicon-pencil"></span> </a></td>
						
						';
					}
						
						
						
						echo	'
					</tr>';
				
					}
				
				}
					
					echo	'</table></tr>';
				
		

	
	}else{
	
	
	?>
	 <div class="clearfix"></div><hr />
           
	
	<?php
	
	///////edit
	
	if(isset($_POST['btn-editf']))
{
	//$uname = strip_tags($_POST['txt_uname']);
	//$umail = strip_tags($_POST['txt_umail']);
	//$upass = strip_tags($_POST['txt_upass']);	
	
	$cfname = strip_tags($_POST['txt_cfname']);
	$cficon = strip_tags($_POST['txt_cficon']);	
	$cftype = strip_tags($_POST['txt_cftype']);
	$cfcat = strip_tags($_POST['txt_cfcat']);	
	$cfdesc = strip_tags($_POST['txt_cfdesc']);
	$cfbgc = strip_tags($_POST['txt_cfbgc']);
	$cfbg = strip_tags($_POST['txt_cfbg']);
	$cfblog = strip_tags($_POST['txt_cfblog']);
	
	
	
	$stmt = $dbc->runQuery("UPDATE ".prx."forums 
							SET f_name=:cfname, 
							f_type=:cftype, 
							f_cat=:cfcat,
							f_desc=:cfdesc,
							f_bgc=:cfbgc,
							f_bg=:cfbg,
							f_blog=:cfblog,
							f_icon=:cficon 
							WHERE f_id=:f_id");
			
				
	if($stmt->execute( array(		
			':cfname'=>$cfname,
			':cftype'=>$cftype,
			':cfcat'=>$cfcat,
			':cfdesc'=>$cfdesc,
			':cfbgc'=>$cfbgc,
			':cfbg'=>$cfbg,
			':cfblog'=>$cfblog,
			':cficon'=>$cficon,
			':f_id'=>$id
									))){
				
				
				
				?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i>  &nbsp; تم ادخال المعلومات بنجاح <a href='admin.php?op=forums'>العودة</a> 
                 </div>
                 <?php
				
			}
			else{
				$errMSG = "هناك خطأ ما...";
			}
		


	
}



	

?>





<?php
			
			
			
			
			
			$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_id=:id ");
			$stmt->execute(array(':id'=>$id));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			
			
			
?>
<!--
<div class="signin-form">
<div class="container">
    -->	
        <form method="post" class="form-signin">
            <h4 class="form-signin-heading">تعديل <?php echo $row['f_name'];?></h4><hr />

			<?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
			
			
								
								
            <div class="form-group">
            <input type="text" class="form-control" name="txt_cfname" placeholder="<?php echo $row['f_name'];?>" value="<?php echo $row['f_name'];?>" />
            </div>
			<div class="form-group">
            <input type="text" class="form-control" name="txt_cfdesc" placeholder="<?php echo $row['f_desc'];?>" value="<?php echo $row['f_desc'];?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control input color" name="txt_cfbgc" placeholder="<?php echo $row['f_bgc'];?>" value="<?php echo $row['f_bgc'];?>" />
            </div>
		
			<div class="form-group">
            <input type="text" class="form-control" name="txt_cfbg" placeholder="" value="<?php echo $row['f_bg'];?>" />
            </div>
		
			<div class="form-group">
            <input type="text" class="form-control" name="txt_cficon" placeholder="أيقونة المنتدى أو القسم" value="<?php echo $row['f_icon'];?>" />
            </div>
							<div class="form-group">
							<fieldset>
									<div class="form-group">
									  <label class="col-md-8 " for="">شكل عرض المنتديات أو المواضيع</label>
									  <div class="col-md-4">
										<select id="selectbasic" name="txt_cfblog" class="form">
										<option value="0" <?php echo $row['f_blog'] == 0 ? "selected" : "" ; ?>>عادي</option>
										<option value="1" <?php echo $row['f_blog'] == 1 ? "selected" : "" ; ?>>مربعات</option>
										</select>
									  </div>
									</div>
							</fieldset>
							</div>
			
			
			<div class="form-group">
            <fieldset>
					<div class="form-group">
					  <label class="col-md-8 control-label" for="selectbasic">هل تريد تغيير نوع المنتدى</label>
					  <div class="col-md-4">
						<select id="selectbasic" name="txt_cftype" class="form">
						
							<?php if($row['f_type'] == 0){ ?>	
							<option value="0">قسم</option>
							<option value="1">منتدى</option>   
							<?php }if($row['f_type'] == 1){ ?>	
							<option value="1">منتدى</option>  
							<option value="0">قسم</option>
							<?php } ?>
						</select>
					  </div>
					</div>
			</fieldset>
			</div>
            
			<div class="form-group">
            							<fieldset>
							<div class="form-group">
							  <label class="col-md-8 control-label" for="selectbasic">المنتدى تابع لـ:</label>
							  <div class="col-md-4">
								<select id="selectbasic" name="txt_cfcat" class="form">
								
								
								
								
								
								<?php
								
			$xstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_id=:fcat ");
			$xstmt->execute(array(':fcat'=>$row['f_cat']));
			$xrow=$xstmt->fetch(PDO::FETCH_ASSOC);					
				

				
			if($row['f_cat'] == 0){
			?><option value="0">بدون أب</option><?php	
			
			$ostmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type='0'");
			$ostmt->execute(array(':idid'=>$idid, ':xid'=>$xid));
			while($orow=$ostmt->fetch(PDO::FETCH_ASSOC)){
			if($orow['f_id'] != $row['f_id']){
			echo '<option width="250" value="'.$orow['f_id'].'" "'.(id == $orow['f_id'] ? "selected" : "").'">'.$orow['f_name'].'</option>';
											}
			}
			
			
			
			
			
			}else{
				
				echo '<option width="250" value="'.$xrow['f_id'].'">'.$xrow['f_name'].'</option>'; 	
				
				
				$ostmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type='0'");
				$ostmt->execute(array(':idid'=>$idid, ':xid'=>$xid));
				while($orow=$ostmt->fetch(PDO::FETCH_ASSOC)){
					if($orow['f_id'] != $xrow['f_id']){
					echo '<option width="250" value="'.$orow['f_id'].'" "'.(id == $orow['f_id'] ? "selected" : "").'">'.$orow['f_name'].'</option>';
					}
				}
			?><option value="0">بدون أب</option><?php	
			
			}
								
								  			
						
			
								?>	
								
								</select>

							  </div>
								<span class="col-md-12"><h6>في حالة جعلته تابعا لقسم آخر يجب  أن تجعله منتدى</h6></span>
							  </div>

			</fieldset>

			
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-editf">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />
 
        </form>
		
		
<!--       
</div>
</div>
-->

<?php
	

	
	/////////////////edit
	
}  	
	
}  




?>
</div>


























