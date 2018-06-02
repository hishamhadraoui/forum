<?php



$forums = "CREATE TABLE ".prx."forums ( ".        		// جدوال الفئات والمنتديات
		  "f_id int(30) NOT NULL AUTO_INCREMENT,".
		  "f_name varchar(250) NOT NULL,".
		  "f_desc varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,".
		  "f_type int(11) DEFAULT NULL,".				// النوع : منتدى(0) - فئة(1) ا
		  "f_cat int(11) DEFAULT NULL,".     // رقم ايدي الفئة التي ينتمي لها المنتدى
		  "f_icon varchar(100) NOT NULL DEFAULT 'img/flogo.png',".
		  "f_t int(11) NOT NULL DEFAULT '0',".   //عدد مواضيع المنتدى
		  "f_r int(11) NOT NULL DEFAULT '0',".  //عدد ردود المنتدى
		  "f_bgc varchar(100) NOT NULL DEFAULT 'FFFFFF',".  //لون خلفية المنتدى
		  "f_gender int(11) NOT NULL DEFAULT '0',".   // منتدى خاص بالجنس
		  "f_bg varchar(100) NOT NULL,".  // صورة خلفية المنتدى
		  "f_hid int(10) NOT NULL DEFAULT '0',".
		  "f_blog int(11) NOT NULL DEFAULT '0',".	// طريقة عرض المواضيع عادي0/مربعات1
		  "PRIMARY KEY (f_id)".
		  ") ENGINE=InnoDB DEFAULT CHARSET=utf8 ";

$forums1 = "INSERT INTO ".prx."forums (f_id, f_name, f_desc, f_type, f_cat, f_icon, f_t, f_r, f_bgc, f_gender, f_bg, f_hid, f_blog) VALUES".
			"(1, 'القسم العام', 'يضم المنتديات العامة', 0, 0, 'img/flogo.png', 0, 0, 'F00', 0, '', 0, 0),".
			"(2, 'تعارف الاعضاء', 'بوابة المنتديات دردشة الاعضاء', 1, 1, 'img/_f5.png', 0, 0, 'FFEAE0', 0, 'img/bg_1.png', 0, 0)";

$friends = 	  "CREATE TABLE ".prx."friends ( ".    // جدزل الاصدقاء يظهر طلبات الصداقة واذا كان العضو صديق
			  "fr_id int(11) NOT NULL AUTO_INCREMENT,".
			  "fr1 int(11) NOT NULL,".    // ايدي العضو الاول
			  "fr2 int(11) NOT NULL,".    // ايدي العضو الثاني
			  "fr_ok int(11) NOT NULL DEFAULT '0',".   // عند الموافقة تصير القيمة1 
			  "PRIMARY KEY (fr_id)".
			  ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
  
$messages = "CREATE TABLE ".prx."messages (".   // الرسائل بين الاصدقاء فقط
			 "id int(11) NOT NULL,".
			 "msg_id int(11) NOT NULL,".  //يتم استخراج الرسائل بالايدي من الجدول msg
			 "user_id int(11) NOT NULL,".
			 "message varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,".
			"date int(11) NOT NULL,".
			"PRIMARY KEY (id)".
			") ENGINE=InnoDB DEFAULT CHARSET=utf8";

$moderators = "CREATE TABLE ".prx."moderators (".   //  المشرفين او المراقبين على منتدى او فئة
			  "mod_id int(11) NOT NULL AUTO_INCREMENT,".
			  "mod_level int(11) NOT NULL,".  // ياخد من مجموعة العضو  usergroup لتعيين كمشرف او مراقب...
			  "user_id int(11) NOT NULL,".  // ايدي العضو
			  "f_id int(11) NOT NULL,".   // ايدي المنتدى او الفئة
			  "PRIMARY KEY (mod_id)".
			") ENGINE=InnoDB DEFAULT CHARSET=utf8";

$msg = "CREATE TABLE ".prx."msg (".  // جلسات الشات مع الاصدقاء بين كل عضوين ايدي ثابت
			  "msg_id int(11) NOT NULL,".
			  "user_s int(11) NOT NULL,".
			  "user_r int(11) NOT NULL,".
			  "date int(11) NOT NULL,".
			  "PRIMARY KEY (msg_id)".
			  ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
			
