PRAGMA FOREIGN_KEY =  ON;

DROP TABLE IF EXISTS fichas;
DROP TABLE IF EXISTS fichas_eliminadas;
DROP TABLE IF EXISTS idiomas;

CREATE TABLE idiomas(
    codigo INT AUTO_INCREMENT,
    nombre VARCHAR(255),

    PRIMARY KEY(codigo)

);

CREATE TABLE fichas (
    id INT NOT NULL AUTO_INCREMENT,
    nombre_comun VARCHAR(40) NOT NULL,
    nombre_cientifico VARCHAR(50) NOT NULL,
    descripcion VARCHAR(400),
    zona  /*VARCHAR(30)*/ ENUM('América','Europa','África','Asia','Oceanía') NOT NULL,
    reino ENUM() NOT NULL,
    codigo_qr VARCHAR(255),
    enlace_video VARCHAR(255),
    idioma VARCHAR(255) NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY(idioma) REFERENCES idiomas(codigo) 
);

CREATE TABLE fichas_eliminadas (
    id INT NOT NULL AUTO_INCREMENT,
    nombre_comun VARCHAR(40) NOT NULL,
    nombre_cientifico VARCHAR(50),
    descripcion VARCHAR(400),
    zona /*VARCHAR(30)*/ ENUM('América','Europa','África','Asia','Oceanía') NOT NULL,
    codigo_qr VARCHAR(255),
    enlace_video VARCHAR(255),
    fecha_de_borrado TEXT,
    idioma VARCHAR(255) NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY(idioma) REFERENCES idiomas(codigo) 
);



CREATE TRIGGER borrado_fichas BEFORE DELETE 
ON fichas 
BEGIN 
INSERT INTO fichas_eliminadas(id,nombre_comun,nombre_cientifico,descripcion,
 zona,codigo_qr,enlace_video,fecha_de_borrado,idioma)
VALUES (old.id, old.nombre_comun, old.nombre_cientifico,old.descripcion,
 old.zona,old.codigo_qr,DATETIME('now'),old.idioma);
END;
