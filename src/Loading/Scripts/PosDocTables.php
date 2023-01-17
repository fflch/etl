<?php

namespace Src\Loading\Scripts;

use Src\Loading\Operations\PosDoutoradoOperations;

class PosDocTables
{
    public function __construct()
    {
        $this->posDoutoradoOp = new PosDoutoradoOperations(); 
    }

    public function update()
    {
        $this->posDoutoradoOp->updateAlunosPosDoutorado();
        $this->posDoutoradoOp->updatePosDoutorados();
        $this->posDoutoradoOp->updatePeriodosPosDoutorado();
    }
}