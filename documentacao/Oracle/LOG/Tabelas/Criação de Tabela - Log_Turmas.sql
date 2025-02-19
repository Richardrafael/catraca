/*  DOCUMENTAÇÃO DE TABELAS DO PROJETO */
/*         Tabela LOG de Turmas        */

/*  TP_ALTERACAO: I -> INSERT          */
/*                U -> UPDATE          */
/*                D -> DELETE          */

--DROPANDO TABELA
DROP TABLE port_catraca.LOG_TURMAS;

--CRIANDO TABELA
CREATE TABLE port_catraca.LOG_TURMAS(
CD_REGISTRO_LOG                     INT NOT NULL,
--DADOS ALTERADOS
CD_TURMA                            INT NOT NULL,
NM_TURMA                            VARCHAR(80) NOT NULL,
SN_ATIVO                            VARCHAR(1),
HR_INICIO                           VARCHAR(5) NOT NULL,
HR_FIM                              VARCHAR(5) NOT NULL,
SN_DOM                              VARCHAR(1),
SN_SEG                              VARCHAR(1),
SN_TER                              VARCHAR(1),
SN_QUA                              VARCHAR(1),
SN_QUI                              VARCHAR(1),
SN_SEX                              VARCHAR(1),
SN_SAB                              VARCHAR(1),
--CAMPOS PADRAO
CD_USUARIO_CADASTRO                 VARCHAR(12),
HR_CADASTRO                         TIMESTAMP,
CD_USUARIO_ULT_ALT                  VARCHAR(12),
HR_ULT_ALT                          TIMESTAMP,
--INFORMACOES LOG
TP_ALTERACAO                        VARCHAR(1) NOT NULL,
TP_UPDATE                           VARCHAR(1),
HR_LOG                              TIMESTAMP NOT NULL,
CD_USUARIO_DB_LOG                   VARCHAR(40),

--PK
CONSTRAINT PK_CD_REGISTRO_LOG_TURMAS PRIMARY KEY (CD_REGISTRO_LOG)
);

--SEQUENCE  
DROP SEQUENCE port_catraca.SEQ_LOG_TURMAS;

CREATE SEQUENCE port_catraca.SEQ_LOG_TURMAS  
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

--SELECT
SELECT * FROM port_catraca.LOG_TURMAS lg ORDER BY lg.CD_REGISTRO_LOG

--INSERT
INSERT INTO port_catraca.LOG_TURMAS
SELECT
FROM DUAL
