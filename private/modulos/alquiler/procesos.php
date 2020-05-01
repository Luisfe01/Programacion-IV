<?php 
include('../../Config/Config.php');
$alquileres = new alquileres($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$alquileres->$proceso( $_GET['alquileres'] );
print_r(json_encode($alquileres->respuesta));

class alquileres{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($alquileres){
        $this->datos = json_decode($alquileres, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['pelicula']['id']) ){
            $this->respuesta['msg'] = 'por favor ingrese el pelicula del alquileres';
        }
        if( empty($this->datos['cliente']['id']) ){
            $this->respuesta['msg'] = 'por favor ingrese el cliente';
        }
        $this->almacenar_alquileres();
    }
    private function almacenar_alquileres(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO alquiler (idPelicula,idCliente,fechaPrestamo,fechaDevolucion,valor) VALUES(
                        "'. $this->datos['pelicula']['id'] .'",
                        "'. $this->datos['cliente']['id'] .'",
                        "'. $this->datos['fechaPrestamo'] .'",
                        "'. $this->datos['fechaDevolucion'] .'",
                        "'. $this->datos['valor'] .'"

                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE alquiler SET
                        idPelicula     = "'. $this->datos['pelicula']['id'] .'",
                        idCliente      = "'. $this->datos['cliente']['id'] .'",
                        fechaPrestamo         = "'. $this->datos['fechaPrestamo'] .'",
                        fechaDevolucion         = "'. $this->datos['fechaDevolucion'] .'",
                        valor         = "'. $this->datos['valor'] .'"

                    WHERE idAlquiler = "'. $this->datos['idAlquiler'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarAlquiler($valor = ''){
        if( substr_count($valor, '-')===2 ){
            $valor = implode('-', array_reverse(explode('-',$valor)));
        }
        $this->db->consultas('
            select alquiler.idAlquiler, alquiler.idPelicula, alquiler.idCliente, 
                alquiler.fechaPrestamo, alquiler.fechaDevolucion, alquiler.valor,
                clientes.nombre,
                peliculas.titulo
            from alquiler
                inner join clientes on(clientes.idCliente=alquiler.idCliente)
                inner join peliculas on(peliculas.idPelicula=alquiler.idPelicula)
            where clientes.nombre like "%'. $valor .'%" or 
                peliculas.titulo like "%'. $valor .'%" or 
                alquiler.valor like "%'. $valor .'%"
                
        ');
        $alquiler = $this->respuesta = $this->db->obtener_data();
        foreach ($alquiler as $key => $value) {
            $datos[] = [
                'idAlquiler' => $value['idAlquiler'],
                'cliente'      => [
                    'id'      => $value['idCliente'],
                    'label'   => $value['nombre']
                ],
                'pelicula'      => [
                    'id'      => $value['idPelicula'],
                    'label'   => $value['titulo']
                ],
                'fechaPrestamo'       => $value['fechaPrestamo'],
                'fechaDevolucion'       => $value['fechaDevolucion'],
                'valor'       => $value['valor']


            ]; 
        }
        return $this->respuesta = $datos;
    }
    public function traer_peliculas_clientes(){
        $this->db->consultas('
            select peliculas.titulo AS label, peliculas.idPelicula AS id
            from peliculas
        ');
        $peliculas = $this->db->obtener_data();
        $this->db->consultas('
            select clientes.nombre AS label, clientes.idCliente AS id
            from clientes
        ');
        $clientes = $this->db->obtener_data();
        return $this->respuesta = ['peliculas'=>$peliculas, 'clientes'=>$clientes ];//array de php en v7+
    }
    public function eliminarAlquiler($idAlquiler = 0){
        $this->db->consultas('
            DELETE alquiler
            FROM alquiler
            WHERE alquiler.idAlquiler="'.$idAlquiler.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>