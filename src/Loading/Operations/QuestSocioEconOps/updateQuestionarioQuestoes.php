<?php

namespace Src\Loading\Operations\QuestSocioEconOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\QuestSocioEcon\QuestionarioQuestaoReplicado;
use Src\Loading\Models\QuestSocioEcon\QuestionarioQuestao;

class updateQuestionarioQuestoes
{
    private $questionarioQuestoes;

    public function __construct()
    {
        $this->questionarioQuestoes = new Transformer(new QuestionarioQuestaoReplicado, 'QuestSocioEcon/questionario_questoes');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->questionarioQuestoes,
            QuestionarioQuestao::class
        );
    }
}
