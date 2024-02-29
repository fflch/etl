<?php

namespace Src\Loading\Operations\CEUOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\CEU\CoordenadorCCExReplicado;
use Src\Loading\Models\CEU\CoordenadorCCEx;

class updateCoordenadoresCCEx
{
    private $coordenadoresCCEx;

    public function __construct()
    {
        $this->coordenadoresCCEx = new Transformer(new CoordenadorCCExReplicado, 'CEU/coordenadores_ccex');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->coordenadoresCCEx, 
            CoordenadorCCEx::class
        );
    }
}