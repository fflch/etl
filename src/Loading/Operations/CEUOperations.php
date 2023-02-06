<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\CEU\OferecimentoCCExReplicado;
use Src\Loading\Models\CEU\OferecimentoCCEx;

class CEUOperations
{
    public function __construct()
    {
        $this->oferecimentosCursos = new Transformer(new OferecimentoCCExReplicado, 'CEU/oferecimentos_ccex');
    }

    public function updateCursosOferecidos()
    {
        $oferecimentosCursos = $this->oferecimentosCursos->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($oferecimentosCursos, 3000) as $chunk) 
        {
            OferecimentoCCEx::upsert($chunk, ["codigoOferecimento"]);
        }
    }
}