# Expediente Clínico

## Listado de entidades

### clientes **(ED)**

### tipos_de_unidades **(ED)**
- tipo_de_unidad_id **(PK)**
- nombre 

### unidades_medicas **(ED)**
- unidad_medica_id **(PK)**
- nombre **(UQ)**
- direccion
- telefono
- tipo_unidad_id **(FK)**

### roles **(EC)**
- role_id **(PK)**
- role

### usuarios **(ED)**
- usuario_id **(PK)**
- nombre
- apellidos
- username **(UQ)**
- email **(UQ)**
- password
- unidad_medica_id **(FK)**
- role_id **(FK)**

### doctores **(ED)**
- doctor_id **(PK)**
- numero_licencia
- especialidad
- user_id **(FK)**
<!-- - unidad_medica_id **(FK)** -->

### pacientes **(ED)**
- paciente_id **(PK)**
- nombre
- apellidos
- genero
- fecha_nacimiento
- lugar_nacimiento
- telefono **(UQ)**
- curp **(UQ)**
- unidad_medica_id **(FK)**

## citas **(ED)**
- cita_id **(PK)**
- fecha
- estatus
- comentarios
- paciente_id **(FK)**
- doctor_id **(FK)**

### expedientes **(ED)**
- expediente_id **(PK)**
- paciente_id **(FK)**

## Relaciones

1. Una **unidad médica** tiene un **tipo de unidad médica** (_1 - M_).
1. Un **usuario** tiene un **rol** (_1 - M_).
1. Un **usuario** pertenece a una **unidad médica** (_1 - M_).
1. Un **doctor** es un **usuario** (_1 - 1_).
1. Un **doctor** pertenece a una **unidad médica** (_1 - M_).
1. Un **paciente** esta en una **unidad médica** (_1 - M_).
1. Un **paciente** tiene **citas** (_1 - M_).
1. Un **expediente** pertece **paciente** (_1 - 1_).
1. Un **paciente** tiene **citas** (_1 - M_).
1. Un **doctor** tiene **citas** (_1 - M_).


## Diseño de logica

### Obtener listado de doctores en la clínica actual

``` 
SELECT * FROM usuarios WHERE unidad_medica_id = {current_unidad_medica_id} AND role_id = {role_doctor_id}
```



<!-- Table tipos_de_unidades {
  id int [primary key]
  nombre varchar
}

Table unidades_medicas {
  id int [primary key]
  nombre varchar
  direccion varchar
  telefono int
  tipo_unidad_id int [ref: > tipos_de_unidades.id]
}

Table roles {
  id int [primary key]
  role varchar
}

Table usuarios {
  id int [primary key]
  nombre varchar
  apellidos varchar
  username varchar [unique]
  email varchar [unique] 
  password varchar
  unidad_medica_id int [ref: > unidades_medicas.id]
  role_id int [ref: > roles.id]
}

Table doctores {
  id int [primary key]
  numero_licencia int 
  especialidad varchar
  user_id int [ref: - usuarios.id]
}

Table pacientes {
  id int [primary key]
  nombre varchar
  apellidos varchar
  genero varchar
  fecha_nacimiento date
  lugar_nacimiento varchar
  telefono int [unique]
  curp varchar [unique]
  unidad_medica_id int [ref: > unidades_medicas.id]
}

table citas {
cita_id int [primary key]
fecha date
estatus varchar
comentarios text
paciente_id int [ref: > pacientes.id]
}

table expedientes {
expediente_id int [primary key]
paciente_id int [ref: - pacientes.id]
} -->
