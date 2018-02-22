DROP TABLE IF EXISTS Login;
DROP TABLE IF EXISTS Usuario;


CREATE TABLE Usuario (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    username VARCHAR(255),
    passwd VARCHAR(255),
    nombre VARCHAR(255),
    apellido VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE, 
    tipoUsuario ENUM('Alumno','Profesor','Administrador'),
    estudios ENUM('ESO', 'Bachillerato', 'FP'),
    grupoAlumno ENUM('A','B','C','D','E','F','G'),
    cursoAlumno INT check (cursoAlumno > 0 && cursoAlumno =< 6),
    telefono INT,
    departamento ENUM('Actividades Extraescolares', 'Asistencia a la direccion','Biologia y Geologia','Comercio y Marketing',
    'Dibujo','Educacion Fisica','Fol y Economia', 'Filosofia','Formacion Evaluacion e Innovacion','Frances','Fisica y Quimica',
    'Geografia e Historia', 'Informatica','Ingles','Latin y Griego', 'Lengua','Matematicas','Musica','Orientacion', 'Religion',
    'Tecnologia');
);

CREATE TABLE Login(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	time_stamp TIMESTAMP,
	usuario INT REFERENCES Usuario(id),
	exito BOOLEAN
	
);
