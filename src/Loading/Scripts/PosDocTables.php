<?php

namespace Src\Loading\Scripts;

use Src\Loading\Operations\PosDocOperations;

class PosDocTables
{
    public function __construct()
    {
        $this->posDocOp = new PosDocOperations(); 
    }

    public function update()
    {
        $this->posDocOp->updateAlunosPosDoc();
        $this->posDocOp->updateProjetosPosDoc();
        $this->posDocOp->updatePeriodosPosDoc();
        $this->posDocOp->updateFontesRecursoPosDoc();
    }
}