<?php
//	require_once 'inc____/class.database.php';
//	require_once 'inc____/class.friend.php';
//	require_once("inc____/__func.php");	
	
	include("global.php");

	global $dbc, $u, $me;
	
	
class CONVERSATION {
	
	//public $me; // = $me; //id
	//public $u;  //id
	
	public $reciver_id;  //id
	public $reciver;  //name
	public $sender_id;  //id
	public $sender;  //name
	
	public $ttu; //time for update
	
	
		public function __construct()
	{
	
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

$conv = new CONVERSATION();

$limite = 20; 
echo $conv->getUserData($me, 'user_name');
echo'<br>';
echo $conv->getUserData(3, 'user_name');
echo'<br>';
echo $msg_id = $conv->creatMsgId(3,$me);
echo'<br>';
echo $conv->conversation($msg_id,$limite);


















/*

include("global.php");
global $gets, $agets, $dbc, $topic_row,$pg,$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$user, $topic, $n;
$error = array();
$title = "المحادثات";
$body = "msg";
include ("system/header.php");


if($usergroup > 0){
$stmt = $dbc->runQuery("select * from ".prx."users WHERE user_id=:u");
$stmt->execute(array(':u'=>$u));
$numu = $stmt->rowCount();
									if($numu == 0){	
									$title = "خطأ";
									$body = "users";
									include ("system/header.php");
									echo'<tr><center><table>
											<tr>
												<td class="alert alert-danger" colspan="4" width="600"><center><br>رقم العضوية خاطئ<br><br>
													<a href="home.php">العودة للرئيسية</a>
												</td>
											</tr>
										</table></tr>';		
													}else{




$me = $me;
$msg_id = $msg->creat_msg_id($u,$me); 
$limite = 20; 






?>
<link rel="stylesheet" href="system/css/msg.css" type="text/css"  />
<div class="container app">
  <div class="row app-one">
    <div class="col-sm-4 side">
      <div class="side-one">
        <div class="row heading">
          <div class="col-sm-3 col-xs-3 heading-avatar">
            <div class="heading-avatar-icon">
              <img src="<?php echo avatar($useravatar,$usergender);?>">
            </div>
          </div>
          <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
            <i class="fa fa-comments-o fa-2x  pull-right" aria-hidden="true"></i>
          </div>
        </div>

        <div class="row searchBox">
          <div class="col-sm-12 searchBox-inner">
            <div class="form-group has-feedback">
              <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Search">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
        </div>

        <div class="row sideBar"><?php echo $msg->new_msg($me);	?></div>

        
      </div>

      <div class="side-two">
        <div class="row newMessage-heading">
          <div class="row newMessage-main">
            <div class="col-sm-2 col-xs-2 newMessage-back">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </div>
            <div class="col-sm-10 col-xs-10 newMessage-title">
             رسائل جديدة
            </div>
          </div>
        </div>

        <div class="row composeBox">
          <div class="col-sm-12 composeBox-inner">
            <div class="form-group has-feedback">
              <input id="composeText" type="text" class="form-control" name="searchText" placeholder="Search People">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
        </div>

		<div class="row compose-sideBar"><?php echo $msg->new_msg($me);	?></div>
      </div>
    </div>
<?php
				$stmt = $dbc->runQuery("select * from ".prx."users WHERE user_id=:u");
				$stmt->execute(array(':u'=>$u));
				$user_row = $stmt->fetch(PDO::FETCH_ASSOC);

	
?>
   <div class="col-sm-8 conversation">
 
	 <div class="row heading">
        <div class="col-sm-5 col-xs-7">
		<div class="col-sm-2 heading-avatar">
          <div class="heading-avatar-icon">
            <img src="<?php echo avatar($user_row['user_avatar'],$user_row['user_gender']);?>">
          </div>
        </div>
		<div class="col-sm-6 heading-name">مراسلاتك مع:<br><?php echo '<a href="users.php?u='.$user_row['user_id'].'">'.$user_row['user_name'].'</a>'; ?><span class="heading-online">Online</span></div>
		
		</div>

        <div class="col-sm-1 col-xs-1  heading-dot pull-right">
          <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
        </div>
		<div class="col-sm-4 col-xs-1  heading-dot pull-right">
          <a href="home.php"><i class="fa fa-home fa-2x  pull-left" aria-hidden="true"></i></a>
        </div>
      </div>
<?php
	  
	  
	  
	  
	  
	  
	  
	  
?>	  
      <div class="row message" id="conversation">
	  
	  <?php $msg->conversation($msg_id,$limite); ?>
	   </div>
	  
	  <form method="post">
<?php if(isset($_POST['add-msg'])){  
$txt = strip_tags($_POST['txt_msg']);
$id = $msg_id;
						if($txt == "")	{
						$error[] = "لا يمكن ادخال رد فارغ";	
						}
						else
						{
						try
						{   if($msg->add_msg($id,$txt)){
							
							}else{	$error[] = "لا يمكن ادخال رد فارغ";	}
						}catch(PDOException $e)
							{
								echo $e->getMessage();
							}
						} } ?>



      <div class="row reply">
        <div class="col-sm-1 col-xs-1 reply-emojis">
          <i class="fa fa-smile-o fa-2x"></i>
        </div>
        <div class="col-sm-9 col-xs-9 reply-main">
          <input class="form-control" rows="1" id="comment" type="text" class="col-lg-10" name="txt_msg">
		  <input type="hidden" name="add-msg">
        </div>
        <div class="col-sm-1 col-xs-1 reply-recording">
          <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
        </div>
        <div class="col-sm-1 col-xs-1 reply-send">
          <i class="fa fa-send fa-2x" aria-hidden="true"></i>
        </div>
      </div></form>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(function(){
    $(".heading-compose").click(function() {
      $(".side-two").css({
        "left": "0"
      });
    });

    $(".newMessage-back").click(function() {
      $(".side-two").css({
        "left": "-100%"
      });
    });
})
$(document).ready(function(){
    $('#conversation').animate({
        scrollTop: $('#conversation')[0].scrollHeight}, 10);
}); 
</script>


<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
setInterval(function(){
$("#message").load('conversation.php')
}, 1000);
});
</script>


<?php //include ('system/footer.php');

}
}else{
	
	$user->redirect('index.php');
		echo'<tr><center><table>
											<tr>
												<td class="alert alert-danger" colspan="4" width="600"><center><br>رقم العضوية خاطئ<br><br>
													<a href="home.php">العودة للرئيسية</a>
												</td>
											</tr>
										</table></tr>';	
	
	
	
	
													}
													
													
													
													*/