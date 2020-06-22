<?php 
include('../../Config/Config.php');
$tipoempleado = new tipoempleado($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$tipoempleado->$proceso( $_GET['tipoempleado'] );
print_r(json_encode($tipoempleado->respuesta));

class tipoempleado{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($tipoempleado){
        $this->datos = json_decode($tipoempleado, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty(trim($this->datos['tipo'])) ){
            $this->respuesta['msg'] = 'por favor ingrese la tipo';
        }
       
        $this->almacenar_tipoempleado();
    }
    private function almacenar_tipoempleado(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO tipoempleados (tipo) VALUES(
                        "'. $this->datos['tipo'] .'"

                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE tipoempleados SET
                        tipo     = "'. $this->datos['tipo'] .'"
                    WHERE idTipoempleado = "'. $this->datos['idTipoempleado'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }else{
                $this->respuesta['msg'] = 'Error no se envio la accion a realizar';
            }
        }
    }
    public function buscarTipoempleado($valor = ''){
        $this->db->consultas('
            select tipoempleados.idTipoempleado, tipoempleados.tipo
            from tipoempleados
            where tipoempleados.tipo like "%'. $valor .'%" 
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarTipoempleado($idTipoempleado = 0){
        $this->db->consultas('
            DELETE tipoempleados
            FROM tipoempleados
            WHERE tipoempleados.idTipoempleado="'.$idTipoempleado.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>