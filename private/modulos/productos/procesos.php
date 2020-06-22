<?php 
include('../../Config/Config.php');
$producto = new producto($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$producto->$proceso( $_GET['producto'] );
print_r(json_encode($producto->respuesta));

class producto{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($producto){
        $this->datos = json_decode($producto, true);
        $this->validar_datos();
    }
    private function validar_datos(){


       
        $this->almacenar_producto();
    }
    private function almacenar_producto(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO productos (idTipoproducto,codigo,imagen,nombre,descripcion,precio) VALUES(
                        "'. $this->datos['tipoproducto']['id'] .'",
                        "'. $this->datos['codigo'].'",
                        "'. $this->datos['imagen'] .'",
                        "'. $this->datos['nombre'].'",
                        "'. $this->datos['descripcion'] .'",
                        "'. $this->datos['precio'].'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE productos SET
                        idTipoproducto     = "'. $this->datos['tipoproducto']['id'] .'",
                        codigo            = "'. $this->datos['codigo'].'",
                        imagen          = "'. $this->datos['imagen'].'",
                        nombre         = "'. $this->datos['nombre'].'",
                        descripcion          = "'. $this->datos['descripcion'].'",
                        precio         = "'. $this->datos['precio'].'"
                    WHERE idProducto = "'. $this->datos['idProducto'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }else{
                $this->respuesta['msg'] = 'Error no se envio la accion a realizar';
            }
        }
    }
    public function buscarProducto($valor = ''){
        $this->db->consultas('
            select productos.idProducto, tipoproductos.idTipoproducto, tipoproductos.categoria, productos.codigo, productos.imagen, productos.nombre, productos.descripcion, productos.precio
            from productos INNER JOIN tipoproductos on productos.idTipoproducto=tipoproductos.idTipoproducto
            where productos.codigo like "%'. $valor .'%" or productos.nombre like "%'. $valor .'%" or productos.precio like "%'. $valor .'%"

        ');
        $productos = $this->respuesta = $this->db->obtener_data();
        foreach ($productos as $key => $value) {
            $datos[] = [
                'idProducto' => $value['idProducto'],
                'codigo' => $value['codigo'],
                'imagen' => $value['imagen'],
                'tipoproducto'      => [
                    'id'      => $value['idTipoproducto'],
                    'label'   => $value['categoria']
                ],
                'nombre'        =>  $value['nombre'],
                'descripcion'        =>  $value['descripcion'],
                'precio'               =>  $value['precio']
                
            ]; 
        }
        return $this->respuesta = $datos;
    }
    public function traer_tipoproductos(){
        $this->db->consultas('
            select tipoproductos.categoria AS label, tipoproductos.idTipoproducto AS id
            from tipoproductos
        ');
        $tipoproductos = $this->db->obtener_data();
        
        return $this->respuesta = ['tipoproductos'=>$tipoproductos];//array de php en v7+
    }
    public function eliminarProducto($idProducto = 0){
        $this->db->consultas('
            DELETE productos
            FROM productos
            WHERE productos.idProducto="'.$idProducto.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>