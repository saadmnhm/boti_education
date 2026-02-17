<div class="container">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">
                        La liste d'utilisateurs
                    </h3>
                </div>
                <div>
                    <a href="<?php echo URL::admin('users/add')?>"
                        class="btn btn-primary m-btn m-btn--pill btn-main m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Nouvel utilisateur</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table m-table m-table--head-bg-brand datatable main-table">
                        <thead>
                            <tr>
                                <th>Nom complet</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>État de compte</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $item) { ?>
                            <tr>
                                <td>
                                    <img width="40" class="rounded-circle" src="<?php echo $item->getImage() ?>" alt="">
                                    <span class="ml-2"><b><?php echo $item->getNomComplet(); ?></b></span>
                                </td>
                                <td>
                                   <span><?php echo $item->get('Email'); ?></span>
                                </td>
                                <td>
                                   <span><?php echo $item->get('Role')->get('Label'); ?></span>
                                </td>
                                <td>
                                    <?php if($item->get('Enabled') == 1){?>
                                        <span class="m-badge m-badge--brand m-badge--wide m-badge--success">
                                            Validée
                                        </span>
                                    <?php }elseif($item->get('Enabled') == 0){ ?>
                                        <span class="m-badge m-badge--brand m-badge--wide m-badge--danger">
                                            Bloquée
                                        </span>
                                    <?php }else{ ?>
                                        <span class="m-badge m-badge--brand m-badge--wide m-badge--primary">
                                            Nouveau
                                        </span>
                                    <?php } ?>
                                   
                                </td>
                                <td class="text-center">
                                    <!-- <a href="<?php echo URL::admin('users/view/'.$item->get('ID'))?>" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                        <i class="la la-eye"></i>
                                    </a> -->
                                    <a href="<?php echo URL::admin('users/update/'.$item->get('ID'))?>" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                        <i class="la la-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    </div>
</div>