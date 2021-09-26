<?php include 'class/User.php' ?>
<?php include 'class/Prueba.php' ?>
<?php include 'class/Pregunta.php' ?>
<?php include 'class/Examen.php' ?>
<?php $us = new User() ?>
<?php $pru = new Prueba() ?>
<?php $pre = new Pregunta() ?>
<?php $exa = new Examen() ?>
<?php $pr = $pru->get(7) ?>
<?php if (!$_admin and !$_superv): ?>
    <?php $ex = $exa->getByUserTestType($_SESSION['msg_userid'], 7) ?>
<?php endif ?>

<section class="content-header">
    <h1>Instrumentos
        <small>Talento natural</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Talento natural</li>
    </ol>
</section>

<section class="content container-fluid">
    <form role="form" id="formNewTest">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Talento Natural</h3>
            </div>

            <?php if ($_admin or $_superv or $us->getHasInstrument($_SESSION['msg_userid'], 7)): ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <input type="hidden" name="ipid" value="7">
                            <?php echo $pr->pru_introduccion ?>
                        </div>

                        <div class="col-sm-6">
                            <table class="table table-bordered">
                                <tr class="bg-gray-light">
                                    <th class="text-center">Aspecto</th>
                                    <th class="text-center">Puntaje</th>
                                </tr>
                                <tr class="text-center">
                                    <td>Lo que HAGO MEJOR</td>
                                    <td>5</td>
                                </tr>
                                <tr class="text-center">
                                    <td>Lo que HAGO BIEN</td>
                                    <td>4</td>
                                </tr>
                                <tr class="text-center">
                                    <td>Lo que HAGO REGULAR</td>
                                    <td>3</td>
                                </tr>
                                <tr class="text-center">
                                    <td>Lo que HAGO MAL</td>
                                    <td>2</td>
                                </tr>
                                <tr class="text-center">
                                    <td>Lo que HAGO PEOR</td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">Evaluación de Talento Natural</h3>
                </div>

                <?php if (!$_admin and !$_superv and !is_null($ex->exa_id)): ?>
                    <div class="box-body">
                        <div class="alert alert-danger">
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            Usted ya ha completado este instrumento. Por favor, escoja un instrumento distinto o comuníquese con el administrador, si considera que existe algún error.
                        </div>
                    </div>
                <?php else: ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="bg-gray">
                                        <th class="text-center">Item</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <!-- CUADRANTE A -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>Cuadrante A</td>
                                        <td>Valoración</td>
                                    </tr>
                                    <?php for ($i = 1; $i < 11; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(7, $i) ?>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-a" id="pa_<?php echo $p->pre_id ?>_a" name="pa[<?php echo $p->pre_id ?>]"></td>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th class="text-center">Subtotal Cuadrante A</th>
                                        <th><input class="form-control input-number total" id="pa_a" value="0" disabled></th>
                                    </tr>
                                    <!-- CUADRANTE B -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>Cuadrante B</td>
                                        <td>Valoración</td>
                                    </tr>
                                    <?php for ($i = 11; $i < 21; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(7, $i) ?>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-b" id="pa_<?php echo $p->pre_id ?>_b" name="pa[<?php echo $p->pre_id ?>]"></td>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th class="text-center">Subtotal Cuadrante B</th>
                                        <th><input class="form-control input-number total" id="pa_b" value="0" disabled></th>
                                    </tr>
                                    <!-- CUADRANTE C -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>Cuadrante C</td>
                                        <td>Valoración</td>
                                    </tr>
                                    <?php for ($i = 21; $i < 31; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(7, $i) ?>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-c" id="pa_<?php echo $p->pre_id ?>_c" name="pa[<?php echo $p->pre_id ?>]"></td>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th class="text-center">Subtotal Cuadrante C</th>
                                        <th><input class="form-control input-number total" id="pa_c" value="0" disabled></th>
                                    </tr>
                                    <!-- CUADRANTE D -->
                                    <tr class="bg-gray-light text-center text-bold">
                                        <td>Cuadrante D</td>
                                        <td>Valoración</td>
                                    </tr>
                                    <?php for ($i = 31; $i < 41; $i++): ?>
                                        <tr>
                                            <?php $p = $pre->getByPruebaNumero(7, $i) ?>
                                            <td><?php echo $p->pre_descripcion ?></td>
                                            <td><input class="form-control input-number valor pa-d" id="pa_<?php echo $p->pre_id ?>_d" name="pa[<?php echo $p->pre_id ?>]"></td>
                                        </tr>
                                    <?php endfor ?>
                                    <tr>
                                        <th class="text-center">Subtotal Cuadrante D</th>
                                        <th><input class="form-control input-number total" id="pa_d" value="0" disabled></th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnsubmit"><i class="fa fa-check"></i> Guardar respuestas</button>
                        <button type="reset" class="btn btn-default" id="btnClear">Limpiar</button>
                        <i class="ajaxLoader fa fa-cog fa-spin" id="submitLoader"></i>
                    </div>
                <?php endif ?>
            <?php else: ?>
                <div class="box-body">
                    <div class="callout callout-danger">
                        <h4><i class="fa fa-times"></i> Error de acceso</h4>
                        <p>Ha intentado ingresar a un instrumento restringido. Si considera que debiera tener acceso, contacte con el administrador para mayor información.</p>
                        <a class="btn btn-warning" id="btnback"><i class="fa fa-undo"></i> Volver atrás</a> <a href="index.php" class="btn btn-info" id="btnback"><i class="fa fa-home"></i> Volver al inicio</a>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </form>
</section>

<script src="instruments/natural-talent.js"></script>