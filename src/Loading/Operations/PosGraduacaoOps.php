<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Utils\ExtractionUtils;
use Src\Transformation\ModelsReplicado\PosGraduacao\PosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\PosGraduacao;

class PosGraduacaoOps
{
    public function __construct()
    {
        $this->posGraduacoes = new Transformer(new PosGraduacaoReplicado, 'PosGraduacao/posgraduacoes');
    }

    public function updatePosGraduacoes()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->posGraduacoes, 
            PosGraduacao::class, 
            3600
        );
    }
}