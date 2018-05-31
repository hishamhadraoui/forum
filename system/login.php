<?php
global $gets, $agets, $dbc, $user, $topic_row,$pg,$username,$useremail,$useravatar,$usergroup,$usergender,$userage,$joining_date,$me,$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,$user_bg,$user_to,$user_re,$my_posts ;
if(isset($_POST['btn-login'])){
			$uname = strip_tags($_POST['txt_uname_email']);
			$umail = strip_tags($_POST['txt_uname_email']);
			$upass = strip_tags($_POST['txt_password']);
				
			if($user->doLogin($uname,$umail,$upass))
			{
				$user->redirect('blog.html');
			}
			else
			{
				$error = " معلومات خاطئة !";
			}	
}	



// action="chkpost.php?type=login"
?>
<div class="container">
	
	
	<div class="row">
    <div class="col-lg-4"> 
      <form class="form-signin" method="post" id="login-form">
        <h3 class="form-signin-heading">تسجيل الدخول </h3><hr />
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="الاسم أو الأميل" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="كلمة المرور" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; الدخول
            </button>
        </div>  
      	<br />
            <label>أم أنك تريد  ! <a href="register.php">التسجيل</a></label>
      </form>

    </div>
	
	
	
	
	<div class="col-lg-8 form-home">	 
		<div class="col-lg-4"><?php echo all_stats('array');  ?></div>
		<div class="col-lg-8"> <?php echo user_20('last');  ?></div>	   
		<hr /> <br /><br /><br /><br /><br /><br /><br /><br />
    </div>
	
	
	
	</div>
	
	
	
    
</div>