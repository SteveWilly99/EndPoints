

-- tables
-- Table: Dado
CREATE TABLE Dado (
    id int  NOT NULL AUTO_INCREMENT,
    cantidadCaras int  NOT NULL,
    color varchar(20)  NOT NULL,
    disenio varchar(20)  NOT NULL,
    CONSTRAINT Dado_pk PRIMARY KEY (id)
);

-- Table: HistorialTiros
CREATE TABLE HistorialTiros (
    id int  NOT NULL AUTO_INCREMENT,
    Usuario_id int  NOT NULL,
    Dado_id int  NOT NULL,
    cantidadDados int  NOT NULL,
    valorObtenido int  NOT NULL,
    fecha date  NOT NULL,
    hora time  NOT NULL,
    CONSTRAINT HistorialTiros_pk PRIMARY KEY (id)
);

-- Table: Usuario
CREATE TABLE Usuario (
    id int  NOT NULL AUTO_INCREMENT,
    nombre varchar(50)  NOT NULL,
    correo varchar(100)  NOT NULL,
    contrasenia varchar(50)  NOT NULL,
    CONSTRAINT Usuario_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: HistorialTiros_Dado (table: HistorialTiros)
ALTER TABLE HistorialTiros ADD CONSTRAINT HistorialTiros_Dado FOREIGN KEY HistorialTiros_Dado (Dado_id)
    REFERENCES Dado (id);

-- Reference: HistorialTiros_Usuario (table: HistorialTiros)
ALTER TABLE HistorialTiros ADD CONSTRAINT HistorialTiros_Usuario FOREIGN KEY HistorialTiros_Usuario (Usuario_id)
    REFERENCES Usuario (id);

-- Insercion de datos
INSERT INTO Dado (cantidadCaras, color, disenio) VALUES
(6, 'Rojo', 'Clasico'),
(20, 'Azul', 'Numerado'),
(12, 'Verde', 'Fantastico'),
(4, 'Negro', 'Piramide'),
(8, 'Amarillo', 'Octogonal');

INSERT INTO Usuario (nombre, correo, contrasenia) VALUES
('Carlos Mendoza', 'carlos.mendoza@gmail.com', 'password123'),
('Andrea López', 'andrea.lopez@hotmail.com', 'andrea2024'),
('Juan Pérez', 'juan.perez@yahoo.com', 'juanpass'),
('Sofía Torres', 'sofia.torres@outlook.com', 'torres321'),
('Luis Gómez', 'luis.gomez@gmail.com', 'luisclave');


INSERT INTO HistorialTiros (Usuario_id, Dado_id, cantidadDados, valorObtenido, fecha, hora) VALUES
-- Datos  (Usuario_id = 1)
(1, 1, 2, 8, '2024-11-20', '10:30:45'),
(1, 3, 1, 10, '2024-11-20', '11:15:20'),
(1, 5, 3, 18, '2024-11-20', '12:00:00'),

-- Datos  (Usuario_id = 2)
(2, 2, 1, 15, '2024-11-20', '13:10:05'),
(2, 4, 2, 6, '2024-11-20', '13:50:30'),
(2, 1, 1, 5, '2024-11-20', '14:25:40'),

-- Datos (Usuario_id = 3)
(3, 5, 2, 12, '2024-11-20', '15:40:15'),
(3, 3, 1, 7, '2024-11-20', '16:00:00'),
(3, 4, 3, 10, '2024-11-20', '16:45:25'),

-- Datos  (Usuario_id = 4)
(4, 2, 2, 18, '2024-11-20', '17:15:10'),
(4, 1, 1, 6, '2024-11-20', '17:50:05'),
(4, 5, 3, 21, '2024-11-20', '18:30:00'),

-- Datos  (Usuario_id = 5)
(5, 3, 2, 14, '2024-11-20', '19:05:45'),
(5, 2, 1, 12, '2024-11-20', '19:45:20'),
(5, 4, 2, 8, '2024-11-20', '20:30:10');

