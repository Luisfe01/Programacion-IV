<?php 
include('../../Config/Config.php');
$tipoproducto = new tipoproducto($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$tipoproducto->$proceso( $_GET['tipoproducto'] );
print_r(json_encode($tipoproducto->respuesta));

class tipoproducto{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($tipoproducto){
        $this->datos = json_decode($tipoproducto, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty(trim($this->datos['categoria'])) ){
            $this->respuesta['msg'] = 'por favor ingrese la categoria';
        }
       
        $this->almacenar_tipoproducto();
    }
    private function almacenar_tipoproducto(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO tipoproductos (categoria) VALUES(
                        "'. $this->datos['categoria'] .'"

                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE tipoproductos SET
                        categoria     = "'. $this->datos['categoria'] .'"
                    WHERE idTipoproducto = "'. $this->datos['idTipoproducto'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }else{
                $this->respuesta['msg'] = 'Error no se envio la accion a realizar';
            }
        }
    }
    public function buscarTipoproducto($valor = ''){
        $this->db->consultas('
            select tipoproductos.idTipoproducto, tipoproductos.categoria
            from tipoproductos
            where tipoproductos.categoria like "%'. $valor .'%" 
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarTipoproducto($idTipoproducto = 0){
        $this->db->consultas('
            DELETE tipoproductos
            FROM tipoproductos
            WHERE tipoproductos.idTipoproducto="'.$idTipoproducto.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>