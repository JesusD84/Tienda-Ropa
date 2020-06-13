<?php

class Pedido {
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function getProvincia() {
        return $this->provincia;
    }

    function setProvincia($provincia) {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function setLocalidad($localidad) {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function getDireccion() {
        return $this->direccion;
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function getCoste() {
        return $this->coste;
    }

    function setCoste($coste) {
        $this->coste = $this->db->real_escape_string($coste);
    }

    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $this->db->real_escape_string($estado);
    }

    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    public function getOne() {
        $pedidos = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->id};");
        return $pedidos->fetch_object();
    }

    public function getOneByUser() {
        $pedidos = $this->db->query("SELECT p.id, p.coste FROM pedidos p 
        WHERE p.usuario_id = {$this->usuario_id} 
        ORDER BY id DESC LIMIT 1;");
        return $pedidos->fetch_object();
    }

    public function getAllByUser() {
        $pedidos = $this->db->query("SELECT p.* FROM pedidos p 
        WHERE p.usuario_id = {$this->usuario_id} 
        ORDER BY id DESC;");
        return $pedidos;
    }

    public function getProductosByPedido($id) {

        $sql = "SELECT pr.*, lp.unidades FROM productos pr 
        INNER JOIN linea_pedidos lp ON pr.id = lp.producto_id 
        WHERE pedido_id={$id};";
        $productos = $this->db->query($sql);
        
        return $productos;
    }

    public function getAll() {
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC;");
        return $pedidos;
    }

    public function save() {
        $sql = "INSERT INTO pedidos VALUES(NULL,'{$this->getUsuario_id()}','{$this->getProvincia()}',
        '{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()}, 'CONFIRM', CURDATE(), 
        CURTIME());";
        $save = $this->db->query($sql);

        $result=false;
        if($save) {
            $result = true;
        }
        return $result;
    }

    public function save_linea() {
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        

        foreach($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];

            $insert = "INSERT INTO linea_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']});";
            
            $save = $this->db->query($insert);
        }
        
        
        $result=false;
        if($save) {
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = "UPDATE pedidos SET estado ='{$this->getEstado()}' ";
        $sql .= " WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result=false;
        if($save) {
            $result = true;
        }
        
        return $result;
    }

}