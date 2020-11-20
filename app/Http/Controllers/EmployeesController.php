<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeesController extends Controller{


  public function create_employee(Request $request){
    $codigo_in = $request->input('codigo');
    $nombre_in = $request->input('nombre');
    $salarioDolares_in = $request->input('salarioDolares');
    $salarioPesos_in = $request->input('salarioPesos');
    $direccion_in = $request->input('direccion');
    $estado_in = $request->input('estado');
    $ciudad_in = $request->input('ciudad');
    $telefono_in = $request->input('telefono');
    $correo_in = $request->input('correo');
    $employee = Employee::create_employee($codigo_in, $nombre_in, $salarioDolares_in, $salarioPesos_in, $direccion_in, $estado_in, $ciudad_in, $telefono_in, $correo_in);
      return response(json_encode($employee));

  }

    public function get_employees(Request $request){
        $employees = Employee::get_employees();
        return response()->json($employees);

    }


    public function get_employee(Request $request){
        $id_in = $request->input('id');
        $employee = Employee::get_employee($id_in);
        return response()->json($employee);

    }

    public function code_validation(Request $request){
        $code_in = $request->input('codigo');
        $id_in = $request->input('id');
        $employee = Employee::code_validation($code_in, $id_in);
        return response()->json($employee);

    }

    public function code_validation_create(Request $request){
        $code_in = $request->input('codigo');
        $employee = Employee::code_validation_create($code_in);
        return response()->json($employee);

    }



    public function update_employee(Request $request){
          $id_in = $request->input('id');
          $codigo_in = $request->input('codigo');
          $nombre_in = $request->input('nombre');
          $salarioDolares_in = $request->input('salarioDolares');
          $salarioPesos_in = $request->input('salarioPesos');
          $direccion_in = $request->input('direccion');
          $estado_in = $request->input('estado');
          $ciudad_in = $request->input('ciudad');
          $telefono_in = $request->input('telefono');
          $correo_in = $request->input('correo');

        $employee = Employee::update_employee($id_in, $codigo_in, $nombre_in, $salarioDolares_in, $salarioPesos_in, $direccion_in, $estado_in, $ciudad_in, $telefono_in, $correo_in);
        return response(json_encode($employee));

    }

    public function deactivate_employee(Request $request){
          $id_in = $request->input('id');
          $type_in = $request->input('type');

        $employee = Employee::deactivate_employee($id_in, $type_in);
        return response(json_encode($employee));

    }

    public function delete_employee(Request $request){
        $id_in = $request->input('id');
        $employee = Employee::delete_employee($id_in);
        return response(json_encode($employee));

    }

}
