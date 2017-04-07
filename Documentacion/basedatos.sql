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

/**correct structure of a stored procedure**/
delimiter $$
create procedure sp_create_user(ID varchar(100),
    nombre varchar(50),
    correop varchar(50),
    pais  varchar(25),
    role varchar(20),
    password varchar(100),
    activo bit)
    begin
    
    declare result int;
    
	select count(*) into result from usuario where correo=correop;
    
    if result = 0 then
	 insert into usuario values(ID,nombre,correop,pais,role, SHA1(password), activo);
	end if;
    
    end $$
delimiter ;



call sp_create_user('2017007','Melissa', 'kamecast20@hotmail.com','Costa Rica', 'Cliente','perro',1);

drop procedure sp_create_user;

create procedure sp_update_user(IDp varchar(100),
    nombrep varchar(50),
    correop varchar(50),
    paisp  varchar(25),
    passwordp varchar(50),
    activop bit)
    
	 update usuario set nombre=nombrep, correo=correop, pais= paisp, password= passwordp, activo= activop where ID = IDp;  


call sp_update_user('2017006','Monica Ramirez','monicaal@aol.com', 'US','jescasti93',1);


create procedure sp_delete_user(IDp varchar(100))
	delete from usuario where ID = IDp;

create procedure sp_autenticar_usuario(email varchar(50), passwordp varchar(100))

	select * from usuario where correo= email and password = SHA1(passwordp);

call sp_autenticar_usuario('test@altamira.com','cliente');


/**Validar si correo ya existe**/
create procedure sp_correo_si(email varchar(50))
	select count(*) from usuario where correo=email;


drop procedure sp_correo_si;

call sp_correo_si('test@altamira.com', res);

select res;


/**CRECION PROCEDIMIENTOS ALMACENADOS PARA TABLA HABITACION**/
create procedure sp_create_habitacion(ID varchar(100),
    tipo varchar(25),
    disponible bit)
    
    insert into habitacion values(ID, tipo, disponible);
	
    
call sp_create_habitacion('A0003','Sencilla', 0);

alter table habitacion drop precio;

drop procedure sp_create_habitacion;

select * from habitacion;


create procedure sp_cant_disponible_tipo(tipop varchar(25))

	select count(*) from habitacion where tipo = tipop and disponible=1; 
        
create procedure sp_disponible_habitacion(IDp varchar(500))

	select * from habitacion where ID=IDp and disponible=1;


    
call sp_cant_disponible_tipo('Sencilla');    

call sp_disponible_habitacion('A0002');

