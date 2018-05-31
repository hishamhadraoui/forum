<?php


//include("autoload.php");
//include("config.php");

global $gets, $agets, $dbc, $topic_row,$pg,
$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,
$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$user ;

if(isset($_POST['btn-admin_login']))
		{
			$uname = strip_tags($_POST['txt_uname_email']);
			$umail = strip_tags($_POST['txt_uname_email']);
			$upass = strip_tags($_POST['txt_password']);
				
			if($user->admin_doLogin($uname,$umail,$upass))
			{
				$user->redirect('admin.php');
			}
			else
			{
				$error = "  معلومات خاطئة / أولاتملك التصريح للدخول";
			}	
		}	


		
		
		 //action="chkpost.php?type=admin_login"
		?>
<style>
body{
	background-color:#111fef;
}
</style>


<div class="signin-form">

	<div class="container">
	
	
	<div class="row">
   
      <form class="form-signin" method="post" id="login-form">
        <h5><center><img src="<?php echo logo_op; ?>"  width="110" height="65"   ></h5>
		<hr />
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
            <button type="submit" name="btn-admin_login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; الدخول
            </button>
        </div>  
      
      </form>

    
	
	
	
	
	
	</div>
	
	
	
    
</div>
</div>
