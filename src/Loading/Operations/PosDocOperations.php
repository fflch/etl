<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Transformation\ModelsReplicado\PosDoc\ProjetoPosDocReplicado;
use Src\Loading\Models\PosDoc\ProjetoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\PeriodoPosDocReplicado;
use Src\Loading\Models\PosDoc\PeriodoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\BolsaPosDocReplicado;
use Src\Loading\Models\PosDoc\BolsaPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\AfastEmpresaPosDocReplicado;
use Src\Loading\Models\PosDoc\AfastEmpresaPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\SupervisaoPosDocReplicado;
use Src\Loading\Models\PosDoc\SupervisaoPosDoc;

class PosDocOperations
{
    public function __construct()
    {
        $this->projetosPosDoc = new Transformer(new ProjetoPosDocReplicado, 'PosDoc/projetos_posdoc');
        $this->periodosPosDoc = new Transformer(new PeriodoPosDocReplicado, 'PosDoc/periodos_posdoc');
        $this->bolsasPosDoc = new Transformer(new BolsaPosDocReplicado, 'PosDoc/bolsas_posdoc');
        $this->afastEmpresasPosDoc = new Transformer(new AfastEmpresaPosDocReplicado, 'PosDoc/afastempresas_posdoc');
        $this->supervisoesPosDoc = new Transformer(new SupervisaoPosDocReplicado, 'PosDoc/supervisoes_posdoc');
    }

    public function updateProjetosPosDoc()
    {
        $projetosPD = $this->projetosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need 10 placeholders for each row at the moment. Let's make room for 13.
        foreach(array_chunk($projetosPD, 5400) as $chunk) 
        {
            ProjetoPosDoc::insert($chunk);
        }

        Capsule::update("UPDATE projetos_posdoc pp
                        SET data_fim_projeto = NULL, data_inicio_projeto = NULL
                        WHERE pp.situacao_projeto IN ('Incompleto', 'Recusado')");
    }

    public function updatePeriodosPosDoc()
    {
        $periodosPD = $this->periodosPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need 9 placeholders for each row at the moment. Let's make room for 11.
        foreach(array_chunk($periodosPD, 5900) as $chunk) 
        {
            //gambi para períodos idênticos
            PeriodoPosDoc::insert($chunk);
        }
    }

    public function updateFontesRecursoPosDoc()
    {
        $bolsasPD = $this->bolsasPosDoc->transform();
        $afastEmpresa = $this->afastEmpresasPosDoc->transform();

        // Insert placeholders limit is 65535.
        // We need 8 placeholders for each row at the moment. Let's make room for 10.
        foreach(array_chunk($bolsasPD, 6500) as $chunk) 
        {
            BolsaPosDoc::insert($chunk);
        }

        // Insert placeholders limit is 65535.
        // We need 7 placeholders for each row at the moment. Let's make room for 9.
        foreach(array_chunk($afastEmpresa, 7200) as $chunk) 
        {
            AfastEmpresaPosDoc::insert($chunk);
        }

        Capsule::delete("DELETE bp, ap
                        FROM projetos_posdoc pp
                            LEFT JOIN bolsas_posdoc bp ON bp.id_projeto = pp.id_projeto
                            LEFT JOIN afastempresas_posdoc ap ON ap.id_projeto = pp.id_projeto
                        WHERE pp.situacao_projeto IN ('Incompleto', 'Recusado')");
        
        Capsule::update("UPDATE bolsas_posdoc bp
                            INNER JOIN projetos_posdoc pp ON pp.id_projeto = bp.id_projeto
                        SET bp.data_fim_fomento = pp.data_fim_projeto
                        WHERE pp.situacao_projeto = 'Cancelado'");

        Capsule::update("UPDATE afastempresas_posdoc ap
                            INNER JOIN projetos_posdoc pp ON pp.id_projeto = ap.id_projeto
                        SET ap.data_fim_afastamento = pp.data_fim_projeto
                        WHERE pp.situacao_projeto = 'Cancelado'");
    }

    public function updateSupervisoesPosDoc()
    {
        $supervisoesPD = $this->supervisoesPosDoc->transform($orderBy = ['ano_projeto', 'codigo_projeto']);

        // Insert placeholders limit is 65535.
        // We need 8 placeholders for each row at the moment. Let's make room for 10.
        foreach(array_chunk($supervisoesPD, 6500) as $chunk) 
        {
            SupervisaoPosDoc::insert($chunk);
        }
    }
}