<?php

class Adept_Template_ViewBuilder extends Adept_Template_Builder 
{
    
    protected $lastExprNode = null;
    
    public function characters($characters)
    {
        if ($this->stripLevel > 0) {
            $characters = $this->stripCharacters($characters);
        }

        if (strlen($characters) == 0) {
            return ;
        }
        
        if (!$this->lastNode instanceof Adept_Template_TagLib_View_ExpressionTag) { 
            $node = $this->executor->createTextNode($characters);
            $node->setLocation($this->fixLocation());
            $this->current->addChild($node);
            $this->lastNode = $node;
        } else {
            $this->lastNode->addTextPart($characters);
        }
    }

    public function expression($expression)
    {
        if (!$this->lastNode instanceof Adept_Template_TagLib_View_ExpressionTag) { 
            $node = $this->executor->createExpressionNode($expression);
            $node->setLocation($this->fixLocation());
            $this->current->addChild($node);
            $this->lastNode = $node;
        } else {
            $this->lastNode->addExpressionPart($expression);
        }        
    }    
    
}

