<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\PosDoutorado\AlunoPosDoutoradoReplicado;
use Src\Loading\Models\PosDoutorado\AlunoPosDoutorado;
use Src\Transformation\ModelsReplicado\PosDoutorado\PosDoutoradoReplicado;
use Src\Loading\Models\PosDoutorado\PosDoutorado;

class PosDoutoradoOperations
{
    public function __construct()
    {
        $this->alunosPosDoutorado = new Transformer(new AlunoPosDoutoradoReplicado, 'PosDoutorado/alunos_posdoutorado');
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
}