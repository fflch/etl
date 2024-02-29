<?php

namespace Src\Loading\Operations\CEUOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\CEU\InscricaoCCExReplicado;
use Src\Loading\Models\CEU\InscricaoCCEx;

class updateInscricoesCCEx
{
    private $inscricoesCCEx;

    public function __construct()
    {
        $this->inscricoesCCEx = new Transformer(new InscricaoCCExReplicado, 'CEU/inscricoes_ccex');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'paginated',
            $this->inscricoesCCEx, 
            InscricaoCCEx::class
        );
    }
}