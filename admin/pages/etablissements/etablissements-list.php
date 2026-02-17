<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    Base des collaboratteurs :
                </h3>
            </div>
            <div>

                <a href="<?php echo URL::admin('etablissements/add') ?>"
                    class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air"><i
                        class="fa fa-plus "></i> Etablissement</a>

            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="row mg-b-20">
                    <?php foreach ($etablissements as $key => $value) { ?>
                    <div class="col-sm-6 col-md-3 mg-t-60">
                        <div class="main-card mb-4 card">
                            <div class="etablissement-logo" style="height:160px">
                                <img src="<?php echo $value->getLogo() ?>" alt="Card image cap" class="card-img-top" style="width:120px; height:auto; margin:auto; display:block; position:relative; top:20%">
                            </div>
                            <h5 class="card-title text-center"><a href="<?php echo URL::admin('etablissements/update/'.$value->get('ID'))?>"><?php echo $value->get('Label') ?></a></h5>
                            <!-- <div class="card-body text-center"> TODO </div> -->
                            <div class="d-block text-center card-footer ">
                                <a href="<?php echo URL::admin('etablissements/update/'.$value->get('ID')) ?>"
                                    class="btn btn-xs btn-outline-primary btn-icon">
                                    <i class="fa fa-fw" aria-hidden="true" title="Copy to use edit"></i>
                                </a>
                                <a href="<?php echo URL::admin('etablissements/delete/'.$value->get('ID'))?>"
                                    class="btn btn-xs btn-outline-danger btn-icon delete">
                                    <i class="fa fa-fw" aria-hidden="true" title="Copy to use trash"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- card -->
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>