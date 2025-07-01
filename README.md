Código MySQL: CREATE DATABASE sistema_veiculos; USE sistema_veiculos;

CREATE TABLE usuario ( id INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE, senha VARCHAR(255) NOT NULL );

CREATE TABLE categoria ( id INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(100) NOT NULL );

CREATE TABLE veiculo ( id INT AUTO_INCREMENT PRIMARY KEY, placa CHAR(7) NOT NULL UNIQUE, cor VARCHAR(50), modelo VARCHAR(100) NOT NULL, marca VARCHAR(100) NOT NULL, ano SMALLINT, id_categoria INT NOT NULL, imagem VARCHAR(255), INDEX (id_categoria), FOREIGN KEY (id_categoria) REFERENCES categoria(id) );

INSERT INTO usuario(nome, email, senha) VALUES ('admin','admin@gmail.com','admin');
INSERT INTO veiculo (placa, cor, modelo, marca, ano, id_categoria, imagem) VALUES ('FRG 0001', 'Preto', 'Onix Joy 1.0', 'Chevrolet', 2019, 1, 'img1.jpg'), ('FRG 0002', 'Gris', 'Prisma', 'Chevrolet', 2021, 2, 'img2.jpg'), ('FRD 1111', 'Prata', 'Amarok ', 'Volkswagen', 2020, 2, 'img3.jpg'), ('RAE 0213', 'Prata', 'Fiesta Hatch', 'Ford', 2013, 3, 'img4.jpg'), ('MAK 1921', 'Vermelho', 'Gol G6', 'Volkswagen', 2015, 3, 'img5.jpg'), ('FRD 8741', 'Prata', 'Aveo', 'Chevrolet', 2013, 4, 'img6.jpg'), ('MAA 3411', 'Grafite', 'Tiguan', 'Volkswagen', 2020, 4, 'img7.jpg'), ('FRF 5455', 'Vermelho', 'Strada Adventure', 'Fiat', 2015, 1, 'img8.jpg');
