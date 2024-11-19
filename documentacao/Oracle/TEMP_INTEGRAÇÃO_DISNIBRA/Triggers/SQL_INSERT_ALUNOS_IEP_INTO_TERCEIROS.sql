/* DOCUMENTAÇÃO DE TRIGGER DO PROJETO */
/*  Trigger Temporaria para Cadastrar Alunos do IEP na Tabela de Terceiros */
CREATE OR REPLACE TRIGGER port_catraca.TRG_TEMP_CADASTRO_ALUNOS_IEP
BEFORE INSERT OR DELETE
ON port_catraca.ALUNOS
REFERENCING NEW AS NEW OLD AS OLD
  FOR EACH ROW
BEGIN
   IF Inserting THEN
     INSERT INTO port_catraca.TERCEIROS
     SELECT port_catraca.SEQ_CD_TERCEIRO.NEXTVAL,
            :new.CD_CRACHA,
            :new.NM_ALUNO,
            TO_DATE('01/01/0001') AS DT_NASCIMENTO,
            :new.RG, 'NULL' AS CPF,
            'NULL' AS CNPJ,
            'NULL' as NM_EMPRESA,
            'A' AS TP_STATUS,
            '01/01/2000' AS DT_INICIO,
            '01/01/2024' AS DT_FIM,
            'TEMP_IEP' AS CD_USUARIO_CADASTRO,
            SYSDATE AS HR_CADASTRO,
            NULL AS CD_USUARIO_ULT_ALT,
            NULL AS HR_ULT_ALT
     FROM DUAL;
     
   ELSIF Deleting THEN
     DELETE FROM port_catraca.TERCEIROS ter
     WHERE ter.CRACHA = :old.CD_CRACHA
     AND ter.CD_USUARIO_CADASTRO = 'TEMP_IEP'
   END IF;
END;
