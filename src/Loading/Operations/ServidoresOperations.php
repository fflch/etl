<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\Servidores\VinculoServidorReplicado;
use Src\Loading\Models\Servidores\VinculoServidor;

class ServidoresOperations
{
    public function __construct()
    {
        $this->vinculosServidores = new Transformer(new VinculoServidorReplicado, 'Servidores/vinculos_servidores');
    }

    public function updateVinculosServidores()
    {
        $vinculosServidores = $this->vinculosServidores->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($vinculosServidores, 3000) as $chunk) 
        {
            VinculoServidor::insert($chunk);
        }
    }
}