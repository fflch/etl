<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PosGraduacao\DisciplinaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\DisciplinaPosGraduacao;

class updateDisciplinasPG
{
    private $disciplinasPG;

    public function __construct()
    {
        $this->disciplinasPG = new Transformer(new DisciplinaPosGraduacaoReplicado, 'PosGraduacao/disciplinas_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->disciplinasPG,
            DisciplinaPosGraduacao::class
        );
    }
}
