create database in_mantenimiento;

use in_mantenimiento;

create table usuarios(
id_usuarios int auto_increment,
nombre varchar(50),
apellido varchar(50),
contrasenia text(50),
fechaCaptura date,
primary key(id_usuarios) 
);

create table roles(
id_roles int auto_increment,
id_usuarios int not null,
nombreRol varchar(50),
primary key(id_roles)
);

create table tareas(
id_tareas int auto_increment,
nombreTarea varchar(100),
personaNombre varchar(50),
descripcion varchar(300),
primary key(id_tareas)
);

create table inventario(
id_inventario int auto_increment,
nombre_articulo varchar(150),
tipo_modelo varchar(150),
color varchar(50),
marca varchar(50),
medida varchar(50),
existencia int,
entrada int,
salida int,
primary key(id_inventario)
);