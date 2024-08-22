<?php
class mdlAsignacion
{

    public $conn;

    // Constructores
    public function __construct()
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->dbConnect();
    }
    // método para guardar equipos asignados
    public function asignarEquipo($losDatos)
    {
        $recio = "EXEC [inventario].[sp_AsignarEquipoUsuario] :usuarioID, :equipoID";
        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":usuarioID", $losDatos->usuarioID);
        $stmt->bindParam(":equipoID", $losDatos->equipoID);
        try {
            $stmt->execute();
            $response[0] = array(
                'status' => '200',
                'mensaje' => 'Insertado correctamente',
            );

            $resultado = json_encode($response);
        } catch (PDOException $e) {
            $res = $stmt->errorInfo();
            $resultado  = json_encode($res);
        }

        echo $resultado;
        return $resultado;
    }

    // listar ubicaciones para select
    public function listarAsignaciones()
    {
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


     // listar ubicaciones para select
     public function listarUsuario()
     {
         $sql = "SELECT * from inventario.vw_usuario WHERE estadoID=1";
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


      // listar ubicaciones para select
    public function listarEquipo()
    {
        $sql = "select * from inventario.equipo WHERE estadoID =3";
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
}
