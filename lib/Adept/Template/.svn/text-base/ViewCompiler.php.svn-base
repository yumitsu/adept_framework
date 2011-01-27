<?php

class Adept_Template_ViewCompiler extends Adept_Template_Compiler 
{

    /**
     * @param Adept_Template_Node $parent
     */
    protected function _optimizeExpressions($parent)
    {
        $children = $parent->getChildren();
        
        for ($i = count($children) - 1; $i > 0; $i--) {
//            $prev = $children[$i - 1];
//            $curr = $children[$i];
//            
//            if ($curr instanceof Adept_Template_TagLib_View_ExpressionTag 
//                && $prev instanceof Adept_Template_TagLib_View_ExpressionTag) {
//                foreach ($curr->getParts() as $part) {
//                    $curr->addPart($part);
//                }
//                $children->remove($i);                    
//            }
        }
        
        foreach ($parent->getChildren() as $child) {
            $this->_optimizeExpressions($child);
        }
    }    
    
    public function optimize($tree)
    {
//        $this->_optimizeExpressions($tree);
    }
    
}