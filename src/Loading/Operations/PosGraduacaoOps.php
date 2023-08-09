<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Utils\ExtractionUtils;
use Src\Transformation\ModelsReplicado\PosGraduacao\PosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\PosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\DefesaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\DefesaPosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\BancaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\BancaPosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\OrientacaoPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\OrientacaoPosGraduacao;

class PosGraduacaoOps
{
    public function __construct()
    {
        $this->posGraduacoes = new Transformer(new PosGraduacaoReplicado, 'PosGraduacao/posgraduacoes');
        $this->defesas = new Transformer(new DefesaPosGraduacaoReplicado, 'PosGraduacao/defesas_posgraduacao');
        $this->bancas = new Transformer(new BancaPosGraduacaoReplicado, 'PosGraduacao/bancas_posgraduacao');
        $this->orientacoes = new Transformer(new OrientacaoPosGraduacaoReplicado, 'PosGraduacao/orientacoes_posgraduacao');
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

    public function updateDefesas()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->defesas, 
            DefesaPosGraduacao::class, 
            10000
        );
    }

    public function updateBancas()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->bancas, 
            BancaPosGraduacao::class, 
            5800
        );
    }

    public function updateOrientacoes()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->orientacoes, 
            OrientacaoPosGraduacao::class, 
            6000
        );
    }
}