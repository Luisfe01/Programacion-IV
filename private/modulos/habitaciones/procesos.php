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
        if( empty( trim($this->datos['numhabitacion'])) ){
            $this->respuesta['msg'] = 'por favor ingrese el numero de habitacion';
        }
        if( empty( trim($this->datos['numcamas'])) ){
            $this->respuesta['msg'] = 'por favor ingrese el numero de camas';
        }
        if( empty( trim($this->datos['disponibilidad'])) ){
            $this->respuesta['msg'] = 'por favor ingrese la disponibilidad';
        }
        if( empty( trim($this->datos['precio'])) ){
            $this->respuesta['msg'] = 'por favor ingrese el precio';
        }
        $this->almacenar_habitacion();
    }
    private function almacenar_habitacion(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO habitaciones (idPiso,idTipohabitacion,numhabitacion,numcamas,disponibilidad,precio) VALUES(
                        "'. $this->datos['piso']['id'] .'",
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
                        idPiso     = "'. $this->datos['piso']['id'] .'",
                        idTipohabitacion     = "'. $this->datos['tipohabitacion']['id'] .'",
                        numhabitacion            = "'. $this->datos['numhabitacion'].'",
                        numcamas          = "'. $this->datos['numcamas'].'",
                        disponibilidad         = "'. $this->datos['disponibilidad'].'",
                        precio          = "'. $this->datos['precio'].'"
                    WHERE idHabitacion = "'. $this->datos['idHabitacion'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }else{
                $this->respuesta['msg'] = 'Error no se envio la accion a realizar';
            }
        }
    }
    public function buscarHabitacion($valor = ''){
        $this->db->consultas('
            select pisos.idPiso, pisos.numpiso, habitaciones.idHabitacion, tipohabitaciones.idTipohabitacion, tipohabitaciones.categoria, habitaciones.numhabitacion, habitaciones.numcamas, habitaciones.disponibilidad, habitaciones.precio
            from habitaciones INNER JOIN tipohabitaciones on habitaciones.idTipohabitacion=tipohabitaciones.idTipohabitacion INNER JOIN pisos on habitaciones.idPiso=pisos.idPiso
            where habitaciones.numcamas like "%'. $valor .'%" or habitaciones.numhabitacion like "%'. $valor .'%" 

        ');
        $habitaciones = $this->respuesta = $this->db->obtener_data();
        foreach ($habitaciones as $key => $value) {
            $datos[] = [
                

                'idHabitacion' => $value['idHabitacion'],
                'piso'      => [
                    'id'      => $value['idPiso'],
                    'label'   => $value['numpiso']
                ],
                'tipohabitacion'      => [
                    'id'      => $value['idTipohabitacion'],
                    'label'   => $value['categoria']
                ],
                'numhabitacion'        =>  $value['numhabitacion'],
                'numcamas'        =>  $value['numcamas'],
                'disponibilidad'        =>  $value['disponibilidad'],
                'precio'        =>  $value['precio'],

                
            ]; 
        }
        return $this->respuesta = $datos;
    }
    public function traer_pisos_tipohabitaciones(){
        $this->db->consultas('
            select tipohabitaciones.categoria AS label, tipohabitaciones.idTipohabitacion AS id
            from tipohabitaciones
        ');
        $tipohabitaciones = $this->db->obtener_data();

        $this->db->consultas('
        select pisos.numpiso AS label, pisos.idPiso AS id
        from pisos
        ');
        $pisos = $this->db->obtener_data();
        
        return $this->respuesta = ['tipohabitaciones'=>$tipohabitaciones,'pisos'=>$pisos];//array de php en v7+
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