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

        
       
        $this->almacenar_habitacion();
    }
    private function almacenar_habitacion(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO habitaciones (idTipohabitacion,numhabitacion,numcamas,disponibilidad,precio) VALUES(
                        "'. $this->datos['tipohabitacion']['id'] .'",
                        "'. $this->datos['numhabitacion'].'",
                        "'. $this->datos['numcamas'] .'",
                        "'. $this->datos['disponibilidad'].'",
                        "'. $this->datos['precio'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE habitaciones SET
                        idTipohabitacion     = "'. $this->datos['tipohabitacion']['id'] .'",
                        numhabitacion            = "'. $this->datos['numhabitacion'].'",
                        numcamas          = "'. $this->datos['numcamas'].'",
                        disponibilidad         = "'. $this->datos['disponibilidad'].'",
                        precio          = "'. $this->datos['precio'].'"
                    WHERE idHabitacion = "'. $this->datos['idHabitacion'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarHabitacion($valor = ''){
        $this->db->consultas('
            select habitaciones.idHabitacion, tipohabitaciones.idTipohabitacion, tipohabitaciones.categoria, habitaciones.numhabitacion, habitaciones.numcamas, habitaciones.disponibilidad, habitaciones.precio
            from habitaciones INNER JOIN tipohabitaciones on habitaciones.idTipohabitacion=tipohabitaciones.idTipohabitacion
            where habitaciones.nombre like "%'. $valor .'%" or habitaciones.apellido like "%'. $valor .'%" or habitaciones.telefono like "%'. $valor .'%"

        ');
        $matriculas = $this->respuesta = $this->db->obtener_data();
        foreach ($matriculas as $key => $value) {
            $datos[] = [
                'idHabitacion' => $value['idHabitacion'],
                'nombre' => $value['nombre'],
                'apellido' => $value['apellido'],
                'tipohabitacion'      => [
                    'id'      => $value['idTipohabitacion'],
                    'label'   => $value['tipo']
                ],
                'direccion'        =>  $value['direccion'],
                'telefono'        =>  $value['telefono'],
                'dui'               =>  $value['dui'],
                'fechanacimiento'   => $value['fechanacimiento']
                
            ]; 
        }
        return $this->respuesta = $datos;
    }
    public function traer_tipohabitaciones(){
        $this->db->consultas('
            select tipohabitaciones.categoria AS label, tipohabitaciones.idTipohabitacion AS id
            from tipohabitaciones
        ');
        $tipohabitaciones = $this->db->obtener_data();
        
        return $this->respuesta = ['tipohabitaciones'=>$tipohabitaciones];//array de php en v7+
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