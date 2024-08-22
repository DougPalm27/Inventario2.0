<?php
class mdlMarcas
{
    public $conn;

    public function __construct()
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->dbConnect();
    }


    public function listarMarca($filtro)
    {
        if ($filtro == 1) {
            $sql = "SELECT m.nombreMarca,COUNT(m.nombreMarca) as Cantidad
                FROM inventario.equipo e
                INNER JOIN inventario.marcas AS m ON e.marcaID = m.marcaID 
                GROUP BY m.nombreMarca
                ORDER BY m.nombreMarca ASC";
        } else {
            $sql = "SELECT nombreMarca FROM inventario.marcas";
        }

        $exec = $this->conn->prepare($sql);

        try {
            $exec->execute();
            $resultado = $exec->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $exec->closeCursor();
        return $resultado;
    }



    public function guardarNuevaMarca($losDatos)
    {

        $recio = "	INSERT INTO inventario.marcas (nombreMarca, estadoID)
                    VALUES (:nombreMarca, 1);";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":nombreMarca", $losDatos->nombreMarca);


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
    public function eliminarMarca($id, $estado)
    {
        $estadoRecio = intval($estado);
        $recio = "	UPDATE inventario.marcas SET estadoID = :estadoID WHERE marcaID = :marcaID";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":marcaID", $id);
        $stmt->bindParam(":estadoID", $estadoRecio);


        try {
            $stmt->execute();
            $response[0] = array(
                'status' => '200',
                'mensaje' => 'Eliminado correctamente',
            );

            $resultado = json_encode($response);
        } catch (PDOException $e) {
            $res = $stmt->errorInfo();
            $resultado  = json_encode($id);
        }

        echo $resultado;
        return $resultado;
    }
}
