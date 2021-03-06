<!DOCTYPE html>
<html lang="ca">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MAQFA TALLER</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="dist/switchery.css" />
    <script src="dist/switchery.js"></script>
	<script src="jquery-3.1.1.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

      .feina { width: 310px;}
      .dia { width: 135px;}
      .hores { width: 87px;}
      .desc { width: 750px}
    </style>


    <script type="text/javascript">
/* code from qodo.co.uk */
// create as many regular expressions here as you need:
var digitsOnly = /[1234567890 A-Za-z\.\,\à\è\é\í\ò\ó\ù\ç]/g;
var integerOnly = /[0-9\.]/g;
var alphaOnly = /[A-Za-z]/g;

function restrictCharacters(myfield, e, restrictionType) {
	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);

	// if they pressed esc... remove focus from field...
	if (code==27) { this.blur(); return false; }

	// ignore if they are press other keys
	// strange because code: 39 is the down key AND ' key...
	// and DEL also equals .
	if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
		if (character.match(restrictionType)) {
			return true;
		} else {
			return false;
		}

	}
}
</script>
</head>

<?php
$idTreballador = $_GET["treballador"];
?>
<script>
var peligro = 0;
</script>
<body>
    <div class="container">
      <br /><br />
      <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php printNomTreballador($idTreballador); ?></div>
                                </div>
                            </div>
                        </div>
                        <a onclick="testguarro()">
                            <div class="panel-footer">
                                <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                <span class="pull-right">Tornar i guardar</span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                  <div class="panel panel-primary">
                      <div class="panel-heading">
                          Entrada d'hores
                      </div>
                      <div class="panel-body">
                          <div class="table-responsive">
                              <table id="supertaula" class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th>Feina</th>
                                          <th>Dia</th>
                                          <th>Hores</th>
                                          <th>Detall</th>
                                          <th>Acabada</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php printNewLines($idTreballador); ?>
                                  </tbody>
                              </table>
			                <button onclick="novalinia()" style='margin: 5px;' class="btn btn-primary btn-lg"><i class="fa fa-plus-circle"></i> Més línies</button>
			                <button onclick="testguarro()" style='margin: 5px;' class="btn btn-success btn-lg"><i class="fa fa-floppy-o"></i> Guardar</button>
							<div id="r"></div>
                          </div>
                      </div>
                  </div>
            </div>
        </div>
    </div>
	<script>
	<?php echo "var idTreballador=".$_GET["treballador"].";\n";?>
	function testguarro(){
		var tableToObj = function( table ) {
			var trs = table.rows,
				trl = trs.length,
				i = 0,
				j = 0,
				keys = [],
				obj, ret = [];

			for (; i < trl; i++) {
				if (i == 0) {
					for (; j < trs[i].children.length; j++) {
						keys.push(trs[i].children[j].innerHTML);
					}
				} else {
					obj = {};
					for (j = 0; j < trs[i].children.length-1; j++) {
						obj[keys[j]] = trs[i].children[j].children[0].value;
					}
					obj[keys[4]] = trs[i].children[4].children[0].checked;
					ret.push(obj);
				}
			}

			return ret;
		};

		document.getElementById('r').innerHTML = JSON.stringify(tableToObj(document.getElementsByTagName('table')[0]));

		// Sending a receiving data in JSON format using GET method
		xhr = new XMLHttpRequest();
		var url = "scripthores.php?idtreballador="+idTreballador+"&data=" + encodeURIComponent(JSON.stringify(tableToObj(document.getElementsByTagName('table')[0])));
		xhr.open("GET", url, true);
		xhr.setRequestHeader("Content-type", "application/json");
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				var json = JSON.parse(xhr.responseText);
				console.log(json.email + ", " + json.password);
			}
		}
		xhr.send();
		window.location = ".";
	}
</script>

