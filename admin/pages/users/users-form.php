<div class="container">
    <div class="m-subheader mb-4">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Gestion des utilisateurs
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="<?php echo URL::link('');?>" class="m-nav__link m-nav__link--icon"> <i
                                class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="<?php echo URL::admin('users')?>" class="m-nav__link">
                            <span class="m-nav__link-text">Gestion des utilisateurs</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <!--begin::Portlet-->
        <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post"
            enctype="multipart/form-data">
            <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-wrapper">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <!-- <h3 class="m-portlet__head-text">Nouvel Utilisateur</h3> -->
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <a href="<?php echo URL::admin('users')?>"
                                class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                <span>
                                    <i class="la la-arrow-left"></i>
                                    <span>Retour</span>
                                </span>
                            </a>
                            <button
                                class="btn btn-metal m-btn m-btn--icon m-btn--wide btn-main m-btn--md m--margin-right-10">
                                <span>
                                    <i class="la la-save"></i>
                                    <span>Enregistrer</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin: Form Body -->
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="m-form__section m-form__section--first">
    
                                    <div class="form-group m-form__group row m--margin-top-20">
                                        <label class="col-form-label col-lg-3 col-sm-12">Rôle *</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select class="form-control" name="role">
                                                <option value="" disabled>Selectionnez un rôle</option>
                                                <?php foreach($roles as $role){?>
                                                    <option value="<?php echo $role->get('ID')?>" <?php if(isset($isUpdate) && $isUpdate && $user->get('Role') && $user->get('Role')->get('ID') == $role->get('ID')) { echo 'selected'; }?> ><?php echo $role->get('Label')?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Nom : *</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="nom" class="form-control m-input" placeholder="Nom"
                                                value="<?php if(isset($isUpdate) && $isUpdate){ echo html($user->get('Nom')); }?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Prénom : *</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="prenom" class="form-control m-input"
                                                placeholder="Prénom"
                                                value="<?php if(isset($isUpdate) && $isUpdate){ echo html($user->get('Prenom')); }?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Email : *</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="email" name="email" class="form-control m-input"
                                                placeholder="Email"
                                                value="<?php if(isset($isUpdate) && $isUpdate){ echo html($user->get('Email')); }?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Téléphone : *</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="tel" class="form-control m-input"
                                                placeholder="Téléphone"
                                                value="<?php if(isset($isUpdate) && $isUpdate){ echo html($user->get('Tel')); }?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Date naissance : *</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="datenaissance" class="form-control m-input datepicker"
                                                style="width:100%" placeholder="Date naissance"
                                                value="<?php if(isset($isUpdate) && $isUpdate){ echo html($user->get('DateNaissance')); }?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Adresse :</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="adresse" class="form-control m-input"
                                                placeholder="Adresse"
                                                value="<?php if(isset($isUpdate) && $isUpdate){ echo html($user->get('Adresse')); }?>">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Fonction :</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="fonction" class="form-control m-input"
                                                placeholder="Fonction"
                                                value="<?php if(isset($isUpdate) && $isUpdate){ echo html($user->get('Fonction')); }?>">
                                        </div>
                                    </div>
    
                                    <div class="form-group m-form__group row">
                                        <label class="form-control-label col-xl-3 col-lg-3">Sexe:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                    <input type="radio" name="homme" value="1"
                                                        <?php if(isset($isUpdate) && $isUpdate && $user->get('Homme') == 1){ echo 'checked'; }?>>
                                                    Homme
                                                    <span></span>
    
                                                </label>
                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                    <input type="radio" name="homme" value="0"
                                                        <?php if(isset($isUpdate) && $isUpdate && $user->get('Homme') == 0){ echo 'checked'; }?>>
                                                    Femme
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="position-relative form-group row mt-3">
                                        <label for="image" class="form-control-label col-xl-3 col-lg-3">Image</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input name="image" id="image" type="file"
                                                class="form-control-file main-input dropify"
                                                <?php if (isset($isUpdate) && $isUpdate) {  ?>
                                                data-default-file="<?php echo $user->getImage() ?>" <?php } ?>>
                                        </div>
                                    </div>
                                    <?php echo cf_fields(); ?>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </form>
    
    </div>
</div>