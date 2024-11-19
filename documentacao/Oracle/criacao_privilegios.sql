CREATE USER port_catraca IDENTIFIED BY sinuquinha_championship_2023;

GRANT CREATE SESSION TO port_catraca;
GRANT CREATE PROCEDURE TO port_catraca;
GRANT CREATE TABLE TO port_catraca;
GRANT CREATE VIEW TO port_catraca;
GRANT UNLIMITED TABLESPACE TO port_catraca;
GRANT CREATE SEQUENCE TO port_catraca;

GRANT SELECT ON portal_projetos.SEQ_CD_ACESSO TO port_catraca;
GRANT INSERT ON portal_projetos.ACESSO TO port_catraca;

GRANT EXECUTE ON dbasgu.FNC_MV2000_HMVPEP TO port_catraca;

GRANT SELECT ON dbasgu.USUARIOS TO port_catraca;
GRANT SELECT ON dbasgu.PAPEL_USUARIOS TO port_catraca;
