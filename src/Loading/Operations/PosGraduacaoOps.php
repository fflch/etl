<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
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
use Src\Transformation\ModelsReplicado\PosGraduacao\MinistrantePosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\MinistrantePosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\CoordenadorPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\CoordenadorPosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\OcorrenciaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\OcorrenciaPosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\BolsaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\BolsaPosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\CredenciamentoPGReplicado;
use Src\Loading\Models\PosGraduacao\CredenciamentoPG;
use Src\Transformation\ModelsReplicado\PosGraduacao\EstagioPaeReplicado;
use Src\Loading\Models\PosGraduacao\EstagioPae;
use Src\Transformation\ModelsReplicado\PosGraduacao\PosGraduacaoConveniadaReplicado;
use Src\Loading\Models\PosGraduacao\PosGraduacaoConveniada;
use Src\Transformation\ModelsReplicado\PosGraduacao\ProficienciaIdiomaPGReplicado;
use Src\Loading\Models\PosGraduacao\ProficienciaIdiomaPG;

class PosGraduacaoOps
{
    private $posGraduacoes, $defesasPG,
        $bancasPG, $orientacoesPG,
        $disciplinasPG, $turmasPG,
        $ministrantesPG, $coordenadoresPG,
        $ocorrenciasPG, $bolsasPG,
        $credenciamentosPG, $estagiosPae,
        $pgConveniadas, $proficienciaIdiomas;

    public function __construct()
    {
        $this->posGraduacoes = new Transformer(new PosGraduacaoReplicado, 'PosGraduacao/posgraduacoes');
        $this->defesasPG = new Transformer(new DefesaPosGraduacaoReplicado, 'PosGraduacao/defesas_posgraduacao');
        $this->bancasPG = new Transformer(new BancaPosGraduacaoReplicado, 'PosGraduacao/bancas_posgraduacao');
        $this->orientacoesPG = new Transformer(new OrientacaoPosGraduacaoReplicado, 'PosGraduacao/orientacoes_posgraduacao');
        $this->disciplinasPG = new Transformer(new DisciplinaPosGraduacaoReplicado, 'PosGraduacao/disciplinas_posgraduacao');
        $this->turmasPG = new Transformer(new TurmaPosGraduacaoReplicado, 'PosGraduacao/turmas_posgraduacao');
        $this->ministrantesPG = new Transformer(new MinistrantePosGraduacaoReplicado, 'PosGraduacao/ministrantes_posgraduacao');
        $this->coordenadoresPG = new Transformer(new CoordenadorPosGraduacaoReplicado, 'PosGraduacao/coordenadores_posgraduacao');
        $this->ocorrenciasPG = new Transformer(new OcorrenciaPosGraduacaoReplicado, 'PosGraduacao/ocorrencias_posgraduacao');
        $this->bolsasPG = new Transformer(new BolsaPosGraduacaoReplicado, 'PosGraduacao/bolsas_posgraduacao');
        $this->credenciamentosPG = new Transformer(new CredenciamentoPGReplicado, 'PosGraduacao/credenciamentos_pg');
        $this->estagiosPae = new Transformer(new EstagioPaeReplicado, 'PosGraduacao/estagios_pae');
        $this->pgConveniadas = new Transformer(new PosGraduacaoConveniadaReplicado, 'PosGraduacao/posgraduacoes_conveniadas');
        $this->proficienciaIdiomas = new Transformer(new ProficienciaIdiomaPGReplicado, 'PosGraduacao/proficiencia_idiomas_pg');
    }

    public function updatePosGraduacoes()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->posGraduacoes,
            PosGraduacao::class
        );
    }

    public function updateDefesasPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->defesasPG, 
            DefesaPosGraduacao::class
        );
    }

    public function updateBancasPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bancasPG, 
            BancaPosGraduacao::class
        );
    }

    public function updateOrientacoesPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->orientacoesPG, 
            OrientacaoPosGraduacao::class
        );
    }

    public function updateDisciplinaPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->disciplinasPG, 
            DisciplinaPosGraduacao::class
        );
    }

    public function updateTurmasPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->turmasPG, 
            TurmaPosGraduacao::class
        );
    }

    public function updateMinistrantesPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->ministrantesPG, 
            MinistrantePosGraduacao::class
        );
    }

    public function updateCoordenadoresPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->coordenadoresPG, 
            CoordenadorPosGraduacao::class
        );
    }

    public function updateOcorrenciasPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->ocorrenciasPG, 
            OcorrenciaPosGraduacao::class
        );
    }

    public function updateBolsasPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bolsasPG, 
            BolsaPosGraduacao::class
        );
    }

    public function updateCredenciamentosPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->credenciamentosPG, 
            CredenciamentoPG::class
        );
    }

    public function updateEstagiosPae()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->estagiosPae,
            EstagioPae::class
        );
    }

    public function updatePGConveniadas()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->pgConveniadas,
            PosGraduacaoConveniada::class
        );
    }

    public function updateProficienciaIdiomasPG()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->proficienciaIdiomas,
            ProficienciaIdiomaPG::class
        );
    }
}
