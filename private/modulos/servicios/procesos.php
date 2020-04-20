<?php 
include('../../Config/Config.php');
$servicio = new servicio($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$servicio->$proceso( $_GET['servicio'] );
print_r(json_encode($servicio->respuesta));

class servicio{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($servicio){
        $this->datos = json_decode($servicio, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del servicio';
        }
        if( empty($this->datos['precio']) ){
            $this->respuesta['msg'] = 'por favor ingrese el precio';
        }
        $this->almacenar_servicio();
    }
    private function almacenar_servicio(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO servicios (nombre,precio) VALUES(
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['precio'] .'"

                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE servicios SET
                        nombre     = "'. $this->datos['nombre'] .'",
                        precio   = "'. $this->datos['precio'] .'"
                    WHERE idServicio = "'. $this->datos['idServicio'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarServicio($valor = ''){
        $this->db->consultas('
            select servicios.idServicio, servicios.nombre, servicios.precio
            from servicios
            where servicios.nombre like "%'. $valor .'%" or servicios.precio like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarServicio($idServicio = 0){
        $this->db->consultas('
            DELETE servicios
            FROM servicios
            WHERE servicios.idServicio="'.$idServicio.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>