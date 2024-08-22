<?php

/**
 * Descripción ;COntrol de consultas para la generación de custodios para las asignaciones de equipo
 * Fecha de creación: 04/07/2024
 * Autor:  Douglas Palma
 */

class mdlReportesLinea
{
    // Variables globales
    public $conn;

    // Constructores
    public function __construct()
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->dbConnect();

        if (!isset($_SESSION)) {
            session_start();
        }
    }



    public function custodioL($id)
    {
        $sql = "SELECT em.codigoEmpleado
,em.nombreCompleto
,la.FechaAsignacion
,em.ingreso
,em.cargo
,em.proyecto
,ld.IMEI
,ma.nombreMarca
,mo.nombreModelo
,'6962' as valorEquipo
,l.numeroLinea
,ISNULL(la.observaciones,'Sin observaciones') as observaciones
FROM inventario.lineasAsignacion as la
INNER JOIN inventario.lineas as l on la.lineaID = l.lineaID
INNER JOIN inventario.lineasDetalle as ld on la.dispositivoID = ld.lineaDetalleID
INNER JOIN DBSIMFCOH.rrhh.vw_empleadosActivos as em ON la.usuarioID = em.idEmpleado
INNER JOIN inventario.marcas AS ma ON ld.marca = ma.marcaID
INNER JOIN inventario.modelos AS mo ON ld.modelo = mo.modeloID
WHERE la.lineaAsignacionID =  $id";

        $stmt  = $this->conn->prepare($sql);
        //  $stmt->bindParam(":tecnico",$tecnio);
        //$stmt->bindParam(":anio",$anio);

        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado  = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }


    public function equipoGeneral($proyectos)
    {
        $sql = "  SELECT e.codigoSAP, e.descripcionGeneral,m.nombreModelo,e.serie,e.fechaAdquisicion,e.precioAdquisicion, ISNULL(em.nombreCompleto,'Sin asignar') as Asignado,es.descripcion as estado,ISNULL(a.observaciones,'Sin observaciones') AS Observaciones FROM inventario.equipo AS e
LEFT JOIN inventario.asignaciones AS a ON e.equipoID = a.equipoID AND a.estadoID = 3
LEFT JOIN DBSIMFCOH.rrhh.vw_empleadosActivos AS em ON a.usuarioID = em.idEmpleado
LEFT JOIN inventario.modelos as m on e.modeloID = m.modeloID 
INNER JOIN inventario.estados as es on e.estadoID = es.estadoID
WHERE e.proyectoID IN (".$proyectos.")";

        $stmt  = $this->conn->prepare($sql);
        //  $stmt->bindParam(":tecnico",$tecnio);
        //$stmt->bindParam(":anio",$anio);

        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado  = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }
}
