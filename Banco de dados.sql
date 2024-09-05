CREATE TABLE usuarios (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    senha varchar(255) NOT NULL,
    criado_em timestamp NULL DEFAULT current_timestamp,
    atualizado_em timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE INDEX AK_0 (email),
    CONSTRAINT usuarios_pk PRIMARY KEY (id)
);

CREATE TABLE enderecos (
    id int NOT NULL AUTO_INCREMENT,
    usuario_id int NULL,
    rua varchar(255) NOT NULL,
    numero varchar(50) NOT NULL,
    complemento varchar(255) NULL,
    bairro varchar(255) NOT NULL,
    cidade varchar(255) NOT NULL,
    estado varchar(50) NOT NULL,
    cep varchar(20) NOT NULL,
    criado_em timestamp NULL DEFAULT current_timestamp,
    atualizado_em timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT enderecos_pk PRIMARY KEY (id)
);

CREATE TABLE produtos (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    descricao text NULL,
    preco decimal(10,2) NOT NULL,
    estoque int NOT NULL,
    criado_em timestamp NULL DEFAULT current_timestamp,
    atualizado_em timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT produtos_pk PRIMARY KEY (id)
);

CREATE TABLE cupons (
    id int NOT NULL AUTO_INCREMENT,
    codigo varchar(50) NOT NULL,
    descricao text NULL,
    desconto decimal(5,2) NOT NULL,
    expiracao timestamp NULL,
    criado_em timestamp NULL DEFAULT current_timestamp,
    atualizado_em timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE INDEX AK_1 (codigo),
    CONSTRAINT cupons_pk PRIMARY KEY (id)
);

CREATE TABLE transacoes (
    id int NOT NULL AUTO_INCREMENT,
    usuario_id int NULL,
    cupom_id int NULL,
    status varchar(50) NOT NULL,
    total decimal(10,2) NULL,
    criado_em timestamp NULL DEFAULT current_timestamp,
    atualizado_em timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT transacoes_pk PRIMARY KEY (id)
);

CREATE TABLE transacoes_itens (
    id int NOT NULL AUTO_INCREMENT,
    transacao_id int NULL,
    produto_id int NULL,
    quantidade int NOT NULL,
    CONSTRAINT transacoes_itens_pk PRIMARY KEY (id)
);

ALTER TABLE transacoes_itens ADD CONSTRAINT fk_transacao FOREIGN KEY (transacao_id)
    REFERENCES transacoes (id)
    ON DELETE CASCADE;

ALTER TABLE transacoes_itens ADD CONSTRAINT fk_produto_transacao FOREIGN KEY (produto_id)
    REFERENCES produtos (id);

ALTER TABLE transacoes ADD CONSTRAINT fk_usuario_transacao FOREIGN KEY (usuario_id)
    REFERENCES usuarios (id)
    ON DELETE SET NULL;

ALTER TABLE transacoes ADD CONSTRAINT fk_cupom_transacao FOREIGN KEY (cupom_id)
    REFERENCES cupons (id)
    ON DELETE SET NULL;

ALTER TABLE enderecos ADD CONSTRAINT fk_usuario_endereco FOREIGN KEY (usuario_id)
    REFERENCES usuarios (id)
    ON DELETE SET NULL;
