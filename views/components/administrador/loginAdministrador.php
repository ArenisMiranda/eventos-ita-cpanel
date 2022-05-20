<?php
include "views/includes/navbar.php"
?>

<h1>Iniciar sesion</h1>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="d-grid gap-3">
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario"  required autofocus>
                            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                            <input type="submit" class="btn btn-success btn-block" value="Iniciar Sesion" name="ingresarAdmin">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<?php

$ingreso = new ControlladorAdministrador;
$ingreso -> ctrFormInicioAdministrador();


?>