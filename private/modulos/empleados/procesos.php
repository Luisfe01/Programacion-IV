<?php 
include('../../Config/Config.php');
$empleado = new empleado($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$empleado->$proceso( $_GET['empleado'] );
print_r(json_encode($empleado->respuesta));

class empleado{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($empleado){
        $this->datos = json_decode($empleado, true);
        $this->validar_datos();
    }
    private function validar_datos(){

        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del empleado';
        }
        if( empty($this->datos['apellido']) ){
            $this->respuesta['msg'] = 'por favor ingrese el apellido del empleado';
        }
        if( empty($this->datos['direccion']) ){
            $this->respuesta['msg'] = 'por favor ingrese la direccion del empleado';
        }
        if( empty($this->datos['telefono']) ){
            $this->respuesta['msg'] = 'por favor ingrese el telefono del empleado';
        }
        if( empty($this->datos['dui']) ){
            $this->respuesta['msg'] = 'por favor ingrese el dui de empleado';
        }
        if( empty($this->datos['fechanacimiento']) ){
            $this->respuesta['msg'] = 'por favor ingrese la fecha de nacimiento';
        }
        if( empty($this->datos['tipoempleado']['id']) ){
            $this->respuesta['msg'] = 'por favor ingrese el tipo del empleado';
        }
       
        $this->almacenar_empleado();
    }
    private function almacenar_empleado(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO empleados (idTipoempleado,nombre,apellido,direccion,telefono,dui,fechanacimiento) VALUES(
                        "'. $this->datos['tipoempleado']['id'] .'",
                        "'. $this->datos['nombre'].'",
                        "'. $this->datos['apellido'] .'",
                        "'. $this->datos['direccion'].'",
                        "'. $this->datos['telefono'] .'",
                        "'. $this->datos['dui'].'",
                        "'. $this->datos['fechanacimiento'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE empleados SET
                        idTipoempleado     = "'. $this->datos['tipoempleado']['id'] .'",
                        nombre            = "'. $this->datos['nombre'].'",
                        apellido          = "'. $this->datos['apellido'].'",
                        direccion         = "'. $this->datos['direccion'].'",
                        telefono          = "'. $this->datos['telefono'].'",
                        dui         = "'. $this->datos['dui'].'",
                        fechanacimiento          = "'. $this->datos['fechanacimiento'].'"
                    WHERE idEmpleado = "'. $this->datos['idEmpleado'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarEmpleado($valor = ''){
        $this->db->consultas('
            select empleados.idEmpleado, tipoempleados.idTipoempleado, tipoempleados.tipo, empleados.nombre, empleados.apellido, empleados.direccion, empleados.telefono, empleados.dui, empleados.fechanacimiento
            from empleados INNER JOIN tipoempleados on empleados.idTipoempleado=tipoempleados.idTipoempleado
            where empleados.nombre like "%'. $valor .'%" or empleados.apellido like "%'. $valor .'%" or empleados.telefono like "%'. $valor .'%"

        ');
        $empleados = $this->respuesta = $this->db->obtener_data();
        foreach ($empleados as $key => $value) {
            $datos[] = [
                'idEmpleado' => $value['idEmpleado'],
                'nombre' => $value['nombre'],
                'apellido' => $value['apellido'],
                'tipoempleado'      => [
                    'id'      => $value['idTipoempleado'],
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
    public function traer_tipoempleados(){
        $this->db->consultas('
            select tipoempleados.tipo AS label, tipoempleados.idTipoempleado AS id
            from tipoempleados
        ');
        $tipoempleados = $this->db->obtener_data();
        
        return $this->respuesta = ['tipoempleados'=>$tipoempleados];//array de php en v7+
    }
    public function eliminarEmpleado($idEmpleado = 0){
        $this->db->consultas('
            DELETE empleados
            FROM empleados
            WHERE empleados.idEmpleado="'.$idEmpleado.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>