$notifications = "CREATE TABLE ".prx."notifications (".  // جدول الاشعارات
  "n_id int(11) NOT NULL AUTO_INCREMENT,".
  "user_in int(11) NOT NULL,".  // ايدي العضو الذي يصله اشعار
  "user_out int(11) NOT NULL,".  // العضو المشارك او المعجب
  "n_type int(100) NOT NULL,".   // نوع الاشعار
  "n_hide int(11) DEFAULT '0',".  // قراءة الاشعار زضع القيمة1
  "t_id int(11) NOT NULL,".
  "r_id int(11) NOT NULL,".
  "xr_id int(11) NOT NULL,".
  "PRIMARY KEY (n_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8";




  

$options = "CREATE TABLE ".prx."options (".  // خيارات الموقع العامة
  "option_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,".
  "option_name varchar(30) DEFAULT NULL,".
  "option_value varchar(300) DEFAULT NULL,".
  "PRIMARY KEY (option_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$options1 = "INSERT INTO ".prx."options (option_id, option_name, option_value) VALUES".
"(1, 'dateforum', '1462118231'),".
"(2, 'title', 'فووريم'),".
"(3, 'adress', 'https://www.exemple.com'),".
"(4, 'showurl', 'https://exemple.com'),".
"(5, 'keywords', 'فووريم, ركن بلوجر, قالب افاق,dyndns,سيرفر,شعر,تحديث,DuHok Forum 2.2'),".
"(6, 'description', 'منتديات فووريم منصة وملتقى لشباب العرب لتبادل المعارف والخبرات في كل المجالات'),".
"(7, 'emailbiot', 'afaqsat.com@gmail.com'),".
"(8, 'time', '1'),".
"(9, 'closeoff', '0'),".
"(10, 'closemsg', 'المنتدى تحت الصيانة ...\r\n\r\n.... سنعود بعد قليل .....'),".
"(11, 'registeroff', '0'),".
"(12, 'registerwait', '0'),".
"(13, 'logo', 'img/afaq7.png'),".
"(14, 'facebook', 'https://www.facebook.com/afaqsatCom'),".
"(15, 'twitter', 'https://twitter.com/AfaqsatCom'),".
"(16, 'youtube', 'https://www.youtube.com/channel/UCOwcupL1M20A4zy1hx-gf0w'),".
"(17, 'colori_f', '1'),".
"(18, 'footer', 'faresdja'),".
"(19, 'sb_home', '1'),".
"(20, 'sb_users', '0'),".
"(21, 'sb_profile', '1'),".
"(22, 'sb_post', '0'),".
"(23, 'sb_login', '0'),".
"(24, 'sb_admin', '0'),".
"(25, 'sb_forum', '1'),".
"(26, 'sb_topic', '1'),".
"(27, 'h_blog', '1'),".
"(28, 'h_forums', '1'),".
"(29, 'h_mixt', '1'),".
"(30, 'h_last', '1'),".
"(31, 'h_sticky', '1')";


  

$permissions = "CREATE TABLE ".prx."permissions (".
  "p_id int(11) NOT NULL AUTO_INCREMENT,".
  "p_name varchar(250) NOT NULL,".
  "p_value int(15) DEFAULT '0',".
  "user_group int(100) NOT NULL,".
  "PRIMARY KEY (p_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8";




  

$replys = "CREATE TABLE ".prx."replys (".   // جدول الردود
  "r_id int(10) NOT NULL AUTO_INCREMENT,".
  "t_id int(10) NOT NULL,".  // ايدي الموضوع
  "user_id int(11) NOT NULL,".
  "r_msg mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,".
  "r_date int(11) NOT NULL,".
  "r_cl int(11) NOT NULL,".
  "PRIMARY KEY (r_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

 

