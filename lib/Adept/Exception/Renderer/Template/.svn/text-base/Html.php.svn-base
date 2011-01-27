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
 * @package    Adept_Exception
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Exception_Renderer_Template_Html extends Adept_Exception_Renderer_Html 
{

    public function renderTemplate($exception)
    {
        // Read source 
        $location = $exception->getLocation();
        if (null == $location) {
            return 'No template...';
        }
        $source = $this->cropFile($exception->getLocation()->getFileName(), 
            $exception->getLocation()->getLineNumber() - 5, 10);
        if (empty($source)) {
            return '';
        }
        // Add php tags anytime, so do not write php in html, guys! 
        return '<code>' . highlight_string($source, true) . '</code>';                    
    }

    /**
     * @param Exception $exception
     * @return string
     */
    public function render($exception) 
    {
        $result = $this->renderHeader($exception);
        $result .= $this->renderParams($exception);
        $result .= $this->renderWrapBlock('Template', $this->renderTemplate($exception));
        $result .= $this->renderWrapBlock('Source', $this->renderSource($exception));
        $result .= $this->renderWrapBlock('Trace', $this->renderTrace($exception));
        $result .= $this->renderWrapBlock('Cause', $this->renderCause($exception));
        $result .= $this->renderFooter($exception);
        return $result;
    }

}