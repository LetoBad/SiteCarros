Código MySQL: CREATE DATABASE sistema_veiculos;
USE sistema_veiculos;

-- Crear tabla de usuarios
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Crear tabla de categorías
CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Crear tabla de vehículos
CREATE TABLE veiculo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa CHAR(7) NOT NULL UNIQUE,
    cor VARCHAR(50),
    modelo VARCHAR(100) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    ano SMALLINT,
    id_categoria INT NOT NULL,
    imagem VARCHAR(255),
    INDEX (id_categoria),
    FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);

-- Insertar usuario admin
INSERT INTO usuario(nome, email, senha) VALUES ('admin', 'admin@gmail.com', 'admin');

-- Insertar categorías necesarias
INSERT INTO categoria(nome) VALUES ('Hatch'), ('Sedan'), ('SUV'), ('Pickup');

-- Insertar vehículos
INSERT INTO veiculo (placa, cor, modelo, marca, ano, id_categoria, imagem) VALUES
('FRG0001', 'Preto', 'Onix Joy 1.0', 'Chevrolet', 2019, 1, 'img1.jpg'),
('FRG0002', 'Gris', 'Prisma', 'Chevrolet', 2021, 2, 'img2.jpg'),
('FRD1111', 'Prata', 'Amarok', 'Volkswagen', 2020, 2, 'img3.jpg'),
('RAE0213', 'Prata', 'Fiesta Hatch', 'Ford', 2013, 3, 'img4.jpg'),
('MAK1921', 'Vermelho', 'Gol G6', 'Volkswagen', 2015, 3, 'img5.jpg'),
('FRD8741', 'Prata', 'Aveo', 'Chevrolet', 2013, 4, 'img6.jpg'),
('MAA3411', 'Grafite', 'Tiguan', 'Volkswagen', 2020, 4, 'img7.jpg'),
('FRF5455', 'Vermelho', 'Strada Adventure', 'Fiat', 2015, 1, 'img8.jpg');
