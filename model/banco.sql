CREATE SCHEMA paradisepies;

CREATE TABLE IF NOT EXISTS paradisepies.TB_Torta (
    id INTEGER NOT NULL,
    nome VARCHAR(150) NOT NULL,
    preco REAL NOT NULL,
    descricao VARCHAR(500), 
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS paradisepies.TB_Usuario(
    nome VARCHAR(150) NOT NULL,
    cpf NUMERIC(11) NOT NULL, 
    telefone NUMERIC(11) NOT NULL,
    cidade VARCHAR(30) NOT NULL,
    cep    NUMERIC(8) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    numeroEndereco NUMERIC(5) NOT NULL,
    complementoEndereco VARCHAR(200) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(10) NOT NULL, 

    PRIMARY KEY(cpf)
);

CREATE TABLE IF NOT EXISTS paradisepies.TB_UsuarioFazPedido(
    cpfCliente NUMERIC(11) NOT NULL,
    idPedidoFeito NUMERIC(3) NOT NULL,

    FOREIGN KEY(cpfCliente) REFERENCES paradisepies.TB_usuario(cpf),
    FOREIGN KEY(idPedidoFeito) REFERENCES paradisepies.TB_pedido(idPedido)

);

CREATE TABLE IF NOT EXISTS paradisepies.TB_Pedido(
    idPedido NUMERIC(5) NOT NULL,
    dataEntrega DATE NOT NULL,
    status VARCHAR(15) NOT NULL,
    precoTotal NUMERIC(5,2) NOT NULL,
    CONSTRAINT pedido_torta FOREIGN KEY (idPedido)
    REFERENCES paradisepies.TB_ItemPedido(idTorta),
    PRIMARY KEY(idPedido)
);

CREATE TABLE IF NOT EXISTS paradisepies.TB_ItemPedido(
    idTorta INTEGER NOT NULL,
    idPedido NUMERIC (5) NOT NULL,
    tamanho CHAR CHECK (tamanho IN ('P', 'M', 'G')),
    FOREIGN KEY(idTorta) REFERENCES paradisepies.TB_torta(idTorta),
    FOREIGN KEY(idPedido) REFERENCES paradisepies.TB_pedido(idPedido)
);