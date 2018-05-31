<?php

function a7_editor($array){
	
			global $gets, $type, $id, $f_name, $stname, $stimg, $stmsg, $xtname, $xtimg, $xtmsg, $title;

			//$cat_id = trim($_REQUEST['cat_id']);
			$a7_tmp  = "";		
////////////topic//////////////    action="post.php?type=addtopic&go=insert&id='.$id.'"



if($type == "addtopic"){
			$a7_tmp .=	'<form method="post"  class="form-editor">';
			$a7_tmp .=	'<h4 class="form-signin-heading">'.$title.' لـ: '.$f_name.'</h4><hr />';
			$a7_tmp .=	'<div class="col-lg-12"><div class="row">';
			$a7_tmp .=	'<div class="form-group col-lg-8">';
			$a7_tmp .=	'<input type="text" class="form-control" name="tname" placeholder="'. $stname .'"/>';
			$a7_tmp .=	'</div>';
			$a7_tmp .=	'<div class="col-lg-4">';
			$a7_tmp .=	'<div class="form-group col-lg-8">';
			$a7_tmp .=	'<input type="text" class="form-control" name="timg" placeholder="'. $stimg.'"/>';
			$a7_tmp .=	'</div>';
			$a7_tmp .=	'</div>';
			$a7_tmp .=	'</div>';
			$a7_tmp .=	'<div>';
			$a7_tmp .=	'<textarea id="dja" name="tmsg" cols="180" rows="23" ></textarea>';
			$a7_tmp .=	'<link rel="stylesheet" href="./editor/skins/editor.css">';
			$a7_tmp .=	'<script type="text/javascript" src="./editor/editor-min.js"></script><script type="text/javascript">';	
			$a7_tmp .=	'Editor.setStyle({"bgColor": "#FFD5B3","borderColor": "#c8c8c8","fontFamily": "tahoma"});';	
			$a7_tmp .=	'Editor.run({"replace": "dja","height": 420,"width": 910,"path":"","mode": "advance"});</script>';
			$a7_tmp .=	'</div></div><hr />';
			$a7_tmp .=	'<center><button type="submit" class="btn btn-primary btn-center" name="btn-addtopic">';
			$a7_tmp .=	'&nbsp;إدخال الموضوع</button>';
			$a7_tmp .=	'<br /></form>';			

}elseif($type == "edittopic"){
			$a7_tmp .=	'<form method="post" action="editpost.php?type=edittopic&go=edit&id='.$id.'" class="form-editor">';
			$a7_tmp .=	'<h4 class="form-signin-heading">'.$title.' : '.$stname.'</h4><hr />';
			$a7_tmp .=	'<div class="col-lg-12"><div><div class="form-group col-lg-6">';	
			$a7_tmp .=	'<input type="text" class="form-control" name="etname" value="'.  $xtname .'" /></div>';	
			$a7_tmp .=	'<div class="col-lg-6"><div class="form-group col-lg-8">';	
			$a7_tmp .=	'<input type="text" class="form-control" name="etimg" value="'. $xtimg .'" /></div>';	
			$a7_tmp .=	'</div></div><div><br><br>';
			$a7_tmp .=	'<textarea id="dja" name="etmsg" cols="180" rows="23" >'. $xtmsg .'</textarea>';
			$a7_tmp .=	'<link rel="stylesheet" href="./editor/skins/editor.css">';
			$a7_tmp .=	'<script type="text/javascript" src="./editor/editor-min.js"></script><script type="text/javascript">';	
			$a7_tmp .=	'Editor.setStyle({"bgColor": "#FFD5B3","borderColor": "#c8c8c8","fontFamily": "tahoma"});';	
			$a7_tmp .=	'Editor.run({"replace": "dja","height": 420,"width": 910,"path":"","mode": "advance"});</script>';
			$a7_tmp .=	'</div></div><hr />';
			$a7_tmp .=	'<center><button type="submit" class="btn btn-primary btn-center" name="btn-edittopic">';
			$a7_tmp .=	'<i class="glyphicon glyphicon-open-file"></i>&nbsp;حفظ وادخال</button>';
			$a7_tmp .=	'<br /></form>';

}elseif($type == "addreply" || $type == "editreply"){   /////////reply//////////
				
				// $a7_tmp .= $id = $_REQUEST['id'];
				//$xid = $_GET['id'];
				$ctype = 0;
				$stmt = $forum->runQuery("SELECT * FROM ".prx."forums WHERE f_type=:ctype and f_id=:cat_id ");
				$stmt->execute(array(':ctype'=>$ctype, ':cat_id'=>$cat_id));
				//$row = $stmt->fetch(PDO::FETCH_ASSOC);	
					
					$a7_tmp .=	'<tr><table>';
				
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$cid = $row['f_id'];		$ctype = $row['f_type'];		$cat = $row['f_cat'];
				
				// <img src="'.$row['f_icon'].'">
				$a7_tmp .='
					<tr>
						<td class="alert alert-info" colspan="4" width="600"><center>
							<a href="?cat_id='.$row['f_id'].'">'.$row['f_name'].'</a> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							';
							if($lvl == 7){
						$a7_tmp .='
							<a href="addff.php?type=edit&id='.$row['f_id'].'"><span class="glyphicon glyphicon-pencil"></span></a>';
							}	
						$a7_tmp .='
						</td>
					</tr>';
				
				$fstmt = $forum->runQuery("SELECT * FROM ".prx."forums WHERE f_cat=:cid ");
				$fstmt->execute(array(':cid'=>$cid));
				while($frow = $fstmt->fetch(PDO::FETCH_ASSOC)){
				
				$a7_tmp .=	'
					<tr>
						<td width="2%"><img src="'.$frow['f_icon'].'" width="28"></td> 
						<td align="right"><a href="forum.php?id='.$frow['f_id'].'">'.$frow['f_name'].'</a><br>'.$frow['f_desc'].' </td>
						<td>المواضيع '.$frow['f_t'].'</br> الردود '.$frow['f_r'].'</td>';
						
					if($lvl == 7){
						
				
						$a7_tmp .=	'
							<td><a href="addff.php?type=edit&id='.$frow['f_id'].'"><span class="glyphicon glyphicon-pencil"></span> </a></td>
						
						';
					}	
						
				$a7_tmp .='		
					</tr>';
				
					}
				
				}
				
				$a7_tmp .=	'
				<tr>
				<td class="alert alert-info" colspan="4" width="600"><center><a href="javascript:history.back()">رجوع</a></td>
				</tr>
				</table></tr>';
				
					
			}
					
					
				return $a7_tmp;		
}				
			
			
		
			
			
			
				
		
			

			

