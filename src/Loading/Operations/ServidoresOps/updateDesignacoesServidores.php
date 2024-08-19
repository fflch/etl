<?php

namespace Src\Loading\Operations\ServidoresOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Servidores\DesignacaoServidorReplicado;
use Src\Loading\Models\Servidores\DesignacaoServidor;

class updateDesignacoesServidores
{
    private $designacoes;

    public function __construct()
    {
        $this->designacoes = new Transformer(new DesignacaoServidorReplicado, 'Servidores/designacoes_servidores');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->designacoes,
            DesignacaoServidor::class
        );
    }
}
