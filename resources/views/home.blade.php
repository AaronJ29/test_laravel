@extends('layouts.app')
@section('content')

<div class="card" style="width: 80rem;margin:auto;">
   <table>
      <thead>
         <tr>
            <th>ID</th>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>SALARIO (DOLARES)</th>
            <th>SALARIO (PESOS)</th>
            <th>CORREO</th>
            <th>STATUS</th>
            <th>ACCIONES</th>
         </tr>
      </thead>
      <tbody id="employee_list">
      </tbody>
   </table>
   <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="ModalEmployeeCreate();">Nuevo Empleado</button>
</div>
<div class="employee_modals">

</div>
<script type="text/javascript">
$('#mes1').html('')
$('#mes2').html('')
$('#mes3').html('')
$('#mes4').html('')
$('#mes5').html('')
$('#mes6').html('')
   get_employees()
   function get_employees() {
     $.ajax({
     url: "/admin/get_employees",
     method: 'GET',
     data: {},
     cache: false,
     beforeSend: function beforeSend(xhr) {},
     success: function success(data) {
       var construct = "";
       var active_employee = ""

       for (var i = 0; i < data.length; i++) {
         if (data[i].activo == true) {
           active_employee = "<button type='button' class='btn btn-secondary' onclick='StatusEmployee("+data[i].id+",0)'>Desactivar</button>"
         }else{
           active_employee = "<button type='button' class='btn btn-success' onclick='StatusEmployee("+data[i].id+",1)'>Activar</button>"
         }


         construct += "<tr><td>"+data[i].id+"</td><td>"+data[i].codigo+"</td><td>"+data[i].nombre+"</td><td>"+data[i].salarioDolares+"</td><td>"+data[i].salarioPesos+"</td><td>"+data[i].correo+"</td><td>"+data[i].activo+"</td><td><button type='button' class='btn btn-info' onclick='GetEmployee("+ data[i].id +",1)'>Detalle</button><button type='button' class='btn btn-warning' onclick='GetEmployee("+ data[i].id +",2)'>Editar</button>"+active_employee+"<button type='button' class='btn btn-danger' onclick='DeleteEmployee("+data[i].id+")'>Borrar</button></td></tr>";
       }
       $('#employee_list').html(construct)


     },
     error: function error(xhr, ajaxOptions, thrownError) {

       alert('Error: 500')
     }
   });
   }

   function GetEmployee(id, action) {
     $.ajax({
     url: "/admin/get_employee",
     method: 'GET',
     data: {
       id:id
     },
     cache: false,
     beforeSend: function beforeSend(xhr) {},
     success: function success(data) {

         ModalEmployee(data[0].id, data[0].codigo, data[0].nombre, data[0].salarioDolares, data[0].salarioPesos, data[0].direccion, data[0].estado, data[0].ciudad, data[0].telefono, data[0].correo, data[0].activo, data[0].created_at, data[0].updated_at, action);

     },
     error: function error(xhr, ajaxOptions, thrownError) {

       alert('Error: 500')
     }
   });
   }



   function UpdateEmployee(id) {
     var codigo = $('#emp_codigo').val()
     var nombre = $('#emp_nombre').val()
     var salarioDolares = $('#emp_salarioDolares').val()
     var salarioPesos = $('#emp_salarioPesos').val()
     var direccion = $('#emp_direccion').val()
     var estado = $('#emp_estado').val()
     var ciudad = $('#emp_ciudad').val()
     var telefono = $('#emp_telefono').val()
     var correo = $('#emp_correo').val()
     if (codigo == '' || nombre == '' || salarioDolares == '' || salarioPesos == '' || direccion == '' || estado == '' || ciudad == '' || telefono == '' || correo == '' ) {
     alert('Asegurate de llenar todos los campos')
   }else{

     $.ajax({
     url: "/admin/code_validation",
     method: 'GET',
     data: {
       codigo:codigo,
       id:id
     },
     cache: false,
     beforeSend: function beforeSend(xhr) {},
     success: function success(data) {
       if (data == null || data == undefined || data == '') {
         $.ajax({
         url: "/admin/update_employee",
         method: 'PUT',
         data: {
           "_token": "{{ csrf_token() }}",
           id:id,
           codigo:codigo,
           nombre:nombre,
           salarioDolares:salarioDolares,
           salarioPesos:salarioPesos,
           direccion:direccion,
           estado:estado,
           ciudad:ciudad,
           telefono:telefono,
           correo:correo,
         },
         cache: false,
         beforeSend: function beforeSend(xhr) {},
         success: function success(data) {
         alert('¡Empleado actualizado correctamente!')
         get_employees()
         },
         error: function error(xhr, ajaxOptions, thrownError) {

           alert('Error: 500')
         }
       });
       }else{
         alert('Este código ya existe')
       }
     },
     error: function error(xhr, ajaxOptions, thrownError) {

       alert('Error: 500')
     }
   });
 }
}

   function CreateEmployee() {
     var codigo = $('#emp_codigo').val()
     var nombre = $('#emp_nombre').val()
     var salarioDolares = $('#emp_salarioDolares').val()
     var salarioPesos = $('#emp_salarioPesos').val()
     var direccion = $('#emp_direccion').val()
     var estado = $('#emp_estado').val()
     var ciudad = $('#emp_ciudad').val()
     var telefono = $('#emp_telefono').val()
     var correo = $('#emp_correo').val()

  if (codigo == '' || nombre == '' || salarioDolares == '' || salarioPesos == '' || direccion == '' || estado == '' || ciudad == '' || telefono == '' || correo == '' ) {
  alert('Asegurate de llenar todos los campos')
}else{

     if (isNaN(salarioDolares) == true || isNaN(salarioPesos) == true) {
       alert('El salario debe ser tipo numérico');
     }else{

     $.ajax({
     url: "/admin/code_validation_create",
     method: 'GET',
     data: {
       codigo:codigo
     },
     cache: false,
     beforeSend: function beforeSend(xhr) {},
     success: function success(data) {
       if (data == null || data == undefined || data == '') {
         $.ajax({
         url: "/admin/create_employee",
         method: 'POST',
         data: {
           "_token": "{{ csrf_token() }}",
           codigo:codigo,
           nombre:nombre,
           salarioDolares:salarioDolares,
           salarioPesos:salarioPesos,
           direccion:direccion,
           estado:estado,
           ciudad:ciudad,
           telefono:telefono,
           correo:correo,
         },
         cache: false,
         beforeSend: function beforeSend(xhr) {},
         success: function success(data) {
         alert('¡Empleado creado correctamente!')
         get_employees()
         },
         error: function error(xhr, ajaxOptions, thrownError) {

           alert('Error: 500')
         }
       });
       }else{
         alert('Este código ya existe')
       }
     },
     error: function error(xhr, ajaxOptions, thrownError) {

       alert('Error: 500')
     }
   });
  }
 }
}

   function DeleteEmployee(id) {
     $.ajax({
     url: "/admin/delete_employee",
     method: 'PUT',
     data: {
       "_token": "{{ csrf_token() }}",
       id:id
     },
     cache: false,
     beforeSend: function beforeSend(xhr) {},
     success: function success(data) {
     alert('¡Empleado Eliminado!')
     get_employees()
     },
     error: function error(xhr, ajaxOptions, thrownError) {

       alert('Error: 500')
     }
   });
   }

   function ModalEmployee(id, codigo, nombre, salarioDolares, salarioPesos, direccion, estado, ciudad, telefono, correo, activo, created_at, updated_at, action) {
     const create_modal_detail_employee = new Promise(function() {
         $('.employee_modals').html('');
         $('.employee_modals').html('<div class="modal fade" id="modal_detail_employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <p class="modal-title" style="font-weight:bold;" id="exampleModalLabel">Modal title</p> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> ... </div>  <div id="modal_footer"></div></div> </div></div>');
       });
       if (action == 1) {
         create_modal_detail_employee.then( Show_Modal_Detail_Employee(id, codigo, nombre, salarioDolares, salarioPesos, direccion, estado, ciudad, telefono, correo, activo, created_at, updated_at));
       }else if (action == 2){
       create_modal_detail_employee.then( Show_Modal_Edit_Employee(id, codigo, nombre, salarioDolares, salarioPesos, direccion, estado, ciudad, telefono, correo, activo, created_at, updated_at));
     }
   }


   function ModalEmployeeCreate() {
     const create_modal_detail_employee = new Promise(function() {
         $('.employee_modals').html('');
         $('.employee_modals').html('<div class="modal fade" id="modal_detail_employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <p class="modal-title" style="font-weight:bold;" id="exampleModalLabel">Modal title</p> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> ... </div>  <div id="modal_footer"></div></div> </div></div>');
       });

        create_modal_detail_employee.then( Show_Modal_Create_Employee());

   }

   function Show_Modal_Detail_Employee(id, codigo, nombre, salarioDolares, salarioPesos, direccion, estado, ciudad, telefono, correo, activo, created_at, updated_at) {
      $('#modal_footer').html('');
      $('#modal_detail_employee .modal-title').html('Detalle del Empleado');
      $('#modal_detail_employee').modal('show');
      if (activo == 1) {
        activo = "Activo"
      }else if (activo == 0) {
        activo = "Inactivo"
      }
      $('#modal_detail_employee .modal-body').html('<input type="text" id="porcentaje" onkeydown="Calculate()" name="" value="" placeholder"Ingresa porcentaje"><div class="container"> <div class="row"> <div class="col-sm" id="mes1">  </div> <div class="col-sm" id="mes2"> One of three columns </div> <div class="col-sm" id="mes3"> One of three columns </div> </div><div class="row"> <div class="col-sm" id="mes4">  </div> <div class="col-sm" id="mes5"> One of three columns </div> <div class="col-sm" id="mes6"> One of three columns </div> </div></div> <div class="card" style="width: 18rem;margin:auto; font-size:11px;"> <div class="card-header"> Empleado </div> <ul class="list-group list-group-flush"> <li class="list-group-item">Id: '+id+'</li> <li class="list-group-item">Codigo: '+codigo+'</li> <li class="list-group-item">Nombre: '+nombre+'</li> <li class="list-group-item">Salario (Dolares): '+salarioDolares+'</li> <li class="list-group-item"><input type="text" name="" id="salario_pesos" style="display:none;" value="'+salarioPesos+'">Salario (Pesos): '+salarioPesos+'</li> <li class="list-group-item">Dirección: '+direccion+'</li> <li class="list-group-item">Estado: '+estado+'</li> <li class="list-group-item">Ciudad: '+ciudad+'</li> <li class="list-group-item">Teléfono: '+telefono+'</li> <li class="list-group-item">Correo: '+correo+'</li> <li class="list-group-item">Status: '+activo+'</li> <li class="list-group-item">Creado el: '+created_at+'</li> <li class="list-group-item">Actualizado el: '+updated_at+'</li> </ul></div>');


}

