<?php

class Adept_Mailer 
{

    protected $encoding;
    protected $sent = false;
    protected $vars = array();    
    
    /**
     * @var Zend_Mail
     */
    protected $mailer;

    public function __construct($encoding = 'windows-1251', $fromEmail = null, $fromName = null)
    {
        $this->encoding = $encoding;
        
        $this->mailer = $this->createMailer();
        
        if ($fromEmail || $fromName) {
            $this->mailer->setFrom($fromEmail, $fromName);
        }
    }
    
    public function setVars($vars)
    {
    	$this->vars = array_merge($this->vars, $vars);
    }
    
    protected function createMailer()
    {
    	return new Zend_Mail($this->encoding);
    }
    
    protected function fillVars($string)
    {
    	return Adept_Util_String::fillPlaces($string, $this->vars, ':');
    }

    public function setSubject($subject)
    {
        // Zend hack :)
        $subject = $this->fillVars($subject);
        
        $quotedValue = '=?win1251?Q?' . Zend_Mime::encodeQuotedPrintable($subject,500) . '?=';        
        $this->mailer->setSubject($quotedValue);
    }
    
    public function setMessage($message)
    {
        $message = $this->fillVars($message);
        $this->mailer->setBodyText(strip_tags($message), $this->encoding);
        $this->mailer->setBodyHtml($message, $this->encoding);
    }
    
    public function setSender($email, $name = null)
    {
        $this->mailer->setFrom($email, $name);
    }
    
    public function addRecepient($email, $name = null)
    {
        $this->mailer->addTo($email, $name);
    }
    
    public function send($multipleSend = false)
    {
        if ($this->sent == true) {
            // Message already sent
            return new Adept_Exception('Mail already sent'); 
        }
        $this->mailer->send();
        $this->sent = true;
    }
    
    public function clearSent()
    {
    	$this->sent = false;
    }
    
}
