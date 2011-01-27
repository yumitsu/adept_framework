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
 * @package    Adept_Filter
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Filter_Profiler_ClientTiming extends Adept_Filter_Abstract 
{

    public function process($chain)
    {
        if (!Adept_Context::getInstance()->getRequest()->isAjax()) {
            echo "<script type=\"text/javascript\">
            var startTime = new Date().getTime();
            function showTime()
            {
                var date = new Date();
                var endTime = date.getTime();
                var diff = endTime - startTime;
                document.write('<small>" . __CLASS__ . ": ' + diff/1000 + ' sec</small><br/>');
            }
            </script>";
        }
        $chain->next();
        if (!Adept_Context::getInstance()->getRequest()->isAjax()) {
            echo '<script type="text/javascript">
                      showTime();
                  </script>';
        }
    }
}
