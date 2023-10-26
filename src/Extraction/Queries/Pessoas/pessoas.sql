SELECT
    p.codpes AS 'numero_usp'
    ,p.nompes AS 'nome'
    ,p.dtanas AS 'data_nascimento'
    ,c.dtaflc AS 'data_falecimento'
    ,e.codema AS 'email'
    ,p2.nacpas AS 'nacionalidade'
    ,l.cidloc AS 'cidade_nascimento'
    ,l.sglest AS 'estado_nascimento'
    ,p3.nompas AS 'pais_nascimento'
    ,c.codraccor AS 'raca'
    ,p.sexpes AS 'sexo'
    ,o.dscortsex AS 'orientacao_sexual'
    ,i.idegen AS 'identidade_genero'
    ,p4.sitvcipes AS 'situacao_vacinal_covid'
    ,p.numcpf AS 'cpf'
FROM PESSOA p
    LEFT JOIN COMPLPESSOA c ON p.codpes = c.codpes
    LEFT JOIN PAIS p2 ON c.codpasnac = p2.codpas
    LEFT JOIN PAIS p3 ON c.codpasnas = p3.codpas
    LEFT JOIN LOCALIDADE l ON c.codlocnas = l.codloc
    LEFT JOIN EMAILPESSOA e ON p.codpes = e.codpes AND e.stamtr = 'S'
    LEFT JOIN ORIENTACAOSEXUAL o ON c.codortsex = o.codortsex
    LEFT JOIN IDENTIDADEGENERO i ON c.codidegen = i.codidegen
    LEFT JOIN PESSOAINFOVACINACOVID p4 ON p4.codpes = p.codpes