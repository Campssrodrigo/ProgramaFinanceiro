-- Quais usuários tem a letra N
select nome_usuario, data_cadastro
	from tb_usuario
    where nome_usuario like '%n%'
    ;
    
 -- Quais usuários tem a letra inicial X
 select nome_usuario, data_cadastro
	from tb_usuario
    where nome_usuario like 'x%'
    ;
    
-- Quais usuários tem a letra Final R
 select nome_usuario, data_cadastro
	from tb_usuario
    where nome_usuario like '%r'
    ;
    
-- Usuarios determinado periodo de cadastro entre
 select nome_usuario, data_cadastro
	from tb_usuario
    where data_cadastro between '2024-01-15' and '2024-12-31'
    ;
    
-- Todas as contas cadastradas do usuario

select banco_conta, agencia_conta, saldo_conta
from tb_conta
where id_usuario = 5;

-- lalalalalalalala
select tipo_movimento,
		date_format(data_movimento, "%d/%m/%Y") as data_movimento,
        valor_movimento,
        nome_categoria,
        obs_movimento,
        nome_empresa,
        nome_usuario,
        banco_conta
from	tb_movimento
inner join tb_categoria
on 		tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
on		tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
on		tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
on		tb_conta.id_conta = tb_movimento.id_conta
where tb_movimento.tipo_movimento = 1
	and tb_movimento.obs_movimento is not null;
    
    
select sum(valor_movimento) as total
from tb_movimento
where tipo_movimento = 1
and id_usuario = 5;
    
