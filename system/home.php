<?php
//namespace main\system;


function a7_home($array){
	
			global $gets, $usergroup, $cat_id, $pg, $pagg, $id,$avatar, $dbc;
			
			
			$a7_tmp  = "";
			
			

$a7_tmp .= '<nav class="navbar navbar-default"><div class="container-fluid"><ul class="nav navbar-nav">';
if(show_in("blog") == 1){ 
      $a7_tmp .= '<li ".($page == "blog" ? "class="active"" : "")." ><a href="blog.html">البوابة</a></li>';
}
if(show_in("forums") == 1){       
	  $a7_tmp .= '<li ".($page == "forums" ? "class="active"" : "")." ><a href="forums.html">المنتديات</a></li>';
}
if(show_in("mixt") == 1){       	  
	  $a7_tmp .= '<li ".($page == "mixt" ? "class="active"" : "")." ><a href="mixt.html">عرض مختلط</a></li>';
}
if(show_in("last") == 1){             
	  $a7_tmp .= '<li ".($page == "last" ? "class="active"" : "")." ><a href="last.html">الجديد</a></li>';
}
if(show_in("sticky") == 1){             
	  $a7_tmp .= '<li ".($page == "sticky" ? "class="active"" : "")." ><a href="sticky.html">مواضيع مميزة</a></li>';
}    
	
	$a7_tmp .= '</ul>
  </div>
</nav>		
		';	

		
		
			$count_page = 10;
			$get_page = ($pg == "" || !is_numeric($pg) ? 1 : $pg);
			$limit_page = (($get_page * $count_page) - $count_page);
			$ttstmt = $dbc->runQuery("SELECT * FROM ".prx."topics");
			$ttstmt->execute();
			$numtt = $ttstmt->rowCount();
		
		

if(page == "last" && show_in("last") == 1 ){



			

			//include ("system/header.php");
			//$stmt = $forum->runQuery("SELECT * FROM topics WHERE f_id=:id ");  WHERE t.f_id=:f array(':f'=>$f)
			$tstmt = $dbc->runQuery("SELECT t.t_id, t.f_id, t.t_name, t.t_msg, t.t_date, t.t_img, t.user_id, u.user_id, u.user_name, 
			u.user_avatar, u.user_gender  FROM ".prx."topics as t inner join ".prx."users as u on(t.user_id = u.user_id) 
			where t.t_hidden in(0) and t.t_locked in(0)
			order by t.t_date desc  limit ".$limit_page.",".$count_page." ");
			$tstmt->execute();
			//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);	
			$numt = $tstmt->rowCount();
			$a7_tmp .= '<table class="form-home"  width="100%">';
			if($numt == 0){	$t_error = "لا توجد مواضيع تطابق ما تبحث عنه";	}else{
										
			$a7_tmp .= '<tr>
			<td class="btn-default btn-sm" width="40%" colspan="2">آخر المواضيع المطروحة بجميع المنتديات</td>
			<td class="btn-default btn-sm" width="40%">أعضاء شاركو بالموضوع</td>';
			//if($usergroup > 1){	$a7_tmp .='	<td class="btn-default btn-sm" width="20%">تعديل</td>';	}	
			$a7_tmp .='</tr>';

			while($topic_row = $tstmt->fetch(PDO::FETCH_ASSOC)){
					//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);
					$t = $topic_row['t_id'];
					$tname = $topic_row['t_name'];
					$timg = $topic_row['t_img'];
					//$topicsinf = $topic_row['topicsinf'];
					$tmsg = $topic_row['t_msg'];	
					
					$a7_tmp .= '
					<tr class="form-home">
					<td class="topic" width="1%"><a href="users.php?u='.$topic_row['user_id'].'"><img src="'.avatar($topic_row['user_avatar'],$topic_row['user_gender']).'"  title="'.$topic_row['user_name'].'" width="40" height="40" style="border-radius:50%;"></a></td>
					<td width="40%" align="right">
					<table><tr>
					
					<td width="100%">
					<a href="topic.php&id='.$topic_row['t_id'].'">'.$topic_row['t_name'].'</a> 
							<br>
					<span style="font-size:13px;">الكاتب : <a href="users.php?u='.$topic_row['user_id'].'">'.$topic_row['user_name'].'</a></span>	
					
						</td></tr>
					</table></td>	
			<td width="40%"><table>	';			////////replys
												
			$stmt = $dbc->runQuery("SELECT distinct r.user_id, u.user_id, u.user_name, u.user_avatar, u.user_gender  FROM ".prx."replys as r left join ".prx."users as u on(u.user_id = r.user_id) WHERE r.t_id=:t  ORDER BY t_id DESC limit 5");
			//$stmt = $dbc->runQuery("SELECT distinct user_id FROM replys WHERE t_id=:t limit 5");
			$stmt->execute(array(':t'=>$t));												
			//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);	
			$numr = $stmt->rowCount();
			if($numr == 0){	$a7_tmp .=	$no_reply = "لا أحد قام بالرد على الموضوع";	}else{
				while($reply_row = $stmt->fetch(PDO::FETCH_ASSOC)){
				//$topic_row = $stmt->fetch(PDO::FETCH_ASSOC);
				//$r = $reply_row['r_id'];
				//$t = $reply_row['t_id'];
				$ruser = $reply_row['user_id'];
				$a7_tmp .= '<td><a href="users.php?u='.$reply_row['user_id'].'">
								<img src="'.avatar($reply_row['user_avatar'],$reply_row['user_gender']).'" 
								title="'.$reply_row['user_name'].'" width="36" height="36" style="border-radius:50%;">
								</a>&nbsp;&nbsp;</td>';
				}	
																								}
			////////replys
			$a7_tmp .='</table></td>';
			//if($usergroup == 7){$a7_tmp .=' <td><a href="editpost.php?type=edittopic&id='.$topic_row['t_id'].'"><span class="glyphicon glyphicon-pencil" style="float:left;"></span></a></td>';}	
			$a7_tmp .='</tr>';
			//$a7_tmp .='<table>';	
			
						
			}
											
			$a7_tmp .='</table>';					
			$a7_tmp .= ypage($numtt, $count_page, $get_page, "home.php?page=last&");																					}
			$a7_tmp .=	'</table></tr>';

}elseif(page == "mixt" && show_in("mixt") == 1 ){				


$stmt0 = $dbc->runQuery("SELECT * FROM ".prx."forums");	$stmt0->execute();	$row = $stmt0->fetch(PDO::FETCH_ASSOC);	$numc = $stmt0->rowCount();
if($numc == 0){	?>	<tr><table>	<tr><td class="alert alert-info" colspan="4" width="600"><center>رقم الفئة خاطئ	<br><!-- <a href="javascript:history.back()">رجوع</a> --><a href="home.php">العودة للرئيسية</a></td></tr></table></tr><?php
}else{			$ctype = 0;
				$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type=:ctype ");
				$stmt->execute(array(':ctype'=>$ctype));


				
$a7_tmp .='<ul class="list-group"><div>';
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$cid = $row['f_id'];$ctype = $row['f_type'];$cat = $row['f_cat'];$hid = $row['f_hid']; $forum_blog = $row['f_blog'];
		$a7_tmp .='<div>
		<ul class="list-group col-lg-12 col-sm-12">
		<li class="list-group-item" style="background-color:#'.$row['f_bgc'].';">&nbsp;'.$row['f_name'].'</li>
		</ul>
		</div>';
		
if($forum_blog == 1){		
		
$a7_tmp .='
		<div class="col-lg-12 col-sm-12">
		<div class="row">';
				$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_cat=:cid ");
				$fstmt->execute(array(':cid'=>$cid));
				while($frow = $fstmt->fetch(PDO::FETCH_ASSOC)){
	
				$a7_tmp .=	'	
	            <div class="xcard hovercard  col-lg-4">
                <div class="cardheader" style="background: url('.$frow['f_bg'].')">

                </div>
                <div class="xavatar">
                    <img alt="" src="'.$frow['f_icon'].'">
                </div>
                <div class="info navbar navbar-default">
                    <div class="xtitle">
                        <a href="forum.php&id='.$frow['f_id'].'">'.$frow['f_name'].'</a>
                    </div>
                    <div class="xdesc">'.$frow['f_desc'].'</div>

				<div class="desc">المواضيع '.$frow['f_t'].' -  الردود '.$frow['f_r'].'</div>
				</div>
				</div>';	
				}
$a7_tmp .=	'
		</div>
		</div>';
		
}elseif($forum_blog == 0){

				$a7_tmp .=	'<tr><table>';
				$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_cat=:cid ");
				$fstmt->execute(array(':cid'=>$cid));
				while($frow = $fstmt->fetch(PDO::FETCH_ASSOC)){
				
				$a7_tmp .=	'
					<tr style="background-color:#'.$frow['f_bgc'].';">
						<td width="2%"><img src="'.$frow['f_icon'].'" width="28"></td> 
						<td align="right"><h5>
						<a href="forum.php&id='.$frow['f_id'].'">'.$frow['f_name'].'</a>
						<h6>'.$frow['f_desc'].'</h6> </h5></td>
						<td><h6>المواضيع '.$frow['f_t'].'</br> الردود '.$frow['f_r'].'</h6></td>';
						
				$a7_tmp .=	'</tr>';
				
				}
				$a7_tmp .=	'</table></tr>';

}
		
		
		
		}
$a7_tmp .=	'	 </div></ul>';
					

	}
		
	













}elseif(page == "sticky" && show_in("sticky") == 1 ){

			$tstmt = $dbc->runQuery("SELECT t.t_id, t.f_id, t.t_name, t.t_msg, t.t_date, t.t_img, t.user_id, t.t_sticky, 
									u.user_id, u.user_name, u.user_avatar, u.user_gender  
									FROM ".prx."topics as t inner join ".prx."users as u on(t.user_id = u.user_id) 
									where t.t_sticky in(1)
									order by t.t_sticky desc   limit ".$limit_page.",".$count_page." ");
			$tstmt->execute();
			$numt = $tstmt->rowCount();
			$a7_tmp .= '<table class="form-home"  width="100%">';
			if($numt == 0){$t_error = "لم يتم طرح مواضيع بالمنتدى بعد...";	}else{

			$a7_tmp .= '<tr>
			<td class="btn-default btn-sm" width="40%" colspan="2">مواضيع مميزة من جميع المنتديات</td>
			<td class="btn-default btn-sm" width="40%">أعضاء شاركو بالموضوع</td>';
			$a7_tmp .='</tr>';

		while($topic_row = $tstmt->fetch(PDO::FETCH_ASSOC)){
			$t = $topic_row['t_id'];
			$tname = $topic_row['t_name'];
			$timg = $topic_row['t_img'];
			//$topicsinf = $topic_row['topicsinf'];
			$tmsg = $topic_row['t_msg'];
			$topic_sticky = $topic_row['t_sticky'];								

			$a7_tmp .= '<tr class="form-home">
			<td class="topic" width="1%"><a href="users.php?u='.$topic_row['user_id'].'"><img src="'.avatar($topic_row['user_avatar'],$topic_row['user_gender']).'"  title="'.$topic_row['user_name'].'" width="40" height="40" style="border-radius:50%;"></a></td>
			<td width="40%" align="right">
			<table><tr>
			<td width="90%">
			<a href="topic.php&id='.$topic_row['t_id'].'">'.$topic_row['t_name'].'</a> 
			<br>
			<span style="font-size:13px;">الكاتب : <a href="users.php?u='.$topic_row['user_id'].'">'.$topic_row['user_name'].'</a></span>	
			</td>';
			if($topic_sticky == 1){	$a7_tmp .='<td width="2%"><i class="fa fa-thumb-tack" aria-hidden="true" title="الموضوع مثبت"></i></td>';	}
			$a7_tmp .= '<td width="8%"></td></tr>
			</table></td>	

		<td width="40%"><table>					';
		////////replys
				$stmt = $dbc->runQuery("SELECT distinct r.user_id, u.user_id, u.user_name, u.user_avatar, u.user_gender  FROM ".prx."replys as r left join ".prx."users as u on(u.user_id = r.user_id) WHERE r.t_id=:t  ORDER BY t_id DESC limit 5");
				$stmt->execute(array(':t'=>$t));							
				$numr = $stmt->rowCount();
				if($numr == 0){	$a7_tmp .=	$no_reply = "لا أحد قام بالرد على الموضوع";	}else{
				while($reply_row = $stmt->fetch(PDO::FETCH_ASSOC)){
				//$r = $reply_row['r_id'];
				//$t = $reply_row['t_id'];
				$ruser = $reply_row['user_id'];
				$a7_tmp .= '<td><a href="users.php?u='.$reply_row['user_id'].'">
							<img src="'.avatar($reply_row['user_avatar'],$reply_row['user_gender']).'" 
							title="'.$reply_row['user_name'].'" width="36" height="36" style="border-radius:50%;"></a>
							&nbsp;&nbsp;</td>';
				}	
				}

		////////replys
		$a7_tmp .='</table></td>';
		$a7_tmp .='</tr>';
		}			
$a7_tmp .= ypage($numtt, $count_page, $get_page, "home.php?page=sticky&");
		$a7_tmp .='</table>';


}


				
			}elseif(page == "blog" && show_in("blog") == 1 ){
	

$stmt0 = $dbc->runQuery("SELECT * FROM ".prx."forums");	$stmt0->execute();	$row = $stmt0->fetch(PDO::FETCH_ASSOC);	$numc = $stmt0->rowCount();
if($numc == 0){	?>	<tr><table>	<tr><td class="alert alert-info" colspan="4" width="600"><center>رقم الفئة خاطئ	<br><!-- <a href="javascript:history.back()">رجوع</a> --><a href="home.php">العودة للرئيسية</a></td></tr></table></tr><?php
}else{			$ctype = 0;
				$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type=:ctype ");
				$stmt->execute(array(':ctype'=>$ctype));
					
?><ul class="list-group"><div><?php
				
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$cid = $row['f_id'];
		$ctype = $row['f_type'];
		$cat = $row['f_cat'];
		$hid = $row['f_hid'];
		
		
		$a7_tmp .='<div>
		<ul class="list-group col-lg-12 col-sm-12">
		<li class="list-group-item" style="background-color:#'.$row['f_bgc'].';">&nbsp;'.$row['f_name'].'</li>
		</ul>
		</div>
		<div class="col-lg-12 col-sm-12">
		<div class="row">';
		
		$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_cat=:cid ");
		$fstmt->execute(array(':cid'=>$cid));
				while($frow = $fstmt->fetch(PDO::FETCH_ASSOC)){
	
				$a7_tmp .=	'	
	            
				<div class="xcard hovercard  col-lg-4">
                <div class="cardheader" style="background: url('.$frow['f_bg'].')">

                </div>
                <div class="xavatar">
                    <img alt="" src="'.$frow['f_icon'].'">
                </div>
                <div class="info navbar navbar-default">
                    <div class="xtitle">
                        <a href="forum.php&id='.$frow['f_id'].'">'.$frow['f_name'].'</a>
                    </div>
                    <div class="xdesc">'.$frow['f_desc'].'</div>

				<div class="desc">المواضيع '.$frow['f_t'].' -  الردود '.$frow['f_r'].'</div>
				</div>
				</div>
				
				';	
					
					
					
					
					
					
					
					
				
					}
				
				
				$a7_tmp .=	'</div></div>
								';
				
				}
				
				//</table></tr>
			$a7_tmp .=	'	 </div></ul>';
					
			}
		
			
			
			
			
			}elseif(page == "forums" && show_in("forums") == 1 ){
			
		

			if(cat_id == ""){
				
				$ctype = 0;
				$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type=:ctype ");
				$stmt->execute(array(':ctype'=>$ctype));
				//$row = $stmt->fetch(PDO::FETCH_ASSOC);	
					
					$a7_tmp .=	'<tr><table>';
				
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$cid = $row['f_id'];
				$ctype = $row['f_type'];
				$cat = $row['f_cat'];
				// <img src="'.$row['f_icon'].'" width="100%" height="100"><br>
				$a7_tmp .='
					<tr style="background-color:#'.$row['f_bgc'].';">
						<td class="btn-sm" colspan="4" width="600" ><center>
							<a href="?cat_id='.$row['f_id'].'" alt="'.$row['f_desc'].'" title="'.$row['f_desc'].'"><font color="#fff">'.$row['f_name'].'</a> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							';
							// if($usergroup == 7){
						// $a7_tmp .='<a href="admin.php?op=forums&type=edit&id='.$row['f_id'].'"><font color="#fff"><span class="glyphicon glyphicon-pencil"></span></a>';
							// }	
						$a7_tmp .='
						</td>
					</tr>';

				$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_cat=:cid ");
				$fstmt->execute(array(':cid'=>$cid));
				while($frow = $fstmt->fetch(PDO::FETCH_ASSOC)){
				
				$a7_tmp .=	'
					<tr   style="background-color:#'.$frow['f_bgc'].';">
						<td width="2%"><img src="'.$frow['f_icon'].'" width="28"></td> 
						<td align="right"><h5>
						<a href="forum.php&id='.$frow['f_id'].'">'.$frow['f_name'].'</a>
						<h6>'.$frow['f_desc'].'</h6> </h5></td>
						<td><h6>المواضيع '.$frow['f_t'].'</br> الردود '.$frow['f_r'].'</h6></td>';
						
						
					//	if($usergroup == 7){$a7_tmp .=	'<td><a href="admin.php?op=forums&type=edit&id='.$frow['f_id'].'"><span class="glyphicon glyphicon-pencil"></span> </a></td>';	}
						
						
						
						$a7_tmp .=	'</tr>';
				
					}
				
				}
					
					$a7_tmp .=	'</table></tr>';
				
				
			}else{
				
				
				$stmt0 = $dbc->runQuery("SELECT * FROM ".prx."forums");
				$stmt0->execute();
				$row = $stmt0->fetch(PDO::FETCH_ASSOC);		
				$numc = $stmt0->rowCount();
		
		
			//$a7_tmp .= '<table class="form-home"  width="100%">';
		
		if($numc == 0){
			
				?>
					<tr><table>
				<tr>
					<td class="alert alert-info" colspan="4" width="600"><center>
						رقم الفئة خاطئ
							<br>
							<!-- <a href="javascript:history.back()">رجوع</a> -->
							<a href="home.php">العودة للرئيسية</a>
						</td>
					</tr>
				</table></tr>
	
	<?php
			
		}else{	
				
				
				
				// $a7_tmp .= $id = $_REQUEST['id'];
				//$xid = $_GET['id'];
				$ctype = 0;
				$stmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type=:ctype and f_id=:cat_id ");
				$stmt->execute(array(':ctype'=>$ctype, ':cat_id'=>$cat_id));
				//$row = $stmt->fetch(PDO::FETCH_ASSOC);	
					
					$a7_tmp .=	'<tr><table>';
				
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$cid = $row['f_id'];		$ctype = $row['f_type'];		$cat = $row['f_cat'];
				
				// <img src="'.$row['f_icon'].'">
				$a7_tmp .='
					<tr>
						<td class="btn-primary btn-sm" colspan="4" width="600"><center>
							<a href="?cat_id='.$row['f_id'].'"  alt="'.$row['f_desc'].'" title="'.$row['f_desc'].'">'.$row['f_name'].'</a> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							';
							if($usergroup == 7){
						$a7_tmp .='
							<a href="admin.php?op=forums&type=edit&id='.$row['f_id'].'"><span class="glyphicon glyphicon-pencil"></span></a>';
							}	
						$a7_tmp .='
						</td>
					</tr>';
				
				$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_cat=:cid ");
				$fstmt->execute(array(':cid'=>$cid));
				while($frow = $fstmt->fetch(PDO::FETCH_ASSOC)){
				
				$a7_tmp .=	'
					<tr>
						<td width="2%"><img src="'.$frow['f_icon'].'" width="28"></td> 
						<td align="right"><a href="forum.php&id='.$frow['f_id'].'">'.$frow['f_name'].'</a><br><h6>'.$frow['f_desc'].'</h6> </td>
						<td>المواضيع '.$frow['f_t'].'</br> الردود '.$frow['f_r'].'</td>';
						
					if($usergroup == 7){
						
				
						$a7_tmp .=	'
							<td><a href="admin.php?op=forums&type=edit&id='.$frow['f_id'].'"><span class="glyphicon glyphicon-pencil"></span> </a></td>
						
						';
					}	
						
				$a7_tmp .='		
					</tr>';
				
					}
				
				}
				
				$a7_tmp .=	'
				<tr>
				<td class="btn-primary btn-sm" colspan="4" width="600"><center><a href="javascript:history.back()"><font color="#fff">رجوع</font></a></td>
				</tr>
				</table></tr>';
				
					
			}
					}










			}else{   // home == "" 
				
				$ctype = 1;
				$fstmt = $dbc->runQuery("SELECT * FROM ".prx."forums WHERE f_type=:ctype ");
				$fstmt->execute(array(':ctype'=>$ctype));
		$a7_tmp .= '<br><ul class="nav nav-pills" role="tablist">';		
		while($frow = $fstmt->fetch(PDO::FETCH_ASSOC)){
			
		$a7_tmp .= '<li role="presentation" class="active" title="'.$frow['f_desc'].'"><a href="forum.php&id='.$frow['f_id'].'">'.$frow['f_name'].' 
		<span class="badge">'.$frow['f_t'].'</span></a></li>';
								
			
			
					}
				$a7_tmp .= '	  </ul>';
				
				
			}		
					
				return $a7_tmp;		
}				
			
			
		
			
			
			
				
		
			

			

