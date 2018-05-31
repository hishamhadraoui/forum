<?php

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




//$me = $me;
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
	  
	  <div class="message_box">
	  <?php $msg->conversation($msg_id,$limite); ?>
	  </div>
	  
	   </div>
	  
	  <form method="post">
<?php 
if(isset($_POST['add-msg'])){  
$txt = strip_tags($_POST['txt_msg']);
$id = $msg_id;
						if($txt == "")	{
						$error[] = "لا يمكن ادخال رد فارغ";	
						}
						else
						{
						try
						{   if($msg->add_msg($id,$txt)){
						?><script>
						window.location.href='msg.php?u=<?php echo $u; ?>';
						</script>	<?php
							}else{	$error[] = "لا يمكن ادخال رد فارغ";	}
						}catch(PDOException $e)
							{
								echo $e->getMessage();
							}
						} 
						
						
						} 
						
						

						
?>



      <div class="row reply">
        <div class="col-sm-1 col-xs-1 reply-emojis">
          <i class="fa fa-smile-o fa-2x"></i>
        </div>
        <div class="col-sm-9 col-xs-9 reply-main">
          <input class="form-control" rows="1" id="comment" type="text" class="col-lg-10" name="txt_msg">
		  <input type="hidden" id="shout_message" name="add-msg">
        </div>
        <div class="col-sm-1 col-xs-1 reply-recording">
          <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
        </div>
        <div class="col-sm-1 col-xs-1 reply-send" id="shout_message">
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



<script type="text/javascript" src="fb/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	// load messages every 1000 milliseconds from server.
	load_data = {'fetch':1};
	window.setInterval(function(){
		var id = $(this).attr("id");
		var u = id;
	 $.post('msg.php, {'u':u}, load_data,  function(data) {
		$('.message_box').html(data);
		document.location.reload(true);
		var scrolltoh = $('.message_box')[0].scrollHeight;
		$('.message_box').scrollTop(scrolltoh);
	 });
	}, 1000);
	
	//method to trigger when user hits enter key
	$("#shout_message").keypress(function(evt) {
		if(evt.which == 13) {
				var iusername = $('#shout_username').val();
				var imessage = $('#shout_message').val();
				post_data = {'txt-msg':imessage};
			 	
				//send data to "shout.php" using jQuery $.post()
				$.post('add-msg', post_data, function(data) {
				
					
				}).fail(function(err) { 
				
				//alert HTTP server error
				alert(err.statusText); 
				});
			}
	});
	
	//toggle hide/show shout box
	$(".close_btn").click(function (e) {
		//get CSS display state of .toggle_chat element
		var toggleState = $('.toggle_chat').css('display');
		
		//toggle show/hide chat box
		$('.toggle_chat').slideToggle();
		
		//use toggleState var to change close/open icon image
		if(toggleState == 'block')
		{
			$(".header div").attr('class', 'open_btn');
		}else{
			$(".header div").attr('class', 'close_btn');
		}
		 
		 
	});
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