<?php
class mdlLineas
{
    public $conn;

    public function __construct()
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->dbConnect();
    }


    //Metodo para cargarLineas
    public function listarAsignaciones()
    {
        $sql = "SELECT * FROM inventario.vw_AsignacionesLineas";
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
    //Metodo para cargarLineas
    public function listarLineasActivas()
    {
        $sql = "SELECT 
	                *  
                FROM 
                    inventario.lineas AS l
					LEFT JOIN inventario.lineasDetalle AS ld ON l.lineaID = ld.lineaID
					LEFT JOIN inventario.marcas AS ms ON ms.marcaID = ld.Marca
					LEFT JOIN inventario.modelos AS md ON md.modeloID = ld.Modelo
                    LEFT JOIN inventario.proyectos AS p ON l.codigoProyecto = p.codigoProyecto
                WHERE 
                    l.lineaID NOT IN (SELECT lineaID FROM inventario.lineasAsignacion WHERE estadoID = 3)";

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
    public function listarMarca()
    {
        $sql = "SELECT * FROM inventario.marcas WHERE estadoID=1";
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
    public function listarModelo($id)
    {
        $sql = "SELECT * FROM inventario.modelos WHERE marcaID = :id";
        $exec = $this->conn->prepare($sql);
        $exec->bindParam(':id', $id);
        try {
            $exec->execute();
            $resultado = $exec->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $exec->closeCursor();
        return $resultado;
    }
    public function listarProyecto()
    {
        $sql = "SELECT * FROM inventario.proyectos";
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

    public function ingresarLinea($losDatos)
    {

        $errorLineasDetalle = 0;


        $sqllinea = "INSERT INTO inventario.lineas (numeroLinea,estadoActivo,FechaActivacion,codigoProyecto) 
        VALUES (:numeroLinea,1,:FechaActivacion,:codigoProyecto)";

        $stmt = $this->conn->prepare($sqllinea);
        $stmt->bindParam(":numeroLinea", $losDatos->numeroLinea);
        $stmt->bindParam(":FechaActivacion", $losDatos->fechaActivacion);
        $stmt->bindParam(":codigoProyecto", $losDatos->codigoProyecto);
        try {
            # Iniciamos una transacción.
            $this->conn->beginTransaction();
            $stmt->execute();

            # Captura del ultimo id insertado de la tabla inventario.lineas
            $idLinea = $this->conn->lastInsertId();

            $sqllineaDetalle = "    INSERT INTO inventario.lineasDetalle (lineaID, Marca, Modelo, IMEI, fechaRenovacion, fechaVencimiento)
                VALUES (:lineaID, :marca, :modelo,:Imei, :fechaRenovacion, :fechaVencimiento)";
            $stmt1 = $this->conn->prepare($sqllineaDetalle);
            $stmt1->bindParam(":lineaID", $idLinea);
            $stmt1->bindParam(":marca", $losDatos->marca);
            $stmt1->bindParam(":modelo", $losDatos->modelo);
            $stmt1->bindParam(":Imei", $losDatos->Imei);
            $stmt1->bindParam(":fechaRenovacion", $losDatos->fechaRenovacion);
            $stmt1->bindParam(":fechaVencimiento", $losDatos->fechaVencimiento);
            try {
                $stmt1->execute();
                $this->conn->commit();
                $response[0] = array(
                    'status'  => '200',
                    'mensaje' => 'Bien'
                );
                $resultado = json_encode($response);
            } catch (PDOException $e) {
                $this->conn->rollBack();
                $errorLineasDetalle = $errorLineasDetalle + 1;
                $res = $stmt1->errorInfo();
                $resultado = json_encode($res);
            }
        } catch (PDOException $e) {
            $res = $stmt->errorInfo();
            $resultado  = json_encode($res);
        }

        $stmt->closeCursor();
        echo $resultado;
        return $resultado;
    }
    //metodo para realizar una asignacion
    public function asignarLinea($losDatos)
    {
        $errorLineasDetalle = 0;


        $sqlasignar = "INSERT INTO inventario.lineasAsignacion (lineaID, usuarioID, dispositivoID, FechaAsignacion, estadoID)
                       VALUES (:lineaID, :usuarioID, :dispositivoID, :FechaAsignacion, 3)";
        $stmt = $this->conn->prepare($sqlasignar);
        $stmt->bindParam(":lineaID", $losDatos->lineaID);
        $stmt->bindParam(":usuarioID", $losDatos->usuarioID);
        $stmt->bindParam(":dispositivoID", $losDatos->dispositivoID);
        $stmt->bindParam(":FechaAsignacion", $losDatos->fechaAsignacion);

        try {
            $stmt->execute();
            // Confirmar transacción si todo está bien
            //$this->conn->commit();+
            $response[0] = array(
                'status'  => '200',
                'mensaje' => 'Línea asignada correctamente.',

            );
            $resultado = json_encode($response);
        } catch (PDOException $e) {

            $errorLineasDetalle = $errorLineasDetalle + 1;
            $res = $stmt->errorInfo();
            $resultado = json_encode($res);
        }

        // Retornar antes de cerrar el cursor
        $stmt->closeCursor();
        return $resultado;
    }
    public function listarImei()
    {
        $sql = "SELECT 	*  	FROM 
                    inventario.lineasDetalle as ld
                    INNER JOIN inventario.marcas As ms ON ld.Marca = ms.marcaID
                    INNER JOIN inventario.modelos AS md ON ld.Modelo = md.modeloID
                    WHERE
                    lineaDetalleID NOT IN (SELECT dispositivoID FROM inventario.lineasAsignacion WHERE estadoID = 3)";
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

    function cargarLinea($id)
    {
        $sql = "SELECT 
                * 
            FROM 
                inventario.lineas AS l
            LEFT JOIN 
                inventario.lineasDetalle AS ld ON l.lineaID = ld.lineaID
            WHERE 
                l.estadoActivo  in (4,1) AND l.lineaID = :id";

        $exec = $this->conn->prepare($sql);
        $exec->bindParam(':id', $id);

        try {
            $exec->execute();
            $resultado = $exec->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $exec->closeCursor();
        return $resultado;
    }

    function editarLineas($losDatos)
    {
        $errorLineasDetalle = 0;

        try {
            // Iniciamos una transacción.
            $this->conn->beginTransaction();

            // Primero, actualizamos la tabla `lineas`.
            $sql = "UPDATE 
                        inventario.lineas 
                    SET
                        numeroLinea = :numeroLinea,
                        FechaActivacion = :FechaActivacion,
                        codigoProyecto = :codigoProyecto
                    WHERE
                        lineaID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $losDatos->id);
            $stmt->bindParam(":numeroLinea", $losDatos->numeroLinea);
            $stmt->bindParam(":FechaActivacion", $losDatos->fechaActivacion);
            $stmt->bindParam(":codigoProyecto", $losDatos->codigoProyecto);
            $stmt->execute();

            // Luego, actualizamos la tabla `lineasDetalle`.
            $sqllineaDetalle = "UPDATE 
                                    inventario.lineasDetalle 
                                SET
                                    Marca = :marca, 
                                    Modelo = :modelo, 
                                    IMEI = :Imei, 
                                    fechaRenovacion = :fechaRenovacion, 
                                    fechaVencimiento = :fechaVencimiento
                                WHERE 
                                    lineaID = :id";
            $stmt1 = $this->conn->prepare($sqllineaDetalle);
            $stmt1->bindParam(":id", $losDatos->id);
            $stmt1->bindParam(":marca", $losDatos->marca);
            $stmt1->bindParam(":modelo", $losDatos->modelo);
            $stmt1->bindParam(":Imei", $losDatos->Imei);
            $stmt1->bindParam(":fechaRenovacion", $losDatos->fechaRenovacion);
            $stmt1->bindParam(":fechaVencimiento", $losDatos->fechaVencimiento);
            $stmt1->execute();

            // Si ambas actualizaciones son exitosas, se confirma la transacción.
            $this->conn->commit();
            $response = array(
                'status' => '200',
                'mensaje' => 'Bien'
            );
            $resultado = json_encode($response);
        } catch (PDOException $e) {
            // En caso de error, se revierte la transacción.
            $this->conn->rollBack();
            $errorLineasDetalle += 1;
            $res = $stmt1->errorInfo();
            $resultado = json_encode($res);
        }

        $stmt->closeCursor();
        echo $resultado;
        return $resultado;
    }

    function historico()
    {
        $sql = "SELECT 
                    l.lineaID, ld.IMEI, l.numeroLinea, l.fechaDesactivacion, p.nombreProyecto, ms.nombreMarca, md.nombreModelo, ld.fechaRenovacion, ld.fechaVencimiento, e.descripcion 
                FROM 
                    inventario.lineas AS l
                LEFT JOIN 
                    inventario.lineasDetalle AS ld ON l.lineaID = ld.lineaID
                LEFT JOIN 
                    inventario.marcas AS ms ON ms.marcaID = ld.Marca
                LEFT JOIN 
                    inventario.modelos AS md ON md.modeloID = ld.Modelo
                LEFT JOIN 
                    inventario.estados AS e ON e.estadoID = l.estadoActivo
                LEFT JOIN 
                    inventario.proyectos AS p ON l.codigoProyecto = p.codigoProyecto
                ";

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

    function quitarAsignacion($id)
    {
        $sql = "UPDATE inventario.lineas SET estadoActivo = 4 WHERE lineaID = :id";
        $exec = $this->conn->prepare($sql);

        try {
            $exec->bindParam(':id', $id, PDO::PARAM_INT);
            $exec->execute();
            $response = array(
                'status' => '200',
                'mensaje' => 'Bien'
            );
        } catch (PDOException $e) {
            $response = array(
                'status' => '400',
                'mensaje' => 'Error al actualizar la línea: ' . $e->getMessage()
            );
        }
        $exec->closeCursor();
        return json_encode($response);
    }
}
