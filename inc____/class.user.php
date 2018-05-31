<?php
require_once('class.session.php');
require_once('class.database.php');


class USER
{
	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
/*	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function fetch_pdo($estmt)
	{
		return $estmt->fetch(PDO::FETCH_ASSOC);
		
	}
	
	public function rowCount(){
    return $this->stmt->rowCount();
	}
*/	
	
	
/////////////////////////////////////////////////////////////////////users///	
public function register($uname,$umail,$upass,$uage,$ugender)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO ".prx."users(user_name,user_email,user_pass,user_age,user_gender) 
		                                               VALUES(:uname, :umail, :upass, :uage, :ugender)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
			$stmt->bindparam(":uage", $uage);
			$stmt->bindparam(":ugender", $ugender);
			
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	

public function doLogin($uname,$umail,$upass){
		
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM ".prx."users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					 session_regenerate_id();

					//$this->$session->__get('user_session') = $userRow['user_id'];
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}

}
	
	
	
	
	
	
	
	
public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
public function u_group()
	{
		if(isset($_SESSION['user_session']))
		{
			
		$uid = $_SESSION['user_session'];
		$stmt = $this->conn->prepare("SELECT user_group FROM ".prx."users WHERE user_id=:uid ");
		$stmt->bindparam(":uid", $uid);
		$stmt->execute();
		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
		return $user_group	= $userRow['user_group'];
		
		}else{
			
		return $user_group	= 0;	
			
		}
		
		
		
	}	
	
