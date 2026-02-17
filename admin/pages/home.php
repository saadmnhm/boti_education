<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    Accueil
                </h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content dashboard-page">
        <!--begin::Portlet-->
        <div class="etablissement_tabs">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <?php foreach ($etablissements as $k => $item) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($k == 0) ? 'active' : ''; ?>" data-target="#etb_<?php echo $item->get('ID') ?>" data-toggle="tab" href="#etb_<?php echo $item->get('ID') ?>">
                            <img src="<?php echo $item->getLogo() ?>" alt="<?php echo $item->get('Label'); ?>">
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
</div>