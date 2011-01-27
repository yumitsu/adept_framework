<?php

/**
 * Adept Framework
 *
 * LICENSE
 *
 * This source file is subject to the BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://adept-project.com/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@adept-project.com so we can send you a copy immediately.
 *
 * @category   Adept
 * @package    Adept_Response
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Response_Http extends Adept_Response_Abstract
{
    protected static $messages = array(
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',

        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',  // 1.0
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',

        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    );

    protected $status;

    protected $redirected = false;
    protected $headerRedirect = true;

    protected $defaultCookiePath = null;
    protected $defaultCookieDomain = null;

    public function clear()
    {
        $this->output->clear();
    }

    public function flush()
    {
        if (!headers_sent()) {
            header($this->getHeaders());
        }
        $this->output->flush();
    }

    /**
     * Send http response status header
     *
     * @param string $text
     *
     * @throws Adept_Exception Throw if headers already sent
     */
    public function sendHeader($text)
    {
        if (!headers_sent()) {
            header($text);
        } else {
            throw new Adept_Exception("Headers already sent");
        }
    }
    
    public function setCookie($key, $value, $expires = null, $path = null, $domain = null, $secure = null)
    {
        if ($path === null && $this->defaultCookiePath !== null) {
            $path = $this->defaultCookiePath;
        }
        
        if ($domain === null && $this->defaultCookieDomain !== null) {
            $domain = $this->defaultCookieDomain;
        }
        
        setcookie($key, $value, $expires, $path, $domain, $secure);
    }

    public function removeCookie($key, $path = null, $domain = null, $secure = null)
    {
        if ($path === null && $this->defaultCookiePath !== null) {  
            $path = $this->defaultCookiePath;
        }
        
        if ($domain === null && $this->defaultCookieDomain !== null) {
            $domain = $this->defaultCookieDomain;
        }
        
        setcookie($key, '', time() - 3600, $path, $domain, $secure);
        unset($_COOKIE[$key]);
    }

    /**
     * Send redirect header
     *
     * @param string $url Target URL
     */
    public function redirect($url, $headerRedirect = null, $status = 301, $doNotThrowExpcetion = false)
    {
        if (is_null($headerRedirect)) {
            $headerRedirect = $this->headerRedirect;
        }

        if ($this->redirected) {
            throw new Adept_Exception('Cannot redirect twice');
        }

        if ($headerRedirect) {
            $this->setStatus($status);
            $this->sendHeader('Location: ' . $url);
        } else {
            echo '<html><head>';
            echo '<meta http-equiv="refresh" content="0; url=' . $url . '">';
            echo '</head><body></body></html>';
            flush();
        }
        if (!$doNotThrowExpcetion) {
            throw new Adept_Exception_Redirect($url);
        }
    }

    public function redirectToReferer($defaultUrl = '/', $headerRedirect = null, $doNotThrowExpcetion = false)
    {
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            $url = $_SERVER['HTTP_REFERER'];
        } else {
            $url = $defaultUrl;
        }
        $this->redirect($url, $headerRedirect, $doNotThrowExpcetion);
    }

    /**
     * Return true if redirect headed was sent.
     *
     * @return bool 
     */
    public function isRedirected()
    {
        return $this->redirected;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusText()
    {
        return $this->getStatus() . ' ' . self::$messages[$this->getStatus()];
    }

    public function getHeaders()
    {
        if(null === $this->getStatus()) {
            $this->setStatus(200);
        }
        if (!isset(self::$messages[$this->getStatus()])) {
            throw new Adept_Exception("{$this->status} is not a valid HTTP status");
        }
        return "HTTP/1.0 {$this->getStatus()} {$this->getStatusText()}";
    }

    public function internalRedirect($url)
    {
        //$a = Adept_Context::getInstance()->getRequest()->getUrl();
        throw new Adept_Exception_InternalRedirect($url);
    }
    
    public function getDefaultCookieDomain()        
    {
        return $this->defaultCookieDomain;
    }
    
    public function setDefaultCookieDomain($defaultCookieDomain) 
    {
        $this->defaultCookieDomain = $defaultCookieDomain;
    }
    
    public function getDefaultCookiePath() 
    {
        return $this->defaultCookiePath;
    }
    
    public function setDefaultCookiePath($defaultCookiePath) 
    {
        $this->defaultCookiePath = $defaultCookiePath;
    }

}
