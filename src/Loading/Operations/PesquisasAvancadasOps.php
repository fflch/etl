<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PesquisasAvancadas\PesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\PesquisaAvancada;
use Src\Transformation\ModelsReplicado\PesquisasAvancadas\PeriodoPesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\PeriodoPesquisaAvancada;
use Src\Transformation\ModelsReplicado\PesquisasAvancadas\BolsaPesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\BolsaPesquisaAvancada;
use Src\Transformation\ModelsReplicado\PesquisasAvancadas\AfastEmpresaPesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\AfastEmpresaPesquisaAvancada;
use Src\Transformation\ModelsReplicado\PesquisasAvancadas\SupervisaoPesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\SupervisaoPesquisaAvancada;

class PesquisasAvancadasOps
{
    private $pesquisasAvancadas, $periodosPesquisaAvancada,
            $bolsasPesquisaAvancada, $afastEmpresasPesquisaAvancada,
            $supervisoesPesquisaAvancada;
    
    public function __construct()
    {
        $this->pesquisasAvancadas = new Transformer(new PesquisaAvancadaReplicado, 'PesquisasAvancadas/pesquisas_avancadas');
        $this->periodosPesquisaAvancada = new Transformer(new PeriodoPesquisaAvancadaReplicado, 'PesquisasAvancadas/periodos_pesq_avancada');
        $this->bolsasPesquisaAvancada = new Transformer(new BolsaPesquisaAvancadaReplicado, 'PesquisasAvancadas/bolsas_pesq_avancada');
        $this->afastEmpresasPesquisaAvancada = new Transformer(new AfastEmpresaPesquisaAvancadaReplicado, 'PesquisasAvancadas/afastempresas_pesq_avancada');
        $this->supervisoesPesquisaAvancada = new Transformer(new SupervisaoPesquisaAvancadaReplicado, 'PesquisasAvancadas/supervisoes_pesq_avancada');
    }

    public function updateProjetosPesquisaAvancada()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->pesquisasAvancadas, 
            PesquisaAvancada::class
        );

        Capsule::update("UPDATE pesquisas_avancadas pa
                        SET data_fim_projeto = NULL, data_inicio_projeto = NULL
                        WHERE pa.situacao_projeto IN ('Incompleto', 'Recusado')");

        Capsule::update("UPDATE pesquisas_avancadas pa
                        SET palavras_chave = NULL
                        WHERE pa.palavras_chave = ''");
    }

    public function updatePeriodosPesquisaAvancada()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->periodosPesquisaAvancada, 
            PeriodoPesquisaAvancada::class
        );
    }

    public function updateFontesRecursoPesquisaAvancada()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bolsasPesquisaAvancada, 
            BolsaPesquisaAvancada::class
        );

        LoadingUtils::insertIntoTable(
            'full',
            $this->afastEmpresasPesquisaAvancada, 
            AfastEmpresaPesquisaAvancada::class
        );

        Capsule::delete("DELETE bp, ap
                        FROM pesquisas_avancadas pa
                            LEFT JOIN bolsas_pesq_avancada bp ON bp.id_projeto = pa.id_projeto
                            LEFT JOIN afastempresas_pesq_avancada ap ON ap.id_projeto = pa.id_projeto
                        WHERE pa.situacao_projeto IN ('Incompleto', 'Recusado')");
        
        Capsule::update("UPDATE bolsas_pesq_avancada bp
                            INNER JOIN pesquisas_avancadas pa ON pa.id_projeto = bp.id_projeto
                        SET bp.data_fim_fomento = pa.data_fim_projeto
                        WHERE pa.situacao_projeto = 'Cancelado'");

        Capsule::update("UPDATE afastempresas_pesq_avancada ap
                            INNER JOIN pesquisas_avancadas pa ON pa.id_projeto = ap.id_projeto
                        SET ap.data_fim_afastamento = pa.data_fim_projeto
                        WHERE pa.situacao_projeto = 'Cancelado'");
    }

    public function updateSupervisoesPesquisaAvancada()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->supervisoesPesquisaAvancada, 
            SupervisaoPesquisaAvancada::class
        );
    }
}