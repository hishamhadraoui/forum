<?php

?>
<script src="system/js/jscolor.js"></script>
<div class="list-group-item active"><center>هذه الصفحة خاصة بالمدير الأول فقط للتحكم في خيارات الموقع الحساسة</div>
 
 <div class="list-group col-md-2 col-lg-2">
  <a href="admin.php?op=option&type=option_0" class="list-group-item <?php print "".($type == "option_0" ? "active" : "")." ";?>">خيارات الموقع الافتراضية</a>
  <a href="admin.php?op=option&type=edit_pages" class="list-group-item <?php print "".($type == "edit_pages" ? "active" : "")." ";?>">التحكم في صفحات الموقع</a>
  <a href="admin.php?op=option&type=menu" class="list-group-item <?php print "".($type == "menu" ? "active" : "")." ";?>">التحكم في القوائم</a>
  <a href="admin.php?op=option&type=option_users" class="list-group-item <?php print "".($type == "option_users" ? "active" : "")." ";?>">خيارات مجموعات الأعضاء</a>
  <a href="admin.php?op=option&type=add_group" class="list-group-item <?php print "".($type == "add_group" ? "active" : "")." ";?>">إضافة مجموعة</a>
</div>
 
 
<div class="list-group col-md-10 col-lg-10"> 
 
<?php

if($type == "option_users"){
?>

<div class="list-group-item active col-lg-12 col-sm-12">المجموعات</div>
		<div class="form-home col-lg-12 col-sm-12">
<div class="col-md-3 col-lg-3">
<?php


			
			$estmt = $dbc->runQuery("SELECT * FROM ".prx."ugroups order by group_l asc");
			$estmt->execute();
			$nnn=$estmt->rowCount();	
			
			while($row=$estmt->fetch(PDO::FETCH_ASSOC))
			{
				
			

			$group_id=$row['group_id'];	
			$group_color=$row['group_color'];
			$group_name=$row['group_name'];
			$group_l=$row['group_l'];
echo'
<div  class="list-group-item col-lg-12 col-sm-12">
<a href="admin.php?op=option&type=option_users&n='.$group_l.'"><font color="'.$group_color.'"><b>'.$group_name.'</b></font></a>

<span style="color:red;font-size:12px;float:left;">
<a href="admin.php?op=option&type=edit_group&id='.$group_l.'"title="تعديل"><font color="blue"><center>
<i class="fa fa-pencil-square-o" aria-hidden="true"></i></font></a></span>&nbsp;&nbsp;&nbsp;&nbsp;
<span style="color:red;font-size:12px;float:left;">
<a href="admin.php?op=option&type=del_group&id='.$group_l.'"title="حذف"><font color="red"><center>
<i class="fa fa-close" aria-hidden="true"></i></font></a></span>
</div>';
			}

echo'</div>';
			
if($n != ""){


echo'<div class="list-group col-md-9 col-lg-9">';
echo'<div class="list-group-item active"><center>';
echo group_op($n,"name");
echo'</div>';

		echo'
	<div class="col-lg-6 col-sm-6">
	<h5 class="form-signin-heading">خيارات المواضيع</h5>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"add_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه إضافة موضوع</span>
			</div>	
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"edit_mytopic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه تعديل موضوعه</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"edit_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه تعديل مواضيع الآخرين</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"del_mytopic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه حذف موضوعه</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"del_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه حذف أي موضوع</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"lock_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه غلق  المواضيع</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"unlock_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه فتح المواضيع</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"stick_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه تثبيث المواضيع</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"unstick_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه إلغاء تثبيث المواضيع</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"hidde_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه إخفاء المواضيع</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"unhidde_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه إظهار المواضيع</span>
			</div>

			
	</div>
	
	<div class="col-lg-6 col-sm-6">
	<h5 class="form-signin-heading">خيارات الردود</h5>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"add_reply") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:blue;font-size:12px;">يمكنه إضافة رد</span>
			</div>	
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"edit_myreply") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:blue;font-size:12px;">يمكنه تعديل رده</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"edit_reply") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:blue;font-size:12px;">يمكنه تعديل ردود الآخرين</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"del_myreply") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:blue;font-size:12px;">يمكنه حذف رده</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"del_reply") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:blue;font-size:12px;">يمكنه حذف أي رد</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"hidde_reply") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:blue;font-size:12px;">يمكنه إخفاء الردود</span>
			</div>
			<div class="col-lg-11 col-sm-11">'.(group_op($n,"unhidde_reply") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:blue;font-size:12px;">يمكنه إظهار الردود</span>
			</div>

	</div>

