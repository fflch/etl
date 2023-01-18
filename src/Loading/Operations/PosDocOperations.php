<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\PosDoc\AlunoPosDocReplicado;
use Src\Loading\Models\PosDoc\AlunoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\ProjetoPosDocReplicado;
use Src\Loading\Models\PosDoc\ProjetoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\PeriodoPosDocReplicado;
use Src\Loading\Models\PosDoc\PeriodoPosDoc;

class PosDocOperations
{
    public function __construct()
    {
        $this->alunosPosDoc = new Transformer(new AlunoPosDocReplicado, 'PosDoc/alunos_posdoc');
        $this->projetosPosDoc = new Transformer(new ProjetoPosDocReplicado, 'PosDoc/projetos_posdoc');
        $this->periodosPosDoc = new Transformer(new PeriodoPosDocReplicado, 'PosDoc/periodos_posdoc');
    }

    public function updateAlunosPosDoc()
    {
        $alunos = $this->alunosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($alunos, 3000) as $chunk) 
        {
            AlunoPosDoc::upsert($chunk, ["numeroUSP"]);
        }
    }

    public function updateProjetosPosDoc()
    {
        $projetos = $this->projetosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($projetos, 3000) as $chunk) 
        {
            ProjetoPosDoc::upsert($chunk, ["idProjeto"]);
        }
    }

    public function updatePeriodosPosDoc()
    {
        $periodos = $this->periodosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($periodos, 3000) as $chunk) 
        {
            PeriodoPosDoc::upsert($chunk, ["idProjeto", "sequenciaPeriodo"]);
        }
    }
}