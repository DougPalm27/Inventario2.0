CREATE TABLE inventario.lineas
(
lineasID int identity(1,1) constraint pk_lineas primary key,
numeroLinea nvarchar(50) not null,
proyecto nvarchar(50) not null,
fechaActivacion date not null,
fechaRenovacion date not null,
estado int not null
)
CREATE TABLE inventario.lineasHistoricos
(
lineasHistoricoID int identity(1,1) constraint pk_lineasHistoricos primary key,
lineasId int not null constraint fk_lineasID$TieneunaLinea FOREIGN KEY REFERENCES inventario.linea(lineasID),
fechaAsignacion date not null,
fechaBaja date not null
)
CREATE TABLE inventario.lineasAsignaciones(
lineaAsignacionID int identity(1,1) constraint pk_lineasAsignacion primary key,
lineasID int not null constraint fk_lineasID$TieneunaLinea foreign key references inventario.linea(lineasID),
usuarioID int not null constraint fk_UsuarioID$TieneunUsuario foreign key references inventario.usuarios(usuarioID)
)