<br>
</div>';

}else{
echo'<div class="list-group col-md-9 col-lg-9">

<div class="alert alert-Success">
	
<center>		
<br>	<br>	
	هنا تظهر خصائص المجموعات المظافة ومايمكن لكل مجموعة التحكم فيه
	
<br><br>	
 
يمكنك الإنتقال بين المجموعة لإظهار الخصائص 
 
 <br>	<br>	
	
	كما يمكنك تعديل كل مجموعة على حدى إدا أرتأيت ذلك.
	<br>	<br>	
 </div>


</div>';
}






			

?></div></div><?php

?></div><?php
}





////////////////////////////////add group
if($type == "add_group"){

	
if(isset($_POST['btn-add_group']))
{
	$gname = strip_tags($_POST['txt_gname']);
	//$glevel = strip_tags($_POST['txt_level']);	
	$gcolor = strip_tags($_POST['txt_color']);
		
	$add_topic = strip_tags($_POST['add_topic']);
	$edit_mytopic = strip_tags($_POST['edit_mytopic']);
	$edit_topic = strip_tags($_POST['edit_topic']);
	$del_mytopic = strip_tags($_POST['del_mytopic']);
	$del_topic = strip_tags($_POST['del_topic']);
	$lock_topic = strip_tags($_POST['lock_topic']);
	$unlock_topic = strip_tags($_POST['unlock_topic']);
	$stick_topic = strip_tags($_POST['stick_topic']);
	$unstick_topic = strip_tags($_POST['unstick_topic']);
	$hidde_topic = strip_tags($_POST['hidde_topic']);
	$unhidde_topic = strip_tags($_POST['unhidde_topic']);
	
	$add_reply = strip_tags($_POST['add_reply']);
	$edit_myreply = strip_tags($_POST['edit_myreply']);
	$edit_reply = strip_tags($_POST['edit_reply']);
	$del_myreply = strip_tags($_POST['del_myreply']);
	$del_reply = strip_tags($_POST['del_reply']);
	$hidde_reply = strip_tags($_POST['hidde_reply']);
	$unhidde_reply = strip_tags($_POST['unhidde_reply']);
	
	
	try
		{
			$stmt = $dbc->runQuery("SELECT group_name FROM ".prx."ugroups WHERE group_name=:gname");
			$stmt->execute(array(':gname'=>$gname));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['group_name']==$gname) {
				$error[] = "توجد مجموعة بنفس الاسم مسبقا";
			}
			else if($gname == "") {
				$error[] = "يجب كتابة عنوان!";
			}
			else
			{
				if($user->addgroup($gname,$gcolor,$add_topic,$edit_mytopic,$edit_topic,$del_mytopic,$del_topic,$lock_topic,$unlock_topic,$stick_topic,$unstick_topic,$hidde_topic,$unhidde_topic,$add_reply,$edit_myreply,$edit_reply,$del_myreply,$del_reply,$hidde_reply,$unhidde_reply))
				{	
					?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i>  &nbsp; تم ادخال المعلومات بنجاح <a href='admin.php?op=option'>العودة</a> 
                 </div>
                 <?php
				}else{
					?><div class="alert alert-danger">
                      هناك خطأ ربم الرقم موجود من قبل ...
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
        <form method="post" class="form-home">
            <h5 class="form-signin-heading">إضافة مجموعة جديدة</h5><hr />
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
			
			?>
			<div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_gname" placeholder="اسم المجموعة"  />
            </div>
			<!--<div class="form-group">
            <input type="text" class="form-control" name="txt_level" placeholder="رقم المجموعة"  />
            </div>-->
            <div class="form-group">
            <input type="text" class="form-control  input color" name="txt_color" placeholder="لون المجموعة" />
            </div>
			<div><hr />
			
			<div class="col-lg-12 col-sm-12">
			<div class="row">
			
			<div class="col-lg-6 col-sm-6">
			<h5 class="form-signin-heading">خيارات المواضيع</h5><hr />
			<div class="form-group">
				<select class="inputselect" name="add_topic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>
				&nbsp;&nbsp;<span style="color:red;font-size:12px;">يمكنه إضافة موضوع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="edit_mytopic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>
				&nbsp;&nbsp;<span style="color:red;font-size:12px;">يمكنه تعديل موضوعه</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="edit_topic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>
				&nbsp;&nbsp;<span style="color:red;font-size:12px;">يمكنه تعديل مواضيع الآخرين</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="del_mytopic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه حذف موضوعه</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="del_topic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه حذف أي موضوع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="lock_topic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه غلق  المواضيع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="unlock_topic"> 
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه فتح المواضيع</span>
				
			</div>
			<div class="form-group">
				<select class="inputselect" name="hidde_topic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه إخفاء المواضيع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="unhidde_topic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه إظهار المواضيع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="stick_topic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه تثبيث المواضيع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="unstick_topic">
				<option value="0">لا</option>
				<option value="1">نعم</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه إلغاء تثبيث المواضيع</span>
			</div>
			</div>
			

						<div class="col-lg-6 col-sm-6">
						<h5 class="form-signin-heading">خيارات الردود</h5><hr />
						<div class="form-group">
							<select class="inputselect" name="add_reply">
							<option value="0">لا</option>
							<option value="1">نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">يمكنه إضافة رد</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="edit_myreply">
							<option value="0">لا</option>
							<option value="1">نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">يمكنه تعديل رده</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="edit_reply">
							<option value="0">لا</option>
							<option value="1">نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">يمكنه تعديل ردود الآخرين</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="del_myreply">
							<option value="0">لا</option>
							<option value="1">نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">يمكنه حذف رده</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="del_reply">
							<option value="0">لا</option>
							<option value="1">نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">يمكنه حذف أي رد</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="hidde_reply">
							<option value="0">لا</option>
							<option value="1">نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">يمكنه إخفاء الردود</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="unhidde_reply">
							<option value="0">لا</option>
							<option value="1">نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">يمكنه إظهار الردود</span>
						</div>
						</div>
			
			
			</div>
			</div>
			          
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-add_group">
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
////////////////////////end add group

////////////////////////////////edit group
if($type == "edit_group"){

	
if(isset($_POST['btn-edit_group']))
{
	$gname = strip_tags($_POST['txt_gname']);
	//$glevel = strip_tags($_POST['txt_level']);	
	$gcolor = strip_tags($_POST['txt_color']);
	
	$add_topic = strip_tags($_POST['add_topic']);
	$edit_mytopic = strip_tags($_POST['edit_mytopic']);
	$edit_topic = strip_tags($_POST['edit_topic']);
	$del_mytopic = strip_tags($_POST['del_mytopic']);
	$del_topic = strip_tags($_POST['del_topic']);
	$lock_topic = strip_tags($_POST['lock_topic']);
	$unlock_topic = strip_tags($_POST['unlock_topic']);
	$stick_topic = strip_tags($_POST['stick_topic']);
	$unstick_topic = strip_tags($_POST['unstick_topic']);
	$hidde_topic = strip_tags($_POST['hidde_topic']);
	$unhidde_topic = strip_tags($_POST['unhidde_topic']);

	$add_reply = strip_tags($_POST['add_reply']);
	$edit_myreply = strip_tags($_POST['edit_myreply']);
	$edit_reply = strip_tags($_POST['edit_reply']);
	$del_myreply = strip_tags($_POST['del_myreply']);
	$del_reply = strip_tags($_POST['del_reply']);
	$hidde_reply = strip_tags($_POST['hidde_reply']);
	$unhidde_reply = strip_tags($_POST['unhidde_reply']);
	
	
	
	
	try
		{
		if($user->updategroup($id,$gname,$gcolor,$add_topic,$edit_mytopic,$edit_topic,$del_mytopic,$del_topic,$lock_topic,$unlock_topic,$stick_topic,$unstick_topic,$hidde_topic,$unhidde_topic,$add_reply,$edit_myreply,$edit_reply,$del_myreply,$del_reply,$hidde_reply,$unhidde_reply))
		{	
					?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i>  &nbsp; تم ادخال المعلومات بنجاح <a href='admin.php?op=option&type=edit_group&id=<?php echo $id; ?>'>العودة</a> 
                 </div>
                 <?php
		}else{
					?><div class="alert alert-info">
                     هناك خطأ ما تأكد من الامر...
                 </div>	
				<?php
		}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
}



?>

<div class="list-group-item active col-lg-12 col-sm-12">المجموعات</div>
		<div class="form-home col-lg-12 col-sm-12">
		<div class="row">
<?php

			
			

			$group_id=group_op($id,'id');	
			$group_color=group_op($id,'color');
			$group_name=group_op($id,'name');
			$group_l = $id;
			
			
			$add_topic=group_op($id,'add_topic');
			$edit_mytopic=group_op($id,'edit_mytopic');
			$edit_topic=group_op($id,'edit_topic');
			$del_mytopic=group_op($id,'del_mytopic');
			$del_topic=group_op($id,'del_topic');
			$lock_topic=group_op($id,'lock_topic');
			$unlock_topic=group_op($id,'unlock_topic');
			$stick_topic=group_op($id,'stick_topic');
			$unstick_topic=group_op($id,'unstick_topic');
			$hidde_topic=group_op($id,'hidde_topic');
			$unhidde_topic=group_op($id,'unhidde_topic');


			$add_reply = group_op($id,'add_reply');
			$edit_myreply = group_op($id,'edit_myreply');
			$edit_reply = group_op($id,'edit_reply');
			$del_myreply = group_op($id,'del_myreply');
			$del_reply = group_op($id,'del_reply');
			$hidde_reply = group_op($id,'hidde_reply');
			$unhidde_reply = group_op($id,'unhidde_reply');			
			

	

?>
	
        <form method="post" class="form-home">
            <h5 class="form-signin-heading">تعديل مجموعة <?php  echo $group_name; ?></h5><hr />
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
			
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_gname" placeholder="<?php echo $group_name; ?>" value="<?php echo $group_name; ?>" />
            </div>
			<!--<div class="form-group">
            <input type="text" disabled="disabled" class="form-control" name="txt_level" placeholder="<?php //echo $group_l; ?>" value="<?php echo $group_l; ?>" />
            </div>-->
            <div class="form-group">
            <input type="text" class="form-control  input color" name="txt_color" placeholder="<?php echo $group_color; ?>" value="<?php echo $group_color; ?>" />
            </div>
			
			
			
			<div class="col-lg-12 col-sm-12">
			<div class="row">
			
			<div class="col-lg-6 col-sm-6">
			<h5 class="form-signin-heading">خيارات المواضيع</h5><hr />
			<div class="form-group">
				<select class="inputselect" name="add_topic">
				<option value="1" <?php echo $add_topic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $add_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>
				&nbsp;&nbsp;<span style="color:red;font-size:12px;">يمكنه إضافة موضوع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="edit_mytopic">
				<option value="1" <?php echo $edit_mytopic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $edit_mytopic == 0 ? "selected" : ""; ?> >لا</option>
				</select>
				&nbsp;&nbsp;<span style="color:red;font-size:12px;">يمكنه تعديل موضوعه</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="edit_topic">
				<option value="1" <?php echo $edit_topic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $edit_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>
				&nbsp;&nbsp;<span style="color:red;font-size:12px;">يمكنه تعديل مواضيع الآخرين</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="del_mytopic">
				<option value="1" <?php echo $del_mytopic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $del_mytopic == 0 ? "selected" : ""; ?> >لا</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه حذف موضوعه</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="del_topic">
				<option value="1" <?php echo $del_topic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $del_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه حذف أي موضوع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="lock_topic">
				<option value="1" <?php echo $lock_topic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $lock_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه غلق  المواضيع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="unlock_topic"> 
				<option value="1" <?php echo $unlock_topic == 1 ? "selected" : ""; ?> >نعم</option>
				<option value="0" <?php echo $unlock_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه فتح المواضيع</span>
				
			</div>
			<div class="form-group">
				<select class="inputselect" name="hidde_topic">
				<option value="1" <?php echo $hidde_topic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $hidde_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه إخفاء المواضيع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="unhidde_topic">
				<option value="1" <?php echo $unhidde_topic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $unhidde_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه إظهار المواضيع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="stick_topic">
				<option value="1" <?php echo $stick_topic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $stick_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه تثبيث المواضيع</span>
			</div>
			<div class="form-group">
				<select class="inputselect" name="unstick_topic">
				<option value="1" <?php echo $unstick_topic == 1 ? "selected" : "" ; ?> >نعم</option>
				<option value="0" <?php echo $unstick_topic == 0 ? "selected" : ""; ?> >لا</option>
				</select>&nbsp;&nbsp;
				<span style="color:red;font-size:12px;">يمكنه إلغاء تثبيث المواضيع</span>
			</div>
			</div>
			
			
			
			<div class="col-lg-6 col-sm-6">
						<h5 class="form-signin-heading">خيارات الردود</h5><hr />
						<div class="form-group">
							<select class="inputselect" name="add_reply">
							<option value="0" <?php echo $add_reply == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo $add_reply == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">يمكنه إضافة رد</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="edit_myreply">
							<option value="0" <?php echo $edit_myreply == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo $edit_myreply == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">يمكنه تعديل رده</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="edit_reply">
							<option value="0" <?php echo $edit_reply == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo $edit_reply == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">يمكنه تعديل ردود الآخرين</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="del_myreply">
							<option value="0" <?php echo $del_myreply == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo $del_myreply == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">يمكنه حذف رده</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="del_reply">
							<option value="0" <?php echo $add_topic == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo $add_topic == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">يمكنه حذف أي رد</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="hidde_reply">
							<option value="0" <?php echo $add_topic == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo $add_topic == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">يمكنه إخفاء الردود</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="unhidde_reply">
							<option value="0" <?php echo $add_topic == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo $add_topic == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">يمكنه إظهار الردود</span>
						</div>
						</div>
			
			</div>
			</div>
			
			          
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-edit_group">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />
 
        </form>


<?php

}
////////////////////////end edit group













if($type == "option_0"){

	
			if(isset($_POST['btn-option']))
			{	$title = strip_tags($_POST['txt_title_op']);
				$adress = strip_tags($_POST['txt_adress_op']);
				$description = strip_tags($_POST['txt_description_op']);
				$facebook = strip_tags($_POST['txt_facebook_op']);
				$twitter = strip_tags($_POST['txt_twitter_op']);
				$youtube = strip_tags($_POST['txt_youtube_op']);
				$logo = strip_tags($_POST['txt_logo_op']);
				try
					{ 		if(
							$user->update_option(title_nm,$title) &&
							$user->update_option(adress_nm,$adress) &&
							$user->update_option(description_nm,$description) &&
							$user->update_option(facebook_nm,$facebook) &&
							$user->update_option(twitter_nm,$twitter) &&
							$user->update_option(youtube_nm,$youtube) &&
							$user->update_option(logo_nm,$logo) 
							){	
								?>
							 <div class="alert alert-info">
								  <i class="glyphicon glyphicon-log-in"></i>  &nbsp; تم ادخال المعلومات بنجاح <a href='admin.php?op=option&type=option_0'>العودة</a> 
							 </div>
							 <?php
							}
						
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
					
			}

?>
<form method="post" class="form-home form-horizontal"><?php
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
			<label for="exampleInputName2"  class="col-sm-3 list-group-item active">اسم الموقع</label>
            <div class="col-sm-9"><input type="text" class="form-control" name="txt_title_op" placeholder="<?php echo title_op ?>" value="<?php echo title_op ?>" />
            </div>
			</div>
			<div class="form-group">
			<label for="exampleInputName2"  class="col-sm-3 list-group-item active">رابط الموقع</label>
            <div class="col-sm-9"><input type="text" class="form-control" name="txt_adress_op" placeholder="" value="<?php echo adress_op ?>" />
            </div>
			</div>
            <div class="form-group">
            <label for="exampleInputName2"  class="col-sm-3 list-group-item active">وصف الموقع</label>
			<div class="col-sm-9"><input type="text" class="form-control" name="txt_description_op" placeholder=""  value="<?php echo description_op ?>" />
            </div>
			</div>
			
			<div class="form-group">
            <label for="exampleInputName2"  class="col-sm-3 list-group-item active">صفحتنا على فيسبوك</label>
			<div class="col-sm-9"><input type="text" class="form-control" name="txt_facebook_op" placeholder=""  value="<?php echo facebook_op ?>" />
            </div>
			</div>

			<div class="form-group">
            <label for="exampleInputName2"  class="col-sm-3 list-group-item active">صفحتنا على تويتر</label>
			<div class="col-sm-9"><input type="text" class="form-control" name="txt_twitter_op" placeholder=""  value="<?php echo twitter_op ?>" />
            </div>
			</div>

			<div class="form-group">
            <label for="exampleInputName2"  class="col-sm-3 list-group-item active">قناة يوتيوب الموقع</label>
			<div class="col-sm-9"><input type="text" class="form-control" name="txt_youtube_op" placeholder=""  value="<?php echo youtube_op ?>" />
            </div>
			</div>

			<div class="form-group">
            <label for="exampleInputName2"  class="col-sm-3 list-group-item active">رابط لوغو الموقع</label>
			<div class="col-sm-9"><input type="text" class="form-control" name="txt_logo_op" placeholder=""  value="<?php echo logo_op ?>" />
            </div>
			</div>			
		
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-option">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />
 
        </form>
<?php








}



if($type == "edit_pages"){


if(is_admin($me) == "0"){	 // التأكد من العضو اذا كان مديرا
?><div class="clearfix"></div><hr /><div class="alert alert-info">
	<i class="glyphicon glyphicon-log-in"></i>  &nbsp; الصفحة المطلوبة غير موجودة <a href='home.php'>العودة للرئيسية</a> 
 </div><br />
<?php




}else{
	
if(isset($_POST['btn-sbshow']))
{
	
/*	sb_home_op
	sb_users_op
	sb_profile_op
	sb_admin_op
	sb_forum_op
	sb_topic_op
	sb_post_op 
	sb_login_op
*/	
	
	$sb_home = strip_tags($_POST['txt_sb_home_op']);
	$sb_users = strip_tags($_POST['txt_sb_users_op']);
	$sb_profile = strip_tags($_POST['txt_sb_profile_op']);
	$sb_admin = strip_tags($_POST['txt_sb_admin_op']);
	$sb_forum = strip_tags($_POST['txt_sb_forum_op']);
	$sb_topic = strip_tags($_POST['txt_sb_topic_op']);
	$sb_post = strip_tags($_POST['txt_sb_post_op']);
	$sb_login = strip_tags($_POST['txt_sb_login_op']);

	try
		{
			
				if(
				$user->update_option(sb_home_nm,$sb_home) &&
				$user->update_option(sb_users_nm,$sb_users) &&
				$user->update_option(sb_profile_nm,$sb_profile) &&
				$user->update_option(sb_admin_nm,$sb_admin) &&
				$user->update_option(sb_forum_nm,$sb_forum) &&
				$user->update_option(sb_topic_nm,$sb_topic) &&
				$user->update_option(sb_post_nm,$sb_post) &&
				$user->update_option(sb_login_nm,$sb_login) 
				){	
					?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i>  &nbsp; تم تحديث كل المعلومات بنجاح<a href='admin.php?op=option&type=edit_pages'>العودة</a> 
                 </div>
                 <?php
				}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
}

	
	
	
	
	
	
	
	
	
	
	
	
/*
sb_home_op sb_users_op sb_profile_op sb_admin_op sb_forum_op sb_topic_op sb_post_op sb_login_op
*/
?>

<form method="post" class="form-home">
            <h5 class="form-signin-heading">التحكم في ظهور السايدبار في الصفحات</h5><hr />
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
			
			?>
			
            
			
			
			<div class="col-lg-12 col-sm-12">
			<div class="row">
			

						<div class="col-lg-6 col-sm-6">
						<h5 class="form-signin-heading">خيارات الصفحات</h5><hr />
						<div class="form-group">
							<select class="inputselect" name="txt_sb_home_op">
							<option value="0" <?php echo sb_home_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo sb_home_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">لإظهار السايدبار في الرئيسية</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_sb_users_op">
							<option value="0" <?php echo sb_users_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo sb_users_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">إظهار السايدبار في صفحة الأعضاء</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_sb_profile_op">
							<option value="0" <?php echo sb_profile_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo sb_profile_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">إظهار السايدبار في صفحة بروفايل الأعضاء</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_sb_post_op">
							<option value="0" <?php echo sb_post_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo sb_post_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">إظهار السايدبار في صفحة المحرر (أثناء اضافة او تعديل الموضوع)</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_sb_login_op">
							<option value="0" <?php echo sb_login_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo sb_login_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">إظهار السايدبار في صفحة الدخول</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_sb_forum_op">
							<option value="0" <?php echo sb_forum_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo sb_forum_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">إظهار السايدبار في صفحة المنتدى</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_sb_topic_op">
							<option value="0" <?php echo sb_topic_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo sb_topic_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">إظهار السايدبار في صفحة عرض المواضيع</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_sb_admin_op">
							<option value="0" <?php echo sb_admin_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo sb_admin_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">إظهار السايدبار في لوحة تحكم المدير</span>
						</div>
						</div>
			
			
			</div>
			</div>
			          
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-sbshow">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />
 
        </form>





















<?php
}
}  // end edit pages  







if($type == "menu"){


if(is_admin($me) == "0"){	 // التأكد من العضو اذا كان مديرا
?><div class="clearfix"></div><hr /><div class="alert alert-info">
	<i class="glyphicon glyphicon-log-in"></i>  &nbsp; الصفحة المطلوبة غير موجودة <a href='home.php'>العودة للرئيسية</a> 
 </div><br />
<?php




}else{
	
if(isset($_POST['btn-hmenu']))
{
	
/*	
	h_blog
	h_forums
	h_mixt 	
	h_new 
	h_sticky
*/	
	
	$h_blog = strip_tags($_POST['txt_h_blog_op']);
	$h_forums = strip_tags($_POST['txt_h_forums_op']);
	$h_mixt = strip_tags($_POST['txt_h_mixt_op']);
	$h_last = strip_tags($_POST['txt_h_last_op']);
	$h_sticky = strip_tags($_POST['txt_h_sticky_op']);
	

	try
		{
			
				if(
				$user->update_option(h_blog_nm,$h_blog) &&
				$user->update_option(h_forums_nm,$h_forums) &&
				$user->update_option(h_mixt_nm,$h_mixt) &&
				$user->update_option(h_last_nm,$h_last) &&
				$user->update_option(h_sticky_nm,$h_sticky) 
				){	
					?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i>  &nbsp; تم تحديث كل المعلومات بنجاح<a href='admin.php?op=option&type=menu'>العودة</a> 
                 </div>
                 <?php
				}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
}

?>

<form method="post" class="form-home">
            <h5 class="form-signin-heading">طرق اظهار المنتديات او المواضيع في الرئيسية</h5><hr />
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
			
			?>
			
            
			
			
			<div class="col-lg-12 col-sm-12">
			<div class="row">
			

						<div class="col-lg-6 col-sm-6">
						<h5 class="form-signin-heading">خيارات إظهار قوائم العرض</h5><hr />
						<div class="form-group">
							<select class="inputselect" name="txt_h_blog_op">
							<option value="0" <?php echo h_blog_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo h_blog_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">تفعيل عرض المنتديات على شكل مربعات</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_h_forums_op">
							<option value="0" <?php echo h_forums_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo h_forums_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">تفعيل العرض العادي للمنتديات</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_h_mixt_op">
							<option value="0" <?php echo h_mixt_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo h_mixt_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>
							&nbsp;&nbsp;<span style="color:blue;font-size:12px;">تفعيل العرض المختلط</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_h_last_op">
							<option value="0" <?php echo h_last_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo h_last_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">تفعيل عرض المواضيع الجديدة</span>
						</div>
						<div class="form-group">
							<select class="inputselect" name="txt_h_sticky_op">
							<option value="0" <?php echo h_sticky_op == 0 ? "selected" : "" ; ?>>لا</option>
							<option value="1" <?php echo h_sticky_op == 1 ? "selected" : "" ; ?>>نعم</option>
							</select>&nbsp;&nbsp;
							<span style="color:blue;font-size:12px;">تفعيل عرض المواضيع المميزة</span>
						</div>
						
						</div>
			
			
			</div>
			</div>
			          
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-hmenu">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال
                </button>
            </div>
            <br />
 
        </form>





















<?php
}
}  // end edit pages  










?>
</div>
	



























