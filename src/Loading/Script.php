<?php

namespace Src\Loading;

use Src\Transformation\Models\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Transformation\Models\AlunoGraduacaoReplicado;
use Src\Loading\Models\AlunoGraduacao;
use Src\Transformation\Models\GraduacaoReplicado;
use Src\Loading\Models\Graduacao;
use Src\Transformation\Models\HabilitacaoReplicado;
use Src\Transformation\Models\IniciacaoCientificaReplicado;
use Src\Loading\Models\IniciacaoCientifica;
use Src\Loading\Models\Habilitacao;

class Script
{
    public function __construct(){
        $this->alunosGraduacao = new Transformer(new AlunoGraduacaoReplicado, 'alunos_graduacao');
        $this->graduacoes = new Transformer(new GraduacaoReplicado, 'graduacoes');
        $this->habilitacoes = new Transformer(new HabilitacaoReplicado, 'habilitacoes');
        $this->iniciacoes = new Transformer(new IniciacaoCientificaReplicado, 'iniciacoes_cientificas');
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

    public function updateGraduacoes()
    {
        $graduacoes =  $this->graduacoes->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($graduacoes, 4500) as $chunk) 
        {
            Graduacao::upsert($chunk, ['idGraduacao']);
        }
    }

    public function updateHabilitacoes()
    {
        $habilitacoes =  $this->habilitacoes->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($habilitacoes, 4500) as $chunk) 
        {
            Habilitacao::upsert($chunk, ['idGraduacao', 'codigoCurso', 'codigoHabilitacao', 'dataInicioHabilitacao']);
        }
    }

    public function updateIniciacoes()
    {
        $iniciacoes = $this->iniciacoes->transform();

        Capsule::schema()->disableForeignKeyConstraints(); //gambi

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($iniciacoes, 5000) as $chunk) 
        {
            IniciacaoCientifica::upsert($chunk, ['projetoId']);
        }

        Capsule::schema()->enableForeignKeyConstraints(); //gambi
    }
}