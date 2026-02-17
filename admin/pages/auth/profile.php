<div class="container">

    <!-- END: Subheader -->
    <div class="m-content mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php if (isset($_SESSION['alert_msg']) && $_SESSION['alert_msg']) { ?>
                    <div class="alert alert-info my-3 text-center">
                        <p class="mb-0"><?php echo $_SESSION['alert_msg']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
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
                                        Modification informations
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Mot de passe
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="m_user_profile_tab_2">
                            <form class="m-form m-form--fit m-form--label-align-right" method="post" action="<?php echo URL::admin('users/profile_chnagePassword/' . $user->get('ID')) ?>">
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
                                        <label for="example-text-input" class="col-4 col-form-label">Mot de passe *</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="password" name="pass" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-4 col-form-label">Nouveau mot de passe *</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="password" name="new_pass" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-4 col-form-label">Confirmation de Nouveau mot de passe *</label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="password" name="new_pass_confirmation" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <?php cf_fields() ?>
                                <div class="text-center">
                                    <button class="btn m-btn--pill m-btn--air btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <!--begin::Portlet-->
                            <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" enctype="multipart/form-data">
                                <div class="m-portlet__body">
                                    <!--begin: Form Body -->
                                    <div class="m-portlet__body">
                                        <div class="row">
                                            <div class="col-xl-8 offset-xl-2">
                                                <div class="m-form__section m-form__section--first">
                                                    <?php
                                                    $user =  Session::getInstance()->getCurUser();
                                                    $isUpdate = true;
                                                    ?>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email : *</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="email" name="email" class="form-control m-input" placeholder="Email" value="<?php if (isset($isUpdate) && $isUpdate) {
                                                                                                                                                            echo html($user->get('Email'));
                                                                                                                                                        } ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Téléphone : *</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="tel" class="form-control m-input" placeholder="Téléphone" value="<?php if (isset($isUpdate) && $isUpdate) {
                                                                                                                                                            echo html($user->get('Tel'));
                                                                                                                                                        } ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Date naissance : *</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="datenaissance" class="form-control m-input datepicker" style="width:100%" placeholder="Date naissance" value="<?php if (isset($isUpdate) && $isUpdate) {
                                                                                                                                                                                                        echo html($user->get('DateNaissance'));
                                                                                                                                                                                                    } ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Adresse :</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="adresse" class="form-control m-input" placeholder="Adresse" value="<?php if (isset($isUpdate) && $isUpdate) {
                                                                                                                                                            echo html($user->get('Adresse'));
                                                                                                                                                        } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Fonction :</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="fonction" class="form-control m-input" placeholder="Fonction" value="<?php if (isset($isUpdate) && $isUpdate) {
                                                                                                                                                                echo html($user->get('Fonction'));
                                                                                                                                                            } ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label class="form-control-label col-xl-3 col-lg-3">Sexe:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-radio-inline">
                                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                                    <input type="radio" name="homme" value="1" <?php if (isset($isUpdate) && $isUpdate && $user->get('Homme') == 1) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                                                    Homme
                                                                    <span></span>

                                                                </label>
                                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                                    <input type="radio" name="homme" value="0" <?php if (isset($isUpdate) && $isUpdate && $user->get('Homme') == 0) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                                                    Femme
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="position-relative form-group row mt-3">
                                                        <label for="image" class="form-control-label col-xl-3 col-lg-3">Image</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input name="image" id="image" type="file" class="form-control-file main-input dropify" <?php if (isset($isUpdate) && $isUpdate) {  ?> data-default-file="<?php echo $user->getImage() ?>" <?php } ?>>
                                                        </div>
                                                    </div>
                                                    <?php echo cf_fields(); ?>
                                                </div>
                                                <button type="submit" class="btn btn-primary m-btn m-btn--icon m-btn--wide btn-main m-btn--md m--margin-right-10">
                                                    <span>
                                                        <i class="la la-save"></i>
                                                        <span>Enregistrer</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Portlet-->
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>