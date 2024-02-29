<?php

namespace Src\Loading\Operations\CEUOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\CEU\CursoCulturaExtensaoReplicado;
use Src\Loading\Models\CEU\CursoCulturaExtensao;

class updateCursosCEU
{
    private $cursosCEU;

    public function __construct()
    {
        $this->cursosCEU = new Transformer(new CursoCulturaExtensaoReplicado, 'CEU/cursos_culturaextensao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->cursosCEU, 
            CursoCulturaExtensao::class
        );
    }
}