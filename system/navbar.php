<?php 
global $gets, $agets, $dbc, $topic_row,$pg,$body,
$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,
$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$fr,$is_admin,$notifications ;
?>

 <?php if($body != "post"){    ?>
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo adress_op; ?>"><img src="<?php echo logo_op; ?>" height="36px"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
		  
		  <?php	 if($usergroup > 0 ){    ?>
		  	<li <?php print "".(body == "home" ? "class=\"active\"" : "")." ";     ?> ><a href="home.php"><span class="glyphicon glyphicon-home"></span> الرئيسية</a></li> &nbsp; 
			
			<li <?php print "".(body == "users" ? "class=\"active\"" : "")." ";     ?> ><a href="users.php"><span class="glyphicon glyphicon-user"></span> الأعضاء</a></li>
		<!--	<li <?php print "".(body == "profile" ? "class=\"active\"" : "")." ";     ?> ><a href="profile.php"><span class="glyphicon glyphicon-user"></span> صفحتي</a></li>
		-->
         
<li id="notification_li"><?php	echo notifications($me);    ?></li>
<li><?php	echo $fr->notification_fr($me);    ?></li>

         
         
         
         
         
         
         
         
          <?php  }  ?> 
          </ul>
          
          <?php	 if($usergroup > 0 ){    ?>
		
		  <ul class="nav navbar-nav navbar-left">          
		  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <?php	echo " <img src='".avatar($useravatar,$usergender)."' width='28px' height='28px'>"; ?>&nbsp; <?php echo $username; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
			  <?php if(is_admin($me) == 1 ){  ?> 
				  <li><a target="_blank" href="admin.php"><span class="glyphicon glyphicon-home"></span>&nbsp;الادارة</a></li>
			  <?php  }  ?> 	  
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;بياناتي</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;الخروج</a></li>
				
              </ul>
            </li>
          </ul>
		   
		  
		  
		  
		  
		  <?php  }  ?> 
		  <ul class="nav navbar-nav navbar-left">
		  <?php	 if($usergroup == 0 ){    ?>
		  	<li <?php print "".($body == "signin" ? "class=\"active\"" : "")." ";     ?> ><a href="index.php"><span class="glyphicon glyphicon-home"></span> الدخول</a></li> &nbsp; 
			<li <?php print "".($body == "signup" ? "class=\"active\"" : "")." ";     ?> ><a href="register.php"><span class="glyphicon glyphicon-user"></span> التسجيل</a></li>
          <?php  }  ?> 
		  </ul>
		  
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<?php  }  ?> 
