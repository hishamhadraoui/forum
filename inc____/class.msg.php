<?php

	require_once 'class.database.php';
	require_once 'class.friend.php';
	require_once("__func.php");	
	//$fr = new friends;
	
class msg{
	
	public function get_msg_id($u,$me){
	global $fr, $fr_request_on ,$dbc , $avatar, $topic_row, $me;
	$me = $me;
	$stmt = $dbc->runQuery("SELECT msg_id FROM ".prx."msg WHERE (user_s =:u AND user_r =:me) OR (user_r =:u AND user_s =:me)");	
	$stmt->execute(array(':u'=>$u,':me'=>$me));
	$msg_row=$stmt->fetch(PDO::FETCH_ASSOC);
	return $msg_id = $msg_row['msg_id'];
	}
	
	public function creat_msg_id($u,$me){
	global $fr, $fr_request_on ,$dbc , $avatar, $topic_row, $me;
	$me = $me;
	$d = time();
	if($this->get_msg_id($u,$me) != ""){
	return $msg_id = $this->get_msg_id($u,$me);
	}else{
	$stmt = $dbc->runQuery("INSERT INTO ".prx."msg (user_s,user_r,date) VALUES ( :me,:u, :d)");	
	$stmt->execute(array(':u'=>$u,':me'=>$me,':d'=>$d));
	//$msg_row=$stmt->fetch(PDO::FETCH_ASSOC);
	//return $msg_id = $msg_row['msg_id'];
	return $msg_id = $this->get_msg_id($u,$me);
	}
	}
	
	
	public function new_msg($s){
	global $fr, $fr_request_on ,$dbc , $avatar, $topic_row, $me;
	

	
	$msgstmt1 = $dbc->runQuery("SELECT m.msg_id, m.user_s, m.user_r, m.date, u.user_id, u.user_name, u.user_avatar, u.user_gender
								FROM ".prx."msg as m left join ".prx."users as u on(u.user_id = m.user_r) WHERE m.user_s =:s");	
	$msgstmt1->execute(array(':s'=>$s));
	while($msg_row=$msgstmt1->fetch(PDO::FETCH_ASSOC)){
			
			$n = $msg_row['msg_id'];
			$u = $msg_row['user_id'];
			$user_name = $msg_row['user_name'];	$iavatar = avatar($msg_row['user_avatar'],$msg_row['user_gender']);
			$m_date = times_date("time", $msg_row['date']);
	echo'<div class="row sideBar-body">';		
	echo'
	<div class="col-sm-3 col-xs-3 sideBar-avatar"><a href="msg.php?u='.$u.'">
	<div class="avatar-icon"><img src="'.$iavatar.'"></div></a></div>
				<div class="col-sm-9 col-xs-9 sideBar-main"><div class="row">
										<div class="col-sm-8 col-xs-8 sideBar-name">
										  <a href="users.php?u='.$u.'" title="'.$user_name.'">
										  <span class="name-meta">'.$user_name.'</span>
										  </a>
										</div>
										<div class="col-sm-4 col-xs-4 pull-right sideBar-time">
										  <span class="time-meta pull-right">'.$m_date.'
										</span>
										</div>
				</div></div>';
				echo'</div>';
	}
	
	///////////////////////////////////////////
	
	
	$msgstmt2 = $dbc->runQuery("SELECT m.msg_id, m.user_s, m.user_r, m.date, u.user_id, u.user_name, u.user_avatar, u.user_gender
								FROM ".prx."msg as m left join ".prx."users as u on(u.user_id = m.user_s) WHERE m.user_r =:s");	
	$msgstmt2->execute(array(':s'=>$s));
	while($msg_row=$msgstmt2->fetch(PDO::FETCH_ASSOC)){
			$n = $msg_row['msg_id'];
			$u = $msg_row['user_id'];
			$user_name = $msg_row['user_name'];	$iavatar = avatar($msg_row['user_avatar'],$msg_row['user_gender']);
			$m_date = times_date("time", $msg_row['date']);
	echo'<div class="row sideBar-body">';		
	echo'
	
	<div class="col-sm-3 col-xs-3 sideBar-avatar"><a href="msg.php?u='.$u.'">
	<div class="avatar-icon"><img src="'.$iavatar.'"></div></a></div>
				<div class="col-sm-9 col-xs-9 sideBar-main"><div class="row">
										<div class="col-sm-8 col-xs-8 sideBar-name">
										  <a href="users.php?u='.$u.'" title="'.$user_name.'">
										  <span class="name-meta">'.$user_name.'</span>
										  </a>
										</div>
										<div class="col-sm-4 col-xs-4 pull-right sideBar-time">
										  <span class="time-meta pull-right">'.$m_date.'
										</span>
										</div>
				</div></div>';
				echo'</div>';
	}
	
	
	
	
	
	
	


	
	}
	
	
	public function conversation($msg_id,$limite){
	global $fr, $fr_request_on ,$dbc , $avatar, $topic_row, $me, $times_date,$xpage;
		
	$constmt = $dbc->runQuery("SELECT *	FROM ".prx."messages WHERE msg_id =:msg_id order by id asc limit ".$limite."");	
	$constmt->execute(array(':msg_id'=>$msg_id));
	
	while($msg_row=$constmt->fetch(PDO::FETCH_ASSOC)){
	$msg = $msg_row['message'];
	$user = $msg_row['user_id'];
	$date = times_date("time", $msg_row['date']);
	
	
	if($user != $me){	
	echo'<p><div class="row message-body">
          <div class="col-sm-12 message-main-receiver">
            <div class="receiver">
              <div class="message-text">'.$msg.'</div>
              <span class="message-time pull-right">'.$date.'</span>
            </div>
          </div>
        </div></p>';
	}else{      
	echo'<p><div class="row message-body">
          <div class="col-sm-12 message-main-sender">
            <div class="sender">
              <div class="message-text">'.$msg.'</div>
              <span class="message-time pull-right">'.$date.'</span>
            </div>
          </div>
        </div></p>';
		
	}	
	
		} 
		

	
	}
	// ادخال الرسالة
	public function add_msg($id,$txt){
	global $fr, $fr_request_on ,$dbc , $avatar, $topic_row, $me;
	$d = time();
	/*
	$stmt = $dbc->runQuery("SELECT msg_id FROM ".prx."msg WHERE (user_s =:u AND user_r =:me) OR (user_r =:u AND user_s =:me)");	
	$stmt->execute(array(':u'=>$u,':me'=>$me));
	$msg_row=$stmt->fetch(PDO::FETCH_ASSOC);
	$numl = $lstmt->rowCount();	
	*/
	
	$constmt = $dbc->runQuery("INSERT INTO ".prx."messages (msg_id, user_id, message, date) VALUES (:id, :u, :txt, :d) ");	
	$constmt->execute(array(':id'=>$id,':txt'=>$txt,':u'=>$me,':d'=>$d));	
		
	return true;	
		
		
	}
	
	
	
	//التاكد من المحادثة هل موجودة من قبل
	public function getMsgId($u,$me){
		global $fr, $fr_request_on ,$dbc , $avatar, $topic_row, $me;
		$me = $me;
		$stmt = $dbc->runQuery("SELECT msg_id FROM ".prx."msg WHERE (user_s =:u AND user_r =:me) OR (user_r =:u AND user_s =:me)");	
		$stmt->execute(array(':u'=>$u,':me'=>$me));
		$msg_row=$stmt->fetch(PDO::FETCH_ASSOC);
		return $msg_id = $msg_row['msg_id'];
	}	

	//ايدي المحادثة الجديدة
	public function creatMsgId($u,$me){
		global $fr, $fr_request_on ,$dbc , $avatar, $topic_row, $me;
		$me = $me; $d = time();
		if($this->getMsgId($u,$me) != ""){
			return $msg_id = $this->getMsgId($u,$me);
		}else{
			$stmt = $dbc->runQuery("INSERT INTO ".prx."msg (user_s,user_r,date) VALUES ( :me,:u, :d)");	
			$stmt->execute(array(':u'=>$u,':me'=>$me,':d'=>$d));
			return $msg_id = $this->getMsgId($u,$me);
		}
	}
	
	//استخراج معلومات العضوية من الايدي الخاص بها
	public function getUserData($id, $parm){
		global $dbc, $me;
		$stmt = $dbc->runQuery("SELECT * FROM ".prx."users WHERE user_id =:id ");	
		$stmt->execute(array(':id'=>$id));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		return $row[$parm];
	}
	
	
	
	
}

$msg = new msg();