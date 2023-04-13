<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\Pessoas\PessoaReplicado;
use Src\Loading\Models\Pessoas\Pessoa;

class PessoasOps
{
    public function __construct()
    {
        $this->pessoas = new Transformer(new PessoaReplicado, 'Pessoas/pessoas');
    }

    public function updatePessoas()
    {
        $pagination = ['limit' => 5000, 'offset' => 0];

        do {
            $data = $this->pessoas->transformData($pagination);
            Pessoa::insert($data);

            $pagination['offset'] += $pagination['limit'];
        } while (!empty($data));
    }
}