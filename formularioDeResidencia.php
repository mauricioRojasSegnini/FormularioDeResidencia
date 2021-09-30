<!DOCTYPE html>
<html>

<head>
  <title>
    Formulario de residencia
  </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    function Confirmacion() {
      var jqxhr = jQuery.ajax("confirmacion.html").done(function(data) {
        jQuery("#msjConfirmacion").html(data);
      });
    }
  </script>
</head>

<body>
  <br /><br />
  <div class="p-3 mb-2 bg-primary text-white">
    <div class="container" style="width: 600px">
      <h2 align="center">
        Formulario de residencia de Costa Rica
      </h2>
      <br /><br />
      <select name="provincia" id="provincia" class="form-control input-lg">
        <option value="">Ingrese la Provincia</option>
      </select>
      <br />
      <select name="cantón" id="cantón" class="form-control input-lg">
        <option value="">Ingrese el cantón</option>
      </select>
      <br />
      <select name="distrito" id="distrito" class="form-control input-lg">
        <option value="">Ingrese el distrito</option>
      </select>
      <br />
      <input type="button" class="btn btn-primary btn-lg" onclick="Confirmacion();" value="Ingresar datos" />
      <div id="msjConfirmacion"></div>
    </div>
  </div>
</body>

</html>


<script>
  $(document).ready(function() {
    load_json_data("provincia");

    function load_json_data(id, parent_id) {
      var html_code = "";
      $.getJSON("dataBaseInfo.json", function(data) {
        html_code += '<option value="">Ingrese ' + id + "</option>";
        $.each(data, function(key, value) {
          if (id == "provincia") {
            if (value.parent_id == "0") {
              html_code +=
                '<option value="' + value.id + '">' + value.name + "</option>";
            }
          } else {
            if (value.parent_id == parent_id) {
              html_code +=
                '<option value="' + value.id + '">' + value.name + "</option>";
            }
          }
        });
        $("#" + id).html(html_code);
      });
    }

    $(document).on("change", "#provincia", function() {
      var country_id = $(this).val();
      if (country_id != "") {
        load_json_data("cantón", country_id);
      } else {
        $("#cantón").html('<option value="">Ingrese el cantón</option>');
        $("#distrito").html('<option value="">Ingrese el distrito</option>');
      }
    });
    $(document).on("change", "#cantón", function() {
      var cantón_id = $(this).val();
      if (cantón_id != "") {
        load_json_data("distrito", cantón_id);
      } else {
        $("#distrito").html('<option value="">Ingrese el distrito</option>');
      }
    });
  });
</script>