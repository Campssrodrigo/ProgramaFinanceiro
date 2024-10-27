-- COMANDO PARA INSERIR
-- insert into nome_da_tabela (colunas) values (valores)

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Roqfeler','Rockimc@gmail.com','ricorico','2024-07-10');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Xonegao','ximbica@gmail.com','palavracruzada','2024-07-14');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('MaodeDeus','kakaka@gmail.com','lindaparis','2024-08-14');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('VitóriaSegredos','sicretsvitoria@gmail.com','vitorinha123','2024-10-10');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Chapameuchapa','severja@gmail.com','soverte123','2024-09-10');

-- --------------------------------------- CATEGORIA -------------------------------

insert into tb_categoria
(nome_categoria, id_usuario)
values
('chapa', 9);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('lanche', 9);

-- ---------------------------------------- EMPRESA ------------------------------------

insert into tb_empresa
(nome_empresa,telefone_empresa, endereco_empresa, id_usuario)
values
('EmpreendoComSeuDinheiro', '43123789456', 'Rua Banco', 9);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Tofora','5543986385','Da Rua', 9);

-- ---------------------------------------- CONTA ------------------------------------

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('BB','8899','147852', 252.20, 9);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Bradesco','9910', '369852', 9999.99, 9);

-- ---------------------------------------- MOVIMENTO ------------------------------------
insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta,id_categoria, id_usuario)
values
(1,'2024-11-11',9999,'mega-sena',5,5,5,6);

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta,id_categoria, id_usuario)
values
(2,'2024-12-12',09.12,'pagamento adiantado',6,6,6,6);