$replys_likes = "CREATE TABLE ".prx."replys_likes (".   // الاعجابات بالرد
  "l_id int(10) NOT NULL AUTO_INCREMENT,".
  "r_id int(10) NOT NULL,".   // ايدي الرد
  "user_id int(10) NOT NULL,".
  "l_date int(10) NOT NULL,".
  "r_like int(11) NOT NULL DEFAULT '1',".
  "PRIMARY KEY (l_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8";

 

$replys_op = "CREATE TABLE ".prx."replys_op (".   // التحكم في الردود لكل مجموعة
  "opr_id int(11) NOT NULL AUTO_INCREMENT,".
  "group_l int(11) NOT NULL,".
  "add_reply int(11) NOT NULL DEFAULT '1',".
  "edit_myreply int(11) NOT NULL DEFAULT '1',".
  "edit_reply int(11) NOT NULL DEFAULT '1',".
  "del_myreply int(11) NOT NULL DEFAULT '0',".
  "del_reply int(11) NOT NULL DEFAULT '0',".
  "hidde_reply int(11) NOT NULL DEFAULT '0',".
  "unhidde_reply int(11) NOT NULL DEFAULT '0',".
  "PRIMARY KEY (opr_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8";
$replys_op1 = "INSERT INTO ".prx."replys_op (opr_id, group_l, add_reply, edit_myreply, edit_reply, del_myreply, del_reply, hidde_reply, unhidde_reply) VALUES".
"(1, 0, 0, 0, 0, 0, 0, 0, 0),".
"(2, 1, 1, 1, 1, 1, 1, 1, 1),".
"(3, 2, 1, 1, 1, 0, 0, 0, 0),".
"(4, 3, 1, 1, 1, 1, 1, 1, 1),".
"(5, 4, 1, 1, 1, 1, 1, 1, 1),".
"(6, 5, 1, 1, 1, 0, 0, 0, 0),".
"(7, 6, 1, 1, 1, 0, 0, 0, 0),".
"(8, 7, 1, 1, 1, 1, 1, 1, 1),".
"(9, 8, 1, 1, 1, 1, 1, 1, 1),".
"(10, 9, 1, 1, 1, 1, 1, 1, 1),".
"(11, 10, 1, 1, 0, 0, 0, 0, 0),".
"(12, 11, 0, 0, 0, 0, 0, 0, 0),".
"(13, 0, 0, 0, 0, 0, 0, 0, 0)";


  

$topics = "CREATE TABLE ".prx."topics (".  // جدول المواضيع
  "t_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,".
  "f_id int(10) NOT NULL,".    // ايدي المنتدى
  "user_id int(10) NOT NULL,".   // كاتب الموضوع
  "t_name varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "t_msg text COLLATE utf8mb4_unicode_ci NOT NULL,".
  "t_date int(10) UNSIGNED NOT NULL,".
  "t_img varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "t_cr int(10) NOT NULL,".   // عدد الردود في الموضوع
  "t_cl int(10) NOT NULL DEFAULT '0',".
  "t_views int(100) NOT NULL DEFAULT '0',".
  "t_sticky tinyint(1) NOT NULL,".
  "t_hidden tinyint(1) NOT NULL,".
  "t_locked tinyint(1) NOT NULL,".
  "t_delete tinyint(1) NOT NULL,".
  "PRIMARY KEY (t_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";




  

$topics_likes = "CREATE TABLE ".prx."topics_likes (".   // الاعجابات بالموضوع
  "l_id int(10) NOT NULL AUTO_INCREMENT,".
  "t_id int(10) NOT NULL,".
  "user_id int(10) NOT NULL,".
  "l_date int(10) NOT NULL,".
  "t_like int(11) NOT NULL DEFAULT '1',".  //عند الغاء الاعجاب تاخد القيمة0
  "PRIMARY KEY (l_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8";




  

