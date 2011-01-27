<?php

class Adept_Renderer_AbstractInput extends Adept_Renderer_AbstractControl
{
    
    /**
     * Handle request phase
     *
     * @param Adept_Component_AbstractInput $component
     */
    public function handleRequest($component)
    {
        $component->setValid(true);
        
        $request = $this->getContext()->getRequest();
        
        if ($request->has($component->getClientId())) {
            $component->setSubmittedValue($request->get($component->getClientId()));
        }
    }
    
    /**
     * Get component value
     * 
     * @param Adept_Component_AbstractInput $component
     * @return mixed
     */
    public function getValue($component)
    {
        return $component->getValue();
    }
    
    /**
     * Converts value to display.
     *
     * @param Adept_Component_AbstractInput $component
     * @param string $modelValue
     * @return string Converted value
     */
    public function getDisplayValue($component)
    {
        if ($component->isSubmitted()) {
            $value = $component->getSubmittedValue();
        } else {
            $value = $component->convertToView($component->getValue());
        }
        return $value;
    }    
    
}