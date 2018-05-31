<?php

	require_once 'class.database.php';
	require_once("__func.php");	
	
	
class friend {
	
public $u1;
public $u2;
	
public function requiest_friend($u1){
		
		global $gets, $agets, $dbc , $me, $topic_row , $fr_request_on;
		$u2 = $me;		
		$frstmt = $dbc->runQuery("SELECT * FROM ".prx."friends");
		$frstmt->execute();
		$fri_row=$frstmt->fetch(PDO::FETCH_ASSOC);
		//$nfr = $frstmt->rowCount();

		if($this->fr_request_on($u1,$u2) == 0){
				if($u1 != $u2){
			$tstmt = $dbc->runQuery("INSERT INTO ".prx."friends (fr1, fr2) VALUES (:u1, :u2)");
			$tstmt->bindparam(":u1", $u1);
			$tstmt->bindparam(":u2", $u2);
			//$tstmt->bindparam(":ok", $ok);
			$tstmt->execute();
			return 'تم ارسال الطلب';
				}
			
		}elseif($this->fr_request_on($u1,$u2) == 1){
			
			return 'تم ارسال الطلب من قبل';
			
		}elseif($this->fr_request_on($u1,$u2) == 2){
			
			return 'انتما صديقين أصلا';
			
		}

		
		
}
	
public function check_friends($u1,$u2){
	if($this->fr_request_on($u1,$u2) == 2){
		return 1;
	}elseif($this->fr_request_on($u1,$u2) == 1){
		return 2;
	}else{
		return 0;
	}	
		
}
	
public function my_friends($u,$row){
	global $gets, $agets, $dbc , $avatar, $topic_row;
	$ok = 1;
		$fr1stmt = $dbc->runQuery("SELECT 		f.fr_id, f.fr_ok, f.fr1, f.fr2,
												u.user_id, u.user_name, u.user_avatar, u.user_gender
												FROM ".prx."friends as f left join ".prx."users as u on(u.user_id = f.fr2)
												WHERE fr1 =:u AND fr_ok=:ok");
		$fr1stmt->execute(array(':u'=>$u,':ok'=>$ok));
		$nfr1 = $fr1stmt->rowCount();		
		if($row == 'list'){
		while($fri_row1=$fr1stmt->fetch(PDO::FETCH_ASSOC)){
			$user_id1 = $fri_row1['user_id'];
			$user_name1 = $fri_row1['user_name'];
			$user_avatar1 = $fri_row1['user_avatar'];
			$user_gender1 = $fri_row1['user_gender'];
			$avatar = avatar($user_avatar1,$user_gender1);
			echo ' <a href="users.php?u='.$user_id1.'" title="'.$user_name1.'"><img src="'.$avatar.'" width="32" height="32"></a>';			
		}
		}
		
		$fr2stmt = $dbc->runQuery("SELECT 		f.fr_id, f.fr_ok, f.fr1, f.fr2,
												u.user_id, u.user_name, u.user_avatar, u.user_gender
												FROM ".prx."friends as f left join ".prx."users as u on(u.user_id = f.fr1)
												WHERE fr2 =:u AND fr_ok=:ok");
		$fr2stmt->execute(array(':u'=>$u,':ok'=>$ok));
		$nfr2 = $fr2stmt->rowCount();		
		if($row == 'list'){
		while($fri_row2=$fr2stmt->fetch(PDO::FETCH_ASSOC)){
			$user_id2 = $fri_row2['user_id'];
			$user_name2 = $fri_row2['user_name'];
			$user_avatar2 = $fri_row2['user_avatar'];
			$user_gender2 = $fri_row2['user_gender'];
			$avatar2 = avatar($user_avatar2,$user_gender2);
			echo ' <a href="users.php?u='.$user_id2.'" title="'.$user_name2.'"><img src="'.$avatar2.'" width="32" height="32"></a>';
		}
		}
		if($row == 'num'){
		return $nfr = $nfr1 + $nfr2;
		}
		
}
	
public function send_by($u1,$u2){
	
	global $gets, $agets, $dbc , $topic_row;
		
		$frstmt = $dbc->runQuery("SELECT f.fr_id, f.fr_ok, f.fr1, f.fr2, u1.user_id, u2.user_id
										FROM ".prx."friends as f 
										left join ".prx."users as u1 on((u1.user_id = f.fr1) || (u1.user_id = f.fr2))
										left join ".prx."users as u2 on((u2.user_id = f.fr1) || (u2.user_id = f.fr2))
										WHERE u1.user_id =:u1 AND u2.user_id =:u2 ");
		$frstmt->execute(array(':u1'=>$u1, ':u2'=>$u2));
		$fri_row=$frstmt->fetch(PDO::FETCH_ASSOC);
		$nfr = $frstmt->rowCount();	
		if($fri_row['fr2'] == $u1){
			return $u1;	
		}elseif($fri_row['fr2'] == $u2){
			return $u2;	
		}
		
		
}
	
public function fr_request_on($u1,$u2){	
	global $gets, $agets, $dbc , $topic_row;
		$frstmt = $dbc->runQuery("SELECT f.fr_id, f.fr_ok, f.fr1, f.fr2, u1.user_id, u2.user_id
										FROM ".prx."friends as f 
										left join ".prx."users as u1 on((u1.user_id = f.fr1) || (u1.user_id = f.fr2))
										left join ".prx."users as u2 on((u2.user_id = f.fr1) || (u2.user_id = f.fr2))
										WHERE u1.user_id =:u1 AND u2.user_id =:u2 ");
		$frstmt->execute(array(':u1'=>$u1, ':u2'=>$u2));
		$fri_row=$frstmt->fetch(PDO::FETCH_ASSOC);
		$nfr = $frstmt->rowCount();
			if($nfr == 0){
			return 0;	
			}else{
				if($fri_row['fr_ok'] == 0){
						return 1;	
				}elseif($fri_row['fr_ok'] == 1){
						return 2;	
				}
				
			}
}	
	
public function accept_fr($u2){	
global $gets, $agets, $dbc , $topic_row , $me , $fr_request_on;
		$ok = 1; $u1 = $me;
			if($u1 != $u2){
		$frstmt = $dbc->runQuery("UPDATE ".prx."friends SET fr_ok=:ok WHERE fr1=:u1 AND fr2=:u2");
		$frstmt->execute(array(':u1'=>$u1, ':u2'=>$u2, ':ok'=>$ok));
		//$fri_row=$frstmt->fetch(PDO::FETCH_ASSOC);
		return 'تم الموافقة على الطلب';
			}else{
		return 'هناك خطأ';		
			}

}	
	
public function notification_fr($me){
	
	global $gets, $agets, $dbc ,  $avatar, $topic_row;
	$ok = 0;
		$fr1stmt = $dbc->runQuery("SELECT 		f.fr_id, f.fr_ok, f.fr1, f.fr2,
												u.user_id, u.user_name, u.user_avatar, u.user_gender
												FROM ".prx."friends as f left join ".prx."users as u on(u.user_id = f.fr2)
												WHERE fr1 =:u AND fr_ok=:ok");
		$fr1stmt->execute(array(':u'=>$me,':ok'=>$ok));
		$nfr = $fr1stmt->rowCount();		
		
		$notifi ='';
			$notifi .='
			';
			if($nfr > 0){
			$notifi .='<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-user"></i><span id="notification_count">'.$nfr.'</span>
			 &nbsp;<span class="caret"></span></a>
			';}
			$notifi .='<ul class="dropdown-menu dropn"  style="padding:2px; height:300px; overflow:auto">
			<li><a href="friends"><center>مشاهدة الكل </a></li>
			طلبات صداقة تنتظر الموافقة
			';
		while($fri_row1=$fr1stmt->fetch(PDO::FETCH_ASSOC)){
			$user_id1 = $fri_row1['user_id'];
			$user_name1 = $fri_row1['user_name'];
			$user_avatar1 = $fri_row1['user_avatar'];
			$user_gender1 = $fri_row1['user_gender'];
			$avatar = avatar($user_avatar1,$user_gender1);
			//echo ' <a href="users.php?u='.$user_id1.'" title="'.$user_name1.'"><img src="'.$avatar.'" width="32" height="32"></a>';		

			$notifi .= '<li>	  
					  <div class="media">
					  
					  <div class="media-left">
						<a href="#">
						  <img class="media-object" src="'.$avatar.'" width="36px" height="36px"  style="border-radius:50%;">
						</a>
					  </div>
					  <div class="media-body media-left">
						<h4 class="media-heading"><a href="users.php?u='.$user_id1.'">'.$user_name1.'</a></h4>
					  </div>
					  <div class="media-body media-right">
						<a href="users.php?op=friends&type=accept&u='.$user_id1.'"><span class="btn btn-success btn-xs">أقبل</span></a>
						<a href="users.php?op=friends&type=denied&u='.$user_id1.'"><span class="btn btn-danger btn-xs">رفض</span></a>
					  </div>
					   </div>
					</li>		  
					';
		}
	
	$notifi .='	 </ul></li>';	
return $notifi;
	
}	
	
	
	
	
}
	
	$fr = new friend;
	//echo $fr->requiest_friend(1,2);
	//echo $fr->check_friends(1,2);
	//echo $fr->send_by(2,1);
	//echo $fr->my_friends(1);
	//echo $fr->accept_fr(1);
	
	
	
	

?>
