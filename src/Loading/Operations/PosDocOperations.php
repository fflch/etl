<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\PosDoc\AlunoPosDocReplicado;
use Src\Loading\Models\PosDoc\AlunoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\ProjetoPosDocReplicado;
use Src\Loading\Models\PosDoc\ProjetoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\PeriodoPosDocReplicado;
use Src\Loading\Models\PosDoc\PeriodoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\BolsaPosDocReplicado;
use Src\Loading\Models\PosDoc\BolsaPosDoc;

class PosDocOperations
{
    public function __construct()
    {
        $this->alunosPosDoc = new Transformer(new AlunoPosDocReplicado, 'PosDoc/alunos_posdoc');
        $this->projetosPosDoc = new Transformer(new ProjetoPosDocReplicado, 'PosDoc/projetos_posdoc');
        $this->periodosPosDoc = new Transformer(new PeriodoPosDocReplicado, 'PosDoc/periodos_posdoc');
        $this->bolsasPosDoc = new Transformer(new BolsaPosDocReplicado, 'PosDoc/bolsas_posdoc');
    }

    public function updateAlunosPosDoc()
    {
        $alunosPD = $this->alunosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($alunosPD, 3000) as $chunk) 
        {
            AlunoPosDoc::upsert($chunk, ["numeroUSP"]);
        }
    }

    public function updateProjetosPosDoc()
    {
        $projetosPD = $this->projetosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($projetosPD, 3000) as $chunk) 
        {
            ProjetoPosDoc::upsert($chunk, ["idProjeto"]);
        }
    }

    public function updatePeriodosPosDoc()
    {
        $periodosPD = $this->periodosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($periodosPD, 3000) as $chunk) 
        {
            PeriodoPosDoc::upsert($chunk, ["idProjeto", "sequenciaPeriodo"]);
        }
    }

    public function updateFontesRecursoPosDoc()
    {
        $bolsasPD = $this->bolsasPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($bolsasPD, 3000) as $chunk) 
        {
            BolsaPosDoc::upsert($chunk, ["idProjeto", "sequenciaPeriodo", "sequenciaFomento"]);
        }
    }
}