$topics_op = "CREATE TABLE ".prx."topics_op (". // خيارات التحكم بالموضوع التي تعطى لمجموعة معية
  "opt_id int(11) NOT NULL AUTO_INCREMENT,".
  "group_l int(11) NOT NULL,".
  "add_topic int(11) NOT NULL DEFAULT '1',".
  "edit_mytopic int(11) NOT NULL DEFAULT '1',".
  "edit_topic int(11) NOT NULL DEFAULT '1',".
  "del_mytopic int(11) NOT NULL DEFAULT '0',".
  "del_topic int(11) NOT NULL DEFAULT '0',".
  "lock_topic int(11) NOT NULL DEFAULT '0',".
  "unlock_topic int(11) NOT NULL DEFAULT '0',".
  "stick_topic int(11) NOT NULL DEFAULT '0',".
  "unstick_topic int(11) NOT NULL DEFAULT '0',".
  "hidde_topic int(11) NOT NULL DEFAULT '0',".
  "unhidde_topic int(11) NOT NULL DEFAULT '0',".
  "PRIMARY KEY (opt_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8";

$topics_op1 = "INSERT INTO ".prx."topics_op (opt_id, group_l, add_topic, edit_mytopic, edit_topic, del_mytopic, del_topic, lock_topic, unlock_topic, stick_topic, unstick_topic, hidde_topic, unhidde_topic) VALUES".
"(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),".
"(2, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),".
"(3, 2, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),".
"(4, 3, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),".
"(5, 4, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0),".
"(6, 5, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),".
"(7, 6, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),".
"(8, 7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),".
"(9, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),".
"(10, 9, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),".
"(11, 10, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),".
"(12, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),".
"(13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";


  

$ugroups = "CREATE TABLE ".prx."ugroups (".   // مجموات الاعضاء تاخد التصاريح من topics_op و replys_op 
  "group_id int(11) NOT NULL AUTO_INCREMENT,".
  "group_l int(11) NOT NULL,".
  "group_name varchar(250) NOT NULL,".
  "group_color varchar(100) NOT NULL DEFAULT '000000',".
  "PRIMARY KEY (group_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8";

$ugroups1 = "INSERT INTO ".prx."ugroups (group_id, group_l, group_name, group_color) VALUES".
"(1, 0, 'الزوار -الغير مسجلين-', '00000e'),".
"(2, 1, 'الأعضاء', '000000'),".
"(3, 2, 'المشرفين', 'FF051E'),".
"(4, 3, 'النواب', 'FF9924'),".
"(5, 4, 'المراقبين', 'FFAA00'),".
"(6, 5, 'المشرفين العامين', 'D608FF'),".
"(7, 6, 'المراقبين العامين', '8E0DFF'),".
"(8, 7, 'الطاقم الإداري', '0D1DFF'),".
"(9, 8, 'فريق العمل', 'FF8793'),".
"(10, 9, 'نائب المدير', '370FFF'),".
"(11, 10, 'فريق الدعاية', 'FF8112'),".
"(12, 11, 'المحظورين', 'A1A1A1'),".
"(13, 12, 'عضوية مجمدة', 'C7C7C7')";



  

$users = "CREATE TABLE ".prx."users (".   // جدول الاعضاء
  "user_id int(11) NOT NULL AUTO_INCREMENT,".
  "user_name varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_email varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_pass varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "joining_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,".
  "user_avatar varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_group int(15) NOT NULL DEFAULT '1',".
  "user_bg varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_mfb varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_mtw varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_myo varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_mgp varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_gender int(10) NOT NULL,".
  "user_to int(100) NOT NULL DEFAULT '0',".   // عدد المواضيع
  "user_re int(100) NOT NULL DEFAULT '0',".   // عدد الردود
  "user_sig text COLLATE utf8mb4_unicode_ci NOT NULL,".
  "user_age int(100) NOT NULL,".
  "friend_count int(11) NOT NULL,".
  "is_admin int(11) NOT NULL DEFAULT '0',".   // هل العضو مدير
  "PRIMARY KEY (user_id)".
") ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";




  

$xreplys = "CREATE TABLE ".prx."xreplys (".  // جدول الردود او التعليقات تحت الردود
  "xr_id int(10) NOT NULL AUTO_INCREMENT,".
  "r_id int(11) NOT NULL,".
  "user_id int(11) NOT NULL,".
  "xr_msg text NOT NULL,".
  "xr_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,".
  "PRIMARY KEY (xr_id)".
") ENGINE=InnoDB DEFAULT CHARSET=utf8";

