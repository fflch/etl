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
}