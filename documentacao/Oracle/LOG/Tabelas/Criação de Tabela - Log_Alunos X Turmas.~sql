/*  DOCUMENTAÇÃO DE TABELAS DO PROJETO */
/*    Tabela LOG de Alunos X Turmas    */

/*  TP_ALTERACAO: I -> INSERT          */
/*                U -> UPDATE          */
/*                D -> DELETE          */

--DROPANDO TABELA
DROP TABLE port_catraca.LOG_ALUNOS_TURMAS;

--CRIANDO TABELA
CREATE TABLE port_catraca.LOG_ALUNOS_TURMAS(
CD_REGISTRO_LOG                     INT NOT NULL,
--DADOS ALTERADOS
CD_ALUNO                            INT NOT NULL,
CD_TURMA                            INT NOT NULL,
NM_ALUNO                            VARCHAR(80) NOT NULL,
RG                                  VARCHAR(9) NOT NULL,
CD_CRACHA                           VARCHAR(12),
SN_ATIVO                            VARCHAR(1) NOT NULL,
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
CONSTRAINT PK_CD_REGISTRO_LOG_ALUNOS_TURM PRIMARY KEY (CD_REGISTRO_LOG)
);

--SEQUENCE  
DROP SEQUENCE port_catraca.SEQ_LOG_ALUNOS_TURMAS;

CREATE SEQUENCE port_catraca.SEQ_LOG_ALUNOS_TURMAS 
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

--SELECT
SELECT * FROM port_catraca.LOG_ALUNOS_TURMAS lg ORDER BY lg.CD_REGISTRO_LOG

--INSERT
INSERT INTO port_catraca.LOG_ALUNOS_TURMAS
SELECT
FROM DUAL
