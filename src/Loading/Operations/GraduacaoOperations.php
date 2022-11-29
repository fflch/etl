<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Transformation\ModelsReplicado\Graduacao\AlunoGraduacaoReplicado;
use Src\Loading\Models\Graduacao\AlunoGraduacao;
use Src\Transformation\ModelsReplicado\Graduacao\GraduacaoReplicado;
use Src\Loading\Models\Graduacao\Graduacao;
use Src\Transformation\ModelsReplicado\Graduacao\HabilitacaoReplicado;
use Src\Loading\Models\Graduacao\Habilitacao;
use Src\Transformation\ModelsReplicado\Graduacao\IniciacaoCientificaReplicado;
use Src\Loading\Models\Graduacao\IniciacaoCientifica;
use Src\Transformation\ModelsReplicado\Graduacao\BolsaICReplicado;
use Src\Loading\Models\Graduacao\BolsaIC;

class GraduacaoOperations
{
    public function __construct(){
        $this->alunosGraduacao = new Transformer(new AlunoGraduacaoReplicado, 'Graduacao/alunos_graduacao');
        $this->graduacoes = new Transformer(new GraduacaoReplicado, 'Graduacao/graduacoes');
        $this->habilitacoes = new Transformer(new HabilitacaoReplicado, 'Graduacao/habilitacoes');
        $this->iniciacoes = new Transformer(new IniciacaoCientificaReplicado, 'Graduacao/iniciacoes_cientificas');
        $this->bolsasIC = new Transformer(new BolsaICReplicado, 'Graduacao/bolsas_ic');
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

    public function updateBolsasIC()
    {
        $bolsasIC = $this->bolsasIC->transform($orderBy = ['anoProjeto', 'codigoProjeto']);

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($bolsasIC, 5000) as $chunk) 
        {
            BolsaIC::upsert($chunk, ['idProjeto', 'sequenciaBolsa']);
        }
    }
}