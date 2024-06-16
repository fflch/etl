<?php

namespace Src\Loading\Operations\PessoasOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Pessoas\TituloPessoaReplicado;
use Src\Loading\Models\Pessoas\TituloPessoa;

class updateTitulosPessoas
{
    private $titulosPessoas;

    public function __construct()
    {
        $this->titulosPessoas = new Transformer(new TituloPessoaReplicado, 'Pessoas/titulos_pessoas');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->titulosPessoas,
            TituloPessoa::class
        );
    }
}
