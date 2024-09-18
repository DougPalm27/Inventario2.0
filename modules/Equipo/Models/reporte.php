<?php

/**
 * Descripción ;COntrol de consultas para la generación de custodios para las asignaciones de equipo
 * Fecha de creación: 04/07/2024
 * Autor:  Douglas Palma
 */

class mdlReportes
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
		a.observaciones,
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
