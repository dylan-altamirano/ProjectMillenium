/**CREACIÓN BASE DATOS db_hotel
*FECHA CREACIÓN: 04/02/2017
AUTOR: DYLAN ALTAMIRANO
**/
create database db_hotel;

use db_hotel;

create table usuario
(
	ID varchar(100),
    nombre varchar(50),
    correo varchar(50),
    pais  varchar(25),
    role varchar(20),
    password varbinary(50),
    activo bit
);

alter table usuario
add constraint PK_usuario primary key(ID);

create table habitacion
(
	ID varchar(100),
    tipo varchar(25),
    precio float,
    disponible bit
);

alter table habitacion
add constraint PK_habitacion primary key(ID);

create table reservacion_enc
(
	ID varchar(100),
    fecha_ini datetime,
    fecha_fin datetime,
    IDUsuario varchar(100),
    total float,
    estado varchar(20)
);

alter table reservacion_enc
add constraint PK_reservacion_enc primary key(ID);

alter table reservacion_enc
add constraint FK_reservacion_enc foreign key(IDUsuario) references usuario(ID) on delete cascade;


create table reservacion_detalle
(
	IDReservacion_enc varchar(100) not null,
    IDHabitacion varchar(100) not null
);

alter table reservacion_detalle
add constraint PK_reservacion_detalle primary key(IDReservacion_enc, IDHabitacion);

alter table reservacion_detalle
add constraint FK_reservacion_detalle foreign key(IDReservacion_enc) references reservacion_enc(ID) on delete cascade;

alter table reservacion_detalle
add constraint FK_reservacion_detalle_habitacion foreign key(IDHabitacion) references habitacion(ID) on delete cascade;

/**INSERTS DE PRUEBA-TABLA USUARIOS**/
insert into usuario values('2017001','admin','admin@altamira.com','Costa Rica','Administrador', SHA1('admin'), 1);

insert into usuario values('2017002','test','test@altamira.com','Costa Rica','Cliente', SHA1('cliente'), 1);

select * from usuario;