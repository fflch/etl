<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\Pessoas\PessoaReplicado;
use Src\Loading\Models\Pessoas\Pessoa;

class PessoasOperations
{
    public function __construct()
    {
        $this->pessoas = new Transformer(new PessoaReplicado, 'Pessoas/pessoas');
    }

    public function updatePessoas()
    {
        $pessoas = $this->pessoas->transformData();

        // Insert placeholders limit is 65535.
        // We need 11 placeholders for each row at the moment. Let's make room for 13.
        foreach(array_chunk($pessoas, 5000) as $chunk) 
        {
            Pessoa::insert($chunk);
        }
    }
}