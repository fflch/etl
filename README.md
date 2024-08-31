# ⚙️ ETL-FFLCH

[![pt-br](https://img.shields.io/badge/lang-pt--br-red.svg)](https://github.com/fflch/etl/blob/main/README.md)
[![eng](https://img.shields.io/badge/lang-en-blue.svg)](https://github.com/fflch/etl/blob/main/README.eng.md)

## 🗒️ Descrição

O ETL-FFLCH é uma ferramenta criada para simplificar os dados do Replicado USP, transformando-os e reorganizando-os em uma fonte de dados mais prática e acessível. Ela realiza a extração, transformação e carga de dados significativos para a faculdade em um banco de dados altamente desnormalizado e simplificado, com dados redundantes. Projetado inicialmente para otimizar a usabilidade desses dados e minimizar erros decorrentes da complexidade do Replicado USP, o ETL-FFLCH agora disponibiliza publicamente sua versão dos dados por meio da [API da FFLCH](https://api.fflch.usp.br), permitindo que qualquer pessoa acesse e integre com facilidade os dados de nossa faculdade.

#### 🌟 Principais benefícios

- **Reformatação**: O ETL-FFLCH permite a manipulação personalizada dos dados do Replicado USP, facilitando a formatação, adaptação e aprimoramento dos dados para preencher lacunas e melhorar sua consistência, garantindo que eles atendam melhor às necessidades de nossa faculdade.

- **Simplificação**: Remodela dados do Replicado USP, que são complexos e dispersos, de modo a oferecer uma fonte de dados mais acessível.


#### 🚧 Limitações

 - **Redundância**: O banco de dados resultante é altamente desnormalizado, levando a uma grande quantidade de dados redundantes. Embora isso facilite o uso, não é recomendado para muitas finalidades.

 - **Confiabilidade**: Devido aos problemas inerentes dos dados do Replicado USP e às dificuldades de diagnosticar e resolver completamente suas deficiências, é fundamental utilizar os dados do ETL-FFLCH com cuidado e permanecer crítico quanto à sua precisão, especialmente ao lidar com dados mais antigos. Se achar que encontrou algum erro, não hesite em abrir uma *issue* ou entrar em contato com a STI-FFLCH.
 
 - **Recarregamento**: Uma vez que o banco de dados Replicado USP não possui timestamps de atualização, não é possível identificar facilmente as alterações incrementais dos dados. Assim, a abordagem mais prática para ter em conta quaisquer atualizações é atualizar todo o conjunto de dados. Isso significa que, cada vez que o processo ETL é executado, quase todos os dados são excluídos e totalmente recarregados. (A tabela *lattes* é a única exceção.)

 Para obter instruções detalhadas de configuração, consulte [Instruções de deploy](#instruções-de-deploy).

<br>

## 🗃️ Organização dos dados

Para fins de organização, categorizamos os dados extraídos em nove categorias distintas. Essa classificação geralmente serve como base para a divisão dos dados em diretórios dentro do nosso código. As categorias são:

- `Pessoas`: Informações sobre cada indivíduo associado à FFLCH.
- `Graduação`: Dados relacionados a cursos de graduação e seus alunos, incluindo iniciação científica.
- `Pós-Graduação`: Informações sobre os programas de pós-graduação e seus alunos.
- `Pesquisas Avançadas`: Dados sobre atividades de pesquisas avançadas, ou seja, realizadas por posdocs e pesquisadores colaboradores.
- `Servidores`: Detalhes sobre os servidores da FFLCH, incluindo docentes.
- `Cultura e Extensão`: Informações relacionadas à área de Cultura e Extensão da faculdade.
- `Programas USP`: Informações sobre os diversos auxílios financeiros, programas e bolsas de estudo disponíveis na USP.
- `Lattes`: Informações do Currículo Lattes dos indivíduos associados à FFLCH.
- `Questionário Socioeconômico`: Dados dos questionários socioeconômicos respondidos por ingressantes da graduação.

<br>

## Instruções de deploy

**1.** Primeiro, instale todas as dependências do projeto:

```sh
composer install
```

**2.** Faça uma cópia do arquivo *.env.example* e configure corretamente sua *.env* com as credenciais de acesso e as configurações do Replicado USP e de um banco de dados MySQL/MariaDB local:

```sh
cp .env.example .env
```

**3.** Após configurado o seu banco de dados local, você pode criar (ou recriar) as tabelas com:

```sh
php builder.php
```

(Para ignorar o prompt de confirmação e forçar a recriação das tabelas, você pode passar o parâmetro `-y`.)

**4.** Depois de criadas as tabelas, você pode inserir (ou atualizar) os dados sempre que necessário com:

```sh
php main.php
```

(Para forçar a construção/reconstrução ao executar o main.php, você pode passar o parâmetro `-f`.)

**5.** Para verificar a última vez em que os jobs do ETL (dividos por categoria) foram executados, use o script `check.php`:

```sh
php check.php
```

**6.** Finalmente, se você quiser dropar todas as tabelas, você pode executar:

```sh
php drop.php
```

<br>

## 🧩 Estrutura básica do código

- `config/`: Gerencia a conexão com o banco de dados local e inicializa as configurações da .env.
- `src/`: Contém o código-fonte do projeto.
    
    - `Extraction/`: Inclui componentes para a parte de Extração do (E)TL.
        - `ReplicadoDB.php`: Gerencia a conexão com o banco de dados do Replicado USP.
        - `TempTables/Scripts/`: Armazena os scripts para a criação de tabelas temporárias utilizadas para um primeiro processamento dos dados, que serão recuperados posteriormente.
        - `TempManager.php`: Gerencia a criação dessas tabelas temporárias necessárias.
        - `Queries/`: Armazena as consultas para buscar dados do Replicado USP, incluindo aquelas nas nossas tabelas temporárias.
    
    - `Transformation/`: Contém componentes para a fase de Transformação do E(T)L.
        - `ReplicadoModels/`: Abriga os modelos dos dados retornados pelas consultas ao Replicado USP, incluindo seu mapeamento e remodelagem para o carregamento subsequente.
        - `Transformer.php`: Lida com a extração e transformação dos dados, invocando a execução de consultas SQL, aplicando paginação e substituições, e mapeando os resultados.

    - `Loading/`: Contém componentes para a fase de Carga [*Loading*] do ET(L).
        - `DbHandle/`: Gerencia processos gerais do banco de dados, como limpeza e atualização de tabelas e invocação do TableHandler (criador).
        - `SchemaBuilder/Tables/`: Define a estrutura de cada tabela a ser criada no novo banco de dados.
        - `SchemaBuilder/TableHandler.php`: Interpreta essas estruturas e cria cada tabela.
        - `Models/`: Armazena modelos para as tabelas do novo banco de dados.
        - `Operations/`: Contém instruções para o carregamento de cada tabela.

    - `Jobs/`: Abriga os jobs individuais de atualização para cada categoria deste projeto. (Ver [Organização dos Dados](#️-organização-dos-dados))