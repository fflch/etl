<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\Servidores\DesignacaoServidorReplicado;
use Src\Loading\Models\Servidores\DesignacaoServidor;
use Src\Transformation\ModelsReplicado\Servidores\VinculoServidorReplicado;
use Src\Loading\Models\Servidores\VinculoServidor;
use Src\Transformation\ModelsReplicado\Servidores\ProfessorVisitanteReplicado;
use Src\Loading\Models\Servidores\ProfessorVisitante;

class ServidoresOps
{
    private $vinculosServidores, $designacoes,
            $professoresVisitantes;

    public function __construct()
    {
        $this->vinculosServidores = new Transformer(new VinculoServidorReplicado, 'Servidores/vinculos_servidores');
        $this->designacoes = new Transformer(new DesignacaoServidorReplicado, 'Servidores/designacoes_servidores');
        $this->professoresVisitantes = new Transformer(new ProfessorVisitanteReplicado, 'Servidores/professores_visitantes');
    }

    public function updateVinculosServidores()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->vinculosServidores, 
            VinculoServidor::class
        );
    }

    public function updateDesignacoesServidores()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->designacoes, 
            DesignacaoServidor::class
        );
    }

    public function updateProfessoresVisitantes()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->professoresVisitantes, 
            ProfessorVisitante::class
        );
    }
}