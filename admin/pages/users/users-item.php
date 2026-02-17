    <div class="container">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title">
                        Utilisateur N° #<?php echo $user->get('ID'); ?>
                        <?php if ($user->get('Enabled') == 1) { ?>
                            <span class="m-badge m-badge--brand m-badge--wide m-badge--success">
                                Validée
                            </span>
                        <?php } elseif ($user->get('Enabled') == 0) { ?>
                            <span class="m-badge m-badge--brand m-badge--wide m-badge--danger">
                                Bloquée
                            </span>
                        <?php } else { ?>
                            <span class="m-badge m-badge--brand m-badge--wide m-badge--primary">
                                Nouveau
                            </span>
                        <?php } ?>

                    </h3>
                </div>
                <div class="text-right">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="<?php echo URL::admin('users/update/' . $user->get('ID')) ?>" class="btn m-btn--pill m-btn--air btn-primary"><i class="la la-edit mr-1" syle="font-size:18px;"></i> Modifier l'utilisateur</a>
                            <?php if ($user->get('Enabled') == 0 || $user->get('Enabled') === null) { ?>
                                <a href="<?php echo URL::admin('users/activer/' . $user->get('ID')) ?>" class="btn m-btn--pill m-btn--air btn-success"><i class="la la-check mr-1" syle="font-size:18px;"></i>Valider le compte</a>
                            <?php } else { ?>
                                <a href="<?php echo URL::admin('users/desactiver/' . $user->get('ID')) ?>" class="btn m-btn--pill m-btn--air btn-danger"><i class="la la-check mr-1" syle="font-size:18px;"></i>Bloquer le compte</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->


        <!-- END: Subheader -->
        <div class="m-content mt-4">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="m-portlet">
                        <div class="m-portlet__body">
                            <div class="m-card-profile">
                                <div class="m-card-profile__pic">
                                    <div class="m-card-profile__pic-wrapper">
                                        <img src="<?php echo $user->getImage() ?>" alt="" />
                                    </div>
                                </div>
                                <div class="m-card-profile__details">
                                    <span class="m-card-profile__name"><?php echo $user->getNomComplet() ?></span>
                                    <a href="" class="m-card-profile__email m-link"><?php echo $user->get('Email') ?></a>
                                </div>
                            </div>
                            <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides mt-4">
                                <li class="m-nav__item text-center mb-2">
                                    <span class="m-nav__link-title">
                                        <span class="m-nav__link-wrap">
                                            <span class="m-nav__link-text">Téléphone : <b><?php echo $user->get('Tel') ?></b></span>
                                        </span>
                                    </span>
                                </li>
                                <li class="m-nav__item text-center mb-2">
                                    <span class="m-nav__link-title">
                                        <span class="m-nav__link-wrap">
                                            <span class="m-nav__link-text">Fonction : <b><?php echo $user->get('Fonction') ?></b></span>
                                        </span>
                                    </span>
                                </li>
                                <li class="m-nav__item text-center mb-2">
                                    <span class="m-nav__link-title">
                                        <span class="m-nav__link-wrap">
                                            <span class="m-nav__link-text">Adresse : <b><?php echo $user->get('Adresse') ?></b></span>
                                        </span>
                                    </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="m-portlet m-portlet--full-height m-portlet--tabs ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                            <i class="flaticon-share m--hide"></i>
                                            Mot de passe
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_user_profile_tab_1">

                                <form class="m-form m-form--fit m-form--label-align-right" method="post" action="<?php echo URL::admin('users/changepassword/' . $user->get('ID')) ?>">
                                    <div class="m-portlet__body">
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2">
                                                <?php if (isset($alert_msg) && $alert_msg) { ?>
                                                    <div class="alert alert-info my-3 text-center">
                                                        <p class="mb-0"><?php echo $alert_msg; ?></p>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-4 col-form-label">Nouveau mot de passe *</label>
                                            <div class="col-7">
                                                <input class="form-control m-input" type="password" name="pass" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-4 col-form-label">Confirmation de mot de passe *</label>
                                            <div class="col-7">
                                                <input class="form-control m-input" type="password" name="pass_confirmation" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <?php cf_fields() ?>
                                    <div class="text-center">
                                        <button class="btn m-btn--pill m-btn--air btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>