<?php

/**
 * Descripción ;Control de querys para reportería y dashboard informativ
 * Fecha de creación: 16/07/2024
 * Autor:  Marcos Sorto
 */

class mdlDash
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


    /**
     * @des : método para lisyado de grafica por categoria
     * @param : any
     * @return : lista cantidad de elementos por grupo
     */
    public function equipoPorCategoria()
    {
        $sql = "SELECT 
                    CAt.descripcion AS nombreCategoria,
		            COUNT(e.equipoID) AS cantidad
                FROM 
                    inventario.equipo AS e        
		            INNER JOIN inventario.categorias as CAt on e.categoriaID = CAt.categoriaID
                GROUP BY 
                    CAt.descripcion";

        $stmt  = $this->conn->prepare($sql);
       

        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado  = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }


     /**
     * @des : método para listado de cardPrinciaples
     * @param : any
     * @return : lista cantidad de elementos por grupo
     */
    public function equipoPorGrupo()
    {
        $sql = "SELECT 
                    'lineas' as descripcion,
                    COUNT(lineaId) as disponible
                FROM
                    inventario.lineasAsignacion
                UNION
                SELECT 
                    'equipo'  as descripcion,
                    COUNT(equipoId)  as disponible
                FROM
                    inventario.equipo
                UNION
                SELECT 
                    'kit' as descripcion,
                    COUNT(kitID) as disponible
                FROM
                    inventario.kit";

        $stmt  = $this->conn->prepare($sql);
       

        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado  = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }

     /**
     * @des : método para listado de grafica por proyecto
     * @param : any
     * @return : lista cantidad de equipo distribuidos por proyecto
     */
    public function equipoProProyecto()
    {
        $sql = "SELECT 
                    count(e.equipoID) as cantidad,
                    p.nombreProyecto as proyecto
                FROM 
                    inventario.equipo AS e        
                    INNER JOIN inventario.proyectos as p on e.proyectoID =p.proyectoID
                GROUP BY
                    p.nombreProyecto";

        $stmt  = $this->conn->prepare($sql);
       

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
