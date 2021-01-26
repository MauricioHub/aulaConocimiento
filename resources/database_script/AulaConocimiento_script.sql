create database aulaConocimiento;

use aulaConocimiento;

create table Ente(
	Ente_ID int not null AUTO_INCREMENT,
	Nombre varchar(255) not null,
	Apellido varchar(255) not null,
	FechaNacimiento date not null,
    activo boolean DEFAULT 1,
    PRIMARY KEY (Ente_ID)
);

create table Usuario(
	Usuario_ID int not null AUTO_INCREMENT,
	Ente_ID int not null,
	Username varchar(255) not null UNIQUE,
	Password varchar(255) not null,
	Rol int not null,
	activo Boolean DEFAULT 1,
	PRIMARY KEY (Usuario_ID),
	FOREIGN KEY (Ente_ID) references Ente(Ente_ID)
);

create table Menu(
	Menu_ID int not null AUTO_INCREMENT,
	Titulo varchar(200) not null UNIQUE,
	Menu_PadreID int not null,
	TieneRecursos
	activo Boolean DEFAULT 1,
);

insert into Ente(Nombre, Apellido, FechaNacimiento,activo) values ("Administrador", "Administrador", curdate(),1);
insert into Usuario(Ente_ID, Username,Password,Rol,activo) values (1, "admin", "admin123", 0, 1);

delete from menu;
ALTER TABLE menu AUTO_INCREMENT = 1