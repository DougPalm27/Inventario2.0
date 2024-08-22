

<?php
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


    public function listarreporteGeneral()
    {
        // verificamos si se muestran todos losregistros o solo los del usuario logeado 

        $sql = "SELECT * FROM inventario.vw_reporteGeneralInventario";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }
    public function listarreporteporcategoriaEstado()
    {
        // verificamos si se muestran todos losregistros

        $sql = "SELECT * FROM inventario.vw_reporteEquipoTotalPorCategoriaEstado";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }

    public function listarreporteInventarioHistorico()
    {
        // verificamos si se muestran todos losregistros
        $sql = "SELECT * FROM inventario.vw_reporteInventarioHistorico";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }
    public function listarreporteAsignaciones()
    {
        // verificamos si se muestran todos losregistros
        $sql = "SELECT * FROM inventario.vw_asignaciones";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }
    public function listarreporteManteniento()
    {
        // verificamos si se muestran todos losregistros
        $sql = "SELECT * FROM inventario.vw_reporteEquipoEnMantenimiento";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }
    public function EliminarreporteGeneral($equipoID)
    {
        // verificamos si se muestran todos losregistros o solo los del usuario logeado 
        $Obv = "Defectuoso";
        $sql = "EXEC [inventario].[sp_CambiarEstadoEquipoYRegistrarHistorico] :equipoID, :observacion";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":equipoID",$equipoID);
        $stmt->bindParam(":observacion", $Obv);

        try {
            $stmt->execute();
            $response[0] = array(
                'status'  => '200',
                'mensaje' => 'Equipo eliminado correctamente.',
            );           
            $resultado = json_encode($response);
            echo $resultado;
           
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
            echo $resultado;
        }
        $stmt->closeCursor();
        return $resultado;
    }
}
?>