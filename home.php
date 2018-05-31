<?php
define("error_7" , true);
include("global.php");

//if($usergroup > 0){
	

		if(op == ""){
			if(page == "last"){	
			$title = "آخر المواضيع";

			}elseif(page == "blog"){	
			$title = "اقسام";	

			}if(page == "stiky"){	
			$title = "المواضيع المميزة";

			}else{	
			$title = "المنتديات";	

			}
			$body = "home";
			include ("system/header.php");
				
			echo a7_home('home');

		}elseif(op == "forum"){
			$title = "المنتدى";	
			$body = "forum";
			include ("system/header.php");
			$tpl->aForum();
			
		}elseif(op == "topic"){	
			$body = "topic";
			$tpl->aTopic();
			
		}elseif(op == "noti"){	
			$body = "topic";
			include ("system/notifications.php");
		}


//   }else{ $user->redirect('index.php');}

$tpl->indexFooter();















?>