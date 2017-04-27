
     <!-- Page Content -->
     <div class="container">

         <!-- Page Heading/Breadcrumbs -->
         <div class="row">
             <div class="col-lg-12">
                 <h1 class="page-header">Reservación
                     <small>Fácil y rápido</small>
                 </h1>
                 <ol class="breadcrumb">
                     <li><a href="index.php">Inicio</a>
                     </li>
                     <li class="active">Reservacion</li>
                 </ol>
             </div>
         </div>
         <!-- /.row -->

         <!-- Content Row -->
         <div class="row">
             <div class="col-sm-8">


                 <div class="panel-group">
                   <div class="panel panel-success">
                       <div class="panel-heading">
                         <b>Cotización de habitación</b>
                       </div>
                      <div class="panel-body">
                        <table class="table">
                          <tr>
                            <td>
                              <br>
                              Nº Factura: <?php echo $reservacion->getID(); ?><br>
                              Cliente: <?php echo  $usuario->getNombre();?><br>
                              Fecha Inicio: <?php echo $reservacion->getFechaIni();?><br>
                              Fecha Final: <?php echo $reservacion->getFechaFin()?><br> <br>
                            </td>
                          </tr>
                          <tr>
                            <td>
                               <?php foreach ($habitaciones as $habitacion) {
                                 echo "Habitacion: ".$habitacion->getID()."<br>";
                                 echo "Tipo: ".$habitacion->getTipo()."<br>";
                               } ?>

                            </td>
                          </tr>
                          <tr align="right">
                            <td><b>Precio Final: <?php echo $reservacion->calcularPrecio()." USD";?></b>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="panel-footer">
                        <small>**Tenga en cuenta que para hacer efectiva su reservación, tiene que continuar con el proceso.</small>
                      </div>
                    </div>
                 </div>


             </div>
             <form class="" action="classes/formalizar.php" method="post" name="enviar-reservacion">
               <div class="col-sm-4">
                 <div class="panel-group">
                   <div class="panel panel-success">
                     <div class="panel-body">
                       <div class="form-group">
                              <label class="control-label">Terms of use</label>
                              <div class="">
                                  <div style="border: 1px solid #e5e5e5; height: 200px; overflow: auto; padding: 10px;">
                                      <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
                                      <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
                                      <p>Mea ea nonumy labores lobortis, duo quaestio antiopam inimicus et. Ea natum solet iisque quo, prodesset mnesarchum ne vim. Sonet detraxit temporibus no has. Omnium blandit in vim, mea at omnium oblique.</p>
                                      <p>Eum ea quidam oportere imperdiet, facer oportere vituperatoribus eu vix, mea ei iisque legendos hendrerit. Blandit comprehensam eu his, ad eros veniam ridens eum. Id odio lobortis elaboraret pro. Vix te fabulas partiendo.</p>
                                      <p>Natum oportere et qui, vis graeco tincidunt instructior an, autem elitr noster per et. Mea eu mundi qualisque. Quo nemore nusquam vituperata et, mea ut abhorreant deseruisse, cu nostrud postulant dissentias qui. Postea tincidunt vel eu.</p>
                                      <p>Ad eos alia inermis nominavi, eum nibh docendi definitionem no. Ius eu stet mucius nonumes, no mea facilis philosophia necessitatibus. Te eam vidit iisque legendos, vero meliore deserunt ius ea. An qui inimicus inciderint.</p>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="agree" value="agree" /> Agree with the terms and conditions
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="">
                                  <button type="submit" class="btn btn-primary" name="reservar" value="">Reservar</button>
                                  <button type="reset" class="btn btn-primary" name="cancelar" value="" onclick="document.location.href='index.php'">Terminar</button>
                              </div>
                          </div>
                     </div>
                   </div>
                 </div>
               </div>
             </form>

         </div>
         <!-- /.row -->

         <hr>

         <!-- Footer -->
         <footer>
             <div class="row">
                 <div class="col-lg-12">
                     <p>Copyright &copy; Hotel Altamira 2017</p>
                 </div>
             </div>
         </footer>

     </div>
     <!-- /.container -->

     <!-- jQuery -->
     <script src="js/jquery.js"></script>

     <!-- Bootstrap Core JavaScript -->
     <script src="js/bootstrap.min.js"></script>

 </body>

 </html>
