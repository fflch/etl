<?php

namespace Src\Loading\Scripts;

class TablesUpdate
{
    public function update($class)
    {
        $newclass = new $class;

        $classMethods = get_class_methods($class);

        foreach($classMethods as $method){
            if($method != '__construct')
            {
                $newclass->{$method}();
            }
        }
    }

}