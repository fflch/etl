<?php

namespace Src\Extraction;

use Uspdev\Replicado\DB;

class Replicado{

    public static function getData($query)
    {  
        return DB::fetchAll($query);
    }
}