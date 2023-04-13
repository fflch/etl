SELECT
    d.idfpescpq AS 'numero_cnpq'
    ,d.codpes AS 'numero_usp'
    ,d.dtaultalt AS 'data_atualizacao_cv'
    ,d.dtapcsetc AS 'data_extracao_cv'
    ,d.imgarqxml AS 'xml_zipped'
FROM DIM_PESSOA_XMLUSP d 
WHERE codpes IN (SELECT numero_usp FROM #nusps_lattes) 
    --AND1