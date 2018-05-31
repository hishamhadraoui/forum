<?php
define('DS',DIRECTORY_SEPARATOR);
define('SESSION_SAVE_PATH',dirname(realpath(__FILE__)) . DS . 'sessions');
class AppSessionHandler extends SessionHandler
{

	private $sessionName = 'MYAPPSESS';
	private $sessionMaxLifetime = 0;
	private $sessionSSL = false;
	private $sessionHTTPonly = True;
	private $sessionPath = '/';
	private $sessionDomain = 'localhost';
	//private $sessionHote = '$_SERVER['HTTP_HOST']';
	private $sessionSavePath = SESSION_SAVE_PATH;
	
	private $sessionCipherAlgo = MCRYPT_BLOWFISH;
	private $sessionCipherMode = MCRYPT_MODE_ECB;
	private $sessionCipherKey = 'MYCRYPTOK3Y@2016';
	private $ttl = 30;
	//private $session = ;
	
	public function __construct()
	{
		ini_set('session.use_cookies',1);
		ini_set('session.use_only_cookies',1);
		ini_set('session.use_trans_sid',0);
		ini_set('session.save_handler','files');
		
		session_name($this->sessionName);
		session_save_path($this->sessionSavePath);
		
		session_set_cookie_params(
			$this->sessionMaxLifetime, $this->sessionPath,
			$this->sessionDomain, $this->sessionSSL,
			$this->sessionHTTPonly
		
		);
		
		session_set_save_handler($this, true);
	}

	public function __get($key)
	{
		return false !== $_SESSION[$key] ? $_SESSION[$key] : false;
	}
	
	public function __set($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	
	public function __isset($key)
	{
		return isset($_SESSION[$key]) ? true : false;
	}
	
	public function read($id)
	{
		return mcrypt_decrypt($this->sessionCipherAlgo, $this->sessionCipherKey, parent::read($id), $this->sessionCipherMode);  
	}
	
	public function write($id, $data)
	{
		return parent::write($id, mcrypt_encrypt($this->sessionCipherAlgo, $this->sessionCipherKey, $data, $this->sessionCipherMode));
	}
	
	
	public function start()
	{
			if(''=== session_id()){
				if(session_start()){
					$this->setSessionStartTime();					
					$this->checkSessionValidity();
				}
				
			}
	}
	
	private function setSessionStartTime()
	{
		if(!isset($this->sessionStartTime)){
			$this->sessionStartTime = time();
		}
		return true;
	}
	
	private function checkSessionValidity()
	{
		if((time() - $this->sessionStartTime) > ($this->ttl * 60)){
			$this->renewSession();
			$this->generateFingerPrint();
		}
		return true;
	}
	
	private function renewSession(){
		
		$this->sessionStartTime = time();
		return session_regenerate_id(true);
		
		
	}
	
	public function kill()
	{
		session_unset();
		
		setcookie(
		$this->sessionName, '', time() - 1000,
		$this->sessionPath, $this->sessionDomain,
		$this->sessionSSL, $this->sessionHTTPonly
		);
		
		session_destroy();
	}
	
		

	private function generateFingerPrint()
	{
		$userAgentId = $_SERVER['HTTP_USER_AGENT'];
		$this->cipherKey = mcrypt_create_iv(16);
		$sessionId = session_id();
		$this->fingerPrint = md5($userAgentId . $this->cipherKey . $sessionId);
	}

	public function isValidFingerPrint()
	{
		if(!isset($this->fingerPrint))
		{
			$this->generateFingerPrint();	
		}
		
		$fingerPrint = md5($_SERVER['HTTP_USER_AGENT'] . $this->cipherKey . session_id());
		
		if($fingerPrint === $this->fingerPrint)
		{
			return true;	
		}
		return false;
	}




}
$session = new AppSessionHandler();
$session->start();
//$session->kill();






























?>