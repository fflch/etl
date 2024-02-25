<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PosGraduacao\TurmaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\TurmaPosGraduacao;

class updateTurmasPG
{
    private $turmasPG;

    public function __construct()
    {
        $this->turmasPG = new Transformer(new TurmaPosGraduacaoReplicado, 'PosGraduacao/turmas_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->turmasPG, 
            TurmaPosGraduacao::class
        );
    }
}