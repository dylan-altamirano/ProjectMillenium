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

-- Procedimiento almacenado que se utilizará para guardar reservaciones
create procedure sp_insert_reservacion(idp varchar(100),
    fecha_inip datetime,
    fecha_finp datetime,
    IDUsuariop varchar(100),
    totalp float,
    estadop varchar(20))
		
	insert into reservacion_enc values(idp, fecha_inip,fecha_finp, IDUsuariop, totalp,estadop);


-- Procedimiento que actualiza la reservacion realizada
create procedure sp_update_reservacion(idp varchar(100),
    fecha_inip datetime,
    fecha_finp datetime,
    IDUsuariop varchar(100),
    totalp float,
    estadop varchar(20))
		
        update reservacion_enc set fecha_ini = fecha_inip, fecha_fin = fecha_finp, total = totalp, estado = estadop where ID = idp;
        
 -- Fin del procedimiento almacenado    
 
 -- Procedimiento almacenado que devuelve un registro dependiendo del número de factura
 create procedure sp_select_reservacion(id varchar(100))
		select * from reservacion_enc where ID = id;

-- Fin del procedimiento almacenado

-- Procedimiento almacenado que elimina las reservaciones
create procedure sp_delete_reservacion(id varchar(100))
	delete from reservacion where ID = id;
    
-- Fin del procedimiento almacenado    

use db_hotel;

call sp_insert_reservacion('106', '2017-04-29 00:00:00','2017-05-02 00:00:00', '2017007', 200.00,'Facturado');

select * from usuario;

select * from reservacion_enc;
select * from habitacion;

delete from reservacion_enc where ID='100';

insert into reservacion_detalle values('106','A0005');
select * from reservacion_detalle;

/**Creación de consulta-parte 1**/
select * from reservacion_enc where fecha_ini='2017-04-07 00:00:00' and fecha_fin='2017-04-08 00:00:00';

select * from reservacion_detalle where IDReservacion_enc ='100';

/**Creación de consulta-parte 2 Consulta a utilizar para verificar la disponibilidad de campos**/
select IDHabitacion from reservacion_detalle join reservacion_enc on reservacion_detalle.IDReservacion_enc= reservacion_enc.ID where fecha_ini >= '2017-04-02 00:00:00' and  fecha_fin <='2017-04-06 00:00:00' and estado='Facturado' group by IDHabitacion;


alter table reservacion_enc
add constraint PK_reservacion_enc primary key(ID);

alter table reservacion_enc
add constraint FK_reservacion_enc foreign key(IDUsuario) references usuario(ID) on delete cascade;


create table reservacion_detalle
(
	IDReservacion_enc varchar(100) not null,
    IDHabitacion varchar(100) not null
);

-- Procedimiento almacenado que guarda un nuevo registro en la tabla reservacion_detalle
create procedure sp_insert_detalle(IDReservacion_encp varchar(100) ,
    IDHabitacionp varchar(100) )

	insert into reservacion_detalle values(IDReservacion_encp,IDHabitacionp);
    
-- Fin del procedimiento almacenado    

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



call sp_create_user('2017007','Melissa', 'melartavia@cr.ibm.com','Costa Rica', 'Cliente','perro',1);

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

call sp_correo_si('cerdilan@amazon.com');


/**CRECION PROCEDIMIENTOS ALMACENADOS PARA TABLA HABITACION**/
create procedure sp_create_habitacion(ID varchar(100),
    tipo varchar(25),
    disponible bit)
    
    insert into habitacion values(ID, tipo, disponible);
	
    
call sp_create_habitacion('STH-002','Suite', 1);

alter table habitacion drop precio;

drop procedure sp_create_habitacion;

select * from habitacion;


create procedure sp_cant_disponible_tipo(tipop varchar(25))

	select count(*) from habitacion where tipo = tipop and disponible=1; 
        
create procedure sp_disponible_habitacion(IDp varchar(500))

	select * from habitacion where ID=IDp and disponible=1;


    
call sp_cant_disponible_tipo('Sencilla');    

call sp_disponible_habitacion('A0002');


use db_hotel;

-- Tabla temporal que almacenará los ID de las reservaciones que concuerden con la
-- fecha de reservación elegida por el usuario.
-- Esta información será eliminada cada vez que se cree un nuevo rango de busqueda.
create table tb_temp_reservaciones
(

	ID varchar(100)
)

select * from tb_temp_reservaciones;

    -- Eliminamos todo el contenido de la tabla temporal antes de comenzar
    delete from tb_temp_reservaciones;

drop procedure sp_reservadas;

    -- Eliminamos todo el contenido de la tabla temporal antes de comenzar
    delete from tb_temp_reservaciones;

/**Creación del procedimiento Encontrar reservadas-con cursor**/

delimiter $$

create procedure sp_reservadas(initial_date datetime, final_date datetime)
begin

	DECLARE id varchar(100);
	DECLARE arrival_date datetime;
    DECLARE departure_date datetime;
    DECLARE done int default 0;
    DECLARE codigo varchar(100);
    
    -- Creacion del cursor 
    declare f_cursor cursor for select ID, fecha_ini, fecha_fin from reservacion_enc;
    
    declare continue handler for not found set done = 1;
    
    -- Abrimos el cursor
    open f_cursor;
 
    -- Empezamos el loop
   read_loop: LOOP
    
    -- Obtenemos los valores del conjunto de datos del registro actual donde apunta el cursor
    fetch f_cursor into id, arrival_date, departure_date;
    
    set codigo = id;
    
    if  done = 1 then
		
        leave read_loop;
    
    else
     if (arrival_date < initial_date) && (departure_date < final_date || departure_date>final_date) then
		if not departure_date < initial_date then
			-- insert into tb_temp_reservaciones values(codigo);
            select * from reservacion_enc where ID = codigo;
            
        end if;    
     else
		if arrival_date >= initial_date && arrival_date <= final_date then
			if departure_date <= final_date || departure_date > final_date then
				 select * from reservacion_enc where ID = codigo;
            end if;    
        
        end if;
     end if;
    end if; 
    -- Terminamos el loop
    END LOOP;
	-- Cerramos el cursor
    close f_cursor;
	

end $$
delimiter ;




call sp_reservadas('2017-04-02 00:00:00','2017-04-06 00:00:00');


use db_hotel;

/**
*Procedimiento que solo lanza las reservaciones que han sido facturadas, no las cotizaciones
**/
delimiter $$
create procedure sp_get_booked_rooms()
begin

select reservacion_enc.ID, fecha_ini, fecha_fin, IDHabitacion, tipo from reservacion_enc join reservacion_detalle on reservacion_enc.ID = reservacion_detalle.IDReservacion_enc  join habitacion on habitacion.ID = reservacion_detalle.IDHabitacion where estado='Facturado';

end $$

delimiter ;

drop procedure sp_get_booked_rooms;

call sp_get_booked_rooms;

select * from reservacion_enc;


delete from reservacion_enc where ID ='105';

select * from habitacion;

delimiter $$
create procedure sp_get_rooms(tipop varchar(20))
begin

select ID, tipo from habitacion where tipo = tipop;

end $$

delimiter ;

delimiter $$
-- Procedimiento que obtiene el valor máximo del ID de la reservacion
create procedure sp_get_last_id()
   select max(ID) from reservacion_enc;

delimiter ;

call sp_get_last_id;

select * from usuario;

select * from reservacion_enc;


call sp_create_user('2017008','Alexandra','alex@sbcglobal.net','US','Cliente','almeda',1);

select * from reservacion_detalle;

delete from reservacion_enc where IDUsuario = '2017008';
