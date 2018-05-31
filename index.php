<?php
if (file_exists("install/new.php"))
                {
                header("Location: install/new.php");
                }
require_once 'global.php';

if ($user->is_loggedin() != "")
                {
                $user->redirect('blog.html');
                }
if (op == "")
                {
                $title = "الدخول";
                $body  = "signin";
                include("system/header.php");
                $tpl->login();
                }
elseif (op == "register")
                {
                $tpl->register();
                }
elseif (op == "joined")
                {
                $tpl->register();
                }
?> 