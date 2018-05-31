<?php
//define("error_7" , true);
//include("autoload.php");
//include("config.php");


$body = "notifications";
$title = "الإشعارات";

include ("system/header.php");		



	$user_in = $me;
	global $gets, $agets, $dbc , $topic_row,$pg,
$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,
$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts ;
	
	// $in_hide = 0;  n.n_hide=:n_hide AND     , 'n_hide'=>$in_hide
	
$stmt = $dbc->runQuery("SELECT n.n_id, n.user_in, n.user_out, n.n_type, n.n_hide, n.t_id, n.r_id, n.xr_id,
									u1.user_id as user_in_id, u1.user_name as user_in_name, u1.user_avatar as user_in_avatar, u1.user_gender as user_in_gender,
									u2.user_id as user_out_id, u2.user_name as user_out_name, u2.user_avatar as user_out_avatar, u2.user_gender as user_out_gender
									FROM ".prx."notifications as n left join ".prx."users as u1 on (u1.user_id = n.user_in)
									left join ".prx."users as u2 on (u2.user_id = n.user_out)
									WHERE n.user_in=:user_in ORDER BY n_id desc");
$stmt->execute(array('user_in'=>$user_in));
$notifications = $stmt->rowCount();

//$notic=$stmt->fetch(PDO::FETCH_ASSOC);
//echo $noti0 = $notic['noti0'];
//echo $noti1 = $notic['noti1'];

echo'<td class="">


<nav class="navbar navbar-default">
  <div class="container-fluid">

    <ul class="nav navbar-nav">
      <li ".($hide == "" ? "class="active"" : "")." ><a href="notifications.php">الإشعارات الكلية التي تلقيتها  <span class="badge">'.$notifications.'</span></a></li>
	  <li ".($hide == "" ? "class="active"" : "")." ><a href="home.php?op=noti&go=readall">إجعلها كلها مقروءة</a></li>
      
    </ul>
  </div>
</nav>		
';
   //<li ".($hide == "0" ? "class="active"" : "")." ><a href="notifications.php?hide=0">إشعارات حديثة  </a></li>
   //<li ".($hide == "1" ? "class="active"" : "")." ><a href="notifications.php?hide=1">إشعارات مقروؤة </a></li>


   if($go == "readall"){	try{  
   if(notifi_hide_all($me) == 1){
   ?><script> window.location.href='notifications.html';	</script><?php
   }
   }catch(PDOException $e){
	   echo $e->getMessage();
   }
   }


echo' &nbsp;

<table width="80%" class="" >
<div style="border:thin inset; padding:2px; height:600px; overflow:auto">
';

while($noti_row=$stmt->fetch(PDO::FETCH_ASSOC)){


	$user_in_id = $noti_row['user_in_id'];
	$user_in_name = $noti_row['user_in_name'];	
	$user_in_avatar = $noti_row['user_in_avatar'];
	$user_in_gender = $noti_row['user_in_gender'];	
	
	$user_out_id = $noti_row['user_out_id'];
	$user_out_name = $noti_row['user_out_name'];	
	$user_out_avatar = $noti_row['user_out_avatar'];	
	$user_out_gender = $noti_row['user_out_gender'];	
	$n_id = $noti_row['n_id'];
	$hide = $noti_row['n_hide'];
	$type = $noti_row['n_type'];	
	$t_id = $noti_row['t_id'];
	$r_id = $noti_row['r_id'];	
	$xr_id = $noti_row['xr_id'];
	$t_name = topic_row($t_id,"name");
	$t_img = topic_row($t_id,"img");
	
	
	
	if($type == 1){	$noti_type = "أعجب بموضوعك";$noti_in = "<a href='topic.php&id=".$t_id."'>".$t_name."</a>";
	}elseif($type == 2){$noti_type = "قام بالرد في موضوعك";	$noti_in = "<a href='topic.php&id=".$t_id."'>".$t_name."</a>";
	}elseif($type == 3){$noti_type = "أعجب بردك في الموضوع";$noti_in = "<a href='topic.php&id=".$t_id."'>".$t_name."</a>";
	}elseif($type == 4){$noti_type = "قام بالتعليق على ردك في الموضوع";$noti_in = "<a href='topic.php&id=".$t_id."'>".$t_name."</a>";
	}elseif($type == 5){$noti_type = "أعجب بتعليقك";$noti_in = "<a href='topic.php&id=".$t_id."'>".$t_name."</a>";
	}elseif($type == 6){$noti_type = "قام بالرد على تعليقك";$noti_in = "<a href='topic.php&id=".$t_id."'>".$t_name."</a>";}
	
	
	if($hide == 0){
	echo ' 
	<script type="text/javascript" src="system/js/notifications.js"></script>
	
					<div class="media '.($hide == "0" ? "bg-success" : "bg-warning").' ">
					  <div class="media-left">
						<a href="#">
						  <img class="media-object" src="'.avatar($user_out_avatar,$user_out_gender).'" width="36px" height="36px">
						</a>
					  </div>
					  <div class="media-body">
						<h6 class="media-heading"><a href="users.php?u='.$user_out_id.'">'.$user_out_name.'</a> '.$noti_type.'</h6>
						&nbsp;&nbsp;'.$noti_in.'
					  </div>
					<div class="media-right">
						<a href="#">
						  <img class="media-object" src="'.$t_img.'" width="28px" height="32px"  style="border-radius:50%;">
						</a>
					  </div>
					</div>
			
<a id='.$n_id.' class="readit" href="#" title="قراءة الإشعار"><i class="fa fa-close" aria-hidden="true"></i></a>';

	}
	
	if($hide == 1){
	echo ' 
					<div class="media bg-warning">
					  <div class="media-left">
						<a href="#">
						  <img class="media-object" src="'.avatar($user_out_avatar,$user_out_gender).'" width="36px" height="36px">
						</a>
					  </div>
					  <div class="media-body">
						<h6 class="media-heading"><a href="users.php?u='.$user_out_id.'">'.$user_out_name.'</a> '.$noti_type.'</h6>
						&nbsp;&nbsp;'.$noti_in.'
					  </div>
					<div class="media-right">
						<a href="#">
						  <img class="media-object" src="'.$t_img.'" width="28px" height="32px">
						</a>
					  </div>
					</div>
			';

	}
			
		
		
}

	echo'	<hr />
	
	
	
	</div></table> </td></tr>';	
	

/*
if($type == "read"){
if($_POST['hidd_id'])
{
	$id = $_POST['hidd_id'];

$user->notifi_hide($id);

}

}
*/

?>
	
	