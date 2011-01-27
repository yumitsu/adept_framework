<?php

class Adept_Filter_FullPageCache extends Adept_Filter_Abstract
{
    
    const CACHE_SERVICE = 'Adept_Filter_FullPageCache';
    const CACHE_GROUP = 'Adept_Filter_FullPageCache';
    
    public function process($chain) 
    {
        $service = $this->getCacheService();
        
        if ($service) {
            $response = Adept_Context::getInstance()->getResponse();
            $cacheKey = md5(self::CACHE_GROUP . $this->getContext()->getRequest()->getUrl()->__toString());
            
            if (!$service->test($cacheKey)) {
                $buffer = new Adept_Response_Output_Buffer();
                $response->startCapture();
                $chain->next();
                $content = $response->endCapture()->getContent();
                $response->write($content);
                $service->save($content, $cacheKey);
            } else {
                $content = $service->load($cacheKey);
                $response->write($content);
            }
        } else {
            $chain->next();
        }
    }
    
    /**
     * @return Zend_Cache_Core
     */
    private function getCacheService()
    {
        return Adept_Cache::getInstance()->getService(self::CACHE_SERVICE);
    }
    
    
}

