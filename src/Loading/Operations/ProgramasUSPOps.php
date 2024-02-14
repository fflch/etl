<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Illuminate\Database\Capsule\Manager as Capsule;
// use Src\Transformation\ModelsReplicado\ProgramasUSP\BeneficioConcedidoReplicado;
// use Src\Loading\Models\ProgramasUSP\BeneficioConcedido;
use Src\Transformation\ModelsReplicado\ProgramasUSP\AuxilioConcedidoReplicado;
use Src\Loading\Models\ProgramasUSP\AuxilioConcedido;
use Src\Transformation\ModelsReplicado\ProgramasUSP\BolsaDiversaReplicado;
use Src\Loading\Models\ProgramasUSP\BolsaDiversa;
use Src\Transformation\ModelsReplicado\ProgramasUSP\InscricaoProjetoDiversoReplicado;
use Src\Loading\Models\ProgramasUSP\InscricaoProjetoDiverso;
use Src\Transformation\ModelsReplicado\ProgramasUSP\ProjetoDiversoReplicado;
use Src\Loading\Models\ProgramasUSP\ProjetoDiverso;

class ProgramasUSPOps
{
    private $auxilios, $bolsas,
            $inscricoes, $projetos;

    public function __construct()
    {
        $this->auxilios = new Transformer(new AuxilioConcedidoReplicado, 'ProgramasUSP/auxilios_concedidos');
        $this->bolsas = new Transformer(new BolsaDiversaReplicado, 'ProgramasUSP/bolsas_diversas');
        $this->inscricoes = new Transformer(new InscricaoProjetoDiversoReplicado, 'ProgramasUSP/inscricoes_projetos_diversos');
        $this->projetos = new Transformer(new ProjetoDiversoReplicado, 'ProgramasUSP/projetos_diversos');
    }

    public function updateAuxiliosConcedidos()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->auxilios, 
            AuxilioConcedido::class
        );
    }

    public function updateBolsasDiversas()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bolsas, 
            BolsaDiversa::class
        );
    }

    public function updateInscricoesProjetosDiversos()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->inscricoes, 
            InscricaoProjetoDiverso::class
        );
    }

    public function updateProjetosDiversos()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->projetos, 
            ProjetoDiverso::class
        );
    }
}