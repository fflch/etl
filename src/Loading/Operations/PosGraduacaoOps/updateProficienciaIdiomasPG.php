<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PosGraduacao\ProficienciaIdiomaPGReplicado;
use Src\Loading\Models\PosGraduacao\ProficienciaIdiomaPG;

class updateProficienciaIdiomasPG
{
    private $proficienciaIdiomas;

    public function __construct()
    {
        $this->proficienciaIdiomas = new Transformer(new ProficienciaIdiomaPGReplicado, 'PosGraduacao/proficiencia_idiomas_pg');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->proficienciaIdiomas,
            ProficienciaIdiomaPG::class
        );
    }
}
