<?php
	
echo'<div class="clearfix"></div>';
echo'<div class="container-fluid" style="margin-top:120px;">
<div class="container">';
	
	
		 if($usergroup > 0 && (show_in($body) == 1 )){    
		 
echo'		 
	<div class="col-lg-3 form-signin">
	<div class="row">
	
	        <div class="card hovercard">
                <div class="cardheader" style="background: url('.$user_bg.');">
    				<br>
    				 <div class="homeavatar col-sm-6">
                        <img alt="" src="'.avatar($useravatar,$usergender).'">
                    </div>
                    <div class="info col-sm-6">
                        <div class="title">
                            <a target="_blank" href="users.php?u='.$me.'">'.$username.'</a>
                        </div>
                        <div class="desc">'.moderator($me).'</div>';
                         if($me == 1 ){   
                        echo'<div class="desc">مبرمج النسخة</div>';
                         }  
                        echo'<div class="desc">مشاركاتي <span class="badge">'.$my_posts.'</span></div>
    					
                    </div>
               	  </div>
      
				
		  </div>
	';

  
	
 echo go2forum('array');
 //echo'<br>'; 
 echo all_stats('array');  
 
 //echo'<br>';
 
 echo user_20('last');

 //echo'<br>';
 
 
  
	echo'</div></div>	
	
	<div class="col-lg-9 form-editor">';
	
	}  
	
	
	
	
	
	
	
	
	