function Show_Modal_Edit_Employee(id, codigo, nombre, salarioDolares, salarioPesos, direccion, estado, ciudad, telefono, correo, activo, created_at, updated_at) {
   $('#modal_footer').html('');
   $('#modal_footer').html('<div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary" onclick="UpdateEmployee('+id+')">Guardar</button> </div>');


   $('#modal_detail_employee .modal-title').html('Editar Empleado');
   $('#modal_detail_employee').modal('show');
   if (activo == 1) {
     activo = "Activo"
   }else if (activo == 0) {
     activo = "Inactivo"
   }
   $('#modal_detail_employee .modal-body').html('<div class="card" style="width: 18rem;margin:auto; font-size:11px;"> <div class="card-header"> Empleado </div> <ul class="list-group list-group-flush"> <li class="list-group-item">Id: <input type="text" name="" id="emp_id" value="'+id+'" disabled></li> <li class="list-group-item">Codigo: <input type="text" name="" id="emp_codigo" value="'+codigo+'"></li> <li class="list-group-item">Nombre: <input type="text" onkeypress="check(event)" name="" onkeypress="check(event)" id="emp_nombre" value="'+nombre+'"></li> <li class="list-group-item">Salario (Dolares): <input type="number" id="emp_salarioDolares" name="" onkeydown="CambioDolar(2)" value="'+salarioDolares+'"></li> <li class="list-group-item">Salario (Pesos): <input type="number" id="emp_salarioPesos" name="" onkeydown="CambioDolar(1)" value="'+salarioPesos+'"></li> <li class="list-group-item">Dirección: <input type="text" name="" id="emp_direccion" value="'+direccion+'"></li> <li class="list-group-item">Estado: <input type="text" name="" id="emp_estado" value="'+estado+'"></li> <li class="list-group-item">Ciudad: <input type="text" name="" id="emp_ciudad" value="'+ciudad+'"></li> <li class="list-group-item">Teléfono: <input type="text" name="" id="emp_telefono" value="'+telefono+'"></li> <li class="list-group-item">Correo: <input type="email" name="" id="emp_correo" value="'+correo+'"></li> <li class="list-group-item">Status: <input type="text" name="" id="emp_activo" value="'+activo+'"></li> <li class="list-group-item">Creado el: <input type="text" name="" value="'+created_at+'" disabled></li> <li class="list-group-item">Actualizado el: <input type="text" name="" value="'+updated_at+'" disabled></li> </ul></div>');


}

