<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model{




  public static function get_employees(){
    $sql = "select * from employees where deleted_at is null order by id asc;";
    $cars = \DB::select(\DB::raw($sql));
    return $cars;

  }

  public static function get_employee($param){
    $sql = "select * from employees where id = ".$param.";";
    $cars = \DB::select(\DB::raw($sql));
    return $cars;

  }

  public static function code_validation($param, $param2){
    $sql = "select codigo from employees where codigo = '".$param."' and id != ".$param2.";";
    $cars = \DB::select(\DB::raw($sql));
    return $cars;

  }

  public static function code_validation_create($param){
    $sql = "select codigo from employees where codigo = '".$param."';";
    $cars = \DB::select(\DB::raw($sql));
    return $cars;

  }

  public static function create_employee($codigo_in, $nombre_in, $salarioDolares_in, $salarioPesos_in, $direccion_in, $estado_in, $ciudad_in, $telefono_in, $correo_in){

    $query = \DB::insert('insert into employees (`codigo`, `nombre`, `salarioDolares`, `salarioPesos`, `direccion`, `estado`, `ciudad`, `telefono`, `correo`, `created_at`) values ("'.$codigo_in.'", "'.$nombre_in.'", "'.$salarioDolares_in.'", "'.$salarioPesos_in.'", "'.$direccion_in.'", "'.$estado_in.'", "'.$ciudad_in.'", "'.$telefono_in.'", "'.$correo_in.'",now())');
    return $query;


  }

  public static function update_employee($id_in, $codigo_in, $nombre_in, $salarioDolares_in, $salarioPesos_in, $direccion_in, $estado_in, $ciudad_in, $telefono_in, $correo_in){

    $query = \DB::update('update employees set codigo = "'.$codigo_in.'", nombre = "'.$nombre_in.'", salarioDolares = "'.$salarioDolares_in.'", salarioPesos = "'.$salarioPesos_in.'", direccion = "'.$direccion_in.'", estado = "'.$estado_in.'", ciudad = "'.$ciudad_in.'", telefono = "'.$telefono_in.'", correo = "'.$correo_in.'", updated_at = now() where id = "'.$id_in.'"');
    return $query;


  }

  public static function deactivate_employee($id_in, $type_in){

    $query = \DB::update('update employees set activo = ? where id = ?',[$type_in, $id_in]);
    return $query;


  }

  public static function delete_employee($param){

    $query = \DB::update('update employees set deleted_at = now() where id = ?',[$param]);
    return $query;


  }



}
