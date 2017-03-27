CREATE SCHEMA IF NOT EXISTS paradisepies;

CREATE TABLE IF NOT EXISTS paradisepies.TB_Torta (
    idTorta VARCHAR(2) NOT NULL,
    nome VARCHAR(150) NOT NULL,
    preco REAL NOT NULL,
    descricao VARCHAR(500),
    PRIMARY KEY(idTorta)
);

CREATE TABLE IF NOT EXISTS paradisepies.TB_Usuario(
    nome VARCHAR(150) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    telefone VARCHAR(14) NOT NULL,
    cidade VARCHAR(30) NOT NULL,
    cep    VARCHAR(10) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    numeroEndereco NUMERIC(5) NOT NULL,
    complementoEndereco VARCHAR(200),
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(10) NOT NULL,

    PRIMARY KEY(cpf)
);

CREATE TABLE IF NOT EXISTS paradisepies.TB_UsuarioFazPedido(
    cpfCliente VARCHAR(14) NOT NULL,
    idPedidoFeito NUMERIC(5) NOT NULL,

    FOREIGN KEY(cpfCliente) REFERENCES paradisepies.TB_usuario(cpf),
    FOREIGN KEY(idPedidoFeito) REFERENCES paradisepies.TB_pedido(idPedido)

);

CREATE TABLE IF NOT EXISTS paradisepies.TB_Pedido(
    idPedido NUMERIC(5) NOT NULL,
    dataEntrega DATE NOT NULL,
    status VARCHAR(15) NOT NULL,
    precoTotal REAL NOT NULL,
    CONSTRAINT pedido_torta FOREIGN KEY (idPedido)
    REFERENCES paradisepies.TB_ItemPedido(idTorta),
    PRIMARY KEY(idPedido)
);

CREATE TABLE IF NOT EXISTS paradisepies.TB_ItemPedido(
    idTorta VARCHAR(2) NOT NULL,
    idPedido NUMERIC (5) NOT NULL,
    quantidade NUMERIC NOT NULL,
    FOREIGN KEY(idTorta) REFERENCES paradisepies.TB_torta(idTorta),
    FOREIGN KEY(idPedido) REFERENCES paradisepies.TB_pedido(idPedido)
);




INSERT INTO paradisepies.TB_Torta (idTorta, nome, preco, descricao) VALUES ('t1', 'Torta de Brigadeiro Preto e Morangos', 30.00, 'Torta com base amanteigada e crocante de biscoito tipo maisena, recheio de brigadeiro tradicional com pedacinhos de morangos frescos, decorada com mais morangos.');


INSERT INTO paradisepies.TB_Torta (idTorta, nome, preco, descricao) VALUES ('t2', 'Torta de Brigadeiro de Leite Ninho', 35.00, 'Torta com base amanteigada e crocante de biscoito tipo maisena, recheio de brigadeiro de leite ninho, decorada com raspas de chocolate ao leite e bombons Sonho de Valsa.');


INSERT INTO paradisepies.TB_Torta (idTorta, nome, preco, descricao) VALUES ('t3', 'Torta de Brigadeiro Preto e Branco', 40.00, 'Torta com base amanteigada e crocante de biscoito tipo maisena, recheio de brigadeiro tradicional e brigadeiro branco, decorada com pedaços de bombom Ouro Branco.');
