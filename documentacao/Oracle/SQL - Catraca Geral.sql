SELECT GERAL."COD",GERAL."NOME",GERAL."DT_ENTRADA",GERAL."DT_SAIDA",GERAL."TIPO",GERAL."ALTA_MEDICA",GERAL."ALTA_HOSP",GERAL."ENTRADA",GERAL."IDENTE",GERAL."ENT_SAI",GERAL."QNT",  CASE
--REGRA FUNCIONARIO
WHEN (GERAL.TIPO = 'F') THEN '4'
--REGRA MÉDICOS
WHEN (GERAL.TIPO = 'M') THEN '4'
--REGRA TERCEIROS
WHEN (GERAL.TIPO = 'T') THEN '4'
--Alterado por Lucas Magno no dia 13/12/2022 a pedido do Segato
/*WHEN (GERAL.TIPO = 'M' AND GERAL.ENT_SAI IS NULL) THEN '0'
WHEN (GERAL.TIPO = 'M' AND GERAL.ENT_SAI = '0') THEN '1'
WHEN (GERAL.TIPO = 'M' AND GERAL.ENT_SAI = '1') THEN '0'
WHEN (GERAL.TIPO = 'M' AND GERAL.QNT = '1' AND GERAL.ENT_SAI = '2') THEN '0'*/
--REGRA AMBULATÓRIO
WHEN (GERAL.ENTRADA = 'DISNIBRA' AND GERAL.DT_SAIDA IS NULL  AND IDENTE = 'A' ) THEN  '1'
--REGRA PACIENTE
WHEN (GERAL.ENTRADA = 'DISNIBRA'  AND GERAL.ALTA_HOSP IS NULL AND GERAL.ALTA_MEDICA IS NULL AND GERAL.TIPO = 'P') THEN '3'
WHEN (GERAL.ENTRADA = 'DISNIBRA'  AND GERAL.ALTA_HOSP IS  NULL AND GERAL.ALTA_MEDICA IS NOT NULL AND GERAL.TIPO = 'P') THEN '3'
WHEN (GERAL.ENTRADA = 'DISNIBRA' AND GERAL.ALTA_HOSP IS NOT NULL AND GERAL.ALTA_HOSP IS NOT NULL AND GERAL.TIPO = 'P')  THEN '1'
WHEN (GERAL.ENTRADA = 'DISNIBRA' AND GERAL.DT_SAIDA IS NULL AND GERAL.TIPO <> 'P' ) THEN  '1'
--REGRA NÃO ENTROU
WHEN (GERAL.ENTRADA <> 'DISNIBRA' AND GERAL.DT_SAIDA IS NULL) THEN '0'
ELSE '0'
  END AS SIT
  FROM
