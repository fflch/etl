<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Transformation\ModelsReplicado\Pessoas\PessoaReplicado;
use Src\Loading\Models\Pessoas\Pessoa;
use Src\Utils\ExtractionUtils;

class PessoasOps
{
    public function __construct()
    {
        $this->pessoas = new Transformer(new PessoaReplicado, 'Pessoas/pessoas');
    }

    public function updatePessoas()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->pessoas, 
            Pessoa::class, 
            5000
        );
    }
}