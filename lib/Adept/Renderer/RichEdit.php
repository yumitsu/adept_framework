<?php

class Adept_Renderer_RichEdit extends Adept_Renderer_AbstractInput  
{

    protected function quoteValue($value)
    {
        $value = str_replace('"', "\\\"", $value);
        $value = str_replace(chr(13) . chr(10), chr(13), $value);
        $value = str_replace(chr(10), chr(13), $value);
        $value = str_replace(chr(13), '\n', $value);
        if($value == ''){
            $value = '&nbsp;';
        }
        return $value;
    }
    
    /**
     * @param Adept_Component_RichEdit $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeScriptBegin();

        $value = $this->quoteValue($this->getDisplayValue($component));
        
        $var = $writer->generateIdentifier();   

        $writer->writeHtml("var {$var} = new FCKeditor('{$component->getClientId()}'); \n");

        $configPath = $component->getConfigPath();
        if ($configPath) {
            $writer->writeHtml("{$var}.Config['CustomConfigurationsPath'] = '{$configPath}'; \n");
        }
        
        $scriptPath = $component->getBasePath();
        if ($scriptPath) {
            $writer->writeHtml("{$var}.BasePath = '{$scriptPath}'; \n");    
        }
        
        if ($component->getWidth() != null) {
            $writer->writeHtml("{$var}.Width={$component->getWidth()}; \n");    
        } 
        
        if ($component->getHeight() != null) {
            $writer->writeHtml("{$var}.Height={$component->getHeight()}; \n");
        }
        
        if ($component->getMode() != null) {
            $writer->writeHtml("{$var}.ToolbarSet='{$component->getMode()}'; \n");
        }
        $writer->writeHtml("{$var}.Value = \"{$value}\"; \n");
        $writer->writeHtml("{$var}.Create(); \n");
        
        $writer->writeScriptEnd();
    }

    public function renderEnd($component) 
    {
        
    }

}