function Show_Modal_Create_Employee() {
   $('#modal_footer').html('');
   $('#modal_footer').html('<div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary" onclick="CreateEmployee()">Guardar</button> </div>');


   $('#modal_detail_employee .modal-title').html('Nuevo Empleado');
   $('#modal_detail_employee').modal('show');

   $('#modal_detail_employee .modal-body').html('<div class="card" style="width: 18rem;margin:auto; font-size:11px;"> <div class="card-header"> Empleado </div> <ul class="list-group list-group-flush"> <li class="list-group-item">Codigo: <input type="text" name="" id="emp_codigo" value=""></li> <li class="list-group-item">Nombre: <input type="text" name="" id="emp_nombre" value=""></li> <li class="list-group-item">Salario (Dolares): <input type="number" id="emp_salarioDolares" name="" onkeydown="CambioDolar(2)" value=""></li> <li class="list-group-item">Salario (Pesos): <input type="number" id="emp_salarioPesos" name="" onkeydown="CambioDolar(1)" value=""></li> <li class="list-group-item">Dirección: <input type="text" name="" id="emp_direccion" value=""></li> <li class="list-group-item">Estado: <input type="text" name="" id="emp_estado" value=""></li> <li class="list-group-item">Ciudad: <input type="text" name="" id="emp_ciudad" value=""></li> <li class="list-group-item">Teléfono: <input type="text" name="" id="emp_telefono" value=""></li> <li class="list-group-item">Correo: <input type="email" name="" id="emp_correo" value=""></li> </ul></div>');


}

