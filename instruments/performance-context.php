<?php include 'class/Prueba.php' ?>
<?php include 'class/Pregunta.php' ?>
<?php $pru = new Prueba() ?>
<?php $pre = new Pregunta() ?>
<?php $pr = $pru->get(1) ?>

<section class="content-header">
    <h1>Instrumentos
        <small>Contexto para el desempeño</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php?section=home"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Contexto para el desempeño</li>
    </ol>
</section>

<section class="content container-fluid">
    <form role="form" id="formNewTest">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Condiciones del Contexto para el Desempeño</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-8">
                        <input type="hidden" name="ipid" value="1">
                        <?php echo $pr->pru_introduccion ?>
                    </div>
                </div>
            </div>

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
                <?php $al = $pre->getByPrueba(1) ?>
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
        </div>
    </form>
</section>

<script src="instruments/performance-context.js"></script>