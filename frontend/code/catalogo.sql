TRUNCATE TABLE dirtelf.catalogo RESTART IDENTITY CASCADE

INSERT INTO dirtelf.catalogo (idpadre,nombcata)
VALUES
(0,'departamento');
insert into dirtelf.catalogo (idpadre,nombcata)
values
(0,'ubicacion');
-- CATALOGO DE NOMBRE DEPARTAMENTO

INSERT INTO dirtelf.catalogo (idpadre,nombcata)
VALUES
(1,'AUDITORIA EXTERNA'),
(1,'SECRETARIA GENERAL'),
(1,'ADMINISTRACION'),
(1,'SALA CONFERENCIA'),
(1,'INTENDENTE'),
(1,'SECRETARIO PROTECCION SOCIAL'),
(1,'CONSULTOR'),
(1,'FUNDAMAR'),
(1,'SEGURIDAD'),
(1,'CORPOTUR'),
(1,'SAIM'),
(1,'COORDINACION COMPRAS'),
(1,'TESORERIA'),
(1,'TALENTO HUMANO 1'),
(1,'DIRECCION GESTION SOCIAL'),
(1,'INFRAESTRUCTURA'),
(1,'BIENES'),
(1,'SALA DE SERVIDORES INFORMATICA'),
(1,'SECRETARIO APOYO Y SERVICIO'),
(1,'Sin Gerencia'),
(1,'CONSULTORIA JURIDICA'),
(1,'DIRECCION PLANIFICACION Y PRESUPUESTO'),
(1,'INFRAESTRUCTURA'),
(1,'RRHH'),
(1,'PROTECCION CIVIL'),
(1,'RECAUDACION'),
(1,'DISPONIBLE'),
(1,'FUNDAIMIR'),
(1,'PRESUPUESTO SATIM'),
(1,'DIRECCION RECAUDACION'),
(1,'SATIM'),
(1,'DIRECTOR DESPACHO'),
(1,'HIDROCARBUROS'),
(1,'PRESUPUESTO'),
(1,'JEFATURA DE GOBIERNO'),
(1,'CONTABILIDAD'),
(1,'COMPRAS'),
(1,'INFORMATICA'),
(1,'PLANIFICACION'),
(1,'ARCHIVO TALENTO HUMANO'),
(1,'DIRECCION GESTION COMUNICACIONA'),
(1,'SATIM RECEPCION');

-- CATALOGO DE UBICACION
insert into dirtelf.catalogo (idpadre,nombcata)
values
(2,'OFIC 1 PISO 22 CARACAS'),
(2,'NUMERO PRIVADO');