function CambioDolar(type) {
  $.ajax({
  url: "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos?token=0fce7d85c76c9afa6f8ef05f95d50a11c62573c637d28706e28f2a81e84264e5",
  method: 'GET',
  data: {},
  cache: false,
  jsonp : 'callback',
	dataType : 'jsonp',
  beforeSend: function beforeSend(xhr) {},
  success: function success(data) {
  var series = data.bmx.series;
  var last_value = ""
  for (var i in series) {
				  var serie=series[i];
				  last_value = serie.datos[serie.datos.length - 1].dato;


			}
      if (type == 1) {
        var value = $('#emp_salarioPesos').val();
        $('#emp_salarioDolares').val(value / last_value);
      }else if (type == 2) {
        var value = $('#emp_salarioDolares').val();
        $('#emp_salarioPesos').val(value * last_value);
      }

  },
  error: function error(xhr, ajaxOptions, thrownError) {

    alert('Error: 500')
  }
});
}

function StatusEmployee(id, type) {
  $.ajax({
  url: "/admin/deactivate_employee",
  method: 'PUT',
  data: {
    "_token": "{{ csrf_token() }}",
    id:id,
    type:type
  },
  cache: false,
  beforeSend: function beforeSend(xhr) {},
  success: function success(data) {
  alert('¡Status Cambiado!')
  get_employees()
  },
  error: function error(xhr, ajaxOptions, thrownError) {

    alert('Error: 500')
  }
});
}

function Calculate() {
var value = $('#porcentaje').val();
var salario = $('#salario_pesos').val();
var mes1 = salario;
var mes2 = ((mes1 * value) / (100)) + salario;
var mes3 = ((mes2 * value) / (100)) + salario;
var mes4 = ((mes3 * value) / (100)) + salario;
var mes5 = ((mes4 * value) / (100)) + salario;
var mes6 = ((mes5 * value) / (100)) + salario;

$('#mes1').html('')
$('#mes2').html('')
$('#mes3').html('')
$('#mes4').html('')
$('#mes5').html('')
$('#mes6').html('')

$('#mes1').html(mes1)
$('#mes2').html(mes2)
$('#mes3').html(mes3)
$('#mes4').html(mes4)
$('#mes5').html(mes5)
$('#mes6').html(mes6)
}
</script>
<style media="screen">
  .employee_modals col-sm{
    font-size: 9px !important;
  }
</style>
@endsection
