<?php require_once('classes/header.php');
	  require_once('classes/DAO.php');

	$email = $_SESSION['user_name'];

	$usuario_d = new usuario_dao();


  $usuario = new usuario();
  $usuario = $usuario_d->select($email);
  $nombre = $usuario->getNombre();

?>
<body>
<div class="well">
		<form id="form" action="classes/actualizacionUsuario.php" method="post" style="">

	<table width=500 >
	<br>
	<td >
		<input class="form-control" type="text" placeholder=<?php echo $email;  ?> readonly>

          			   <div class="form-group">
          					<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Nombre de usuario" value=<?php echo $nombre;  ?>>
          			   </div>
          				<div class="form-group">
                              <label for="cbopaises">Elije tu país: </label>
          									    <select class="form-control" name="cbopaises" tabindex="1">
                                 <option value="Costa Rica">Costa Rica</option>
                                 <option value="US">Estados Unidos</option>
                                 <option value="Mexico">Mexico</option>
                                 <option value="España">España</option>
                                 <option value="Otro">Otro</option>
          									    </select>
          				</div>
          				<div class="form-group">
          						<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña actual">
          				</div>
						<div class="form-group">
          					<input type="password" name="passwordA" id="passwordA" tabindex="2" class="form-control" placeholder="Contraseña nueva">
          				</div>
          				<div class="form-group">
          						<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirmar contraseña nueva">
          				</div>
          				<div class="form-group">
          						<div class="row">
          						<div class="col-sm-6 col-sm-offset-3">
          							<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Actualizar datos">
          				</div>
          				</div>
          					</div>
	</td>
	</table>
         </form>
		 </div>
</body>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Grupo Altamira 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	 <script src="js/signinfunctions.js"></script>

		


</body>

</html>
