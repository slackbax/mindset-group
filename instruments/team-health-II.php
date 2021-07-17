<?php include 'class/Prueba.php' ?>
<?php include 'class/Pregunta.php' ?>
<?php $pru = new Prueba() ?>
<?php $pre = new Pregunta() ?>
<?php $pr = $pru->get(3) ?>

<section class="content-header">
    <h1>Instrumentos
        <small>Salud del Equipo II</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Salud del equipo II</li>
    </ol>
</section>

<section class="content container-fluid">
    <form role="form" id="formNewTest">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Diagnóstico del Estado de Salud del Equipo II</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-8">
                        <input type="hidden" name="ipid" value="3">
                        <?php echo $pr->pru_introduccion ?>
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="row hidden-xs">
                    <div class="col-sm-6"></div>

                    <div class="col-sm-2 text-center text-bold" style="font-size: 12px">
                        Casi nunca
                    </div>

                    <div class="col-sm-2 text-center text-bold" style="font-size: 12px">
                        A veces
                    </div>

                    <div class="col-sm-2 text-center text-bold" style="font-size: 12px">
                        Habitualmente
                    </div>
                </div>

                <?php $ind = 1 ?>
                <?php $al = $pre->getByPrueba(3) ?>
                <?php foreach ($al as $i => $v): ?>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-sm-6">
                            <span class="text-bold"><?php echo $ind ?>.</span> <?php echo $v->pre_descripcion ?>
                        </div>

                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg text-bold" style="margin-top: 5px">Casi nunca</div>
                        <div class="col-xs-6 col-md-2 text-center" style="margin-top: 5px">
                            <input class="minimal" type="radio" name="pr[<?php echo $v->pre_id ?>]" id="pr_<?php echo $v->pre_id ?>_1" value="1" required>
                        </div>

                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg text-bold" style="margin-top: 5px">A veces</div>
                        <div class="col-xs-6 col-md-2 text-center" style="margin-top: 5px">
                            <input class="minimal" type="radio" name="pr[<?php echo $v->pre_id ?>]" id="pr_<?php echo $v->pre_id ?>_2" value="2" required>
                        </div>

                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg text-bold" style="margin-top: 5px">Habitualmente</div>
                        <div class="col-xs-6 col-md-2 text-center" style="margin-top: 5px">
                            <input class="minimal" type="radio" name="pr[<?php echo $v->pre_id ?>]" id="pr_<?php echo $v->pre_id ?>_3" value="3" required>
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
        </div>
    </form>
</section>

<script src="instruments/team-health-II.js"></script>