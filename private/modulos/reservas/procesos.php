<?php 
include('../../Config/Config.php');
$reserva = new reserva($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$reserva->$proceso( $_GET['reserva'] );
print_r(json_encode($reserva->respuesta));

class reserva{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($reserva){
        $this->datos = json_decode($reserva, true);
        $this->validar_datos();
    }
    private function validar_datos(){

        $this->almacenar_reserva();
    }
    private function almacenar_reserva(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO reservas (idCliente,idHabitacion,fechainicio,fechafinal) VALUES(
                        "'. $this->datos['cliente']['id'] .'",
                        "'. $this->datos['habitacion']['id'] .'",
                        "'. $this->datos['fechainicio'].'",
                        "'. $this->datos['fechafinal'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE reservas SET
                        idCliente     = "'. $this->datos['cliente']['id'] .'",
                        idHabitacion     = "'. $this->datos['habitacion']['id'] .'",
                        fechainicio            = "'. $this->datos['fechainicio'].'",
                        fechafinal          = "'. $this->datos['fechafinal'].'"
                    WHERE idReserva = "'. $this->datos['idReserva'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }else{
                $this->respuesta['msg'] = 'Error no se envio la accion a realizar';
            }
        }
    }
    public function buscarReserva($valor = ''){
        $this->db->consultas('
        SELECT reservas.idReserva, reservas.fechainicio, reservas.fechafinal, clientes.idCliente, clientes.nombre, habitaciones.idHabitacion, habitaciones.numhabitacion FROM reservas 
        INNER JOIN clientes on reservas.idCliente=clientes.idCliente 
        INNER JOIN habitaciones ON reservas.idHabitacion=habitaciones.idHabitacion
        where reservas.fechainicio like "%'. $valor .'%" or reservas.fechafinal like "%'. $valor .'%" 

        ');
        $reservas = $this->respuesta = $this->db->obtener_data();
        foreach ($reservas as $key => $value) {
            $datos[] = [
                

                'idReserva' => $value['idReserva'],
                'cliente'      => [
                    'id'      => $value['idCliente'],
                    'label'   => $value['nombre']
                ],
                'habitacion'      => [
                    'id'      => $value['idHabitacion'],
                    'label'   => $value['numhabitacion']
                ],
                'fechainicio'        =>  $value['fechainicio'],
                'fechafinal'        =>  $value['fechafinal']

                
            ]; 
        }
        return $this->respuesta = $datos;
    }
    public function traer_clientes_habitaciones(){
        $this->db->consultas('
            select habitaciones.numhabitacion AS label, habitaciones.idHabitacion AS id
            from habitaciones
        ');
        $habitaciones = $this->db->obtener_data();

        $this->db->consultas('
        select clientes.nombre AS label, clientes.idCliente AS id
        from clientes
        ');
        $clientes = $this->db->obtener_data();
        
        return $this->respuesta = ['habitaciones'=>$habitaciones,'clientes'=>$clientes];//array de php en v7+
    }
    public function eliminarReserva($idReserva = 0){
        $this->db->consultas('
            DELETE reservas
            FROM reservas
            WHERE reservas.idReserva="'.$idReserva.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>