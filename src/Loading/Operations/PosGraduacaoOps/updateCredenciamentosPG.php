<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PosGraduacao\CredenciamentoPGReplicado;
use Src\Loading\Models\PosGraduacao\CredenciamentoPG;

class updateCredenciamentosPG
{
    private $credenciamentosPG;

    public function __construct()
    {
        $this->credenciamentosPG = new Transformer(new CredenciamentoPGReplicado, 'PosGraduacao/credenciamentos_pg');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->credenciamentosPG,
            CredenciamentoPG::class
        );
    }
}
