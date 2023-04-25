<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\Servidores\DesignacaoServidorReplicado;
use Src\Loading\Models\Servidores\DesignacaoServidor;
use Src\Transformation\ModelsReplicado\Servidores\VinculoServidorReplicado;
use Src\Loading\Models\Servidores\VinculoServidor;

class ServidoresOps
{
    public function __construct()
    {
        $this->vinculosServidores = new Transformer(new VinculoServidorReplicado, 'Servidores/vinculos_servidores');
        $this->designacoes = new Transformer(new DesignacaoServidorReplicado, 'Servidores/designacoes_servidores');
    }

    public function updateVinculosServidores()
    {
        $vinculosServidores = $this->vinculosServidores->transformData();

        // Insert placeholders limit is 65535.
        // We need x placeholders for each row at the moment. Let's make room for y.
        foreach(array_chunk($vinculosServidores, 3100) as $chunk) 
        {
            VinculoServidor::insert($chunk);
        }
    }

    public function updateDesignacoesServidores()
    {
        $designacoes = $this->designacoes->transformData();

        // Insert placeholders limit is 65535.
        // We need x placeholders for each row at the moment. Let's make room for y.
        foreach(array_chunk($designacoes, 1) as $chunk) 
        {
            DesignacaoServidor::insert($chunk);
        }
    }
}