<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Utils\ExtractionUtils;
use Src\Transformation\ModelsReplicado\CredenciamentosPG\CredenciamentoPGReplicado;
use Src\Loading\Models\CredenciamentosPG\CredenciamentoPG;

class CredenciamentosPGOps
{
    public function __construct()
    {
        $this->credenciamentos = new Transformer(new CredenciamentoPGReplicado, 'CredenciamentosPG/credenciamentos_pg');
    }

    public function updateCredenciamentosPG()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->credenciamentos, 
            CredenciamentoPG::class, 
            7200
        );
    }
}