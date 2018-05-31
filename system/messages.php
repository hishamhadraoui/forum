<?php
include '../global.php';

$title = "المحادثات";
global $gets, $agets, $dbc, $topic_row,$pg,$username,$useremail,$useravatar,$usergroup,
$usergender,$userage,$joining_date,$me,$my_mfb,$my_mtw,$my_myo,$my_mgp,$my_sig,
$user_bg,$user_to,$user_re,$my_posts,$user, $topic, $n;
//include ("header.php");
$limite = 20; 
$msg_id = $msg->creat_msg_id($u,$me); 






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
							
							}else{	$error[] = "لا يمكن ادخال رد فارغ";	}
						}catch(PDOException $e)
							{
								echo $e->getMessage();
							}
						} 
						
						
						} 
						
						

?>