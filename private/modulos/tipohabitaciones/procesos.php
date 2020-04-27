<?php 
include('../../Config/Config.php');
$tipohabitacion = new tipohabitacion($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$tipohabitacion->$proceso( $_GET['tipohabitacion'] );
print_r(json_encode($tipohabitacion->respuesta));

class tipohabitacion{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($tipohabitacion){
        $this->datos = json_decode($tipohabitacion, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['categoria']) ){
            $this->respuesta['msg'] = 'por favor ingrese la categoria';
        }
       
        $this->almacenar_tipohabitacion();
    }
    private function almacenar_tipohabitacion(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO tipohabitaciones (categoria) VALUES(
                        "'. $this->datos['categoria'] .'"

                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE tipohabitaciones SET
                        categoria     = "'. $this->datos['categoria'] .'"
                    WHERE idTipohabitacion = "'. $this->datos['idTipohabitacion'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarTipohabitacion($valor = ''){
        $this->db->consultas('
            select tipohabitaciones.idTipohabitacion, tipohabitaciones.categoria
            from tipohabitaciones
            where tipohabitaciones.categoria like "%'. $valor .'%" 
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarTipohabitacion($idTipohabitacion = 0){
        $this->db->consultas('
            DELETE tipohabitaciones
            FROM tipohabitaciones
            WHERE tipohabitaciones.idTipohabitacion="'.$idTipohabitacion.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>