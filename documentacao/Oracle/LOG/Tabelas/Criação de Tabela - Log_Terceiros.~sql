/*  DOCUMENTAÇÃO DE TABELAS DO PROJETO */
/*       Tabela LOG de Terceiros       */

/*  TP_ALTERACAO: I -> INSERT          */
/*                U -> UPDATE          */
/*                D -> DELETE          */

--DROPANDO TABELA
DROP TABLE port_catraca.LOG_TERCEIROS;

--CRIANDO TABELA
CREATE TABLE port_catraca.LOG_TERCEIROS(
CD_REGISTRO_LOG                     INT NOT NULL,
--DADOS ALTERADOS
CD_TERCEIRO                         INT NOT NULL,
CRACHA                              VARCHAR(12),
NM_TERCEIRO                         VARCHAR(80) NOT NULL,
DT_NASCIMENTO                       DATE NOT NULL,
RG                                  VARCHAR(9) NOT NULL,
CPF                                 VARCHAR(11) NOT NULL,
CNPJ                                VARCHAR(14) NOT NULL,
NM_EMPRESA                          VARCHAR(80) NOT NULL,
TP_STATUS                           VARCHAR(1) NOT NULL,
DT_INICIO                           DATE NOT NULL,
DT_FIM                              DATE NOT NULL,
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
CONSTRAINT PK_CD_REGISTRO_LOG_TERCEIROS PRIMARY KEY (CD_REGISTRO_LOG)
);

--SEQUENCE  
DROP SEQUENCE port_catraca.SEQ_LOG_TERCEIROS;

CREATE SEQUENCE port_catraca.SEQ_LOG_TERCEIROS  
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

--SELECT
SELECT * FROM port_catraca.LOG_TERCEIROS lg ORDER BY lg.CD_REGISTRO_LOG

--INSERT
INSERT INTO port_catraca.LOG_TERCEIROS
SELECT
FROM DUAL
