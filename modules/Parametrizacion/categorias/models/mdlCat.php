<?php
class mdlCat
{
    public $conn;

    public function __construct()
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->dbConnect();
    }


    public function listarCat($filtro)
    {
        if($filtro==1){
            $sql = "SELECT c.descripcion, COUNT(e.categoriaID) AS cantidad
                    FROM inventario.equipo e
                        INNER JOIN inventario.categorias AS c ON e.categoriaID = c.categoriaID
                    GROUP BY c.descripcion
                    ORDER BY c.descripcion ASC";
        }else{
            $sql = "Otra cosa";
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



    public function guardarCat($losDatos){

        $recio ="	INSERT INTO inventario.categorias (descripcion,estadoID)
                    VALUES (:categoria,1);";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":categoria",$losDatos->cat);


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
    public function eliminarCat($id, $estado){
        $estadoRecio = intval($estado);
        $recio ="	UPDATE inventario.categorias SET estadoID = :estadoID WHERE marcaID = :marcaID";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":marcaID",$id);
        $stmt->bindParam(":estadoID",$estadoRecio );


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