<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\PosDoc\ProjetoPosDocReplicado;
use Src\Loading\Models\PosDoc\ProjetoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\PeriodoPosDocReplicado;
use Src\Loading\Models\PosDoc\PeriodoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\BolsaPosDocReplicado;
use Src\Loading\Models\PosDoc\BolsaPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\AfastEmpresaPosDocReplicado;
use Src\Loading\Models\PosDoc\AfastEmpresaPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\SupervisaoPosDocReplicado;
use Src\Loading\Models\PosDoc\SupervisaoPosDoc;

class PosDocOperations
{
    public function __construct()
    {
        $this->projetosPosDoc = new Transformer(new ProjetoPosDocReplicado, 'PosDoc/projetos_posdoc');
        $this->periodosPosDoc = new Transformer(new PeriodoPosDocReplicado, 'PosDoc/periodos_posdoc');
        $this->bolsasPosDoc = new Transformer(new BolsaPosDocReplicado, 'PosDoc/bolsas_posdoc');
        $this->afastEmpresasPosDoc = new Transformer(new AfastEmpresaPosDocReplicado, 'PosDoc/afastempresas_posdoc');
        $this->supervisoesPosDoc = new Transformer(new SupervisaoPosDocReplicado, 'PosDoc/supervisoes_posdoc');
    }

    public function updateProjetosPosDoc()
    {
        $projetosPD = $this->projetosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($projetosPD, 3000) as $chunk) 
        {
            ProjetoPosDoc::insert($chunk);
        }
    }

    public function updatePeriodosPosDoc()
    {
        $periodosPD = $this->periodosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($periodosPD, 3000) as $chunk) 
        {
            //gambi para períodos idênticos
            PeriodoPosDoc::upsert($chunk, ["id_projeto", "sequencia_periodo"]);
        }
    }

    public function updateFontesRecursoPosDoc()
    {
        $bolsasPD = $this->bolsasPosDoc->transform();
        $afastEmpresa = $this->afastEmpresasPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($bolsasPD, 3000) as $chunk) 
        {
            BolsaPosDoc::insert($chunk);
        }

        foreach(array_chunk($afastEmpresa, 3000) as $chunk) 
        {
            AfastEmpresaPosDoc::insert($chunk);
        }
    }

    public function updateSupervisoesPosDoc()
    {
        $supervisoesPD = $this->supervisoesPosDoc->transform($orderBy = ['ano_projeto', 'codigo_projeto']);

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($supervisoesPD, 3000) as $chunk) 
        {
            SupervisaoPosDoc::insert($chunk);
        }
    }
}