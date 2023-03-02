<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\Servidores\ServidorReplicado;
use Src\Loading\Models\Servidores\Servidor;
use Src\Transformation\ModelsReplicado\Servidores\VinculoServidorReplicado;
use Src\Loading\Models\Servidores\VinculoServidor;

class ServidoresOperations
{
    public function __construct()
    {
        $this->vinculosServidores = new Transformer(new VinculoServidorReplicado, 'Servidores/vinculos_servidores');
        $this->servidores = new Transformer(new ServidorReplicado, 'Servidores/servidores');
    }

    public function updateServidores()
    {
        $servidores = $this->servidores->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($servidores, 3000) as $chunk) 
        {
            Servidor::insert($chunk);
        }
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