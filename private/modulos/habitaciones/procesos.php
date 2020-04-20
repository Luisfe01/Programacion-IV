<?php 
include('../../Config/Config.php');
$habitacion = new habitacion($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$habitacion->$proceso( $_GET['habitacion'] );
print_r(json_encode($habitacion->respuesta));

class habitacion{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($habitacion){
        $this->datos = json_decode($habitacion, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['numhabitacion']) ){
            $this->respuesta['msg'] = 'por favor ingrese el numero de la habitacion';
        }
        if( empty($this->datos['numcamas']) ){
            $this->respuesta['msg'] = 'por favor ingrese la cantidad de camas';
        }
        if( empty($this->datos['disponibilidad']) ){
            $this->respuesta['msg'] = 'por favor ingrese la disponibilidad';
        }
        $this->almacenar_habitacion();
    }
    private function almacenar_habitacion(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO habitaciones (numhabitacion, numcamas, disponibilidad) VALUES(
                        "'. $this->datos['numhabitacion'] .'",
                        "'. $this->datos['numcamas'] .'",
                        "'. $this->datos['disponibilidad'] .'"

                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE habitaciones SET
                        numhabitacion     = "'. $this->datos['numhabitacion'] .'",
                        numcamas     = "'. $this->datos['numcamas'] .'",
                        disponibilidad   = "'. $this->datos['disponibilidad'] .'"
                    WHERE idHabitacion = "'. $this->datos['idHabitacion'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarHabitacion($valor = ''){
        $this->db->consultas('
            select habitaciones.idHabitacion, habitaciones.numhabitacion, habitaciones.numcamas, habitaciones.disponibilidad
            from habitaciones
            where habitaciones.numhabitacion like "%'. $valor .'%" or habitaciones.numcamas like "%'. $valor .'%" or habitaciones.disponibilidad like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarHabitacion($idHabitacion = 0){
        $this->db->consultas('
            DELETE habitaciones
            FROM habitaciones
            WHERE habitaciones.idHabitacion="'.$idHabitacion.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>