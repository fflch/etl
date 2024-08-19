<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Graduacao\DisciplinaGraduacaoReplicado;
use Src\Loading\Models\Graduacao\DisciplinaGraduacao;

class updateDisciplinasGraduacao
{
    private $disciplinasGraduacao;

    public function __construct()
    {
        $this->disciplinasGraduacao = new Transformer(new DisciplinaGraduacaoReplicado, 'Graduacao/disciplinas_graduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->disciplinasGraduacao,
            DisciplinaGraduacao::class
        );
    }
}
