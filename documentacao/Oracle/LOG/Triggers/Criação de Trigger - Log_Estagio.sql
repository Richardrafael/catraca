/* DOCUMENTAÇÃO DE TRIGGER DO PROJETO */
/*         Trigger de Estagio         */
CREATE OR REPLACE TRIGGER port_catraca.TRG_LOG_ESTAGIO
BEFORE UPDATE OR INSERT OR DELETE
ON port_catraca.ESTAGIO
REFERENCING NEW AS NEW OLD AS OLD
  FOR EACH ROW
BEGIN
   IF Inserting THEN

     --INSERT
     INSERT INTO port_catraca.LOG_ESTAGIO
     SELECT SEQ_LOG_ESTAGIO.NEXTVAL,
     --DADOS ALTERADOS
     :new.CD_ESTAGIO,
     :new.NM_ESTAGIO,
     :new.SN_ATIVO,
     :new.HR_INICIO,
     :new.HR_FIM,
     :new.SN_DOM,
     :new.SN_SEG,
     :new.SN_TER,
     :new.SN_QUA,
     :new.SN_QUI,
     :new.SN_SEX,
     :new.SN_SAB,
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
     INSERT INTO port_catraca.LOG_ESTAGIO
     SELECT SEQ_LOG_ESTAGIO.NEXTVAL,
     --DADOS ALTERADOS
     :old.CD_ESTAGIO,
     :old.NM_ESTAGIO,
     :old.SN_ATIVO,
     :old.HR_INICIO,
     :old.HR_FIM,
     :old.SN_DOM,
     :old.SN_SEG,
     :old.SN_TER,
     :old.SN_QUA,
     :old.SN_QUI,
     :old.SN_SEX,
     :old.SN_SAB,
     --CAMPOS PADRAO
     :old.CD_USUARIO_CADASTRO,
     :old.HR_CADASTRO,
     :old.CD_USUARIO_ULT_ALT,
     :old.HR_ULT_ALT,
     --INFORMACOES LOG
     'U' AS TP_ALTERACAO, 'A' TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;

     --UPDATE (DEPOIS)
     INSERT INTO port_catraca.LOG_ESTAGIO
     SELECT SEQ_LOG_ESTAGIO.NEXTVAL,
     --DADOS ALTERADOS
     :new.CD_ESTAGIO,
     :new.NM_ESTAGIO,
     :new.SN_ATIVO,
     :new.HR_INICIO,
     :new.HR_FIM,
     :new.SN_DOM,
     :new.SN_SEG,
     :new.SN_TER,
     :new.SN_QUA,
     :new.SN_QUI,
     :new.SN_SEX,
     :new.SN_SAB,
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
     INSERT INTO port_catraca.LOG_ESTAGIO
     SELECT SEQ_LOG_ESTAGIO.NEXTVAL,
     --DADOS ALTERADOS
     :old.CD_ESTAGIO,
     :old.NM_ESTAGIO,
     :old.SN_ATIVO,
     :old.HR_INICIO,
     :old.HR_FIM,
     :old.SN_DOM,
     :old.SN_SEG,
     :old.SN_TER,
     :old.SN_QUA,
     :old.SN_QUI,
     :old.SN_SEX,
     :old.SN_SAB,
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