public function editsig($nsig,$mid)
	{
		try
		{
			
			$stmt = $this->conn->prepare(" UPDATE ".prx."users SET user_sig=:nsig
			                                WHERE user_id=:mid ");
			$stmt->bindparam(":nsig", $nsig);
			$stmt->bindparam(":mid", $mid);
			
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	
public function ul_group($user_group)
	{
			
		if($user_group	== 1){
		return "مجموعة الأعضاء";	
		}elseif($user_group	== 2){
		return "مجموعة المشرفين";	
		}elseif($user_group	== 3){
		return "مجموعة النواب";	
		}elseif($user_group	== 4){
		return "مجموعة المراقبين";	
		}elseif($user_group	== 5){
		return "مجموعة المشرفين العامين";	
		}elseif($user_group	== 6){
		return "مجموعة المراقبين العامين";	
		}elseif($user_group	== 7){
		return "<font color='blue'>مجموعة المدراء</font>";	
		}else{
		return "غير مسجل في الموقع";		
		}
		
	}	
	
	
public function redirect($url)
	{
		header("Location: $url");
	}
	
public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
	
	
	
	public function editprofile($uavatar,$ubg,$ufb, $utw, $ugp, $uyo,$id)
	{
		try
		{
			
			$stmt = $this->conn->prepare(" UPDATE ".prx."users SET 
			                                user_bg=:ubg, user_avatar=:uavatar, 
			                                user_mfb=:ufb, user_mtw=:utw,
			                                user_mgp=:ugp, user_myo=:uyo
			                                WHERE user_id=:id ");
												  
			//$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":uavatar", $uavatar);
			$stmt->bindparam(":ubg", $ubg);
			$stmt->bindparam(":id", $id);
			
			$stmt->bindparam(":ufb", $ufb);
			$stmt->bindparam(":utw", $utw);
			$stmt->bindparam(":ugp", $ugp);
			$stmt->bindparam(":uyo", $uyo);
			
			
			
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	
	public function edituser($uname,$umail,$uavatar,$ubg,$ufb, $utw, $ugp, $uyo,$id)
	{
		try
		{
			//$upass,$ugroup,
			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			// user_pass=:upass, user_group=:ugroup,
			
			
			$stmt = $this->conn->prepare(" UPDATE ".prx."users SET 
			                                
											user_name=:uname, user_email=:umail, 
											 
											
											user_bg=:ubg, user_avatar=:uavatar, 
			                                user_mfb=:ufb, user_mtw=:utw,
			                                user_mgp=:ugp, user_myo=:uyo
			                                WHERE user_id=:id ");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			//$stmt->bindparam(":upass", $upass);
					
			//$stmt->bindparam(":ugroup", $ugroup);
			
			
			$stmt->bindparam(":uavatar", $uavatar);
			$stmt->bindparam(":ubg", $ubg);
			$stmt->bindparam(":id", $id);
			
			$stmt->bindparam(":ufb", $ufb);
			$stmt->bindparam(":utw", $utw);
			$stmt->bindparam(":ugp", $ugp);
			$stmt->bindparam(":uyo", $uyo);
			
			
			
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}	
	
	public function upgraduser($ugroup,$forum,$u)
{
	
			/*
			$ustmt = $user->prepare('select * from users WHERE user_id=:u');
			$ustmt->execute(array(':u'=>$u));
			$user_row=$ustmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $user_row['user_id'];
			*/
			if($ugroup == 1){
					
					$dstmt=$this->conn->prepare("DELETE FROM ".prx."moderators WHERE user_id=:u");
					$dstmt->bindparam(":u", $u);
					$dstmt->execute();	
				
			$stmt = $this->conn->prepare(" UPDATE ".prx."users SET user_group=:ugroup WHERE user_id=:u ");
			$stmt->bindparam(":ugroup", $ugroup);
			$stmt->bindparam(":u", $u);
			$stmt->execute();
			
				}else{
	
	
	
	
			
				$stmt = $this->conn->prepare("select * from ".prx."moderators WHERE user_id=:u AND f_id=:forum AND mod_level=:ugroup");
				$stmt->bindparam(":u", $u);
				$stmt->bindparam(":forum", $forum);
				$stmt->bindparam(":ugroup", $ugroup);
				
				$stmt->execute();
				$num = $stmt->rowCount();
				if($num == 0){
					
									try
											{
												$stmt = $this->conn->prepare(" UPDATE ".prx."users SET user_group=:ugroup WHERE user_id=:u ");
											
												$stmt->bindparam(":ugroup", $ugroup);
												$stmt->bindparam(":u", $u);
												$stmt->execute();	
												
												$mstmt = $this->conn->prepare("INSERT INTO ".prx."moderators(f_id,mod_level,user_id) 
																						   VALUES(:forum, :ugroup, :u)");

												
												$mstmt->bindparam(":forum", $forum);
												$mstmt->bindparam(":ugroup", $ugroup);
												$mstmt->bindparam(":u", $u);
												$mstmt->execute();	
												
												return $stmt;	
											}
											catch(PDOException $e)
											{
												echo $e->getMessage();
											}	
							
						}
						
				
			
		
				}	
		
}



/// ADD GROUP //////////////////////////////////

public function addgroup($gname,$gcolor,$add_topic,$edit_mytopic,$edit_topic,$del_mytopic,$del_topic,$lock_topic,$unlock_topic,$stick_topic,$unstick_topic,$hidde_topic,$unhidde_topic,$add_reply,$edit_myreply,$edit_reply,$del_myreply,$del_reply,$hidde_reply,$unhidde_reply)
{
	
	$tstmt = $this->conn->prepare("SELECT * FROM ".prx."ugroups ORDER BY group_l DESC LIMIT 1");
	$tstmt->execute();
	$row = $tstmt->fetch(PDO::FETCH_ASSOC);
	$glevel = $row['group_l'] + 1;
			
try
		{
			$ustmt = $this->conn->prepare("INSERT INTO ".prx."ugroups (group_name,group_color,group_l) VALUES (:gname,:gcolor,:glevel) ");
			
			$ustmt->bindparam(":gname", $gname);
			$ustmt->bindparam(":gcolor", $gcolor);
			$ustmt->bindparam(":glevel", $glevel);
			$ustmt->execute();	
				
			
			$tostmt = $this->conn->prepare("INSERT INTO ".prx."topics_op
										(group_l,add_topic,edit_mytopic,edit_topic,del_mytopic,del_topic,lock_topic,
										unlock_topic,stick_topic,unstick_topic,hidde_topic,unhidde_topic) 
		                                 VALUES
										(:glevel,:add_topic,:edit_mytopic,:edit_topic,
										:del_mytopic,:del_topic,:lock_topic,:unlock_topic,:stick_topic,
										:unstick_topic,:hidde_topic,:unhidde_topic)	");
			
			$ustmt->bindparam(":glevel", $glevel);
			$tostmt->bindparam(":add_topic", $add_topic);
			$tostmt->bindparam(":edit_mytopic", $edit_mytopic);
			$tostmt->bindparam(":edit_topic", $edit_topic);
			$tostmt->bindparam(":del_mytopic", $del_mytopic);
			$tostmt->bindparam(":del_topic", $del_topic);
			$tostmt->bindparam(":lock_topic", $lock_topic);
			$tostmt->bindparam(":unlock_topic", $unlock_topic);
			$tostmt->bindparam(":stick_topic", $stick_topic);
			$tostmt->bindparam(":unstick_topic", $unstick_topic);
			$tostmt->bindparam(":hidde_topic", $hidde_topic);
			$tostmt->bindparam(":unhidde_topic", $unhidde_topic);
			$tostmt->execute();
			
			$rstmt = $this->conn->prepare("INSERT INTO ".prx."replys_op
										(group_l,add_reply,edit_myreply,edit_reply,del_myreply,del_reply,hidde_reply,unhidde_reply) 
		                                 VALUES	
										(:glevel,:add_reply,:edit_myreply,:edit_reply,:del_myreply,:del_reply,:hidde_reply,:unhidde_reply)");
			
			$ustmt->bindparam(":glevel", $glevel);
			$rstmt->bindparam(":add_reply", $add_reply);
			$rstmt->bindparam(":edit_myreply", $edit_myreply);
			$rstmt->bindparam(":edit_reply", $edit_reply);
			$rstmt->bindparam(":del_myreply", $del_myreply);
			$rstmt->bindparam(":del_reply", $del_reply);
			$rstmt->bindparam(":hidde_reply", $hidde_reply);
			$rstmt->bindparam(":unhidde_reply", $unhidde_reply);
			$rstmt->execute();
			
			
			
			
			
			
			return $ustmt;
			return $tostmt;
			return $rstmt;
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
		
	
	
	
}

//// END ADD GROUP  ///////////////////////////////





////////////////EDIT GROUP///////////////
public function updategroup($id,$gname,$gcolor,$add_topic,$edit_mytopic,$edit_topic,$del_mytopic,$del_topic,$lock_topic,$unlock_topic,$stick_topic,$unstick_topic,$hidde_topic,$unhidde_topic,$add_reply,$edit_myreply,$edit_reply,$del_myreply,$del_reply,$hidde_reply,$unhidde_reply)
{
	
try
		{
			$ustmt = $this->conn->prepare("UPDATE ".prx."ugroups SET 
															group_name=:gname, 
															group_color=:gcolor
															WHERE group_l=:id ");
			
			$ustmt->bindparam(":gname", $gname);
			$ustmt->bindparam(":gcolor", $gcolor);
			$ustmt->bindparam(":id", $id);
			$ustmt->execute();	
			
			$tstmt = $this->conn->prepare("UPDATE ".prx."topics_op SET 
															add_topic=:add_topic,
															edit_mytopic=:edit_mytopic,
															edit_topic=:edit_topic,
															del_mytopic=:del_mytopic,
															del_topic=:del_topic,
															lock_topic=:lock_topic,
															unlock_topic=:unlock_topic,
															stick_topic=:stick_topic,
															unstick_topic=:unstick_topic,
															hidde_topic=:hidde_topic,
															unhidde_topic=:unhidde_topic
															WHERE group_l=:id ");
			
			$tstmt->bindparam(":add_topic", $add_topic);
			$tstmt->bindparam(":edit_mytopic", $edit_mytopic);
			$tstmt->bindparam(":edit_topic", $edit_topic);
			$tstmt->bindparam(":del_mytopic", $del_mytopic);
			$tstmt->bindparam(":del_topic", $del_topic);
			$tstmt->bindparam(":lock_topic", $lock_topic);
			$tstmt->bindparam(":unlock_topic", $unlock_topic);
			$tstmt->bindparam(":stick_topic", $stick_topic);
			$tstmt->bindparam(":unstick_topic", $unstick_topic);
			$tstmt->bindparam(":hidde_topic", $hidde_topic);
			$tstmt->bindparam(":unhidde_topic", $unhidde_topic);
			$tstmt->bindparam(":id", $id);
			$tstmt->execute();	
			
			$rstmt = $this->conn->prepare("UPDATE ".prx."replys_op SET 
															add_reply=:add_reply,
															edit_myreply=:edit_myreply,
															edit_reply=:edit_reply,
															del_myreply=:del_myreply,
															del_reply=:del_reply,
															hidde_reply=:hidde_reply,
															unhidde_reply=:unhidde_reply
															WHERE group_l=:id ");
			
			$rstmt->bindparam(":add_reply", $add_reply);
			$rstmt->bindparam(":edit_myreply", $edit_myreply);
			$rstmt->bindparam(":edit_reply", $edit_reply);
			$rstmt->bindparam(":del_myreply", $del_myreply);
			$rstmt->bindparam(":del_reply", $del_reply);
			$rstmt->bindparam(":hidde_reply", $hidde_reply);
			$rstmt->bindparam(":unhidde_reply", $unhidde_reply);
			$rstmt->bindparam(":id", $id);
			$rstmt->execute();	
			
			
			return $ustmt;	
			//return $tstmt;
			//return $rstmt;
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
		
	
	
	
}
/////////////// END EDIT GROUP ///////////////////



	
////////////////////////////////////////////////////////////////users end ////
////////////////////////////////////////////////////////////////users admin ////
		public function admin_doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass , user_group FROM ".prx."users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1 && $userRow['is_admin'] == 1)
			{
				
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['admin_name_session'] = $userRow['user_name'];
					$_SESSION['admin_pass_session'] = $userRow['user_pass'];
					$_SESSION['is_admin_session'] = $userRow['is_admin'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	
	public function admin_is_loggedin()
	{
		if(isset($_SESSION['admin_name_session'] ))
		{
			return true;
		}
	}
	
	
		public function admin_doLogout()
	{
		session_destroy();
		unset($_SESSION['admin_name_session'] );
		return true;
	}
	



////////////////////////////////////////////////////////////////users admin end ////

	public function update_option($op_name,$op_value)
    {
		try
		{
			$stmt = $this->conn->prepare("UPDATE ".prx."options SET option_value=:op_value WHERE option_name=:op_name ");
			$stmt->bindparam(":op_value", $op_value);
			$stmt->bindparam(":op_name", $op_name);
			$stmt->execute();	
			return $stmt;	
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}






//// add forum //////
public function addf($fname,$ficon,$ftype,$fcat,$fdesc,$fbgc,$fbg,$fblog)
	{
		try
		{
			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO ".prx."forums(f_name,f_icon,f_type,f_cat,f_desc, f_bgc,f_bg,f_blog) 
		                                               VALUES(:fname, :ficon, :ftype, :fcat, :fdesc, :fbgc, :fbg, :fblog)");

												  
			$stmt->bindparam(":fname", $fname);
			$stmt->bindparam(":ficon", $ficon);
			$stmt->bindparam(":ftype", $ftype);
			$stmt->bindparam(":fcat", $fcat);	
			$stmt->bindparam(":fdesc", $fdesc);
			$stmt->bindparam(":fbgc",$fbgc);
			$stmt->bindparam(":fbg",$fbg);
			$stmt->bindparam(":fblog",$fblog);
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
//////////  add reply  ////////


	
//////////// edit reply//////





//////// add topic //////


public function notifi_hide($n)
{
$n_hide = 1;
$nstmt = $this->conn->prepare("UPDATE ".prx."notifications SET n_hide=:n_hide WHERE n_id=:n ");
$nstmt->bindparam(":n_hide", $n_hide);
$nstmt->bindparam(":n", $n);
$nstmt->execute();
return $nstmt;
}

public function ins_notif($userin,$userout,$ntype,$tid,$rid,$xrid)
{


	$nstmt = $this->conn->prepare("INSERT INTO ".prx."notifications (user_in , user_out , n_type , t_id , r_id , xr_id)	VALUES
	(:userin, :userout, :ntype, :tid, :rid,  :xrid)");
	$nstmt->bindparam(':userin',$userin);
	$nstmt->bindparam(':userout',$userout);
	$nstmt->bindparam(':ntype',$ntype);
	$nstmt->bindparam(':tid',$tid);
	$nstmt->bindparam(':rid',$rid);
	$nstmt->bindparam(':xrid',$xrid);
	$nstmt->execute();

	return $nstmt;
}

/*
public function like_topic($id,$user_id)
{
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
*/






/*
public function des_like_topic($id,$user_id)
{
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
*/





	
////// edit topic////

//////////////////////edit reply/////

///////////////////888////////////////////

public function ip(){
		global $_SERVER;
		$adder='REMOTE_ADDR';
		$for='HTTP_X_FORWARDED_FOR';
		$client='HTTP_CLIENT_IP';
		if(isset($_SERVER)){
				if(isset($_SERVER["{$adder}"])){
				$ip=$_SERVER["{$adder}"];
			}
			elseif(isset($_SERVER["{$for}"])){
				$ip=$_SERVER["{$for}"];
			}
			elseif(isset($_SERVER["{$client}"])){
				$ip=$_SERVER["{$client}"];
			}
		}
		else{
				if(getenv($for)){
				$ip=getenv($for);
			}
			elseif(getenv($client)){
				$ip=getenv($client);
			}
			else{
				$ip=getenv($adder);
			}
		}
		return $ip;
	}
	
	
}




	$user = new USER();


    //$dbc = new Database();	

?>