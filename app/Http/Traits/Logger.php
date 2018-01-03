<?php

trait Logger
{

    /**
     * Logs Error detail.
     * 
     * @param \Exception $e 
     * @param string $class  - Main class in which exception occurs
     * @param string $method - function in which exception occurs  
     * 
     * */
    public static function logError(\Exception $exp, $class, $method)
    {
        \Log::error(date('Y-m-d H:i:s') . ' - [' . $class . '] - ' . $method, array(
            'Line' => $exp->getLine(),
            'File' => $exp->getFile(),
            'Exception' => $exp->getMessage()
        ));
    }
    
}
