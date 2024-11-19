-- / TESTES SQL Port_Catraca \ --
/*   TIPOS: F = Funcionario    */
/*          T = Terceiros      */
/*          A = Alunos         */
/*          E = Estagio        */

SELECT cons.CRACHA, cons.NOME, cons.TIPO, cons.CD_CATRACA
--SELECT cons.CRACHA AS COD, cons.NOME, NULL AS DT_ENTRADA, NULL AS DT_SAIDA, cons.TIPO, NULL AS ALTA_MEDICA, NULL AS ALTA_HOSP, NULL AS ENTRADA, NULL AS IDENTE, NULL AS ENT_SAI, NULL AS QND
FROM (
      /* Verificação de Funcionarios */
      SELECT res.CRACHA, res.NM_FUNCIONARIO AS NOME, cra.TIPO, cra.CD_CATRACA
      FROM (SELECT CASE 
                        WHEN CHAPA < 10 THEN '000000000' || CHAPA || '00'
                        WHEN CHAPA < 100 THEN '00000000' || CHAPA || '00'
                        WHEN CHAPA < 1000 THEN '0000000' || CHAPA || '00'
                        WHEN CHAPA < 10000 THEN '000000' || CHAPA || '00'
                        WHEN CHAPA < 100000 THEN '00000' || CHAPA || '00'
                        WHEN CHAPA < 1000000 THEN '0000' || CHAPA || '00'
                        WHEN CHAPA < 10000000 THEN '000' || CHAPA || '00'
                        WHEN CHAPA < 100000000 THEN '00' || CHAPA || '00'
                        WHEN CHAPA < 1000000000 THEN '0' || CHAPA || '00'
                        WHEN CHAPA < 10000000000 THEN CHAPA || '00'
                  END AS CRACHA,
                  sta.NM_FUNCIONARIO
           FROM dbamv.STA_TB_FUNCIONARIO sta
           WHERE sta.TP_SITUACAO = 'A')res
      INNER JOIN port_catraca.CRACHAS cra
       ON cra.CD_CRACHA = res.CRACHA

      UNION ALL

      /* Verificação de Terceiros */
      SELECT ter.CRACHA, ter.NM_TERCEIRO AS NOME, cra.TIPO, cra.CD_CATRACA
      FROM port_catraca.TERCEIROS ter
      INNER JOIN port_catraca.CRACHAS cra
       ON cra.CD_CRACHA = ter.CRACHA
      WHERE ter.TP_STATUS = 'A'
      AND ter.DT_INICIO <= TRUNC(SYSDATE)
      AND ter.DT_FIM >= TRUNC(SYSDATE)

      UNION ALL
      
      /* Verificação de Alunos do IEP */
      SELECT alu.CD_CRACHA as CRACHA, alu.NM_ALUNO AS NOME, cra.TIPO, cra.CD_CATRACA
      FROM port_catraca.ALUNOS alu
      INNER JOIN port_catraca.TURMAS tur
       ON tur.CD_TURMA = alu.CD_TURMA
      INNER JOIN port_catraca.CRACHAS cra
       ON cra.CD_CRACHA = alu.CD_CRACHA
      WHERE tur.SN_ATIVO = 'A'
      AND alu.SN_ATIVO = 'A'
      AND 'S' = CASE /* Verifica em quais catracas o aluno pode entrar hoje */
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'SEG' AND tur.SN_SEG = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'TER' AND tur.SN_TER = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'QUA' AND tur.SN_QUA = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'QUI' AND tur.SN_QUI = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'SEX' AND tur.SN_SEX = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'SAB' AND tur.SN_SAB = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'DOM' AND tur.SN_DOM = 'S' THEN 'S'
                     ELSE 'N'
                END
      /* Verificacao de Horário - 1h de Tolerancia, Regra: 30m = 30 / 1h = 100 / 1.5h = 130  */
      AND ((CAST(REPLACE(tur.HR_FIM, ':', '') AS INT)+100) - CAST(REPLACE(TO_CHAR(SYSDATE, 'hh24:mi'), ':', '') AS INT)) >= 0
      AND (CAST(REPLACE(TO_CHAR(SYSDATE, 'hh24:mi'), ':', '') AS INT) - (CAST(REPLACE(tur.HR_INICIO, ':', '') AS INT)-100)) >= 0
      AND cra.TIPO = 'A'
      
      UNION ALL

      /* Verificação de Alunos em Estagio */
      SELECT alu.CD_CRACHA as CRACHA, alu.NM_ALUNO AS NOME, cra.TIPO, cra.CD_CATRACA
      FROM port_catraca.ALUNOS alu
      INNER JOIN port_catraca.ALUNOS_ESTAGIO aluest
       ON aluest.CD_ALUNO = alu.CD_ALUNO
      INNER JOIN port_catraca.ESTAGIO est
       ON est.CD_ESTAGIO = aluest.CD_ESTAGIO
      INNER JOIN port_catraca.CRACHAS cra
       ON cra.CD_CRACHA = alu.CD_CRACHA
      WHERE est.SN_ATIVO = 'A'
      AND aluest.SN_ATIVO = 'A'
      AND 'S' = CASE /* Verifica em quais catracas o estagiario pode entrar hoje */
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'SEG' AND est.SN_SEG = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'TER' AND est.SN_TER = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'QUA' AND est.SN_QUA = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'QUI' AND est.SN_QUI = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'SEX' AND est.SN_SEX = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'SAB' AND est.SN_SAB = 'S' THEN 'S'
                     WHEN TO_CHAR(SYSDATE, 'DY') = 'DOM' AND est.SN_DOM = 'S' THEN 'S'
                     ELSE 'N'
                END
      /* Verificacao de Horário - 1h de Tolerancia, Regra: 30m = 30 / 1h = 100 / 1.5h = 130 */
      AND ((CAST(REPLACE(est.HR_FIM, ':', '') AS INT)+100) - CAST(REPLACE(TO_CHAR(SYSDATE, 'hh24:mi'), ':', '') AS INT)) >= 0
      AND (CAST(REPLACE(TO_CHAR(SYSDATE, 'hh24:mi'), ':', '') AS INT) - (CAST(REPLACE(est.HR_INICIO, ':', '') AS INT)-100)) >= 0
      AND cra.TIPO = 'E'
      
)cons
ORDER BY cons.CRACHA, cons.TIPO

------------------------------------------------------------------------------------------------------------------

SELECT cra.CD_CRACHA, cra.TIPO, cra.CD_CATRACA, cat.NM_CATRACA
FROM port_catraca.CRACHAS cra
INNER JOIN port_catraca.CATRACA cat
 ON cra.CD_CATRACA = cat.CD_CATRACA
ORDER BY cra.CD_CRACHA, cra.TIPO, cra.CD_CATRACA
