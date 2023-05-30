<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\ExtractionUtils;
use Src\Transformation\ModelsReplicado\Graduacao\GraduacaoReplicado;
use Src\Loading\Models\Graduacao\Graduacao;
use Src\Transformation\ModelsReplicado\Graduacao\HabilitacaoReplicado;
use Src\Loading\Models\Graduacao\Habilitacao;
use Src\Transformation\ModelsReplicado\Graduacao\IniciacaoCientificaReplicado;
use Src\Loading\Models\Graduacao\IniciacaoCientifica;
use Src\Transformation\ModelsReplicado\Graduacao\BolsaICReplicado;
use Src\Loading\Models\Graduacao\BolsaIC;
use Src\Transformation\ModelsReplicado\Graduacao\QuestionarioRespostaReplicado;
use Src\Loading\Models\Graduacao\QuestionarioResposta;
use Src\Transformation\ModelsReplicado\Graduacao\QuestionarioQuestaoReplicado;
use Src\Loading\Models\Graduacao\QuestionarioQuestao;
use Src\Transformation\ModelsReplicado\Graduacao\SIICUSPTrabalhoReplicado;
use Src\Loading\Models\Graduacao\SIICUSPTrabalho;
use Src\Transformation\ModelsReplicado\Graduacao\SIICUSPParticipanteReplicado;
use Src\Loading\Models\Graduacao\SIICUSPParticipante;
use Src\Transformation\ModelsReplicado\Graduacao\DisciplinaGraduacaoReplicado;
use Src\Loading\Models\Graduacao\DisciplinaGraduacao;
use Src\Transformation\ModelsReplicado\Graduacao\TurmaGraduacaoReplicado;
use Src\Loading\Models\Graduacao\TurmaGraduacao;
use Src\Transformation\ModelsReplicado\Graduacao\DemandaTurmaGraduacaoReplicado;
use Src\Loading\Models\Graduacao\DemandaTurmaGraduacao;
use Src\Transformation\ModelsReplicado\Graduacao\MinistranteGraduacaoReplicado;
use Src\Loading\Models\Graduacao\MinistranteGraduacao;

class GraduacaoOps
{
    public function __construct()
    {
        $this->graduacoes = new Transformer(new GraduacaoReplicado, 'Graduacao/graduacoes');
        $this->habilitacoes = new Transformer(new HabilitacaoReplicado, 'Graduacao/habilitacoes');
        $this->iniciacoes = new Transformer(new IniciacaoCientificaReplicado, 'Graduacao/iniciacoes_cientificas');
        $this->bolsasIC = new Transformer(new BolsaICReplicado, 'Graduacao/bolsas_ic');
        $this->questionarioRespostas = new Transformer(new QuestionarioRespostaReplicado, 'Graduacao/questionario_respostas');
        $this->questionarioQuestoes = new Transformer(new QuestionarioQuestaoReplicado, 'Graduacao/questionario_questoes');
        $this->SIICUSPTrabalhos = new Transformer(new SIICUSPTrabalhoReplicado, 'Graduacao/SIICUSP_trabalhos');
        $this->SIICUSPParticipantes = new Transformer(new SIICUSPParticipanteReplicado, 'Graduacao/SIICUSP_participantes');
        $this->disciplinasGraduacao = new Transformer(new DisciplinaGraduacaoReplicado, 'Graduacao/disciplinas_graduacao');
        $this->turmasGraduacao = new Transformer(new TurmaGraduacaoReplicado, 'Graduacao/turmas_graduacao');
        $this->demandaTurmasGraduacao = new Transformer(new DemandaTurmaGraduacaoReplicado, 'Graduacao/demanda_turmas_graduacao');
        $this->ministrantesGraduacao = new Transformer(new MinistranteGraduacaoReplicado, 'Graduacao/ministrantes_graduacao');
    }

    public function updateGraduacoes()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->graduacoes, 
            Graduacao::class, 
            4300
        );
    }

    public function updateHabilitacoes()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->habilitacoes, 
            Habilitacao::class, 
            5900
        );
    }

    public function updateIniciacoes()
    {
        Capsule::schema()->disableForeignKeyConstraints(); //gambi

        ExtractionUtils::updateTable(
            'full',
            $this->iniciacoes, 
            IniciacaoCientifica::class, 
            5000
        );

        Capsule::schema()->enableForeignKeyConstraints(); //gambi

        Capsule::update("UPDATE iniciacoes i
                        SET data_fim_projeto = NULL, data_inicio_projeto = NULL
                        WHERE i.situacao_projeto = 'Denegado'");
    }

    public function updateBolsasIC()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->bolsasIC, 
            BolsaIC::class, 
            8100
        );

        Capsule::delete("DELETE bi
                        FROM iniciacoes i
                            INNER JOIN bolsas_ic bi ON i.id_projeto = bi.id_projeto
                        WHERE i.situacao_projeto = 'Denegado'");

        Capsule::update("UPDATE bolsas_ic bi
                            INNER JOIN iniciacoes i ON bi.id_projeto = i.id_projeto
                        SET bi.data_fim_fomento = i.data_fim_projeto
                        WHERE i.situacao_projeto = 'Cancelado'");
    }

    public function updateQuestionarios()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->questionarioQuestoes, 
            QuestionarioQuestao::class, 
            10000
        );

        ExtractionUtils::updateTable(
            'paginated',
            $this->questionarioRespostas, 
            QuestionarioResposta::class, 
            15000
        );
    }

    public function updateSIICUSP()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->SIICUSPTrabalhos, 
            SIICUSPTrabalho::class, 
            5900
        );

        ExtractionUtils::updateTable(
            'full',
            $this->SIICUSPParticipantes, 
            SIICUSPParticipante::class, 
            5000
        );
    }

    public function updateDisciplinasGraduacao()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->disciplinasGraduacao, 
            DisciplinaGraduacao::class, 
            4000
        );
    }

    public function updateTurmasGraduacao()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->turmasGraduacao, 
            TurmaGraduacao::class, 
            2500
        );
    }

    public function updateDemandaTurmasGraduacao()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->demandaTurmasGraduacao, 
            DemandaTurmaGraduacao::class, 
            3000
        );
    }

    public function updateMinistrantesGraduacao()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->ministrantesGraduacao, 
            MinistranteGraduacao::class, 
            8000
        );
    }
}