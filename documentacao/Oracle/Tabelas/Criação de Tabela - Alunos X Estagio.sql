/* DOCUMENTAÇÃO DE TABELAS DO PROJETO */
/*  Tabela de Alunos X Estagio*/

--DROPANDO TABELA
DROP TABLE port_catraca.ALUNOS_ESTAGIO;

--CRIANDO TABELA
CREATE TABLE port_catraca.ALUNOS_ESTAGIO(
CD_ALUNO_ESTAGIO    INT NOT NULL,
CD_ESTAGIO          INT NOT NULL,
CD_ALUNO            INT NOT NULL,
SN_ATIVO            VARCHAR(1),
CD_USUARIO_CADASTRO VARCHAR(12),
HR_CADASTRO         TIMESTAMP,
CD_USUARIO_ULT_ALT  VARCHAR(12),
HR_ULT_ALT          TIMESTAMP,

--PK
CONSTRAINT PK_CD_ALUNO_ESTAGIO PRIMARY KEY (CD_ALUNO_ESTAGIO)
);

--SEQUENCE  
DROP SEQUENCE port_catraca.SEQ_CD_ALUNO_ESTAGIO;

CREATE SEQUENCE port_catraca.SEQ_CD_ALUNO_ESTAGIO  
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

--SELECT
SELECT * FROM port_catraca.ALUNOS_ESTAGIO aluest ORDER BY aluest.CD_ESTAGIO

--INSERT
INSERT INTO port_catraca.ALUNOS_ESTAGIO
SELECT
port_catraca.SEQ_CD_ALUNO_ESTAGIO.NEXTVAL AS CD_ALUNO_ESTAGIO,
'1' AS CD_ESTAGIO,
'37' AS CD_ALUNO,
'A' AS SN_ATIVO,
'000001430000' as CD_USUARIO_CADASTRO,
SYSDATE AS HR_CADASTRO,
NULL AS CD_USUARIO_ULT_ALT,
NULL AS HR_ULT_ALT
FROM DUAL;

UPDATE port_catraca.ESTAGIO est
SET est.CD_TURMA = '15'
WHERE NM_ALUNO = 'TESTE14'
