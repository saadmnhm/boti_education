<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    Nouveau établissement :
                </h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="main-card mb-3 card" style="border:none">
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="position-relative form-group"><label for="Label"
                                                    class="">Label *</label><input name="label" id="Label" required placeholder=""
                                                    type="Label" class="form-control" <?php if($isUpdate) { ?>
                                                    value="<?php echo $etablissement->get('Label') ?>" <?php } ?>>
                                            </div>
                                            <div class="position-relative form-group"><label for="Label"
                                                    class="">Abréviation</label><input name="abreviation" placeholder=""
                                                    type="Label" class="form-control" <?php if($isUpdate) { ?>
                                                    value="<?php echo $etablissement->get('Abreviation') ?>" <?php } ?>>
                                            </div>
                                            <div class="position-relative form-group"><label for="Label"
                                                    class="">Adresse IP</label><input name="ip_adress" id="ip_adress"
                                                    placeholder="" type="Label" class="form-control"
                                                    <?php if($isUpdate) { ?>
                                                    value="<?php echo $etablissement->get('IP_Adress') ?>" <?php } ?>>
                                            </div>
                                            <div class="position-relative form-group"><label for="Label"
                                                    class="">Port</label><input name="port" id="port"
                                                    placeholder="" type="text" class="form-control"
                                                    <?php if($isUpdate) { ?>
                                                    value="<?php echo $etablissement->get('Port') ?>" <?php } ?>>
                                            </div>
                                            <div class="position-relative form-group"><label for="Label"
                                                    class="">Index</label><input name="index" id="index"
                                                    placeholder="" type="text" class="form-control"
                                                    <?php if($isUpdate) { ?>
                                                    value="<?php echo $etablissement->get('Index') ?>" <?php } ?>>
                                            <p class="color-danger"><small>Cette valeur impacte l’historique chargé des pointages de cet établissement. Merci de ne pas changer sauf en cas de besoin.</small></p>
                                            </div>
                                            <div class="position-relative form-group"><label for="exampleFile"
                                                    class="">Logo</label><input name="logo" id="exampleFile" type="file"
                                                    class="form-control-file main-input dropify"
                                                    <?php if ($isUpdate) { ?>
                                                    data-default-file="<?php echo $etablissement->getLogo() ?>"
                                                    <?php } ?>>
                                            </div>
                                            <button class="mt-1 btn btn-primary">Valider</button>

                                            <?php if (isset($isUpdate) &&  $isUpdate) { ?>
                                            <input type="hidden" name="id"
                                                value="<?php echo $etablissement->get('ID') ?>">
                                            <?php } ?>
                                            <button class="mt-1 btn btn-danger"
                                                href="<?php echo URL::admin('') ?>">Annuler</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
            </div>
           