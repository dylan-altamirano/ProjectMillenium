<?php //var_dump($usuario); ?>
<div class="container">
  <div class="row">
		<div class="well widget widget-gray"> <!-- TYPE PANEL -->
				<div class="widget-head"> <!-- HEAD PANEL -->
					<h4 class="heading"><i class="fa fa-briefcase"></i>  <?php echo $usuario->getNombre(); ?></h4>
				</div><!-- /HEAD PANEL -->

                <div class="widget-body" id="widget-body1"> <!-- CONTENT PANEL -->
                        <h3> Identificación: <?php echo $usuario->getId(); ?> </h3>
												<h3> Correo: <?php echo $usuario->getCorreo(); ?> </h3>
                        <h3> Pais: <?php echo $usuario->getPais(); ?> </h3>

                </div><!-- /CONTENT PANEL -->

                <div class="widget-footer"><!-- FOOTER PANEL-->
                    <a href="classes/eliminarUsuario.php?id=<?php echo $usuario->getId(); ?>" class="fa fa-minus-circle fa-1x" data-toggle="tooltip" data-placement="right" title="" data-original-title="FA-MINUS-CIRCLE"><i></i></a>
                    <a href="#" class="fa fa-pencil fa-1x" data-toggle="tooltip" data-placement="right" title="" data-original-title="FA-PENCIL"><i></i></a>
                    <a href="#" class="fa fa-search fa-1x" data-toggle="tooltip" data-placement="right" title="" data-original-title="FA-SEARCH"><i></i></a>
                    <a href="#" class="fa fa-plus-circle fa-1x" data-toggle="tooltip" data-placement="right" title="" data-original-title="FA-PLUS-CIRCLE"><i></i></a>
					<a href="#" id="toggle1" class="fa fa-chevron-up fa-1x" data-toggle="tooltip" data-placement="right" title="" data-original-title="FA-PLUS-CIRCLE"><i></i></a>
				</div><!-- /FOOTER PANEL-->

        </div> <!-- /TYPE PANEL -->
	</div>
