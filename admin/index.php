<?php
//function clv($clv){	if($clv == 0){ echo 'ظاهرة للجميع';		}elseif($clv == 1){ echo 'ظاهرة للمسجلين فقط';		}elseif($clv == 2){  echo 'ظاهرة للمشرفين فما فوق';		}elseif($clv == 3){  echo 'ظاهرة للمراقبين فما فوق';		}elseif($clv == 4){  echo 'خاصة بالمشرف العام والمدراء';		}elseif($clv == 5){  echo 'فئة إدارية';	}}?>
<script type="text/javascript">function addc_id(id){	if(confirm('هل تريد إضافة فئة جديدة؟'))	{		window.location='?op=add_cat'	}}function add_id(id){	if(confirm('هل تريد إضافة منتدى لهذه الفئة؟'))	{		window.location='?op=add_forum&add_id='+id	}}function edit_id(id){	if(confirm('Sure to edit this record ?'))	{		window.location='edit_data.php?edit_id='+id	}}function editf_id(id){	if(confirm('Sure to edit this record ?'))	{		window.location='editf_data.php?edit_id='+id	}}</script>
<?php
$template = new Template('core');
$cat = new Database();
$cat->query('select * from cat'.DB_PREFIX.' ORDER BY  cat_order  ASC');
$cat->execute();
$rowscat = $cat->resultset();
//echo"<div class=\"container\">";
//echo"<div class=\"content-loader\">";
echo"<table cellspacing=\"0\" cellspadding=\"0\" width=\"98%\" align=\"center\" class=\"dja_cat\"> <tbody>	";
//'CAT_L' => $array_cats['cat_l'],
foreach($rowscat as $array_cats){
	$cl = $array_cats['cat_l'];
if($cl = 0){  $clv = 'ظاهرة للجميع';	
}elseif($cl = 1){ $clv = 'ظاهرة للمسجلين فقط';	
}elseif($cl = 2){ $clv = 'ظاهرة للمشرفين فما فوق';	
}elseif($cl = 3){ $clv = 'ظاهرة للمراقبين فما فوق';	
}elseif($cl = 4){ $clv = 'خاصة بالمشرف العام والمدراء';	
}elseif($cl = 5){ $clv = 'فئة إدارية';	}
	
			  $template->assign_vars(array(
			   'ID_CAT'  =>  $array_cats['cat_id'],
			   'NAME_CAT' => $array_cats['cat_name'],
			   'CAT_L' => $clv,
		   
			   			  ));
			  $template->set_filenames(array('body' => 'cat.html'));
			  $template->display('body');

		$fid = $array_cats['cat_id'];
		$f = new Database();
		$f->select('forum'.DB_PREFIX.'', 'forum_catid=:fid','forum_id asc');
		//$f->query('select * from '.DB_PREFIX.'forums WHERE cat_id=:fid ORDER BY id desc');
		
		$f->bind(':fid', $fid);
		$f->execute();
		$rowsf = $f->resultset();
		foreach($rowsf as $array_forums){
			
		$tfid = $array_forums['forum_id'];
		$tf = new Database();
		//$tf->query('select * from topic'.DB_PREFIX.' WHERE topic_forumid=:tfid ORDER BY topic_id desc limit 1');
		$tf->query('select t.topic_id, t.topic_forumid, t.topic_name, t.topic_user, t.topic_date, u.user_id, u.user_nameuser, u.user_photo, u.user_sex from topic'.DB_PREFIX.' as t left join user'.DB_PREFIX.' as u on(u.user_id = t.topic_user) WHERE topic_forumid=:tfid ORDER BY topic_id desc limit 1');
		
		$tf->bind(':tfid', $tfid);
		$tf->execute();
		$rowstf = $tf->resultset();
		foreach($rowstf as $array_t){
		
		
			/*
			$tid = $array_t['topic_user'];
			$tu = new Database();
			$tu->query('select * from user'.DB_PREFIX.' WHERE user_id=:tid');
			$tu->bind(':tid', $tid);
			$tu->execute();
			$rowstu = $tu->single();
			extract($rowstu);
			*/
			if(!empty($array_t['user_photo'])){
				$photo = $array_t['user_photo'];
			}else{
				if($array_t['user_sex'] == 1){
				$photo = "http://www.afaqsat.com/images/sex1.png";	
				}
				if($array_t['user_sex'] == 2){
				$photo = "http://www.afaqsat.com/images/sex2.png";	
				}
				
			}
				$template->assign_vars(array(
							   'ID_FORUM'  =>  $array_forums['forum_id'],
							   'ICON' => $array_forums['forum_logo'],
							   'NAME_FORUM' => $array_forums['forum_name'],
							   'DES_FORUM' => $array_forums['forum_wasaf'],
							   'T_NUM' => $array_forums['forum_topic'],
							   'R_NUM' => $array_forums['forum_reply'],
							   'DATE' => normal_time($array_t['topic_date']),
							   'TID' => $array_t['topic_id'],
							   'TFTITLE' => $array_t['topic_name'],
							   'AUTHOR' => $array_t['user_nameuser'],
							   'A_PHOTO' => $photo,
							   
							));
				$template->set_filenames(array('body' => 'forum.frm'));
				$template->display('body');
			
		} 
 
 
 
 
 } 
 }
 echo"</table></div></div><br />";
