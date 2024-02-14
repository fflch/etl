<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\QuestSocioEcon\QuestionarioRespostaReplicado;
use Src\Loading\Models\QuestSocioEcon\QuestionarioResposta;
use Src\Transformation\ModelsReplicado\QuestSocioEcon\QuestionarioQuestaoReplicado;
use Src\Loading\Models\QuestSocioEcon\QuestionarioQuestao;

class QuestSocioEconOps
{
    private $questionarioRespostas, $questionarioQuestoes;

    public function __construct()
    {
        $this->questionarioRespostas = new Transformer(new QuestionarioRespostaReplicado, 'QuestSocioEcon/questionario_respostas');
        $this->questionarioQuestoes = new Transformer(new QuestionarioQuestaoReplicado, 'QuestSocioEcon/questionario_questoes');
    }

    public function updateQuestionarios()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->questionarioQuestoes, 
            QuestionarioQuestao::class
        );

        LoadingUtils::insertIntoTable(
            'paginated',
            $this->questionarioRespostas, 
            QuestionarioResposta::class
        );
    }
}