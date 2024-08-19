<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PosGraduacao\PosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\PosGraduacao;

class updatePosGraduacoes
{
    private $posGraduacoes;

    public function __construct()
    {
        $this->posGraduacoes = new Transformer(new PosGraduacaoReplicado, 'PosGraduacao/posgraduacoes');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->posGraduacoes,
            PosGraduacao::class
        );
    }
}