?>
<?php
/*
$fid = $array_cats['id'];
$f = new Database();
$f->query('select * from '.DB_PREFIX.'forums WHERE cat_id=:fid ORDER BY id desc');
$f->bind(':fid', $fid);
$f->execute();
$rowsf = $f->resultset();
		foreach($rowsf as $array_forums){
//$id_cat = $array_forums['id'];
$name_forum = $array_forums['id'];
   }

    foreach($array_cats as $id_cat=>$name_cat)
    {
        $template->assign_block_vars('cat', array(
           'ID_CAT'  =>  $id_cat,
           'NAME_CAT'   =>  $name_cat,
        ));
        foreach($array_forums as $name_forum=>$cat_id)
        {
            if($id_cat == $cat_id)
            {
                $template->assign_block_vars('cat.forum', array(
                    'NAME_FORUM'  =>  $name_forum,  
                ));
            }
        }
    }
    $template->set_filenames(array('body' => 'test.html'));
    $template->display('body');
 
*/
 
	/*	
<div class="container">
<hr />
<div class="content-loader">
<table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive"><tbody>
		

$cat = new Database();
$cat->query('select * from '.DB_PREFIX.'category ORDER BY id desc');
$cat->execute();
$rows = $cat->resultset();
//$cat->resultset();
//$rowcat = $cat->single();
//$rowcat = $cat->resultset();
//$cat->rowCount();

?>
<tr>
<td align="center" width="99%" colspan="10" class="tcat"><a href="javascript:addc_id(<?php echo $ca['id']; ?>)"><img src="<?php echo $site_url; ?>views/themes/images/add.png" width="20px" title=" اضافة فئة " /></a></td>
</tr>


<?php foreach($rows as $ca){
echo'<br>';
$clv = $ca['cat_l'];

?>
	<tr>
	<td width="1%" class="tcat"><img src="<?php echo $site_url; ?>views/themes/images/cat.png" width="20px" /></td>
	<td align="center" colspan="2" class="tcat"><?php echo $ca['name']; ?></td>
	<td colspan="2" class="tcat"><?php echo clv($clv); ?></td>
	<td width="10%" class="tcat"></td>
	<td align="center" width="1%" class="tcat"><a href="javascript:add_id(<?php echo $ca['id']; ?>)"><img src="<?php echo $site_url; ?>views/themes/images/add.png" width="20px" /></a></td>
	<td align="center" width="1%" class="tcat"><a id="<?php echo $ca['id']; ?>" class="edit-link" href="#" title="Edit"><img src="<?php echo $site_url; ?>views/themes/images/edit.png" width="20px" /></a></td>
	<td align="center" width="1%" class="tcat"><a id="<?php echo $ca['id']; ?>" class="delete-link" href="#" title="Delete"><img src="<?php echo $site_url; ?>views/themes/images/delete.png" width="20px" /></a></td>
<?php
//echo $ca['name'];
echo'<br>'; 
$fid = $ca['id'];
$f = new Database();
$f->query('select * from '.DB_PREFIX.'forums WHERE cat_id=:fid ORDER BY id desc');
$f->bind(':fid', $fid);
$f->execute();
		$rowsf = $f->resultset();
		foreach($rowsf as $fa){
		echo'<br>';
	?>
				<tr>
	<td width="1%"><img src="<?php echo $site_url; ?><?php echo $fa['icon']; ?>" width="30" height="30"></td>
	<td width="40%"><a href="forum<?php echo $fa['id']; ?>"><?php echo $fa['name']; ?></a><br><?php echo $fa['des']; ?></td>
	<td width="20%">المواضيع : <?php echo $fa['t_num']; ?><br>الردود : <?php echo $fa['r_num']; ?></td>
	<td align="center" width="30%"></td>
	<td width="60%"></td>
	<td width="10%"></td>
	<td width="10%"></td>
	<td align="center" width="1%"><a id="<?php echo $fa['id']; ?>" class="edit-link" href="#" title="Edit"><img src="<?php echo $site_url; ?>views/themes/images/edit.png" width="20px" /></a></td>
	<td align="center" width="1%"><a id="<?php echo $fa['id']; ?>" class="delete-link" href="#" title="Delete"><img src="<?php echo $site_url; ?>views/themes/images/delete.png" width="20px" /></a></td>
	</tr>
	<?php
	//echo $fa['name'];
	echo'<br>'; 
	}
	?>
	</tr>
	<?php
	} 	
	?>
    </tbody></table>
	
	
	
	
	
	
	<?php
	
	
	/*
				//  require('template.class.php');
			  $template = new Template('templates');  
			  $template->assign_vars(array(
			   'PRENOM'  =>  'faresdja',
			   'EMAIL'  =>  'faresdja55@gmail.com',
			   'AGE'  =>  '36',
			   'PAYS'  =>  'ALGERIA',
			   'DATE'  =>  '07/04/1981',
			  ));
			  $template->set_filenames(array('body' => 'test.html'));
			  $template->display('body');
			  
			  
			  
			  
    require('template.class.php');
    $template   = new Template('templates');

    $array = array(
        'jalal'   =>  'jalal@gmail.com',
        'anass'   =>  'anass@gmail.com',
        'mohammed'  =>  'med@gmail.com',
        'kamal'   =>  'kamal@gmail.com',
    );
    foreach($array as $prenom=>$email)
    {
        $template->assign_block_vars('membres', array(
            'PRENOM'  =>  $prenom,
            'EMAIL'   =>  $email,   
        ));
    }
    $template->set_filenames(array('body' => 'test.html'));
    $template->display('body'); 
			

*/
?>