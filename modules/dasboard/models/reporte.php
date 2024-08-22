<?php

/**
 * Descripción: Reporte para inventario completo por proecto desde el dashboard
 * Fecha de creación: 29/07/2024
 * Autor:  Douglas Palma
 */

class mdlReportesDash
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



    public function custodio($id)
    {
        $sql = "SELECT 
        a.asignacionID,
         e.codigoSAP,
        em.nombreCompleto AS Asignado,
		em.codigoEmpleado,
		a.fechaAsignacion,
		em.ingreso,
		em.cargo,
		em.proyecto AS proyectoEmpleado,
        p.nombreProyecto AS proyectoEquipo,
        m.nombreMarca,
        md.nombreModelo,
        e.serie,
		e.precioAdquisicion,
		e.descripcionGeneral,
		es.descripcion AS estado
            FROM inventario.asignaciones AS a
            INNER JOIN inventario.equipo AS e ON a.equipoID = e.equipoID
            INNER JOIN [DBSIMFCOH].[rrhh].[vw_empleadosActivos] AS em ON a.usuarioID = em.idEmpleado
            INNER JOIN inventario.proyectos AS p ON e.proyectoID = p.proyectoID
            INNER JOIN inventario.marcas AS m ON e.marcaID = m.marcaID
            INNER JOIN inventario.modelos AS md ON e.modeloID = md.modeloID
            INNER JOIN inventario.estados  AS es ON a.estadoID = es.estadoID
            WHERE a.asignacionid = $id";

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


    public function reporteGeneralDash($proyecto)
    {
        $sql = " SELECT e.codigoSAP,'Equipo de Computo' as ClaseAF,e.descripcionGeneral,m.nombreModelo,e.serie,e.fechaAdquisicion,e.precioAdquisicion, ISNULL(em.nombreCompleto,'Sin asignar') as Asignado,es.descripcion as estado,ISNULL(a.observaciones,'Sin observaciones') AS Observaciones FROM inventario.equipo AS e
LEFT JOIN inventario.asignaciones AS a ON e.equipoID = a.equipoID AND a.estadoID = 3
LEFT JOIN DBSIMFCOH.rrhh.vw_empleadosActivos AS em ON a.usuarioID = em.idEmpleado
LEFT JOIN inventario.modelos as m on e.modeloID = m.modeloID 
INNER JOIN inventario.estados as es on e.estadoID = es.estadoID
WHERE E.proyectoID = $proyecto

UNION
SELECT k.codigoSAP,'Insumos suministros agricolas' as ClaseAF,k.descripcion as descripcionGeneral, 'N/A' as nombreModelo, 'N/A' as serie,k.fechaCompra,k.precio,ISNULL(em.nombreCompleto,'Sin asignar') as Asignado,es.descripcion as estado,ISNULL(a.observaciones,'Sin observaciones') AS Observaciones
FROM inventario.kit as k
LEFT JOIN inventario.kitAsignaciones AS a ON k.kitID = a.kitID AND a.estadoID = 3
LEFT JOIN DBSIMFCOH.rrhh.vw_empleadosActivos AS em ON a.usuarioID = em.idEmpleado
INNER JOIN inventario.estados as es on k.estadoID = es.estadoID
WHERE K.proyectoID = $proyecto";

        $stmt  = $this->conn->prepare($sql);
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
