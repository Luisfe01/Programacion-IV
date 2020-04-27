<?php 
include('../../Config/Config.php');
$piso = new piso($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$piso->$proceso( $_GET['piso'] );
print_r(json_encode($piso->respuesta));

class piso{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($piso){
        $this->datos = json_decode($piso, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['piso']) ){
            $this->respuesta['msg'] = 'por favor ingrese el numero del piso';
        }
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese nombre del piso';
        }
        $this->almacenar_piso();
    }
    private function almacenar_piso(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO pisos (piso,nombre) VALUES(
                        "'. $this->datos['piso'] .'",
                        "'. $this->datos['nombre'] .'"

                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE pisos SET
                        piso     = "'. $this->datos['piso'] .'",
                        nombre   = "'. $this->datos['nombre'] .'"
                    WHERE idPiso = "'. $this->datos['idPiso'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarPiso($valor = ''){
        $this->db->consultas('
            select pisos.idPiso, pisos.piso, pisos.nombre
            from pisos
            where pisos.piso like "%'. $valor .'%" or pisos.nombre like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarPiso($idPiso = 0){
        $this->db->consultas('
            DELETE pisos
            FROM pisos
            WHERE pisos.idPiso="'.$idPiso.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>