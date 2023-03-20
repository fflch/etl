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
        $pessoas = $this->pessoas->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($pessoas, 3000) as $chunk) 
        {
            Pessoa::insert($chunk);
        }
    }
}