<?php
/**
* Secure login/registration tpl class.
*/

class TPL{
    /** @var object $pdo Copy of PDO connection */
    private $pdo;
    /** @var object of the logged in user */
    private $user;
    /** @var string error msg */
    private $msg;
    /** @var int number of permitted wrong login attemps */
    private $permitedAttemps = 5;

    /**
    * Simple template rendering function
    * @param string $path path of the template file.
    * @return void.
    */
    public function render($path,$vars = '') {
        ob_start();
        include($path);
        return ob_get_clean();
    }
	public function nOtiFication() {
        print $this->render(nOtiFication);
    }
	
	public function aTopic() {
        print $this->render(aTopic);
    }
	
	public function aForum() {
        print $this->render(aForum);
    }
	
	public function aHeader() {
        print $this->render(aHeader);
    }
	
	public function login() {
        print $this->render(login);
    }
	
	public function register() {
        print $this->render(register);
    }
	
	public function ADlogin() {
        print $this->render(ADlogin);
    }
	
    public function MYprofile() {
        print $this->render(MYprofile);
    }	
	public function eMYprofile() {
        print $this->render(eMYprofile);
    }
	
	public function eMYprofileSig() {
        print $this->render(eMYprofileSig);
    }
	public function friends() {
        print $this->render(friends);
    }
    /**
    * Template for index head function
    * @return void.
    */
    public function indexHead() {
        print $this->render(indexHead);
    }

    /**
    * Template for index top function
    * @return void.
    */
    public function indexTop() {
        print $this->render(indexTop);
    }

    /**
    * Template for login form function
    * @return void.
    */
    public function loginForm() {
        print $this->render(loginForm);
    }

    /**
    * Template for activation form function
    * @return void.
    */
    public function activationForm() {
        print $this->render(activationForm);
    }

    /**
    * Template for index middle function
    * @return void.
    */
    public function indexMiddle() {
        print $this->render(indexMiddle);
    }

    /**
    * Template for register form function
    * @return void.
    */
    public function registerForm() {
        print $this->render(registerForm);
    }

    /**
    * Template for index footer function
    * @return void.
    */
    public function indexFooter() {
        print $this->render(indexFooter);
    }

    /**
    * Template for user page function
    * @return void.
    */
    /*
	public function userPage() {
	$users = [];
	if($_SESSION['user']['user_role'] == 2){
		$users = $this->listUsers();
	}
        print $this->render(userPage,$users);
    }
	*/
}

$tpl = new TPL();

/*  exemple ***************************

	require_once '../class.tpl.php';
	require_once 'config.php';
	$tpl->indexHead();
	$tpl->indexTop();
	$tpl->loginForm();
	if($tpl->isConfirmationOn() == 1){
		$tpl->activationForm();
	}
	$tpl->indexMiddle();
	$tpl->registerForm();
	$tpl->indexFooter();
	
************************************** */
	

















