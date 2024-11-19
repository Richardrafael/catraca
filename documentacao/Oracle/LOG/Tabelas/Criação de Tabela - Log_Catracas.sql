/*  DOCUMENTA��O DE TABELAS DO PROJETO */
/*        Tabela LOG de Catracas       */

/*  TP_ALTERACAO: I -> INSERT          */
/*                U -> UPDATE          */
/*                D -> DELETE          */

--DROPANDO TABELA
DROP TABLE port_catraca.LOG_CATRACAS;

--CRIANDO TABELA
CREATE TABLE port_catraca.LOG_CATRACAS(
CD_REGISTRO_LOG                     INT NOT NULL,
--DADOS ALTERADOS
CD_CATRACA                          INTEGER NOT NULL,
NM_CATRACA                          NVARCHAR2(50) NOT NULL,
DS_CATRACA                          NVARCHAR2(100) NOT NULL,
ID_CATRACA                          NVARCHAR2(20) NOT NULL,
SN_ATIVO                            NVARCHAR2(1) NOT NULL,
--CAMPOS PADRAO
CD_USUARIO_CADASTRO                 VARCHAR2(12),
HR_CADASTRO                         TIMESTAMP,
CD_USUARIO_ULT_ALT                  VARCHAR2(12),
HR_ULT_ALT                          TIMESTAMP,
--INFORMACOES LOG
TP_ALTERACAO                        VARCHAR(1) NOT NULL,
TP_UPDATE                           VARCHAR(1),
HR_LOG                              TIMESTAMP NOT NULL,
CD_USUARIO_DB_LOG                   VARCHAR(40),

IP_CATRACA                          NVARCHAR2(20) NOT NULL,

--PK
CONSTRAINT PK_CD_REGISTRO_LOG_CATRACAS PRIMARY KEY (CD_REGISTRO_LOG)
);

--SEQUENCE  
DROP SEQUENCE port_catraca.SEQ_LOG_CATRACAS;

CREATE SEQUENCE port_catraca.SEQ_LOG_CATRACAS  
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

--SELECT
SELECT * FROM port_catraca.LOG_CATRACAS lg ORDER BY lg.CD_REGISTRO_LOG

--INSERT
INSERT INTO port_catraca.LOG_CATRACAS
SELECT
FROM DUAL
