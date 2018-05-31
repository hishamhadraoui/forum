<?php
//session_start();
//require_once('inc____/class.user.php');
//$user = new USER();

global $gets, $agets, $dbc, $user, $topic_row,$pg,$username,$useremail,$useravatar,$usergroup,$usergender,$userage,$joining_date,$me,$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,$user_bg,$user_to,$user_re,$my_posts ;

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

$title = "التسجيل";
$body = "signup";
include ("system/header.php");
	
	
if(isset($_POST['btn-signup'])){
			$uname = strip_tags($_POST['txt_uname']);
			$umail = strip_tags($_POST['txt_umail']);
			$upass = strip_tags($_POST['txt_upass']);
			$uage = strip_tags($_POST['txt_uage']);
			$ugender = strip_tags($_POST['txt_ugender']);
			
			if($uname=="")	{
				$error[] = error('no_name');	
			}
			else if($umail=="")	{
				$error[] = error('no_email');	
			}
			else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
				$error[] = 'الرجاء ادخال اميل صالح !';
			}
			else if($upass=="")	{
				$error[] = "لم تكتب كلمة المرور !";
			}
			else if(strlen($upass) < 6){
				$error[] = "كلمة المرور يجب ان تكون أكثر من 6 أحرف";	
			}
			else
			{
				try
				{
					$stmt = $dbc->runQuery("SELECT user_name, user_email FROM ".prx."users WHERE user_name=:uname OR user_email=:umail");
					$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
					$row=$stmt->fetch(PDO::FETCH_ASSOC);
						
					if($row['user_name']==$uname) {
						$error[] = "للأسف الاسم مسجل من قبل !";
					}
					else if($row['user_email']==$umail) {
						$error[] = "الاميل مسجل من قبل !";
					}
					else
					{
						if($user->register($uname,$umail,$upass,$uage,$ugender)){	
							$user->redirect('sign-up.joined');
						}
					}
				}
				catch(PDOException $e)
				{
					echo $e->getMessage();
				}
			}	
		}

//action="chkpost.php?type=signup"
?>



<div class="container">
    	
        <form method="post"   class="form-signin">
            <h2 class="form-signin-heading">التسجيل</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(op == "joined")
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; تم تسجيل عضوية جديدة بنجاح <a href='index.php'>الدخول</a> هنا
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="اسم المستخدم" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="البريد الإلكتروني" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="كلمة المرور" />
            </div>
            
            
            			
            			
			<div class="form-group">
            	<input type="number" class="form-control" name="txt_uage" min="13" max="100" placeholder="العمر (من 13 الى 100) سنة" />
            </div>			
			<div class="form-group">
			<select id="selectbasic" name="txt_ugender" class="form">
			  <option value="1">ذكر</option>
			  <option value="2">أنثى</option>
			</select>
			</div>

			
            
            
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;تسجيل
                </button>
            </div>
            <br />
            <label>إذا كنت مسجلا يمكنك <a href="index.php">الدخول</a></label>
        </form>
       </div>
</div>

<?php
	include ("footer.php");