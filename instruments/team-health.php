<?php include 'class/User.php' ?>
<?php include 'class/Prueba.php' ?>
<?php include 'class/Pregunta.php' ?>
<?php include 'class/Examen.php' ?>
<?php $us = new User() ?>
<?php $pru = new Prueba() ?>
<?php $pre = new Pregunta() ?>
<?php $exa = new Examen() ?>
<?php $pr = $pru->get(2) ?>
<?php if (!$_admin and !$_superv): ?>
    <?php $ex = $exa->getByUserTestType($_SESSION['msg_userid'], 2) ?>
<?php endif ?>

<section class="content-header">
    <h1>Instrumentos
        <small>Salud del Equipo</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Salud del equipo</li>
    </ol>
</section>

<section class="content container-fluid">
    <form role="form" id="formNewTest">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Diagnóstico del Estado de Salud del Equipo</h3>
            </div>

            <?php if ($_admin or $_superv or $us->getHasInstrument($_SESSION['msg_userid'], 2)): ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <input type="hidden" name="ipid" value="2">
                            <?php echo $pr->pru_introduccion ?>
                        </div>
                    </div>
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
                        <div class="row hidden-xs hidden-sm">
                            <div class="col-md-12 col-lg-7"></div>

                            <div class="col-md-2 col-lg-1 text-center text-bold" style="font-size: 12px">
                                Muy en desacuerdo
                            </div>

                            <div class="col-md-2 col-lg-1 text-center text-bold" style="font-size: 12px">
                                En desacuerdo
                            </div>

                            <div class="col-md-2 col-lg-1 text-center text-bold" style="font-size: 12px">
                                Neutro
                            </div>

                            <div class="col-md-2 col-lg-1 text-center text-bold" style="font-size: 12px">
                                De acuerdo
                            </div>

                            <div class="col-md-2 col-lg-1 text-center text-bold" style="font-size: 12px">
                                Muy de acuerdo
                            </div>
                        </div>

                        <?php $ind = 1 ?>
                        <?php $al = $pre->getByPrueba(2) ?>
                        <?php foreach ($al as $i => $v): ?>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-sm-12 col-lg-7">
                                    <span class="text-bold"><?php echo $ind ?>.</span> <?php echo $v->pre_descripcion ?>
                                </div>

                                <div class="col-xs-6 hidden-md hidden-lg text-bold" style="margin-top: 5px">Muy en desacuerdo</div>
                                <div class="col-xs-6 col-md-2 col-lg-1 text-center" style="margin-top: 5px">
                                    <input class="minimal" type="radio" name="pr[<?php echo $v->pre_id ?>]" id="pr_<?php echo $v->pre_id ?>_1" value="-10" required>
                                </div>

                                <div class="col-xs-6 hidden-md hidden-lg text-bold" style="margin-top: 5px">En desacuerdo</div>
                                <div class="col-xs-6 col-md-2 col-lg-1 text-center" style="margin-top: 5px">
                                    <input class="minimal" type="radio" name="pr[<?php echo $v->pre_id ?>]" id="pr_<?php echo $v->pre_id ?>_2" value="-5" required>
                                </div>

                                <div class="col-xs-6 hidden-md hidden-lg text-bold" style="margin-top: 5px">Neutro</div>
                                <div class="col-xs-6 col-md-2 col-lg-1 text-center" style="margin-top: 5px">
                                    <input class="minimal" type="radio" name="pr[<?php echo $v->pre_id ?>]" id="pr_<?php echo $v->pre_id ?>_3" value="0" required>
                                </div>

                                <div class="col-xs-6 hidden-md hidden-lg text-bold" style="margin-top: 5px">De acuerdo</div>
                                <div class="col-xs-6 col-md-2 col-lg-1 text-center" style="margin-top: 5px">
                                    <input class="minimal" type="radio" name="pr[<?php echo $v->pre_id ?>]" id="pr_<?php echo $v->pre_id ?>_4" value="5" required>
                                </div>

                                <div class="col-xs-6 hidden-md hidden-lg text-bold" style="margin-top: 5px">Muy de acuerdo</div>
                                <div class="col-xs-6 col-md-2 col-lg-1 text-center" style="margin-top: 5px">
                                    <input class="minimal" type="radio" name="pr[<?php echo $v->pre_id ?>]" id="pr_<?php echo $v->pre_id ?>_5" value="10" required>
                                </div>
                            </div>
                            <?php $ind++ ?>
                        <?php endforeach ?>
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

<script src="instruments/team-health.js"></script>