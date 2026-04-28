CREATE DATABASE gerenciamento_estoque;

USE gerenciamento_estoque;

CREATE TABLE stock (
	id INT AUTO_INCREMENT PRIMARY KEY,
    stock_name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE usuarios ( 
id INT AUTO_INCREMENT PRIMARY KEY,  
id_stock INT,
imagem_path VARCHAR(255),
firstname VARCHAR(100) NOT NULL,  
lastname VARCHAR(100) NOT NULL, 
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,  
access_level ENUM('admin', 'operador', 'visualizador'), 
created_in DATETIME DEFAULT CURRENT_TIMESTAMP ,
CONSTRAINT fk_usuarios_stock FOREIGN KEY (id_stock) REFERENCES stock(id)
); 

CREATE TABLE usuario_log (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    status_online BOOLEAN,
    ultima_atividade DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario_log_usuario
        FOREIGN KEY (id_usuario)
        REFERENCES usuarios (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_stock INT,
    imagem_path VARCHAR(255),
    produto VARCHAR(100) NOT NULL,
    categoria ENUM(
    'Alimentos e Bebidas',
    'Higiene e Limpeza',
    'Eletrônicos',
    'Vestuário',
    'Móveis e Decoração',
    'Construção e Ferramentas',
    'Farmácia e Saúde',
    'Automotivo'
	) NOT NULL,
    preco_compra DECIMAL(10,2) NOT NULL,
    preco_venda DECIMAL(10,2) NOT NULL,
    estoque INT,
    estoque_minimo INT,
    adicionado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_validade DATE,
    lote VARCHAR(50),
    unidade_medida ENUM('quilograma','metro','metro quadrado','nenhuma') NOT NULL,
    marca VARCHAR(100),
    CONSTRAINT fk_produtos_stock FOREIGN KEY (id_stock) REFERENCES stock(id)
);