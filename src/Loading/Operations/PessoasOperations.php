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
        $rowsLimit = 5000;
        $offset = 0;

        do {
            $data = $this->pessoas->transformData($rowsLimit, $offset);
            Pessoa::insert($data);

            $offset += $rowsLimit;
        } while (!empty($data));
    }
}