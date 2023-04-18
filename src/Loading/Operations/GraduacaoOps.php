<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
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
use Src\Transformation\ModelsReplicado\Graduacao\InfoTurmaGraduacaoReplicado;
use Src\Loading\Models\Graduacao\InfoTurmaGraduacao;
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
        $this->infoTurmasGraduacao = new Transformer(new InfoTurmaGraduacaoReplicado, 'Graduacao/info_turmas_graduacao');
        $this->ministrantesGraduacao = new Transformer(new MinistranteGraduacaoReplicado, 'Graduacao/ministrantes_graduacao');
    }

    public function updateGraduacoes()
    {
        $graduacoes =  $this->graduacoes->transformData();

        // Insert placeholders limit is 65535.
        // We need 13 placeholders for each row at the moment. Let's make room for 15.
        foreach(array_chunk($graduacoes, 4300) as $chunk) 
        {
            Graduacao::insert($chunk);
        }
    }

    public function updateHabilitacoes()
    {
        $habilitacoes =  $this->habilitacoes->transformData();

        // Insert placeholders limit is 65535.
        // We need 9 placeholders for each row at the moment. Let's make room for 11.
        foreach(array_chunk($habilitacoes, 5900) as $chunk) 
        {
            Habilitacao::insert($chunk);
        }
    }

    public function updateIniciacoes()
    {
        $iniciacoes = $this->iniciacoes->transformData();

        Capsule::schema()->disableForeignKeyConstraints(); //gambi

        // Insert placeholders limit is 65535.
        // We need 11 placeholders for each row at the moment. Let's make room for 13.
        foreach(array_chunk($iniciacoes, 5000) as $chunk) 
        {
            IniciacaoCientifica::insert($chunk);
        }

        Capsule::schema()->enableForeignKeyConstraints(); //gambi

        Capsule::update("UPDATE iniciacoes i
                        SET data_fim_projeto = NULL, data_inicio_projeto = NULL
                        WHERE i.situacao_projeto = 'Denegado'");
    }

    public function updateBolsasIC()
    {
        $bolsasIC = $this->bolsasIC->transformData();

        // Insert placeholders limit is 65535.
        // We need 6 placeholders for each row at the moment. Let's make room for 8.
        foreach(array_chunk($bolsasIC, 8100) as $chunk) 
        {
            BolsaIC::insert($chunk);
        }

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
        $questionarioRespostas = $this->questionarioRespostas->transformData();
        $questionarioQuestoes = $this->questionarioQuestoes->transformData();

        QuestionarioQuestao::insert($questionarioQuestoes);
    
        // Insert placeholders limit is 65535.
        // We need 3 placeholders for each row at the moment. Let's make room for 4.
        foreach(array_chunk($questionarioRespostas, 16000) as $chunk) 
        {
            QuestionarioResposta::insert($chunk);
        }
    }

    public function updateSIICUSP()
    {
        $SIICUSPTrabalhos = $this->SIICUSPTrabalhos->transformData();
        $SIICUSPParticipantes = $this->SIICUSPParticipantes->transformData();
    
        // Insert placeholders limit is 65535.
        // We need 9 placeholders for each row at the moment. Let's make room for 11.
        foreach(array_chunk($SIICUSPTrabalhos, 5900) as $chunk) 
        {
            SIICUSPTrabalho::insert($chunk);
        }

        // Insert placeholders limit is 65535.
        // We need 11 placeholders for each row at the moment. Let's make room for 13.
        foreach(array_chunk($SIICUSPParticipantes, 5000) as $chunk) 
        {
            SIICUSPParticipante::insert($chunk);
        }
    }

    public function updateDisciplinasGraduacao()
    {
        $disciplinas =  $this->disciplinasGraduacao->transformData();

        // Insert placeholders limit is 65535.
        // We need 14 placeholders for each row at the moment. Let's make room for 16.
        foreach(array_chunk($disciplinas, 4000) as $chunk) 
        {
            DisciplinaGraduacao::insert($chunk);
        }
    }

    public function updateTurmasGraduacao()
    {
        $turmas =  $this->turmasGraduacao->transformData();

        // Insert placeholders limit is 65535.
        // We need 21 placeholders for each row at the moment. Let's make room for 23.
        foreach(array_chunk($turmas, 2800) as $chunk) 
        {
            TurmaGraduacao::insert($chunk);
        }
    }

    public function updateInfoTurmasGraduacao()
    {
        $infoTurmas =  $this->infoTurmasGraduacao->transformData();

        // Insert placeholders limit is 65535.
        // We need 19 placeholders for each row at the moment. Let's make room for 21.
        foreach(array_chunk($infoTurmas, 3100) as $chunk) 
        {
            InfoTurmaGraduacao::insert($chunk);
        }
    }

    public function updateMinistrantesGraduacao()
    {
        $ministrantes =  $this->ministrantesGraduacao->transformData();

        // Insert placeholders limit is 65535.
        // We need 5 placeholders for each row at the moment. Let's make room for 7.
        foreach(array_chunk($ministrantes, 9300) as $chunk) 
        {
            MinistranteGraduacao::insert($chunk);
        }
    }
}