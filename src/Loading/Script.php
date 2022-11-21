<?php

namespace Src\Loading;

use Src\Transformation\Models\AlunoGraduacaoReplicado;
use Src\Loading\Models\AlunoGraduacao;
use Src\Transformation\Models\Transformer;

class Script
{
    public function __construct(){
        $this->alunosGraduacao = new Transformer(new AlunoGraduacaoReplicado, 'alunos_graduacao');
    }

    public function updateAlunosGraduacao()
    {
        $alunosGraduacao = $this->alunosGraduacao->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($alunosGraduacao, 5000) as $chunk) 
        {
            AlunoGraduacao::upsert($chunk, ['numeroUSP']);
        }
    }
}