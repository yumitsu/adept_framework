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
 * @package    Adept_Renderer
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Renderer_DateTime_SelectDate extends Adept_Renderer_AbstractInput 
{

    protected $converter;

    public function __construct()
    {
        $this->converter = new Adept_Converter_DateTime();
    }
    
    /**
     * @param Adept_Component_Ui_SelectDate $component
     */
    public function handleRequest($component)
    {
        $component->setValid(true);
        
        $request = $this->getContext()->getRequest();
        
        $dayName = $this->getDaySelectId($component);
        $monthName = $this->getMonthSelectId($component);
        $yearName = $this->getYearSelectId($component);
        
        $component->setSubmittedValue(null);
        
        if ($request->has($dayName) && $request->has($monthName) && $request->has($yearName) &&
            $request->get($dayName) != 0 && $request->get($monthName) != 0 && $request->get($yearName) != 0) {
            $component->setSubmittedValue($request->get($dayName) 
                . '.' . $request->get($monthName) . '.' . $request->get($yearName));
        }
    }
    
    /**
     * @param Adept_Component_AbstractComponent $component
     */
    public function getDaySelectId($component)
    {
        $id = $component->getClientId() . Adept_Component_NamingContainer::SEPARATOR;
        return $id . $component->getAttribute('dayPrefix', 'day');
    } 
    
    public function getMonthSelectId($component)
    {
        $id = $component->getClientId() . Adept_Component_NamingContainer::SEPARATOR;
        return $id . $component->getAttribute('monthPrefix', 'month');
    }
    
    public function getYearSelectId($component)
    {
        $id = $component->getClientId() . Adept_Component_NamingContainer::SEPARATOR;
        return $id . $component->getAttribute('yearPrefix', 'year');
    }

    public function getConverter()
    {
        return $this->converter;
    }
    
    public function getDisplayDateAsArray($component)
    {
        $parts = explode('.', $this->getDisplayValue($component));
        return array('day' => $parts[0], 'month' => $parts[1], 'year' => $parts[2]);
    }

    protected function getMonthList()
    {
        $months = array();
        $monthNames = Adept_Locale::getInstance()->getTranslationList('Month');
        
        $value = 1;
        foreach ($monthNames as $monthName) {
            $months[$value++] = $monthName;
        }
        return $months;        
    }
    
    protected function renderSelect($component, $clientId, $items, $selected)
    {
        $attributes = array(
            'id' => $clientId,
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'disabled' => $component->isDisabled(),
            'name' => $clientId,
        );
        
        $writer = $this->getWriter();
        
        $writer->writeTag('select', $attributes);
        
        $writer->writeTag('option', array('selected' => 0 == $selected, 'value' => 0));
        $writer->writeText('- -');
        $writer->writeClosedTagLn('option');
            
        foreach ($items as $key => $value) {
            $attributes = array(
                'selected' => $key == $selected,
                'value' => $key
            );
            $writer->writeTag('option', $attributes);
            $writer->writeText($value);
            $writer->writeClosedTagLn('option');
        }
        $writer->writeClosedTagLn('select');
    }
    
    public function renderBegin($component)
    {
    }
    
    public function renderChildren($component)
    {
        $displayDate = $this->getDisplayDateAsArray($component);
        
        $this->renderSelect($component, $this->getDaySelectId($component), 
            new Adept_Util_RangeIterator(1, 31), $displayDate['day']);
            
        $this->renderSelect($component, $this->getMonthSelectId($component), 
            $this->getMonthList(), $displayDate['month']);
        
        $this->renderSelect($component, $this->getYearSelectId($component), 
            new Adept_Util_RangeIterator($component->getMaxYear(), $component->getMinYear(), -1), 
            $displayDate['year']);
    }
    
    public function renderEnd($component)
    {
        
    }
    
}