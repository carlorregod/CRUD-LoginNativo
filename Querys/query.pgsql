--CREACION DE TABLAS Y ALGUNOS VALORES DE REFERENICIA
drop table if exists usuario1;
create table usuario1(
id serial not null,
nombre varchar not null,
email varchar not null,
usuario varchar not null,
paswd text not null,
token_remember text,
primary key (id)
);

alter table usuario1
   add constraint UQ_usuario
   unique (usuario);
   
--Programando métodos y funciones
--Revisando disponibilidad de usuario
DROP FUNCTION IF EXISTS fn_revisaUsuario(VARCHAR);
CREATE OR REPLACE FUNCTION fn_revisaUsuario(VARCHAR) 
RETURNS BOOLEAN AS
$body$
DECLARE
_nickname ALIAS FOR $1;
--Variable interna
__consulta VARCHAR;
BEGIN
__consulta := (SELECT usuario FROM Usuario1 where usuario=_nickname LIMIT 1);
IF (__consulta is NULL) THEN
    RETURN TRUE;
ELSE
    RETURN FALSE;
END IF;
END;
$body$ LANGUAGE 'plpgsql' volatile;

--Ejemplo: SELECT fn_revisaUsuario('queso70');

--Validando correo
DROP FUNCTION IF EXISTS fn_validacorreo_r(VARCHAR) ;
CREATE OR REPLACE FUNCTION chat.fn_validaCorreo_r (VARCHAR) 
RETURNS BOOLEAN AS
	$body$
		DECLARE
		--Declaración de la variable de entrada
		_email ALIAS FOR $1;
		--Declaración de las variables locales de la función
		__esCorreo BOOLEAN;
		BEGIN
			--IF (textregexeq(_email,'^([a-zA-Z])([\w.-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$')=true) THEN
			IF (textregexeq(_email, E'^([a-zA-Z])([a-zA-Z0-9_.-])+\@(([a-zA-Z0-9\-])+([\.]){1})([a-zA-Z0-9]{2,4})+$') = TRUE) THEN
        __esCorreo :=true;
			ELSE
				__esCorreo :=false;
			END IF;
		RETURN __esCorreo;
		END;
	$body$
Language 'plpgsql';

--Ejemplo: select * from fn_validaCorreo_r('ALGUIE7-N@correo.cl');

--validando nombre
DROP FUNCTION IF EXISTS fn_validaNombre_r(VARCHAR) ;
CREATE OR REPLACE FUNCTION fn_validaNombre_r(VARCHAR) 
RETURNS BOOLEAN AS
	$body$
		DECLARE
		--Declaración de la variable de entrada
		_nombre ALIAS FOR $1;
		BEGIN
			IF(textregexeq(_nombre, E'^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+[\ ]{1}([a-zA-ZñÑáéíóúÁÉÍÓÚ])+') = TRUE)THEN
				RETURN TRUE;
			ELSE
				RETURN FALSE;
			END IF;
		END;
	$body$
Language 'plpgsql' volatile;

--select * from fn_validaNombre_r('ALGUIE SOTO PARRA');

--Validando alias y passwords mínimo 5 caracteres y alfanuméricos, da 3 en este caso
DROP FUNCTION IF EXISTS fn_validaAliasPw_r(VARCHAR);
CREATE OR REPLACE FUNCTION fn_validaAliasPw_r(VARCHAR) 
RETURNS INTEGER AS
$body$
DECLARE
_nickname ALIAS FOR $1;
BEGIN
IF (textregexeq(_nickname, E'([a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+[0-9]+)+|([0-9]+[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+)')=FALSE) THEN
    RETURN 1;
ELSIF (length(_nickname)<6) THEN
    RETURN 2;
ELSE
    RETURN 3;
END IF;
END;
$body$ LANGUAGE 'plpgsql' volatile;
Ejemplo: SELECT fn_validaAliasPw_r('gw12DF');


--HACEMOS EL INSET
--Función de inserción y actualización 
DROP FUNCTION IF EXISTS fn_registroUsuario_i(VARCHAR, VARCHAR, VARCHAR, VARCHAR);
CREATE OR REPLACE FUNCTION fn_registroUsuario_i(VARCHAR, VARCHAR, VARCHAR, VARCHAR) 
RETURNS INTEGER AS
$body$
DECLARE
--Variables internas de entrada
_nombre ALIAS FOR $1;
_correo ALIAS FOR $2;
_usuario ALIAS FOR $3;
_contrasena ALIAS FOR $4;
--Variables locales
__respuesta INTEGER;
BEGIN
--Verificación de las validaciones
IF(_nombre IS NULL OR _correo IS NULL OR _usuario IS NULL OR _contrasena IS NULL) THEN
	__respuesta:= -1; --Campos vacíos

ELSIF (SELECT NOT fn_validaNombre_r(_nombre)) THEN
    __respuesta:= 1;  --Nombre vacío

ELSIF (SELECT NOT fn_validacorreo_r(_correo)) THEN
     __respuesta:=2;   --Correo no válido
     
ELSIF (SELECT fn_validaAliasPw_r(_usuario) = 1 ) THEN
     __respuesta:=3;   --Alias no tiene letra+número
ELSIF (SELECT fn_validaAliasPw_r(_usuario) = 2 ) THEN
     __respuesta:=4;   --Alias no posee largo establecido

--VALIDACIONES OK. SE PROCEDERÁ A INSERTAR:
ELSE
    INSERT INTO Usuario1 (nombre, email, usuario, paswd) VALUES (_nombre, _correo, _usuario, _contrasena);
    __respuesta:=0;     --EXITO...
END IF;
RETURN __respuesta;
END;
$body$ LANGUAGE 'plpgsql' volatile;

--select fn_registroUsuario_i('aaa ddd','aaa@as.cl','aaa111','aaaa');


















