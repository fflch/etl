<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Transformation\ModelsReplicado\Graduacao\AlunoGraduacaoReplicado;
use Src\Loading\Models\Graduacao\AlunoGraduacao;
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

class GraduacaoOperations
{
    public function __construct(){
        $this->alunosGraduacao = new Transformer(new AlunoGraduacaoReplicado, 'Graduacao/alunos_graduacao');
        $this->graduacoes = new Transformer(new GraduacaoReplicado, 'Graduacao/graduacoes');
        $this->habilitacoes = new Transformer(new HabilitacaoReplicado, 'Graduacao/habilitacoes');
        $this->iniciacoes = new Transformer(new IniciacaoCientificaReplicado, 'Graduacao/iniciacoes_cientificas');
        $this->bolsasIC = new Transformer(new BolsaICReplicado, 'Graduacao/bolsas_ic');
        $this->questionarioRespostas = new Transformer(new QuestionarioRespostaReplicado, 'Graduacao/questionario_respostas');
        $this->questionarioQuestoes = new Transformer(new QuestionarioQuestaoReplicado, 'Graduacao/questionario_questoes');
        $this->SIICUSPTrabalhos = new Transformer(new SIICUSPTrabalhoReplicado, 'Graduacao/SIICUSP_trabalhos');
        $this->SIICUSPParticipantes = new Transformer(new SIICUSPParticipanteReplicado, 'Graduacao/SIICUSP_participantes');
    }

    public function updateAlunosGraduacao()
    {
        $alunosGraduacao = $this->alunosGraduacao->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($alunosGraduacao, 5000) as $chunk) 
        {
            AlunoGraduacao::upsert($chunk, ['numeroUSP']);
        }
    }

    public function updateGraduacoes()
    {
        $graduacoes =  $this->graduacoes->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($graduacoes, 4500) as $chunk) 
        {
            Graduacao::upsert($chunk, ['idGraduacao']);
        }
    }

    public function updateHabilitacoes()
    {
        $habilitacoes =  $this->habilitacoes->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($habilitacoes, 4500) as $chunk) 
        {
            Habilitacao::upsert($chunk, ['idGraduacao', 'codigoCurso', 'codigoHabilitacao', 'dataInicioHabilitacao']);
        }
    }

    public function updateIniciacoes()
    {
        $iniciacoes = $this->iniciacoes->transform();

        Capsule::schema()->disableForeignKeyConstraints(); //gambi

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($iniciacoes, 5000) as $chunk) 
        {
            IniciacaoCientifica::upsert($chunk, ['projetoId']);
        }

        Capsule::schema()->enableForeignKeyConstraints(); //gambi
    }

    public function updateBolsasIC()
    {
        $bolsasIC = $this->bolsasIC->transform($orderBy = ['anoProjeto', 'codigoProjeto']);

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($bolsasIC, 5000) as $chunk) 
        {
            BolsaIC::upsert($chunk, ['idProjeto', 'sequenciaBolsa']);
        }

        Capsule::update("UPDATE bolsas_ic bi
                        RIGHT JOIN iniciacoes i ON bi.idProjeto = i.idProjeto
                        SET bi.dataFimBolsa = i.dataFimProjeto
                        WHERE i.statusProjeto = 'Cancelado'");
    }

    public function updateQuestionarios()
    {
        $questionarioRespostas = $this->questionarioRespostas->transform();
        $questionarioQuestoes = $this->questionarioQuestoes->transform();

        QuestionarioQuestao::upsert($questionarioQuestoes, ['idQuestao', 'codigoAlternativa']);
    
        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($questionarioRespostas, 5000) as $chunk) 
        {
            QuestionarioResposta::upsert($chunk, ['idGraduacao', 'idQuestao']);
        }
    }

    public function updateSIICUSP()
    {
        $SIICUSPTrabalhos = $this->SIICUSPTrabalhos->transform();
        $SIICUSPParticipantes = $this->SIICUSPParticipantes->transform();
    
        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($SIICUSPTrabalhos, 5000) as $chunk) 
        {
            SIICUSPTrabalho::upsert($chunk, 'idTrabalho');
        }

        foreach(array_chunk($SIICUSPParticipantes, 5000) as $chunk) 
        {
            SIICUSPParticipante::upsert($chunk, 'idTrabalho');
        }
    }
}