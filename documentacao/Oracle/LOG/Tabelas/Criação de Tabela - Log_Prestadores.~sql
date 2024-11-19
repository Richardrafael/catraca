/*  DOCUMENTAÇÃO DE TABELAS DO PROJETO */
/*       Tabela LOG de Prestadores     */

/*  TP_ALTERACAO: I -> INSERT          */
/*                U -> UPDATE          */
/*                D -> DELETE          */

--DROPANDO TABELA
DROP TABLE port_catraca.LOG_PRESTADORES;

--CRIANDO TABELA
CREATE TABLE port_catraca.LOG_PRESTADORES(
CD_REGISTRO_LOG                     INT NOT NULL,
--DADOS ALTERADOS
CD_SEQ_PRESTADOR                    INT NOT NULL,
CRACHA                              VARCHAR(12),
NM_PRESTADOR                        VARCHAR(80) NOT NULL,
CPF                                 VARCHAR(11) NOT NULL,
TIPO                                VARCHAR(2) NOT NULL,
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
CONSTRAINT PK_CD_REGISTRO_LOG_PRESTADORES PRIMARY KEY (CD_REGISTRO_LOG)
);

--SEQUENCE  
DROP SEQUENCE port_catraca.SEQ_LOG_PRESTADORES;

CREATE SEQUENCE port_catraca.SEQ_LOG_PRESTADORES  
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

--SELECT
SELECT * FROM port_catraca.LOG_PRESTADORES lg ORDER BY lg.LOG_PRESTADORES
