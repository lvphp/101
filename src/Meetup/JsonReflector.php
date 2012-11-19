<?php
namespace Meetup;
trait JsonReflector{
    public function jsonSerialize()
    {
        $json = array();
        $reflector = new \ReflectionClass($this);
        foreach($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method){
            $name = $method->getName();
            if(substr($name, 0,3) != 'get'){
                continue;
            }
            $json[strtolower(substr($name, 3))] = $this->{$name}();
        }
        
        return $json;
    }    
}