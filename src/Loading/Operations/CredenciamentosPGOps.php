<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\CredenciamentosPG\CredenciamentoPGReplicado;
use Src\Loading\Models\CredenciamentosPG\CredenciamentoPG;

class CredenciamentosPGOps
{
    public function __construct()
    {
        $this->credenciamentos = new Transformer(new CredenciamentoPGReplicado, 'CredenciamentosPG/credenciamentos_pg');
    }

    public function updateCredenciamentosPG()
    {
        $credenciamentos = $this->credenciamentos->transformData();

        // Insert placeholders limit is 65535.
        // We need 7 placeholders for each row at the moment. Let's make room for 9.
        foreach(array_chunk($credenciamentos, 7200) as $chunk) 
        {
            CredenciamentoPG::insert($chunk);
        }
    }
}