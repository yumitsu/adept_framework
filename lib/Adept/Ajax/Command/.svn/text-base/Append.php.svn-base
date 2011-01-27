<?php

class Adept_Ajax_Command_Append extends Adept_Ajax_Command 
{

    protected $parentId;
    protected $content;

    public function __construct($parentId, $contentOrComponent)
    {
        parent::__construct();
        $this->parentId = $parentId;

        if (is_object($contentOrComponent) && $contentOrComponent instanceof Adept_Component_AbstractBase) {
            $this->content = $this->getContent($contentOrComponent);    
        } else {
            $this->content = $contentOrComponent;            
        }
    }
    
    private function getContent($container)
    {
        $response = Adept_Context::getInstance()->getResponse();
        $response->startCapture();
        $container->render();
        return $response->endCapture()->getContent();
    }
    
}