<script>
	function novalinia() {
		/*var table = document.getElementById("supertaula");
		var row = table.insertRow(0);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		cell1.innerHTML = "NEW CELL1";
		cell2.innerHTML = "NEW CELL2";*/
		var row = $("<tr>");
		row.append($('<td class="feina"><?php printDesplegableFeinesActives();?></td>'))
			.append($('<td class="dia"><input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" placeholder="Descripció"></td>'))
			.append($('<td class="hores"><input class="form-control" placeholder="h"></td>'))
			.append($('<td class="desc"><input class="form-control" onkeypress="return restrictCharacters(this, event, digitsOnly);" placeholder="Descripció de la feina"></td>'))
			.append($('<td class="text-center"><input type="checkbox" class="js-switch" /></tr>'))
			$("#supertaula tbody").append(row);
		var nodes = document.querySelectorAll('.js-switch');
		var last = nodes[nodes.length- 1];
		var init = new Switchery(last);

	}
    </script>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


    <script>
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
      var switchery = new Switchery(html);
    });
    </script>

</body>

</html>
<?php
function printNewLines($idTreballador)
{
  include "mysql.php";
  $sql = "SELECT * FROM `hores` WHERE `dia_creacio_hores` = CURDATE() AND`id_treballador_hores`= $idTreballador ORDER BY `timestamp_hores`;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
    $checked = $row["feina_acabada_hores"];
	  echo
    "<tr>
        <td class=\"feina\">";
        printDesplegableFeinesActives1($row["id_feina_hores"]);
        echo"</td>
        <td class=\"dia\"><input type=\"date\" value=\"". $row["dia_hores"] ."\" class=\"form-control\" placeholder=\"Descripció\"></td>
        <td class=\"hores\"><input id=\"hores\" class=\"form-control\" placeholder=\"h\" value=". $row["hores_hores"]/100 ."></td>
        <td class=\"desc\"><input class=\"form-control\" onkeypress=\"return restrictCharacters(this, event, digitsOnly);\" placeholder=\"Descripció de la feina\" value=\"".$row["detall_hores"]."\"></td>
        <td class=\"text-center\"><input type=\"checkbox\" class=\"js-switch\" ";
        if ($checked == 1 || $checked) echo "checked";
        echo "/>
    </tr>";
	}
  } else {
	echo
    "<tr>
        <td class=\"feina\">";
        printDesplegableFeinesActives();
        echo"</td>
        <td class=\"dia\"><input type=\"date\" value=\"". date("Y-m-d") ."\" class=\"form-control\" placeholder=\"Descripció\"></td>
        <td class=\"hores\"><input id=\"hores\" class=\"form-control\" placeholder=\"h\"></td>
        <td class=\"desc\"><input class=\"form-control\" placeholder=\"Descripció de la feina\"></td>
        <td class=\"text-center\"><input type=\"checkbox\" class=\"js-switch\" />
    </tr>";
  }
}

function printDesplegableFeinesActives()
{
  echo "<select class=\"form-control\">";
  $result = getFeinesActivesIdDesc();
      echo "<option value=\"0\" style=\"font-style: oblique;\">Altres/Varis</option>";

      if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<option value=\"".$row["id_feina"]."\">".$row["descripcio_feina"]."</option>";
        }
      };

  echo "</select>";
}

function printDesplegableFeinesActives1($default)
{
  echo "<select class=\"form-control\">";
  $result = getFeinesActivesIdDesc();
      echo "<option value=\"0\" style=\"font-style: oblique;\">Altres/Varis</option>";

      if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
			if ($row["id_feina"] == $default)
			{
				echo "<option value=\"".$row["id_feina"]."\" selected>".$row["descripcio_feina"]."</option>";
			} else {
				echo "<option value=\"".$row["id_feina"]."\">".$row["descripcio_feina"]."</option>";
			}
        }
      };

  echo "</select>";
}

function getFeinesActivesIdDesc()
{
  include "mysql.php";
  $sql = "SELECT id_feina, descripcio_feina FROM feines WHERE estat_feina=1;";
  $result = $conn->query($sql);
  $conn->close();
  return $result;
}

function printNomTreballador($idTreb)
{
  include "mysql.php";
  $sql = "SELECT * FROM `treballadors` WHERE `id_treballador` = $idTreb;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
    echo $row["nom_treballador"];
  }
}
}
?>
