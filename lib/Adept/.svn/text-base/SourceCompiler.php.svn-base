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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_SourceCompiler 
{
    
    /**
     * Compile PHP classes to one bundle file.
     *
     * @param string $source Source path
     * @param string $dest Result file 
     * @param array $excludedFiles 
     * @param array $excludedClasses
     * @return boolean
     */
    public static function compile($source, $dest, $stripWhitespaces = true, $excludedFiles = array(), $excludedClasses = array())
    {
        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), 
            RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($it as $file) {
            $e = explode('.', $file->getFileName());
            // Filter files
            
            if (in_array($file->getFileName(), $excludedFiles)) {
                continue;
            }
            
            if (end($e) === 'php' && strpos($file->getFileName(), '.inc') === false) {
                require_once($file->getPathName());
            }
        }
            
        $classes = array_merge(get_declared_classes(), get_declared_interfaces());
        
        $result = array();
        foreach ($classes as $class) {
            if (in_array($class, $excludedClasses)) {
                continue;
            }
            
            $reflection  = new ReflectionClass($class);
            $file  = $reflection->getFileName();
            
            // Embeded class like SPL etc
            if (!$file || !file_exists($file)) {
                continue;
            }
            
            // Skip self class
            if ($class == 'Adept_SourceCompiler') {
                continue;
            }

            $lines = file($file);
            
            $start = $reflection->getStartLine() - 1;
            $end   = $reflection->getEndLine();
            
            $classCodeLines = array_slice($lines, $start, ($end - $start));

            $result = array_merge($result, $classCodeLines);
        } 
        
        // Source bundle
        $result = implode("", $result);
        
        $fp = @fopen($dest, 'w');
        if ($fp === false) {
            return false;
        }
        
        fwrite($fp, '<' . '?php ' . $result);
        fclose($fp);

        if ($stripWhitespaces) {
        
            // Strip php whiltespaces on result file.
            $stripped = php_strip_whitespace($dest);
            
            // Save stripped content.
            $fp = @fopen($dest, 'w');
            if ($fp === false) {
                return false;
            }
            fwrite($fp, $stripped);
            fclose($fp);
        }

        return true;
    }
    
}
