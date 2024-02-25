<?php

namespace Src\Loading\Operations\ProgramasUSPOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\ProgramasUSP\InscricaoProjetoDiversoReplicado;
use Src\Loading\Models\ProgramasUSP\InscricaoProjetoDiverso;

class updateInscricoesProjetosDiversos
{
    private $inscricoes;

    public function __construct()
    {
        $this->inscricoes = new Transformer(new InscricaoProjetoDiversoReplicado, 'ProgramasUSP/inscricoes_projetos_diversos');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->inscricoes, 
            InscricaoProjetoDiverso::class
        );
    }
}