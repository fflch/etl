<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\Servidores\VinculoServidorReplicado;
use Src\Loading\Models\Servidores\VinculoServidor;

class ServidoresOps
{
    public function __construct()
    {
        $this->vinculosServidores = new Transformer(new VinculoServidorReplicado, 'Servidores/vinculos_servidores');
    }

    public function updateVinculosServidores()
    {
        $vinculosServidores = $this->vinculosServidores->transformData();

        // Insert placeholders limit is 65535.
        // We need 19 placeholders for each row at the moment. Let's make room for 21.
        foreach(array_chunk($vinculosServidores, 3100) as $chunk) 
        {
            VinculoServidor::insert($chunk);
        }
    }
}