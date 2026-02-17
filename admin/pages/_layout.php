<?php
$pageTitle = isset($pageTitle) ? $pageTitle : Config::get('sitename');
$auth = Session::getInstance()->getCurUser();
?>
<!DOCTYPE html>

<html lang="fr">
<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title><?php echo $pageTitle ? $pageTitle : 'Espace Admin' ?></title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Global Theme Styles -->
    <link href="<?php echo URL::base() ?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL::base() ?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.0.0/main.css">
    <link href="<?php echo URL::base() ?>assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL::base() ?>assets/lib/dropify/dropify.css" rel="stylesheet">

    <link href="<?php echo URL::base() ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles -->

    <link rel="shortcut icon" href="<?php echo URL::base() ?>assets/img/logo.png" />

    <?php if (isset($app)) { ?>
        <script>
            app = <?php echo json_encode($app) ?>
        </script>
    <?php } ?>
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body class="m-page--fluid m--skin- m-page--loading-enabled m-page--loading m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin::Page loader -->
    <div class="m-page-loader m-page-loader--base">
        <div class="m-spinner m-spinner--brand"></div>
    </div>
    <!-- end::Page Loader -->
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        <header id="m_header" class="m-grid__item m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
            <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- BEGIN: Brand -->
                    <div class="m-stack__item m-brand m-brand--skin-light ">
                        <div class="m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="#" class="m-brand__logo-wrapper">
                                    <?php if ($auth->get('Etablissement')) { ?>
                                        <img src="<?php echo $auth->get('Etablissement')->getLogo() ?>" alt="<?php echo $auth->get('Etablissement')->get('Label'); ?>" style="width: 91px;">
                                    <?php }  ?>
                                </a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                <!-- BEGIN: Left Aside Minimize Toggle -->
                                <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block ">
                                    <span></span>
                                </a>
                                <!-- END -->
                                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                    <span></span>

                                </a>
                                <!-- END -->
                                <!-- BEGIN: Responsive Header Menu Toggler -->
                                <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>
                                <!-- END -->
                                <!-- BEGIN: Topbar Toggler -->
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                    <i class="flaticon-more"></i>
                                </a>
                                <!-- BEGIN: Topbar Toggler -->
                            </div>

                        </div>
                    </div>
                    <!-- END: Brand -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head p-4" id="m_header_nav">
                        <!-- BEGIN: Horizontal Menu -->
                        <button class="m-aside-header-menu-mobile-close m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <!-- END: Horizontal Menu -->
                        <!-- BEGIN: Topbar -->
                        <div id="m_header_topbar" class="m-topbar m-stack m-stack--ver m-stack--general m-stack--fluid">
                            <div class="m-stack__item m-topbar__nav-wrapper">


                                <div class="widget-content">

                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="<?php echo Session::getInstance()->getCurUser()->getImage() ?>" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="<?php echo URL::admin('users/profile/');  ?>" type="button" tabindex="0" class="dropdown-item">Profile</a>
                                            <a href="<?php echo URL::link('login?logout') ?>" type="button" tabindex="0" class="dropdown-item"> Déconnexion</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="widget-heading">
                                    <div>
                                        <?php echo Session::getInstance()->getCurUser()->getNomComplet() ?>
                                    </div>
                                    <div>
                                        <?php echo Session::getInstance()->getCurUser()->get('Fonction') ?></p>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Topbar -->
                    </div>
                </div>
            </div>
        </header>
        <!-- END: Header -->
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close m-aside-left-close--skin-light " id="m_aside_left_close_btn">
                <i class="la la-close"></i>
            </button>
            <div id="m_aside_left" class="m-grid__item m-aside-left m-aside-left--skin-light ">

                <?php if (Session::getInstance()->getCurUser()->get('Role')->get('Alias') == 'admin') { ?>
                    <!-- BEGIN: Aside Menu  admin -->
                    <div id="m_ver_menu" class="m-aside-menu m-aside-menu--skin-light m-aside-menu--submenu-skin-light " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
                        <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow ">
                            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                                <a href="<?php echo URL::admin('') ?>" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text" href="<?php echo URL::admin('') ?>">Accueil</span>

                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li class="m-menu__section ">
                                <h4 class="m-menu__section-text">
                                    Modules :
                                </h4>
                                <i class="m-menu__section-icon flaticon-more-v2"></i>
                            </li>






                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-text">Référentiel</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="m-menu__submenu ">
                                    <span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">


                                        <li class="m-menu__item " aria-haspopup="true">
                                            <a href="<?php echo URL::admin('etablissements') ?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                                <span class="m-menu__link-text">Etablissements</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                    </div>
                <?php } else { ?>
                    <!-- BEGIN: Aside Menu Callaborateurs -->
                    <div id="m_ver_menu" class="m-aside-menu m-aside-menu--skin-light m-aside-menu--submenu-skin-light " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
                        <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow ">
                            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                                <a href="<?php echo URL::admin('') ?>" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text" href="<?php echo URL::admin('') ?>">Accueil

                                            </span>
                                        </span>
                                </a>
                            </li>
                            <li class="m-menu__section ">
                                <h4 class="m-menu__section-text">
                                    Modules :
                                </h4>
                                <i class="m-menu__section-icon flaticon-more-v2"></i>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-layers"></i><span class="m-menu__link-text">Permissions</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="m-menu__submenu ">
                                    <span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
                                            <span class="m-menu__link"><span class="m-menu__link-text">Permissions</span></span>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true">
                                            <a href="<?php echo URL::admin('userpermissions/add') ?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                                <span class="m-menu__link-text">Nouvelle demande</span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true">
                                            <a href="<?php echo URL::admin('userpermissions/mesdemandes') ?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                                <span class="m-menu__link-text">Mes demandes</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="<?php echo URL::admin('users/profile/'); ?>" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-share"></i>
                                    <span class="m-menu__link-text">Mon compte</span>
                                </a>

                            </li>
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="<?php echo URL::admin('conges') ?>" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-share"></i>
                                    <span class="m-menu__link-text">Mes congés</span>
                                </a>

                            </li>
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="<?php echo URL::admin('taches') ?>" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-share"></i>
                                    <span class="m-menu__link-text">Mes tâches</span>
                                </a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="<?php echo URL::admin('pvs') ?>" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-share"></i>
                                    <span class="m-menu__link-text"> Procès verbal & synthèse</span>
                                </a>
                            </li>
                            <?php if (count(Session::getInstance()->getCurUser()->getSubCollaborateurs())) { ?>
                                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="<?php echo URL::admin('sub_collaborateurs/plan_action') ?>" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon flaticon-share"></i>
                                        <span class="m-menu__link-text"> Suivi des tâches </span>
                                    </a>

                                </li>
                            <?php } ?>

                    </div>
                    <!-- END: Aside Menu -->
                <?php } ?>
            </div>
            <!-- <div class="m-grid__item m-grid__item--fluid m-wrapper"> -->
            <?php include _basepath . ((Config::has('admin') && Config::get('admin')) ? Config::get('admin') . '/' : '') . 'pages/' . $view . '.php' ?>
        </div>
        <div class="clearfix"></div>
        <!-- begin::Footer -->
        <footer class="m-grid__item m-footer ">
            <div class="m-container m-container--fluid m-container--full-height m-page__container">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                        <span class="m-footer__copyright">
                            2020 &copy;
                        </span>
                    </div>

                </div>
            </div>
        </footer>
        <!-- end::Footer -->
    </div>
    <!-- end:: Page -->
    <!-- begin::Quick Sidebar -->

    <!-- end::Quick Sidebar -->
    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->

    <script src="<?php echo URL::base() ?>assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo URL::base() ?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo URL::base() ?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo URL::base() ?>assets/vendors/custom/datatables/datatables.bundle.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/locales-all.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::base() ?>assets/lib/dropify/dropify.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="<?php echo URL::base() ?>assets/app/js/dashboard.js" type="text/javascript">
    </script>
    <!--  Vendors -->
    <!--end::Page Vendors -->
    <!--begin::Page Scripts -->

    <script src="<?php echo URL::base() ?>assets/demo/default/custom/crud/datatables/advanced/column-rendering.js" type="text/javascript"></script>
    <script src="<?php echo URL::base() ?>assets/demo/default/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
    <script src="<?php echo URL::base() ?>assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo URL::base() ?>assets/demo/default/custom/crud/forms/widgets/bootstrap-timepicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo URL::base() ?>assets/js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo URL::base() ?>assets/js/custom_scripts.js" type="text/javascript"></script>
    <!-- begin::Quick Nav -->
    <!--begin::Global Theme Bundle -->

    <!--end::Page Scripts -->
    <!-- begin::Page Loader -->
    <script>
        $(window).on('load', function() {
            $('body').removeClass('m-page--loading');
        });
    </script>
    <!-- end::Page Loader -->
</body>
<!-- end::Body -->

</html>