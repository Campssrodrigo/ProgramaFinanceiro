-- COMANDO PARA CONSULTAR (READ)
-- * TODAS AS COLUNAS

select * from tb_usuario;

select * from tb_categoria;

select * from tb_empresa;

select * from tb_conta;


select * from tb_movimento;

Truncate table tb_usuario;
Truncate table tb_categoria;
Truncate table tb_empresa;
Truncate table tb_conta;
Truncate table tb_movimento;



alter table tb_usuario auto_increment = 1;
alter table tb_conta auto_increment = 1;
alter table tb_empresa auto_increment = 1;
alter table tb_movimento auto_increment = 1;
alter table tb_categoria auto_increment = 1;