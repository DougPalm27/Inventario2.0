<?php
class mdlModelos
{
    public $conn;

    public function __construct()
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->dbConnect();
    }


    public function listarModelo($filtro)
    {
        if($filtro==1){
            $sql = "SELECT m.nombreModelo,COUNT(m.nombreModelo) as Cantidad , ma.nombreMarca
                    FROM inventario.equipo e
                    INNER JOIN inventario.modelos AS m ON e.modeloID = m.modeloID 
                    INNER JOIN inventario.marcas AS ma ON e.marcaID = ma.marcaID 
                    GROUP BY m.nombreModelo, ma.nombreMarca
                    ORDER BY m.nombreModelo ASC";
        }else{
            $sql = "SELECT nombreModelo FROM inventario.modelos";
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


    public function guardarNuevoModelo($losDatos){

        $recio ="	INSERT INTO inventario.modelos(nombreModelo, marcaID)
                    VALUES (:modelo,:marcaID)";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":modelo",$losDatos->modelo);
        $stmt->bindParam(":marcaID",$losDatos->marcaID);


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
    public function eliminarModelo($losDatos){

        $recio ="	UPDATE inventario.marcas SET estadoID = 2 WHERE marcaID = :marcaID";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":marcaID",$losDatos);


        try {
            $stmt->execute();
            $response[0] = array(
                'status' => '200',
                'mensaje' => 'Eliminado correctamente',
            );

            $resultado = json_encode($response);
        } catch (PDOException $e) {
            $res = $stmt->errorInfo();
            $resultado  = json_encode($res);
        }

        echo $resultado;
        return $resultado;
    } 
}