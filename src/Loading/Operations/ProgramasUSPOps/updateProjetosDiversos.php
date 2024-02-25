<?php

namespace Src\Loading\Operations\ProgramasUSPOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\ProgramasUSP\ProjetoDiversoReplicado;
use Src\Loading\Models\ProgramasUSP\ProjetoDiverso;

class updateProjetosDiversos
{
    private $projetos;

    public function __construct()
    {
        $this->projetos = new Transformer(new ProjetoDiversoReplicado, 'ProgramasUSP/projetos_diversos');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->projetos, 
            ProjetoDiverso::class
        );
    }
}