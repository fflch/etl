<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\PosDoutorado\AlunoPosDoutoradoReplicado;
use Src\Loading\Models\PosDoutorado\AlunoPosDoutorado;
use Src\Transformation\ModelsReplicado\PosDoutorado\PosDoutoradoReplicado;
use Src\Loading\Models\PosDoutorado\PosDoutorado;
use Src\Transformation\ModelsReplicado\PosDoutorado\PeriodoPosDoutoradoReplicado;
use Src\Loading\Models\PosDoutorado\PeriodoPosDoutorado;

class PosDoutoradoOperations
{
    public function __construct()
    {
        $this->alunosPosDoutorado = new Transformer(new AlunoPosDoutoradoReplicado, 'PosDoutorado/alunos_posdoutorado');
        $this->posDoutorados = new Transformer(new PosDoutoradoReplicado, 'PosDoutorado/posdoutorados');
        $this->periodosPosDoutorado = new Transformer(new PeriodoPosDoutoradoReplicado, 'PosDoutorado/periodos_posdoutorado');
    }

    public function updateAlunosPosDoutorado()
    {
        $alunosPosDoutorado = $this->alunosPosDoutorado->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($alunosPosDoutorado, 3000) as $chunk) 
        {
            AlunoPosDoutorado::upsert($chunk, ["numeroUSP"]);
        }
    }

    public function updatePosDoutorados()
    {
        $posDoutorados = $this->posDoutorados->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($posDoutorados, 3000) as $chunk) 
        {
            PosDoutorado::upsert($chunk, ["idProjeto"]);
        }
    }

    public function updatePeriodosPosDoutorado()
    {
        $periodosPosDoutorado = $this->periodosPosDoutorado->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($periodosPosDoutorado, 3000) as $chunk) 
        {
            PeriodoPosDoutorado::upsert($chunk, ["idProjeto", "sequenciaPeriodo"]);
        }
    }
}