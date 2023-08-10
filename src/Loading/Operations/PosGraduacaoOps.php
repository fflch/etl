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
use Src\Transformation\ModelsReplicado\PosGraduacao\DisciplinaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\DisciplinaPosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\TurmaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\TurmaPosGraduacao;

class PosGraduacaoOps
{
    public function __construct()
    {
        $this->posGraduacoes = new Transformer(new PosGraduacaoReplicado, 'PosGraduacao/posgraduacoes');
        $this->defesasPG = new Transformer(new DefesaPosGraduacaoReplicado, 'PosGraduacao/defesas_posgraduacao');
        $this->bancasPG = new Transformer(new BancaPosGraduacaoReplicado, 'PosGraduacao/bancas_posgraduacao');
        $this->orientacoesPG = new Transformer(new OrientacaoPosGraduacaoReplicado, 'PosGraduacao/orientacoes_posgraduacao');
        $this->disciplinasPG = new Transformer(new DisciplinaPosGraduacaoReplicado, 'PosGraduacao/disciplinas_posgraduacao');
        $this->turmasPG = new Transformer(new TurmaPosGraduacaoReplicado, 'PosGraduacao/turmas_posgraduacao');

    }

    public function updatePosGraduacoes()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->posGraduacoes, 
            PosGraduacao::class
        );
    }

    public function updateDefesasPG()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->defesasPG, 
            DefesaPosGraduacao::class
        );
    }

    public function updateBancasPG()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->bancasPG, 
            BancaPosGraduacao::class
        );
    }

    public function updateOrientacoesPG()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->orientacoesPG, 
            OrientacaoPosGraduacao::class
        );
    }

    public function updateDisciplinaPG()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->disciplinasPG, 
            DisciplinaPosGraduacao::class
        );
    }

    public function updateTurmasPG()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->turmasPG, 
            TurmaPosGraduacao::class
        );
    }
}