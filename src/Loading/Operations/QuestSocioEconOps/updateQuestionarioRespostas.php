<?php

namespace Src\Loading\Operations\QuestSocioEconOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\QuestSocioEcon\QuestionarioRespostaReplicado;
use Src\Loading\Models\QuestSocioEcon\QuestionarioResposta;

class updateQuestionarioRespostas
{
    private $questionarioRespostas;

    public function __construct()
    {
        $this->questionarioRespostas = new Transformer(new QuestionarioRespostaReplicado, 'QuestSocioEcon/questionario_respostas');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'paginated',
            $this->questionarioRespostas, 
            QuestionarioResposta::class
        );
    }
}