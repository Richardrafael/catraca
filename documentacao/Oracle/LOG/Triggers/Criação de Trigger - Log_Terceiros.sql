/* DOCUMENTAÇÃO DE TRIGGER DO PROJETO */
/*        Trigger de Terceiros        */
CREATE OR REPLACE TRIGGER port_catraca.TRG_LOG_TERCEIROS
BEFORE UPDATE OR INSERT OR DELETE
ON port_catraca.TERCEIROS
REFERENCING NEW AS NEW OLD AS OLD
  FOR EACH ROW
BEGIN
   IF Inserting THEN

     --INSERT
     INSERT INTO port_catraca.LOG_TERCEIROS
     SELECT SEQ_LOG_TERCEIROS.NEXTVAL,
     --DADOS ALTERADOS
     :new.CD_TERCEIRO,
     :new.CRACHA,
     :new.NM_TERCEIRO,
     :new.DT_NASCIMENTO,
     :new.RG,
     :new.CPF,
     :new.CNPJ,
     :new.NM_EMPRESA,
     :new.TP_STATUS,
     :new.DT_INICIO,
     :new.DT_FIM,
     --CAMPOS PADRAO
     :new.CD_USUARIO_CADASTRO,
     :new.HR_CADASTRO,
     :new.CD_USUARIO_ULT_ALT,
     :new.HR_ULT_ALT,
     --INFORMACOES LOG
     'I' AS TP_ALTERACAO, NULL TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;
     
   ELSIF Updating THEN
     
     --UPDATE (ANTES)
     INSERT INTO port_catraca.LOG_TERCEIROS
     SELECT SEQ_LOG_TERCEIROS.NEXTVAL,
     --DADOS ALTERADOS
     :old.CD_TERCEIRO,
     :old.CRACHA,
     :old.NM_TERCEIRO,
     :old.DT_NASCIMENTO,
     :old.RG,
     :old.CPF,
     :old.CNPJ,
     :old.NM_EMPRESA,
     :old.TP_STATUS,
     :old.DT_INICIO,
     :old.DT_FIM,
     --CAMPOS PADRAO
     :old.CD_USUARIO_CADASTRO,
     :old.HR_CADASTRO,
     :old.CD_USUARIO_ULT_ALT,
     :old.HR_ULT_ALT,
     --INFORMACOES LOG
     'U' AS TP_ALTERACAO, 'A' TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;

     --UPDATE (DEPOIS)
     INSERT INTO port_catraca.LOG_TERCEIROS
      SELECT SEQ_LOG_TERCEIROS.NEXTVAL,
     --DADOS ALTERADOS
     :new.CD_TERCEIRO,
     :new.CRACHA,
     :new.NM_TERCEIRO,
     :new.DT_NASCIMENTO,
     :new.RG,
     :new.CPF,
     :new.CNPJ,
     :new.NM_EMPRESA,
     :new.TP_STATUS,
     :new.DT_INICIO,
     :new.DT_FIM,
     --CAMPOS PADRAO
     :new.CD_USUARIO_CADASTRO,
     :new.HR_CADASTRO,
     :new.CD_USUARIO_ULT_ALT,
     :new.HR_ULT_ALT,
     --INFORMACOES LOG
     'U' AS TP_ALTERACAO, 'D' TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;
     
   ELSIF Deleting THEN
     --DELETE
     INSERT INTO port_catraca.LOG_TERCEIROS
     SELECT SEQ_LOG_TERCEIROS.NEXTVAL,
     --DADOS ALTERADOS
     :old.CD_TERCEIRO,
     :old.CRACHA,
     :old.NM_TERCEIRO,
     :old.DT_NASCIMENTO,
     :old.RG,
     :old.CPF,
     :old.CNPJ,
     :old.NM_EMPRESA,
     :old.TP_STATUS,
     :old.DT_INICIO,
     :old.DT_FIM,
     --CAMPOS PADRAO
     :old.CD_USUARIO_CADASTRO,
     :old.HR_CADASTRO,
     :old.CD_USUARIO_ULT_ALT,
     :old.HR_ULT_ALT,
     --INFORMACOES LOG
     'D' AS TP_ALTERACAO, NULL TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;
   END IF;
END;
