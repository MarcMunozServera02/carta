CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    admin TINYINT NOT NULL DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

#La contraseña es 12345

INSERT INTO usuarios (usuario, contrasena, nombre, email, admin)
VALUES ('prueba', '$2y$10$lE/BZxxUkyHthwyv2odjqevC0VRbIe/yF59r2DX3ypY9SE1UdTs.W', 'Prueba Usuario', 'prueba@gmail.com', 1);
