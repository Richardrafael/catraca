/*  DOCUMENTAÇÃO DE TABELAS DO PROJETO */
/*  Tabela LOG de Crachas X Catracas   */

/*  TP_ALTERACAO: I -> INSERT          */
/*                U -> UPDATE          */
/*                D -> DELETE          */

--DROPANDO TABELA
DROP TABLE port_catraca.LOG_CRACHAS;

--CRIANDO TABELA
CREATE TABLE port_catraca.LOG_CRACHAS(
CD_REGISTRO_LOG                 INT NOT NULL,
--DADOS ALTERADOS
CD_REGISTRO                     INT NOT NULL,
CD_CRACHA                       VARCHAR(12) NOT NULL,
TIPO                            VARCHAR(2),
CD_CATRACA                      INT NOT NULL,
--CAMPOS PADRAO
CD_USUARIO_CADASTRO             VARCHAR(12),
HR_CADASTRO                     TIMESTAMP,
--INFORMACOES LOG
TP_ALTERACAO                    VARCHAR(1) NOT NULL,
TP_UPDATE                       VARCHAR(1),
HR_LOG                          TIMESTAMP NOT NULL,
CD_USUARIO_DB_LOG               VARCHAR(40),

--PK
CONSTRAINT PK_CD_REGISTRO_LOG_CRACHA PRIMARY KEY (CD_REGISTRO_LOG)
);

--SEQUENCE  
DROP SEQUENCE port_catraca.SEQ_LOG_CRACHA;

CREATE SEQUENCE port_catraca.SEQ_LOG_CRACHA  
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

--SELECT
SELECT * FROM port_catraca.LOG_CRACHAS lg ORDER BY lg.CD_REGISTRO_LOG
