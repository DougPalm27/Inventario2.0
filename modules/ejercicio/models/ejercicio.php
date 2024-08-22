<?php
 class mdlEjercicio{

    public $conn;

    // Constructores
    public function __construct(){
        $this->conn = new Connection();
        $this->conn = $this->conn->dbConnect();
        
       
    }


    // método para guardar correos
    public function guardarCorreo($losDatos){

        $recio ="INSERT INTO ejercicio.correo(correo,password)
                VALUES (:correo,:password)";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":correo",$losDatos->email);
        $stmt->bindParam(":password",$losDatos->passowrd);

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
    
    // listar correos para select
    public function listarCorreos(){
        $sql ="SELECT * FROM ejercicio.correo";
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

?>