(
select to_char(pac.CD_ATENDIMENTO) AS COD, PAC.NOME AS NOME, pac.HR_ENTRADA AS DT_ENTRADA, pac.HR_SAIDA AS DT_SAIDA, 'P' AS TIPO, pac.ALTA_MEDICA AS ALTA_MEDICA, pac.ALTA_GERAL AS ALTA_HOSP, PAC.CD_USUARIO_ENTRADA AS ENTRADA, PAC.CD_TP_IDENTIFICACAO AS IDENTE, NULL AS ENT_SAI, NULL AS QNT from (SELECT
PRINCIPAL.ID_PACIENTE,
PRINCIPAL.CD_CARTAO_CRACHA,
PRINCIPAL.CD_ATENDIMENTO,
    PRINCIPAL.NOME,
    PRINCIPAL.IDADE,
    PRINCIPAL.NM_MAE,
    PRINCIPAL.DT_ATENDIMENTO,
    PRINCIPAL.HR_ENTRADA,
    PRINCIPAL.HR_SAIDA,
    PRINCIPAL.CD_TP_IDENTIFICACAO,
    PRINCIPAL.CD_USUARIO_ENTRADA,
    PRINCIPAL.ALTA_MEDICA,
    PRINCIPAL.ALTA_GERAL,
    PRINCIPAL.CD_CONVENIO,
    PRINCIPAL.CONVENIO,
    PRINCIPAL.ID_LEITO,
    PRINCIPAL.DS_LEITO,
    PRINCIPAL.CD_UNID_INT,
    PRINCIPAL.DS_UNID_INT,
    PRINCIPAL.VISITANTES_PERMITIDOS,
    PENDENCIA.SN_FECHADA,
    CASE WHEN PENDENCIA.CD_ATENDIMENTO IS NOT NULL THEN 'CONTA ABERTA' END PENDENCIA,
    PRINCIPAL.ATIVO

FROM
(

SELECT
    P.CD_PACIENTE ID_PACIENTE,
    PMP.CD_CARTAO_CRACHA,  ------  NOVO CAMPO
    A.CD_ATENDIMENTO,
    P.NM_PACIENTE NOME,
    DBAMV.FN_IDADE_PACIENTE(P.CD_PACIENTE )IDADE,
    P.NM_MAE,
    A.DT_ATENDIMENTO, --INICIO_INTERNACAO,
    A.DT_ALTA_MEDICA ALTA_MEDICA,
    A.DT_ALTA ALTA_GERAL,
    CO.CD_CONVENIO,
    CO.NM_CONVENIO CONVENIO,
    A.CD_LEITO ID_LEITO,
    L.DS_LEITO,
    PMP.HR_ENTRADA,
    PMP.HR_SAIDA,
    PMP.CD_TP_IDENTIFICACAO, --ADD POR LUCAS 20/10
    PMP.CD_USUARIO_ENTRADA,
    UI.CD_UNID_INT,
    UI.DS_UNID_INT,
    vI.qt_max_visitantes VISITANTES_PERMITIDOS,
    P.SN_ATIVO ATIVO
FROM DBAMV.ATENDIME A, DBAMV.PACIENTE P, DBAMV.CONVENIO CO, DBAMV.LEITO L, DBAMV.UNID_INT UI, PT_CONFIG_UNID_INTERNAC_VISITT VI, DBAMV.PT_MVTO_PACIENTE PMP
WHERE P.CD_PACIENTE = A.CD_PACIENTE
AND CO.CD_CONVENIO = A.CD_CONVENIO
AND L.CD_LEITO(+) = A.CD_LEITO
AND UI.CD_UNID_INT(+) = L.CD_UNID_INT
AND VI.CD_UNIDADE_INTERNACAO(+) = UI.CD_UNID_INT
AND PMP.CD_ATENDIMENTO = A.CD_ATENDIMENTO
AND PMP.DT_SAIDA IS NULL
AND A.DT_ALTA IS NULL
--AND A.CD_ATENDIMENTO IN (4304033,4304037,4304038,4304039,4304040) -- TESTE

UNION

SELECT
    P.CD_PACIENTE ID_PACIENTE,
    PMP.CD_CARTAO_CRACHA,  ------  NOVO CAMPO
    A.CD_ATENDIMENTO,
    P.NM_PACIENTE NOME,
    DBAMV.FN_IDADE_PACIENTE(P.CD_PACIENTE )IDADE,
    P.NM_MAE,
    A.DT_ATENDIMENTO INICIO_INTERNACAO ,
    A.DT_ALTA_MEDICA ALTA_MEDICA,
    A.DT_ALTA ALTA_GERAL,
    CO.CD_CONVENIO,
    CO.NM_CONVENIO CONVENIO,
    A.CD_LEITO ID_LEITO,
    L.DS_LEITO,
    PMP.HR_ENTRADA,
    PMP.HR_SAIDA,
    PMP.CD_TP_IDENTIFICACAO, -- ADD POR LUCAS 20/10
    PMP.CD_USUARIO_ENTRADA,
    UI.CD_UNID_INT,
    UI.DS_UNID_INT,
    vI.qt_max_visitantes VISITANTES_PERMITIDOS,
    P.SN_ATIVO ATIVO
FROM DBAMV.ATENDIME A, DBAMV.PACIENTE P, DBAMV.CONVENIO CO, DBAMV.LEITO L, DBAMV.UNID_INT UI, PT_CONFIG_UNID_INTERNAC_VISITT VI, DBAMV.PT_MVTO_PACIENTE PMP
WHERE P.CD_PACIENTE = A.CD_PACIENTE
AND CO.CD_CONVENIO = A.CD_CONVENIO
AND L.CD_LEITO(+) = A.CD_LEITO
AND UI.CD_UNID_INT(+) = L.CD_UNID_INT
AND VI.CD_UNIDADE_INTERNACAO(+) = UI.CD_UNID_INT
AND PMP.CD_ATENDIMENTO = A.CD_ATENDIMENTO
AND PMP.DT_SAIDA IS NULL
AND TRUNC(A.DT_ALTA) >= TRUNC(SYSDATE)-1
--AND A.CD_ATENDIMENTO IN (4304033,4304037,4304038,4304039,4304040) -- TESTE

)PRINCIPAL,
(
SELECT CD_ATENDIMENTO,
       CD_REG_FAT,
       CD_CONVENIO,
       SN_FECHADA
FROM REG_FAT
--WHERE CD_CONVENIO = 83
where SN_FECHADA = 'N'
)PENDENCIA

WHERE PRINCIPAL.CD_ATENDIMENTO = PENDENCIA.CD_ATENDIMENTO(+)
) pac

UNION ALL

-------- Visitante e acompanhante ----------

SELECT to_char(vis.CD_ID_VISITA_ACOM) AS COD, vis.NM_NOME AS NOME, vis.hr_entrada AS DT_ENTRADA, to_date(vis.hr_saida, 'DD/MM/YYYY HH24:MI:SS') AS DT_SAIDA, vis.ID_ACOM_VISIT AS TIPO, NULL AS ALTA_MEDICA, NULL AS ALTA_HOSP, vis.CD_USUARIO_ENTRA AS ENTRADA, NULL AS IDENTE, NULL AS ENT_SAI,NULL AS QNT FROM (
SELECT VA.CD_ATENDIMENTO,
       VA.ID_ACOM_VISIT,
       VA.CD_ID_VISITA_ACOM,
       PP.CD_PESSOA, -- ID_PESSOA
       (
       CASE
         WHEN PP.DOC_IDENT_ID IN (1,4,5)
           THEN PP.NR_DOCUMENTO ELSE NULL
       END)RG,
       PP.DOC_IDENT_ID,
       NULL                 SSP_RG, -- SSP_RG
       NULL                 DT_EXPEDICAO_RG, -- DT_EXPEDICAO_RG
       NULL                 EMAIL, -- EMAIL
       NULL                 DT_ADMISSAO, -- DT_ADMISSAO
       NULL                 DT_DEMISSAO, --DT_DEMISSAO
       PP.SN_VISITANTE_RESTRITO RESTRITO, -- ATIVO
       PP.NM_NOME, -- NOME
(
       CASE
         WHEN PP.DOC_IDENT_ID IN (3)
           THEN PP.NR_DOCUMENTO ELSE NULL
       END)CPF,

       --VA.CD_ID_VISITA_ACOM, --CRACHA1
       VA.CD_CARTAO_CRACHA CRACHA1,
       NULL                 CRACHA2, --  CRACHA2
       NULL                 MATRICULA, -- MATRICULA
       PP.TELEFONE, -- TELEFONE
       NULL                 CELULAR, -- CELULAR
       NULL                 ENDERECO, -- ENDERECO
       NULL                 NUMERO, -- NUMERO
       NULL                 COMPLEMENTO, -- COMPLEMENTO
       NULL                 BAIRRO, -- BAIRRO
       NULL                 CEP, -- CEP
       VA.DT_ENTRADA, --INICIO_ACESSO
       VA.DT_SAIDA, --FIM_ACESSO
       VA.HR_SAIDA,
       VA.HR_ENTRADA,
       VA.CD_USUARIO_ENTRA,
       A.CD_PACIENTE, -- ID_PESSOA_VISITADO
       VA.DS_OBSERVACOES                OBS_PESSOA, -- OBS_PESSOA
       VA.DT_ENTRADA DATA_CAD -- DATA_CAD  ---   POSSIVELMENTE ELE GERA UM SYSDATE EM SUA FERRAMENTA
      -- ,P.NM_PACIENTE

  FROM DBAMV.MVTO_VISITA_ACOM VA, -- VISITAS
       DBAMV.PT_PESSOA        PP, -- CADASTRO PESSOA
       DBAMV.ATENDIME         A,
       DBAMV.PACIENTE P
 WHERE PP.CD_PESSOA = VA.CD_PESSOA
   AND A.CD_ATENDIMENTO = VA.CD_ATENDIMENTO
   AND A.CD_PACIENTE = P.CD_PACIENTE
   AND VA.DT_SAIDA IS NULL) vis

UNION ALL

---FUNCIONARIO----
SELECT COD, NOME, DT_ENTRADA, DT_SAIDA, TIPO, ALTA_MEDICA, ALTA_HOSP, ENTRADA, IDENTE, ENT_SAI, NULL AS QNT FROM (
SELECT CASE WHEN func.CHAPA*1 > '9999' AND func.chapa*1 <= '99999' THEN '00000' || TO_CHAR(func.CHAPA) || '00' else '000000' || TO_CHAR(func.CHAPA) || '00' end as cod,
func.nm_funcionario AS NOME, NULL AS DT_ENTRADA, NULL as DT_SAIDA, 'F' AS TIPO, NULL AS ALTA_MEDICA, NULL AS ALTA_HOSP,
NULL AS ENTRADA, NULL AS IDENTE, NULL AS ENT_SAI
FROM dbamv.sta_tb_funcionario func
/*LEFT JOIN dbamv.LOG_FUNC_CATRACA fct ON
fct.cracha not like '%E%'
and fct.cracha is not null
and fct.cracha * 1 = func.chapa*/
WHERE func.Tp_Situacao = 'A'
GROUP BY func.chapa, func.nm_funcionario)

UNION ALL

---Médicos e Alunos Médicos---

SELECT COD,
       NOME,
       DT_ENTRADA,
       DT_SAIDA,
       TIPO,
       ALTA_MEDICA,
       ALTA_HOSP,
       ENTRADA,
       IDENTE,
       case when ENT_SAI = 2 then null
         else ENT_SAI end as ENT_SAI,
       null as QTD
  FROM (SELECT substr(ENT_SAI, 21, 1) AS ENT_SAI,
               COD,
               NOME,
               DT_ENTRADA,
               DT_SAIDA,
               TIPO,
               ALTA_MEDICA,
               ALTA_HOSP,
               ENTRADA,
               IDENTE
          from (SELECT pr.NR_CPF_CGC AS COD,
                       pr.NM_PRESTADOR AS NOME,
                       MAX(to_char(ct.data_hora, 'dd/mm/rrrr hh24:mi:ss') || '-' ||
                           ct.ent_sai) as ENT_SAI,
                       NULL AS DT_ENTRADA,
                       NULL AS DT_SAIDA,
                       'M' AS TIPO,
                       NULL AS ALTA_MEDICA,
                       NULL AS ALTA_HOSP,
                       NULL AS ENTRADA,
                       NULL AS IDENTE
                  FROM dbamv.prestador pr
                  LEFT JOIN dbamv.log_func_catraca ct
                    ON ct.cracha = pr.nr_cpf_cgc
                  LEFT JOIN (SELECT CRACHA, ENT_SAI, QNT, LINHA
                              FROM (SELECT ab.CRACHA,
                                           a.ENT_SAI,
                                           a.QNT,
                                           ab.LINHA
                                      FROM (SELECT CRACHA,
                                                   count(LINHA) as LINHA
                                              FROM (SELECT CRACHA,
                                                           ENT_SAI,
                                                           QNT,
                                                           ROWNUM AS LINHA
                                                      FROM (SELECT CRACHA,
                                                                   ENT_SAI,
                                                                   COUNT(ENT_SAI) AS QNT
                                                              FROM dbamv.log_func_catraca ctt
                                                             GROUP BY CRACHA,
                                                                      ENT_SAI
                                                             ORDER BY ENT_SAI desc))
                                             GROUP BY CRACHA) ab
                                     INNER JOIN (SELECT CRACHA,
                                                       ENT_SAI,
                                                       COUNT(ENT_SAI) AS QNT
                                                  FROM dbamv.log_func_catraca ct
                                                 GROUP BY CRACHA, ENT_SAI
                                                 ORDER BY ENT_SAI DESC) A
                                        ON A.CRACHA = ab.CRACHA)) CC
                    ON CT.CRACHA = CC.CRACHA
                 WHERE pr.tp_situacao = 'A'
                   AND pr.cd_tip_presta IN (8, 51)
                   AND ((pr.ct.ent_sai <> 2 AND CC.linha >= 1) OR
                       (pr.ct.ent_sai = 2 AND CC.linha = 1) OR
                       pr.ct.ent_sai IS NULL)
                 GROUP BY pr.NR_CPF_CGC, pr.NM_PRESTADOR))

UNION ALL

SELECT COD,
       NOME,
       DT_ENTRADA,
       NULL       AS DT_SAIDA,
       TIPO,
       NULL       AS ALTA_MEDICA,
       NULL       AS ALTA_HOSP,
       ENTRADA,
       NULL       AS IDENTE,
       NULL       AS ENT_SAI,
       NULL       AS QNT
  FROM (SELECT CASE
                 WHEN (RES.TIPO_PERMANENCIA = 'C') THEN
                  'C'
                 WHEN (RES.TIPO_PERMANENCIA = 'V') THEN
                  'VE'
                 WHEN (RES.TIPO_PERMANENCIA = 'P') THEN
                  'PR'
                 WHEN (RES.TIPO_PERMANENCIA = 'F') THEN
                  'FO'
               END AS TIPO,
               '0000' || RES.CD_CARTAO_CRACHA || 'E' as COD,
               RES.HR_ENTRADA as DT_ENTRADA,
               RES.ENTRADA,
               CASE WHEN res.TIPO_PERMANENCIA = 'P' THEN
                RES.NM_PRESTADOR
                ELSE RES.NOME END AS NOME
          FROM (SELECT pva.CD_CARTAO_CRACHA,
                       ps.nm_nome             as NOME,
                       prest.NM_PRESTADOR,
                       pva.HR_ENTRADA,
                       pva.Cd_Usuario_Entrada as ENTRADA,
                       pva.TIPO_PERMANENCIA
                  FROM dbamv.Pt_Mvto_Adm pva
                 LEFT JOIN DBAMV.Pt_Pessoa ps
                    ON ps.CD_PESSOA = pva.CD_PESSOA
                 LEFT JOIN PRESTADOR prest
                    ON pva.Cd_Prestador = prest.cd_prestador
                    WHERE PVA.DT_SAIDA IS NULL
                    AND PVA.CD_USUARIO_SAIDA IS NULL
                    ) RES) ADM
                    
UNION ALL
        
--Consulta de Terceiros - Portal_Catraca - 16/05/2023 - Francisco
SELECT cons.CRACHA AS COD, cons.NOME, NULL AS DT_ENTRADA, NULL AS DT_SAIDA, cons.TIPO, NULL AS ALTA_MEDICA, NULL AS ALTA_HOSP, NULL AS ENTRADA, NULL AS IDENTE, NULL AS ENT_SAI, NULL AS QND
FROM (
      SELECT ter.CRACHA, ter.NM_TERCEIRO AS NOME, cra.TIPO, cra.CD_CATRACA
      FROM port_catraca.TERCEIROS ter
      INNER JOIN port_catraca.CRACHAS cra
       ON cra.CD_CRACHA = ter.CRACHA
      INNER JOIN port_catraca.CATRACA cat
       ON cra.CD_CATRACA = cat.CD_CATRACA
      WHERE ter.TP_STATUS = 'A'
      AND ter.DT_INICIO <= TRUNC(SYSDATE)
      AND ter.DT_FIM >= TRUNC(SYSDATE)
      AND cat.SN_ATIVO = 'A'
      --VERIFICA SE A CATRACA LIBERADA É A CENTRAL
      AND cat.IP_CATRACA = '0.0.0:0000'
)cons
      
) GERAL
WHERE GERAL.TIPO = 'T'
