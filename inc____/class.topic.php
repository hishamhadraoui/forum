<?php

require_once('class.database.php');

class TOPIC
{
	private $conn;
	
	public function __construct()	{
			$database = new Database();
			$db = $database->dbConnection();
			$this->conn = $db;
		}
		
	public function addreply($tid,$fid,$ruser,$rmsg,$ure,$tre,$fre)
	{
		try
	{
			
		$fstmt = $this->conn->prepare("UPDATE ".prx."forums SET f_r=:fre WHERE f_id=:fid ");
		$fstmt->bindparam(":fre", $fre);
		$fstmt->bindparam(":fid", $fid);
		$fstmt->execute();	
		
		$tstmt = $this->conn->prepare("UPDATE ".prx."topics SET t_cr=:tre WHERE t_id=:id ");
		$tstmt->bindparam(":tre", $tre);
		$tstmt->bindparam(":id", $tid);
		$tstmt->execute();	
		
		$ustmt = $this->conn->prepare("UPDATE ".prx."users SET user_re=:nuser_re WHERE user_id=:ruser ");
		$ustmt->bindparam(":ruser", $ruser);
		$ustmt->bindparam(":nuser_re", $ure);
		$ustmt->execute();	

		/*
		$rstmt = $this->conn->prepare("INSERT INTO ".prx."notifications (t_id, user_in, user_out, n_type) VALUES (:id, :ruser, :rmsg)");
		$rstmt->bindparam(":rmsg", $rmsg);
		$rstmt->bindparam(":ruser", $ruser);
		$rstmt->bindparam(":id", $tid);
		$rstmt->execute();	
		*/
		$rstmt = $this->conn->prepare("INSERT INTO ".prx."replys (t_id, user_id, r_msg, r_date) VALUES (:id, :ruser, :rmsg, :date)");
		$rstmt->bindparam(":rmsg", $rmsg);
		$rstmt->bindparam(":ruser", $ruser);
		$rstmt->bindparam(":date", time());
		$rstmt->bindparam(":id", $tid);
		
		$rstmt->execute();	
		

		
		
									  
		//return $fstmt;	
		//return $ustmt;
		return $rstmt;
	}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				

	}
	
	public function editreply($rmsg,$rid)
    {
		
		try
		{
			
			
			$stmt = $this->conn->prepare("UPDATE ".prx."replys SET r_msg=:rmsg WHERE r_id=:rid ");
			$stmt->bindparam(":rmsg", $rmsg);
			$stmt->bindparam(":rid", $rid);
			$stmt->execute();	
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}


	public function addtopic($tfid,$tuser,$tname,$tmsg,$timg,$ut,$ft)
	{
		try
	{
			
			
		$fstmt = $this->conn->prepare("UPDATE ".prx."forums SET f_t=:nf_t WHERE f_id=:id ");
		$fstmt->bindparam(":nf_t", $ft);
		$fstmt->bindparam(":id", $tfid);
		$fstmt->execute();	
		
		$ustmt = $this->conn->prepare("UPDATE ".prx."users SET user_to=:nuser_to WHERE user_id=:me ");
		$ustmt->bindparam(":me", $tuser);
		$ustmt->bindparam(":nuser_to", $ut);
		$fstmt->execute();	

		$tstmt = $this->conn->prepare("INSERT INTO ".prx."topics (t_name,f_id, user_id, t_msg, t_img) VALUES (:tname, :id, :me, :tmsg, :timg)");
		$tstmt->bindparam(":tname", $tname);
		$tstmt->bindparam(":tmsg", $tmsg);
		$tstmt->bindparam(":timg", $timg);
		$tstmt->bindparam(":me", $tuser);
		$tstmt->bindparam(":id", $tfid);
		$fstmt->execute();	
									  
		//return $fstmt;	
		//return $ustmt;
		return $tstmt;
	}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}

	public function edittopic($tname,$tmsg,$timg,$tid)
    {
		
		try
		{
			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("UPDATE ".prx."topics SET t_name=:tname, t_msg=:tmsg, t_img=:timg WHERE t_id=:id ");

			$stmt->bindparam(":tname", $tname);
			$stmt->bindparam(":tmsg", $tmsg);
			$stmt->bindparam(":timg", $timg);
			$stmt->bindparam(":id", $tid);
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function incr_topic($v,$id)
	{
	//global $gets, $func;
	$v1 = $v + 1;
	$tstmt = $this->conn->prepare(" UPDATE ".prx."topics SET t_views=:views WHERE t_id=:id");
	$tstmt->bindparam(":views", $v1);
	$tstmt->bindparam(":id", $id);
	$tstmt->execute();

	return $tstmt;

	}
	
	
	
	//////////// edit reply//////
	public function like_topic($id,$user_id){
	$tstmt = $this->conn->prepare("SELECT t_cl FROM topics WHERE t_id=:id ");
	$tstmt->execute(array(':id'=>$id));
	$topicRow=$tstmt->fetch(PDO::FETCH_ASSOC);
	$tcl = $topicRow['t_cl'];	
		
	$lstmt = $this->conn->prepare("SELECT user_id FROM topics_likes WHERE t_id=:id ");
	$lstmt->execute(array(':id'=>$id));
	$likeRow=$lstmt->fetch(PDO::FETCH_ASSOC);
	if($lstmt->rowCount() == 1 && $likeRow['user_id'] == $user_id)
	{
		return false;
	}else{
			
			$tcl1 = $tcl + 1;
			$fstmt = $this->conn->prepare('UPDATE topics SET t_cl=:tcl1 WHERE t_id=:id ');
			$fstmt->bindparam(":tcl1", $tcl1);
			$fstmt->bindparam(":id", $id);
			$fstmt->execute();


			$tstmt = $this->conn->prepare('INSERT INTO topics_likes (t_id, user_id, l_date) VALUES (:id, :user_id, :date)');
			$tstmt->bindparam(":date", time());
			$tstmt->bindparam(":user_id", $user_id);
			$tstmt->bindparam(":id", $id);
			$tstmt->execute();
	return $tstmt;
	}
	}

	public function des_like_topic($id,$user_id){
		global $topic_row;
		
	$tstmt = $this->conn->prepare("SELECT t_cl FROM topics WHERE t_id=:id ");
	$tstmt->execute(array(':id'=>$id));
	$topicRow=$tstmt->fetch(PDO::FETCH_ASSOC);

	$tcl = topic_row($id,'t_cl');	
		
	$lstmt = $this->conn->prepare("SELECT user_id FROM topics_likes WHERE t_id=:id ");
	$lstmt->execute(array(':id'=>$id));

	$likeRow=$lstmt->fetch(PDO::FETCH_ASSOC);

	if($lstmt->rowCount() == 1 && $likeRow['user_id'] == $user_id)
	{
		return false;
	}else{
			
			$tcl1 = $tcl - 1;
			$fstmt = $this->conn->prepare('UPDATE topics SET t_cl=:tcl1 WHERE t_id=:id ');
			$fstmt->bindparam(":tcl1", $tcl1);
			$fstmt->bindparam(":id", $id);
			$fstmt->execute();


			$tstmt = $this->conn->prepare('DELETE FROM topics_likes  WHERE t_id=:id AND user_id=:user_id ');
			
			$tstmt->bindparam(":user_id", $user_id);
			$tstmt->bindparam(":id", $id);
			$tstmt->execute();
	return $tstmt;
	}
	}



	
	///////////////////888////////////////////

	
	
}
	$topic = new TOPIC();

?>