<!-- Navigation -->
<?php
include "funcions.php";
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Obrir navegació</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><i class="fa fa-cubes"></i> MaqfaPlus</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-version">
                    <p class="text-muted">Versió 0.23.131216 <a href="about.php"><i class="fa fa-cogs"></i></a></p>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Portada</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-tasks fa-fw"></i> Feines<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="afegirFeina.php"><i class="fa fa-plus"></i> Crear feina</a>
                        </li>
                        <li>
                            <a href="feinesActives.php"><i class="fa fa-cog fa-spin"></i> Feines actives [<?php getCountFeinesActives(); ?>]</a>
                        </li>
                        <li>
                            <a href="feinesFinalitzades.php"><i class="fa fa-check-square-o"></i> Feines finalitzades [<?php getCountFeinesFinalitzades(); ?>]</a>
                        </li>
                        <li>
                            <a href="feinesFacturades.php"><i class="fa fa-check-square"></i> Feines facturades</a>
                        </li>
                        <li>
                            <a href="totesFeines.php"><i class="fa fa-list"></i> Totes les feines</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> Clients<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="afegirClient.php"><i class="fa fa-user-plus"></i> Afegir client</a>
                        </li>
                        <li>
                            <a href="clients.php"><i class="fa fa-users"></i> Tots els clients</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-file-text fa-fw"></i> Factures<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="afegirFactura.php"><i class="fa fa-pencil"></i> Crear factura</a>
                        </li>
                        <li>
                            <a href="totesFactures.php"><i class="fa fa-list"></i></i> Totes les factures</a>
                        </li>
                        <li>
                            <a href="facturesNoCobrades.php"><i class="fa fa-money"></i></i> Pendents de cobrament</a>
                        </li>
                        <li>
                            <a href="facturesBorrador.php"><i class="fa fa-eraser"></i></i> Borradors</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-id-card-o fa-fw"></i> Treballadors<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php imprimirMenuTreballadors();?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="about.php"><i class="fa fa-info-circle fa-fw"></i></i> Informació MaqfaPlus</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<?php
function imprimirMenuTreballadors()
{
  include "mysql.php";
  $sql = "SELECT * FROM `treballadors`";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $nom = $row["nom_treballador"];
        echo "<li>
            <a href=\"totesHores.php?id=3\"><i class=\"fa fa-user\"></i> ".$nom."</a>
        </li>";
      }
    }
}
?>
