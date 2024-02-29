<?php

namespace Src\Loading\Operations\CEUOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\CEU\OferecimentoCCExReplicado;
use Src\Loading\Models\CEU\OferecimentoCCEx;

class updateOferecimentosCCEx
{
    private $oferecimentosCCEx;

    public function __construct()
    {
        $this->oferecimentosCCEx = new Transformer(new OferecimentoCCExReplicado, 'CEU/oferecimentos_ccex');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->oferecimentosCCEx, 
            OferecimentoCCEx::class
        );
    }
}