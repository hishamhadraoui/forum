<?php
/*////////////////////////////////////////////////////////////////////*/
/*         || النسخة فووريم مبرمجة بواسطة faresdja ||                 */
/*         @Email: faresdja55@hotmail.fr				              */
/*         Tel:+213671150086                                          */
/*         fb.com/redoffs                                             */
/*         twitter.com/faresdja                                       */
/*         2018/                                                      */
/*////////////////////////////////////////////////////////////////////*/


	require_once("inc____/class.session.php");
		require_once('inc____/class.database.php');
			require_once("inc____/class.user.php");
				require_once("inc____/class.topic.php");
					require_once("inc____/class.friend.php");
						require_once("inc____/class.msg.php");
					require_once("inc____/__func.php");	
				require_once("inc____/__func.moderators.php");
			require_once("inc____/__func.errors.php");	
	if($user->is_loggedin() != ""){	
	require_once("inc____/session.php"); }
	/////////////////////////////////////
	require_once("inc____/class.tpl.php");
	/////////////////////////////////////
	include ("system/home.php");
	include ("system/editor.php");
	


if($user->is_loggedin()!="")
{
	
	$user_id = $_SESSION['user_session'];
	$stmt = $dbc->runQuery("SELECT * FROM ".$prx."users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1){

		$username 				= $userRow['user_name'];
		$useremail 				= $userRow['user_email'];
		$useravatar 			= $userRow['user_avatar'];
		$usergroup 				= $userRow['user_group'];
		$usergender 			= $userRow['user_gender'];
		$userage 				= $userRow['user_age'];
		$joining_date 			= $userRow['joining_date']; 
		$me 					= $userRow['user_id'];
		$my_mfb 				= $userRow['user_mfb'];
		$my_mtw 				= $userRow['user_mtw'];
		$my_myo 				= $userRow['user_myo'];
		$my_mgp 				= $userRow['user_mgp'];
		$my_sig 				= $userRow['user_sig'];	
		$user_bg 				= $userRow['user_bg'];
		$user_to 				= $userRow['user_to'];
		$user_re 				= $userRow['user_re'];
		$my_posts 				= $user_to + $user_re;
	}
}else{
		$me 					= 0;
		$usergroup 				= 0;
		$username 				= "";
		$useremail 				= "";
		$useravatar 			= "";
		$usergender 			= "";
		$userage 				= "";
		$joining_date 			= "";
		$my_mfb 				= "";
		$my_mtw 				= "";
		$my_myo 				= "";
		$my_mgp 				= "";
		$my_sig 				= "";
		$user_bg 				= "";
		$user_to 				= "";
		$user_re 				= "";
		$my_posts 				= "";
}
	
$body = isset($_GET['body']) ? $_GET['body'] : '';     define("body" , $body);
$title = isset($_GET['title']) ? $_GET['title'] : '';     define("title" , $title);
	
			define("username" , $username);
				define("useremail" , $useremail);
					define("useravatar" , $useravatar);
						define("usergroup" , $usergroup);
							define("usergender" , $usergender);
								define("userage" , $userage);
									define("joining_date" , $joining_date);
										define("me" , $me);
											define("my_mfb" , $my_mfb);
												define("my_mtw" , $my_mtw);
													define("my_mgp" , $my_mgp);
														define("my_sig" , $my_sig);
															define("user_bg" , $user_bg);
																define("user_to" , $user_to);
																	define("user_re" , $user_re);
																		define("my_posts" , $my_posts);
	$id = isset($_GET['id']) ? $_GET['id'] : '';							define("id" , $id);
	$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';					define("cat_id" , $cat_id);
	$type = isset($_GET['type']) ? $_GET['type'] : '';								define("type" , $type);
	$pg = isset($_GET['pg']) ? $_GET['pg'] : '';										define("pg" , $pg);
	$page = isset($_GET['page']) ? $_GET['page'] : '';										define("page" , $page);
	$op = isset($_GET['op']) ? $_GET['op'] : '';											define("op" , $op);
	$option = isset($_GET['option']) ? $_GET['option'] : '';								define("option" , $option);
	$c = isset($_GET['c']) ? $_GET['c'] : '';												define("c" , $c);
	$f = isset($_GET['f']) ? $_GET['f'] : '';												define("f" , $f);
	$t = isset($_GET['t']) ? $_GET['t'] : '';												define("t" , $t);
	$u = isset($_GET['u']) ? $_GET['u'] : '';												define("u" , $u);
	$n = isset($_GET['n']) ? $_GET['n'] : '';												define("n" , $n);
	$go = isset($_GET['go']) ? $_GET['go'] : '';											define("go" , $go);
	$hide = isset($_GET['hide']) ? $_GET['hide'] : '';										define("hide" , $hide);
	//$topic = isset($_GET['topic']) ? $_GET['topic'] : '';									define("topic" , $topic);
	$t_error = isset($_GET['t_error']) ? $_GET['t_error'] : '';								define("t_error" , $t_error);
	$error = isset($_GET['error']) ? $_GET['error'] : '';									define("error" , $error);
/*template files*/																			define('aHeader', 'system/header.php');
																							define('friends', 'system/friends.php');
																						define('aForum', 'system/forum.php');
																					define('aTopic', 'system/topics.php');
																				define('MYprofile', 'system/profile.php');
																			define('eMYprofile', 'system/editprofile.php');
																		define('eMYprofileSig', 'system/editprofilesig.php');
																	define('nOtiFication', 'system/notifications.php');
																define('login', 'system/login.php');
															define('register', 'system/sign-up.php');
														define('ADlogin', 'system/loginadmin.php');
													define('loginForm', 'system/loginform.php');
												define('indexFooter', 'system/footer.php');
date_default_timezone_set ('Africa/Algiers'); //التوقيت الافتراضي
// إظهار الأخطاء
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);