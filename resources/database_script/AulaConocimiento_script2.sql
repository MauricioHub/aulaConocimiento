--
--ER/Studio 6.5 SQL Code Generation
-- Company :      Hewlett-Packard
-- Project :      hogar de cristo robotica.DM1
-- Author :       gjorgeh@hotmail.com
--
-- Date Created : Saturday, September 03, 2016 19:37:10
-- Target DBMS : MySQL 3.x
--

-- 
-- TABLE: curso 
--

CREATE TABLE curso(
    id              INT         AUTO_INCREMENT,
    nombre          TEXT        NOT NULL,
    descripcion     TEXT        NOT NULL,
    duracion        INT         NOT NULL,
    fecha_inicio    DATE,
    fecha_fin       CHAR(10),
    id_profesor     INT         NOT NULL,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: curso_estudiante 
--

CREATE TABLE curso_estudiante(
    id                INT         AUTO_INCREMENT,
    fecha_registro    DATETIME    NOT NULL,
    calificacion      FLOAT,
    id_estudiante     INT,
    id_curso          INT,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: detalle_evaluacion 
--

CREATE TABLE detalle_evaluacion(
    id                           INT    NOT NULL,
    id_evaluacion                INT    NOT NULL,
    id_pregunta                  INT,
    id_respuesta_seleccionada    INT,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: estudiante 
--

CREATE TABLE estudiante(
    id                  INT            AUTO_INCREMENT,
    apellidos           TEXT           NOT NULL,
    nomrbes             TEXT           NOT NULL,
    cedula              VARCHAR(10),
    direccion           TEXT,
    fecha_nacimiento    DATE,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: evaluacion 
--

CREATE TABLE evaluacion(
    id               INT         AUTO_INCREMENT,
    fecha            DATETIME,
    tiempo           TEXT,
    calificacion     FLOAT,
    id_estudiante    INT,
    id_taller        INT,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: pregunta 
--

CREATE TABLE pregunta(
    id           INT     AUTO_INCREMENT,
    enunciado    TEXT    NOT NULL,
    id_taller    INT     NOT NULL,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: profesor 
--

CREATE TABLE profesor(
    id                  INT            AUTO_INCREMENT,
    cedula              VARCHAR(10),
    apellidos           TEXT           NOT NULL,
    nombres             TEXT           NOT NULL,
    direccion           TEXT,
    fecha_nacimiento    DATE,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: recurso 
--

CREATE TABLE recurso(
    id                INT     AUTO_INCREMENT,
    nombre_archivo    TEXT    NOT NULL,
    ruta              TEXT,
    link              TEXT,
    archivo           MEDIUMBLOB,
    extension         TEXT,
    id_taller         INT,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: respuesta 
--

CREATE TABLE respuesta(
    id             INT     AUTO_INCREMENT,
    respuesta      TEXT,
    es_correcta    BIT     NOT NULL,
    id_pregunta    INT     NOT NULL,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- TABLE: taller 
--

CREATE TABLE taller(
    id             INT     AUTO_INCREMENT,
    titulo         TEXT    NOT NULL,
    descripcion    TEXT    NOT NULL,
    duracion       INT,
    id_curso       INT,
    PRIMARY KEY (id)
)TYPE=MYISAM
;



-- 
-- INDEX: Ref35 
--

CREATE INDEX Ref35 ON curso(id_profesor)
;
-- 
-- INDEX: Ref12 
--

CREATE INDEX Ref12 ON curso_estudiante(id_estudiante)
;
-- 
-- INDEX: Ref24 
--

CREATE INDEX Ref24 ON curso_estudiante(id_curso)
;
-- 
-- INDEX: Ref520 
--

CREATE INDEX Ref520 ON detalle_evaluacion(id_evaluacion)
;
-- 
-- INDEX: Ref625 
--

CREATE INDEX Ref625 ON detalle_evaluacion(id_pregunta)
;
-- 
-- INDEX: Ref726 
--

CREATE INDEX Ref726 ON detalle_evaluacion(id_respuesta_seleccionada)
;
-- 
-- INDEX: Ref116 
--

CREATE INDEX Ref116 ON evaluacion(id_estudiante)
;
-- 
-- INDEX: Ref418 
--

CREATE INDEX Ref418 ON evaluacion(id_taller)
;
-- 
-- INDEX: Ref415 
--

CREATE INDEX Ref415 ON pregunta(id_taller)
;
-- 
-- INDEX: Ref413 
--

CREATE INDEX Ref413 ON recurso(id_taller)
;
-- 
-- INDEX: Ref614 
--

CREATE INDEX Ref614 ON respuesta(id_pregunta)
;
-- 
-- INDEX: Ref212 
--

CREATE INDEX Ref212 ON taller(id_curso)
;
-- 
-- TABLE: curso 
--

ALTER TABLE curso ADD CONSTRAINT Refprofesor51 
    FOREIGN KEY (id_profesor)
    REFERENCES profesor(id)
;


-- 
-- TABLE: curso_estudiante 
--

ALTER TABLE curso_estudiante ADD CONSTRAINT Refestudiante21 
    FOREIGN KEY (id_estudiante)
    REFERENCES estudiante(id)
;

ALTER TABLE curso_estudiante ADD CONSTRAINT Refcurso41 
    FOREIGN KEY (id_curso)
    REFERENCES curso(id)
;


-- 
-- TABLE: detalle_evaluacion 
--

ALTER TABLE detalle_evaluacion ADD CONSTRAINT Refevaluacion201 
    FOREIGN KEY (id_evaluacion)
    REFERENCES evaluacion(id)
;

ALTER TABLE detalle_evaluacion ADD CONSTRAINT Refpregunta251 
    FOREIGN KEY (id_pregunta)
    REFERENCES pregunta(id)
;

ALTER TABLE detalle_evaluacion ADD CONSTRAINT Refrespuesta261 
    FOREIGN KEY (id_respuesta_seleccionada)
    REFERENCES respuesta(id)
;


-- 
-- TABLE: evaluacion 
--

ALTER TABLE evaluacion ADD CONSTRAINT Refestudiante161 
    FOREIGN KEY (id_estudiante)
    REFERENCES estudiante(id)
;

ALTER TABLE evaluacion ADD CONSTRAINT Reftaller181 
    FOREIGN KEY (id_taller)
    REFERENCES taller(id)
;


-- 
-- TABLE: pregunta 
--

ALTER TABLE pregunta ADD CONSTRAINT Reftaller151 
    FOREIGN KEY (id_taller)
    REFERENCES taller(id)
;


-- 
-- TABLE: recurso 
--

ALTER TABLE recurso ADD CONSTRAINT Reftaller131 
    FOREIGN KEY (id_taller)
    REFERENCES taller(id)
;


-- 
-- TABLE: respuesta 
--

ALTER TABLE respuesta ADD CONSTRAINT Refpregunta141 
    FOREIGN KEY (id_pregunta)
    REFERENCES pregunta(id)
;


-- 
-- TABLE: taller 
--

ALTER TABLE taller ADD CONSTRAINT Refcurso121 
    FOREIGN KEY (id_curso)
    REFERENCES curso(id)
;


