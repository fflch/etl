<?php

namespace Src\Loading\Operations\PessoasOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\Pessoas\PessoaReplicado;
use Src\Loading\Models\Pessoas\Pessoa;

class updatePessoas
{
    private $pessoas;

    public function __construct()
    {
        $this->pessoas = new Transformer(new PessoaReplicado, 'Pessoas/pessoas');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->pessoas, 
            Pessoa::class
        );
    }
}