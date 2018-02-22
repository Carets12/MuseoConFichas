DROP TABLE IF EXISTS fichas_eliminadas;
DROP TABLE IF EXISTS fichas;
DROP TABLE IF EXISTS reinos;
DROP TABLE IF EXISTS zonas;
DROP TABLE IF EXISTS idiomas;

CREATE TABLE idiomas(
    codigo VARCHAR(2) NOT NULL,
    nombre VARCHAR(255),

    PRIMARY KEY(codigo)
);

CREATE TABLE zonas(
	codigo INT,
	nombre VARCHAR(30),

	PRIMARY KEY(codigo)
);

CREATE TABLE reinos(
	codigo INT,
	nombre VARCHAR(30),

  PRIMARY KEY(codigo)
);

CREATE TABLE fichas (
    id INT NOT NULL AUTO_INCREMENT,
    nombre_comun VARCHAR(40),
    nombre_cientifico VARCHAR(50),
    descripcion VARCHAR(400),
    zona  INT,
    reino INT,
    codigo_qr VARCHAR(255),
    enlace_video VARCHAR(255),
    idioma VARCHAR(2) NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY(idioma) REFERENCES idiomas(codigo),
		FOREIGN KEY(zona) REFERENCES zonas(codigo),
		FOREIGN KEY(reino) REFERENCES reinos(codigo)
);

CREATE TABLE fichas_eliminadas (
    id INT NOT NULL,
    nombre_comun VARCHAR(40),
    nombre_cientifico VARCHAR(50),
    descripcion VARCHAR(400),
    zona INT,
		reino INT,
    codigo_qr VARCHAR(255),
    enlace_video VARCHAR(255),
    idioma VARCHAR(2),
		fecha_de_borrado DATE,

    PRIMARY KEY (id), 
);


CREATE OR REPLACE TRIGGER comprobar_nombre BEFORE INSERT ON fichas
BEGIN 
	IF new.nombre_comun IS NULL OR new.nombre_cientifico IS NULL THEN
	SIGNAL SQLSTATE -20001 SET MESSAGE_TEXT = 'Falta algún nombre';
	END IF;
END;


CREATE OR REPLACE TRIGGER borrado_fichas BEFORE DELETE ON fichas 
BEGIN 
	INSERT INTO fichas_eliminadas(id,nombre_comun,nombre_cientifico,descripcion,zona,codigo_qr,enlace_video,fecha_de_borrado,idioma)
	VALUES (old.id, old.nombre_comun, old.nombre_cientifico,old.descripcion,old.zona,old.codigo_qr,DATETIME('now'),old.idioma);
END;
