<?php

namespace Src\Loading\Operations\CEUOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\CEU\MatriculaCCExReplicado;
use Src\Loading\Models\CEU\MatriculaCCEx;

class updateMatriculasCCEx
{
    private $matriculasCCEx;

    public function __construct()
    {
        $this->matriculasCCEx = new Transformer(new MatriculaCCExReplicado, 'CEU/matriculas_ccex');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'paginated',
            $this->matriculasCCEx,
            MatriculaCCEx::class
        );
    }
}
