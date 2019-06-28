<?php

require_once("class.phpmailer.php");


class Mail extends PHPMailer
{
	var $From     = "info@alsace-navette.com";  
	var $FromName = "Alsace Navette";  
	var $WordWrap = 70;
	var $CharSet  = 'utf-8';
	var $ContentType = 'text/html';
	
	
	
	function Mail()
	{
		global $method_mail;
		
		$this->Mailer = $method_mail;
		
		if($method_mail == "smtp")
		{
			/*
			$this->Host = "auth.smtp.1and1.fr";
			$this->Port = 587;
			$this->SMTPAuth = true;
			$this->SMTPDebug = true;
			$this->Username = "info@alsace-navette.com";
			$this->Password = "kuhn2000";
			*/
			
			$this->Mailer = "mail";
		}
		
		$this->AddReplyTo("info@alsace-navette.com", "Alsace Navette");
	}
}


?>