<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PosGraduacao\PosGraduacaoConveniadaReplicado;
use Src\Loading\Models\PosGraduacao\PosGraduacaoConveniada;

class updatePGConveniadas
{
    private $pgConveniadas;

    public function __construct()
    {
        $this->pgConveniadas = new Transformer(new PosGraduacaoConveniadaReplicado, 'PosGraduacao/posgraduacoes_conveniadas');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->pgConveniadas,
            PosGraduacaoConveniada::class
        );
    }
}
