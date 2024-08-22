<?php
class mdlEquipos
{
    public $conn;

    public function __construct()
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->dbConnect();
    }


    public function guardarAsignacionEquipo($losDatos)
    {

        $recio = "INSERT INTO inventario.asignaciones (equipoID,usuarioID,fechaAsignacion,estadoID,observaciones) VALUES (:equipoID,:usuarioID,:fechaAsignacion,3,:observaciones)";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":equipoID", $losDatos->equipoID);
        $stmt->bindParam(":usuarioID", $losDatos->usuarioID);
        $stmt->bindParam(":fechaAsignacion", $losDatos->fechaAsignacion);
        $stmt->bindParam(":observaciones", $losDatos->observaciones);


        try {
            $stmt->execute();
            $response[0] = array(
                'status' => '200',
                'mensaje' => 'Insertado correctamente',
            );

            $resultado = json_encode($response);
            echo $resultado;
        } catch (PDOException $e) {
            $res = $stmt->errorInfo();
            $resultado  = json_encode($res);
            echo $resultado;
        }


        return $resultado;
    }
    public function listarEquipoAsignado()
    {

        $Equipo = "SELECT 
        a.asignacionID,
         e.codigoSAP,
        CONCAT(
            UPPER(LEFT(em.primerNombre, 1)), LOWER(SUBSTRING(em.primerNombre, 2, LEN(em.primerNombre))), ' ',
            COALESCE(CONCAT(
                UPPER(LEFT(em.segundoNombre, 1)), LOWER(SUBSTRING(em.segundoNombre, 2, LEN(em.segundoNombre))), ' '
            ), ''), 
            UPPER(LEFT(em.primerApellido, 1)), LOWER(SUBSTRING(em.primerApellido, 2, LEN(em.primerApellido))), ' ',
            UPPER(LEFT(em.segundoApellido, 1)), LOWER(SUBSTRING(em.segundoApellido, 2, LEN(em.segundoApellido)))
        ) AS Asignado,
        p.nombreProyecto AS Proyecto,
        m.nombreMarca,
        md.nombreModelo,
        e.serie,
		es.descripcion AS estado
            FROM inventario.asignaciones AS a
            INNER JOIN inventario.equipo AS e ON a.equipoID = e.equipoID
            INNER JOIN DBSIMFCOH.rrhh.empleados AS em ON a.usuarioID = em.idEmpleado
            INNER JOIN inventario.proyectos AS p ON e.proyectoID = p.proyectoID
            INNER JOIN inventario.marcas AS m ON e.marcaID = m.marcaID
            INNER JOIN inventario.modelos AS md ON e.modeloID = md.modeloID
            INNER JOIN inventario.estados  AS es ON a.estadoID = es.estadoID
            WHERE a.estadoID = 3";
        $stmt = $this->conn->prepare($Equipo);
        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }
    public function listarTodo()
    {

        $Equipo = "SELECT 
        e.equipoID,e.categoriaID,e.estadoID,e.fechaAdquisicion,precioAdquisicion,ubicacionID,e.proyectoID,p.nombreProyecto AS np,proveedorID,descripcionGeneral,
        e.serie,e.codigoSAP,e.marcaID,e.modeloID,ma.nombreMarca,m.nombreModelo,es.descripcion FROM inventario.equipo AS e
        INNER JOIN inventario.proyectos AS p on e.proyectoID = p.proyectoID
        INNER JOIN inventario.modelos AS m ON e.modeloID = m.modeloID 
        INNER JOIN inventario.marcas AS ma ON e.marcaID = ma.marcaID
		INNER JOIN inventario.estados AS es ON e.estadoID = es.estadoID ";
        $stmt = $this->conn->prepare($Equipo);
        try {
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        $stmt->closeCursor();
        return $resultado;
    }
    public function EliminarAsignacion($asignacionID)
    {
        $sql = "UPDATE inventario.asignaciones SET estadoID = 4 WHERE asignacionID = :asignacionID";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":asignacionID", $asignacionID);

        try {
            $stmt->execute();
            $response[0] = array(
                'status'  => '200',
                'mensaje' => 'Actualización exitosa',
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

    public function baja($equipoID)
    {
        $sql = "UPDATE inventario.equipo SET estadoID = 2 WHERE equipoID = :equipoID";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":equipoID", $equipoID);

        try {
            $stmt->execute();
            $response[0] = array(
                'status'  => '200',
                'mensaje' => 'Actualización exitosa',
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
    public function guardarEquipo($losDatos)
    {

        $recio = "	INSERT INTO inventario.equipo 
        (categoriaID,
        estadoID,
        fechaAdquisicion,
        proveedorID,
        descripcionGeneral,
        serie,
        codigoSAP,
        marcaID,
        modeloID,
        proyectoID,
        precioAdquisicion) 
        VALUES 
        (:categoriaID,
        1,
        :fechaAdquisicion,
        :proveedorID,
        :descripcion,
        :serie,
        :codigoSAP,
        :marcaID,
        :modeloID,
        :proyectoID,
        :precio)";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":categoriaID", $losDatos->categoria2);
        $stmt->bindParam(":fechaAdquisicion", $losDatos->fecha2);
        $stmt->bindParam(":descripcion", $losDatos->descripcion2);
        $stmt->bindParam(":serie", $losDatos->serie2);
        $stmt->bindParam(":codigoSAP", $losDatos->sap2);
        $stmt->bindParam(":marcaID", $losDatos->marca2);
        $stmt->bindParam(":modeloID", $losDatos->modelo2);
        $stmt->bindParam(":proyectoID", $losDatos->proyecto2);
        $stmt->bindParam(":proveedorID", $losDatos->proyecto2);
        $stmt->bindParam(":precio", $losDatos->precio2);

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


    function cargarEquipo($id)
    {
        $sql = "SELECT 
        e.codigoSAP, e.equipoID,e.categoriaID,e.fechaAdquisicion,precioAdquisicion,ubicacionID,e.proyectoID,p.nombreProyecto AS np,proveedorID,descripcionGeneral,
        e.serie,e.codigoSAP,e.marcaID,e.modeloID,ma.nombreMarca,m.nombreModelo,es.estadoID,es.descripcion FROM inventario.equipo AS e
        INNER JOIN inventario.proyectos AS p on e.proyectoID = p.proyectoID
        INNER JOIN inventario.modelos AS m ON e.modeloID = m.modeloID 
        INNER JOIN inventario.marcas AS ma ON e.marcaID = ma.marcaID
		INNER JOIN inventario.estados AS es ON e.estadoID = es.estadoID 
        WHERE equipoID = :id";

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
    public function editarEquipo($losDatos)
    {

        $recio = "	UPDATE inventario.equipo 
        SET
        categoriaID=:categoriaID,
        estadoID= :estado,
        fechaAdquisicion = :fechaAdquisicion ,
        proveedorID = :proveedorID,
        descripcionGeneral =:descripcion,
        serie=:serie,
        codigoSAP=:codigoSAP,
        marcaID = :marcaID,
        modeloID = :modeloID,
        proyectoID = :proyectoID,
        precioAdquisicion = :precio
        WHERE equipoID = :id";

        $stmt = $this->conn->prepare($recio);
        $stmt->bindParam(":categoriaID", $losDatos->categoria2);
        $stmt->bindParam(":fechaAdquisicion", $losDatos->fecha2);
        $stmt->bindParam(":descripcion", $losDatos->descripcion2);
        $stmt->bindParam(":serie", $losDatos->serie2);
        $stmt->bindParam(":codigoSAP", $losDatos->sap2);
        $stmt->bindParam(":marcaID", $losDatos->marca2);
        $stmt->bindParam(":modeloID", $losDatos->modelo2);
        $stmt->bindParam(":proyectoID", $losDatos->proyecto2);
        $stmt->bindParam(":proveedorID", $losDatos->proveedores2);
        $stmt->bindParam(":precio", $losDatos->precio2);
        $stmt->bindParam(":estado", $losDatos->estado);
        $stmt->bindParam(":id", $losDatos->id);

        try {
            $stmt->execute();
            $response[0] = array(
                'status' => '200',
                'mensaje' => 'Actualizado correctamente',
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
