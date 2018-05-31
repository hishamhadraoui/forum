<?php



echo'


		<div class="row">
	<div class="col-lg-12 col-sm-12">
		<ul class="nav   ">
					
		  <li class="dropdown col-lg-11 col-sm-11">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <font color="'.$group_color.'"><b>'.$group_name.'</b></font>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
			
			
			
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"add_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه إضافة موضوع</span>
			</li>	
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"edit_mytopic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه تعديل موضوعه</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"edit_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه تعديل مواضيع الآخرين</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"del_mytopic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه حذف موضوعه</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"del_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه حذف أي موضوع</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"lock_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه غلق  المواضيع</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"unlock_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه فتح المواضيع</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"stick_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه تثبيث المواضيع</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"unstick_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه إلغاء تثبيث المواضيع</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"hidde_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه إخفاء المواضيع</span>
			</li>
			<li class="col-lg-11 col-sm-11">'.(group_op($group_l,"unhidde_topic") == 1 ? "نعم" : "لا").'&nbsp;&nbsp;
			<span style="color:red;font-size:12px;">يمكنه إظهار المواضيع</span>
			</li>

			<li class="col-lg-1 col-sm-1"><a href="admin.php?op=option&type=edit_group&id='.group_op($group_l,'group_id').'">
			&nbsp;<span style="color:red;font-size:12px;"title="تعديل"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>&nbsp;</a>
			</li>


              </ul>
            </li>
          </ul>
		</div>
		
		
		
		';
?>
