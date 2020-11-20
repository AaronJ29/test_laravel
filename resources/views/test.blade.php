<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


</head>
    <body>
        <div class="card" style="width: 30rem; margin:auto">
<table>
 <thead>
   <tr>
     <th>ID</th>
     <th>CAR</th>
     <th>OPTIONS</th>
   </tr>
 </thead>
 <tbody id="car_list">

 </tbody>
</table>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">New Car</button>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agrega un nuevo auto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group mx-sm-3 mb-2">
    <label  class="sr-only">Car Name</label>
    <input type="text" class="form-control" id="car_name" placeholder="Car Name...">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="CreateCar()">Save changes</button>
      </div>
    </div>
  </div>
</div>
    </body>
</html>

<script type="text/javascript">
get_cars()
function get_cars() {
  $.ajax({
  url: "/admin/get_cars",
  method: 'GET',
  data: {},
  cache: false,
  beforeSend: function beforeSend(xhr) {},
  success: function success(data) {
    var construct = "";
    for (var i = 0; i < data.length; i++) {
      construct += "<tr><td>"+data[i].id+"</td><td><input id='car_"+data[i].id+"' value='"+data[i].car+"'></td><td><button type='button' class='btn btn-success' onclick='UpdateCar("+data[i].id+")'>Save</button><button type='button' class='btn btn-danger' onclick='DeleteCar("+data[i].id+")'>Delete</button></td></tr>"
    }
    $('#car_list').html(construct)


  },
  error: function error(xhr, ajaxOptions, thrownError) {

    alert('Error: 500')
  }
});
}



function UpdateCar(id) {
  var car = $('#car_'+id).val()
  $.ajax({
  url: "/admin/update_car",
  method: 'PUT',
  data: {
    "_token": "{{ csrf_token() }}",
    id:id,
    car:car
  },
  cache: false,
  beforeSend: function beforeSend(xhr) {},
  success: function success(data) {
  alert('¡Auto actualizado correctamente!')
  get_cars()
  },
  error: function error(xhr, ajaxOptions, thrownError) {

    alert('Error: 500')
  }
});
}

function CreateCar() {
  var car = $('#car_name').val();
  $.ajax({
  url: "/admin/create_car",
  method: 'POST',
  data: {
    "_token": "{{ csrf_token() }}",
    car:car
  },
  cache: false,
  beforeSend: function beforeSend(xhr) {},
  success: function success(data) {
  alert('¡Auto creado correctamente!')
  get_cars()
  },
  error: function error(xhr, ajaxOptions, thrownError) {

    alert('Error: 500')
  }
  });
}

function DeleteCar(id) {
  var car = $('#car_'+id).val()
  $.ajax({
  url: "/admin/delete_car",
  method: 'DELETE',
  data: {
    "_token": "{{ csrf_token() }}",
    id:id
  },
  cache: false,
  beforeSend: function beforeSend(xhr) {},
  success: function success(data) {
  alert('¡Auto eliminado correctamente!')
  get_cars()
  },
  error: function error(xhr, ajaxOptions, thrownError) {

    alert('Error: 500')
  }
});
}

</script>

<style media="screen">
  body{
    background: black
  }
</style>
