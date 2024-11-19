/* DOCUMENTAÇÃO DE TRIGGER DO PROJETO */
/*  Trigger Temporaria para Cadastrar Alunos do IEP na Tabela de Crachas */
CREATE OR REPLACE TRIGGER port_catraca.TRG_TEMP_CADASTRO_CRACHA_IEP
BEFORE INSERT OR DELETE
ON port_catraca.TERCEIROS
REFERENCING NEW AS NEW OLD AS OLD
  FOR EACH ROW
BEGIN
   IF Inserting THEN
     INSERT INTO port_catraca.CRACHAS
     SELECT port_catraca.SEQ_CRACHA_CATRACA.NEXTVAL AS CD_REGISTRO,
            :new.CRACHA AS CD_CRACHA,
            'T' AS TIPO,
            '6' AS CD_CATRACA,
            'TEMP_IEP' AS CD_USUARIO_CADASTRO,
            SYSDATE AS HR_CADASTRO
     FROM DUAL;
     
   ELSIF Deleting THEN
     DELETE FROM port_catraca.CRACHAS cra
     WHERE cra.CD_CRACHA = :old.CRACHA
     AND cra.TIPO = 'T'
     AND cra.CD_USUARIO_CADASTRO = 'TEMP_IEP'
   END IF;
END;
