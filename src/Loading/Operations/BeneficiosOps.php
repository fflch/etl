<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Utils\ExtractionUtils;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Transformation\ModelsReplicado\Beneficios\BeneficioConcedidoReplicado;
use Src\Loading\Models\Beneficios\BeneficioConcedido;

class BeneficiosOps
{
    private $beneficio;

    public function __construct()
    {
        $this->beneficios = new Transformer(new BeneficioConcedidoReplicado, 'Beneficios/beneficios_concedidos');
    }

    public function updateBeneficiosConcedidos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->beneficios, 
            BeneficioConcedido::class
        );

        Capsule::update("UPDATE beneficios_concedidos bc
                        SET bc.tipo_vinculo = 'Aluno de Graduação'
                        WHERE bc.tipo_vinculo = 'Aluno Escola de Arte Dramática'
                            AND bc.id_graduacao IS NOT NULL"); // ver
    }
}