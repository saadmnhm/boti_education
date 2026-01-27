<?php require 'session.php';
require 'header.php'; 
$result = null;
    if(isset($_SESSION['result']) && $_SESSION['result']){
        $result = $_SESSION['result'];
        unset($_SESSION['result']);
        
    }
?>

<nav class=" navbar navbar-expand-lg sticky-navbar">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">
            <img src="assets/images/new/loggg.png" class="logo" alt="logo">
          </a>
          <button class="navbar-toggler" type="button">
            <span class="menu-lines"><span></span></span>
          </button>
          <div class="collapse navbar-collapse" id="mainNavigation">
            <ul class="navbar-nav">
              <li class="nav__item has-dropdown">
                <a href="index.php" class="nav__item-link ">Accueil</a>
              </li><!-- /.nav-item -->
              <li class="nav__item has-dropdown">
                <a href="index.php#a_propos_de_nous" class="nav__item-link">À propos de nous</a>
              </li><!-- /.nav-item -->
              <li class="nav__item has-dropdown">
                <a href="index.php#secteur_activite" class="nav__item-link">Secteurs d'activite</a>
                <button class="dropdown-toggle" data-toggle="dropdown"></button>
                <ul class="dropdown-menu">
                  <li class="nav__item"><a href="secteur_electrique.php" class="nav__item-link">Sécteur électrique</a></li>
                  <!-- /.nav-item -->
                  <li class="nav__item"><a href="secteur_automatisme.php" class="nav__item-link">Sécteur d'automatisme</a></li>
                  <!-- /.nav-item -->
                  <li class="nav__item"><a href="secteur_energie_solaire.php" class="nav__item-link">Sécteur d'energie solaire</a></li>
                  <!-- /.nav-item -->

                  <!-- /.nav-item -->
                </ul><!-- /.dropdown-menu -->
              </li><!-- /.nav-item -->
              <li class="nav__item has-dropdown">
                <a href="index.php#moyens_humains" class="nav__item-link">Nos moyens humains</a>
              </li><!-- /.nav-item -->
              <li class="nav__item has-dropdown">
                <a href="index.php#references_et_fournisseurs" class="nav__item-link">Références et fournisseurs</a>
              </li><!-- /.nav-item -->
              <li class="nav__item">
                <a href="contact.php" class="nav__item-link active">Contact</a>
              </li>
            </ul><!-- /.navbar-nav -->
            <button class="close-mobile-menu d-block d-lg-none"><i class="fas fa-times"></i></button>
          </div><!-- /.navbar-collapse -->
          
        </div><!-- /.container -->
      </nav><!-- /.navabr -->
    </header><!-- /.Header -->



     <section class="google-map py-0">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.74917650372!2d-7.572555599999999!3d33.585861099999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbd1d1e8ffc269613!2zMzPCsDM1JzA5LjEiTiA3wrAzNCcyMS4yIlc!5e0!3m2!1sfr!2sma!4v1673370130230!5m2!1sfr!2sma" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
     </section><!-- /.GoogleMap -->
     <section class="contact-layout1 pb-90">
       <div class="container">
         <div class="row">
           <div class="col-12">
             <div class="contact-panel p-0 box-shadow-none">
               <div class="contact__panel-info mb-30">
                 <div class="contact-info-box">
                   <h4 class="contact__info-box-title">Obtenir des directions</h4>
                   <ul class="contact__info-list list-unstyled">
                     <li>26 rue 12 métre RDC Hay mohammadi, Casablanca</li>
                   </ul><!-- /.contact__info-list -->
                 </div><!-- /.contact-info-box -->
                 <div class="contact-info-box">
                   <h4 class="contact__info-box-title">Contact rapide</h4>
                   <ul class="contact__info-list list-unstyled">
                     <li>Email: <a href="mailto:commercial.travtech@gmail.com">commercial.travtech@gmail.com</a></li>
                   </ul><!-- /.contact__info-list -->
                 </div><!-- /.contact-info-box -->
                 <div class="contact-info-box">
                   <h4 class="contact__info-box-title">Horaires d'ouvertures</h4>
                   <ul class="contact__info-list list-unstyled">
                     <li><b>Du Lundi - Vendredi</b></li>
                     <li>8 : 30 am to 6 pm</li>
                     <li><b>Samedi</b></li>
                     <li>8 : 30 am to 12 : 30 pm</li>
                   </ul><!-- /.contact__info-list -->
                 </div><!-- /.contact-info-box -->
                 
               </div><!-- /.contact__panel-info -->
               
               <form action="mail.php" method="post"   class="contact__panel-form mb-30">
                  <input type="hidden" name="op" value="contact" />
                 <div class="row">
                 <?php if(isset($result) && $result=='success'){ ?>

                   <div class="text-success text-center mb-4">

                   <h5 class="" style="color: #00a5d2 !important;">Votre message a été bien transmis</h5>

                       </div>

                   <?php } ?>
                   <div class="col-sm-12">
                     <h4 class="contact__panel-title">Contactez-Nous</h4>
                     <p class="contact__panel-desc mb-40">Si vous avez des questions ou besoin d'aide, n'hésitez pas à contacter notre équipe.</p>
                   </div>
                   <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="form-group">
                       <input type="text" class="form-control" placeholder="Nom & Prénom" id="contact-name" name="nomcomplet" required="">
                     </div>
                   </div><!-- /.col-lg-6 -->
                   <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="form-group">
                       <input type="email" class="form-control" placeholder="Email" id="contact-email" name="email" required="">
                     </div>
                   </div><!-- /.col-lg-6 -->
                   <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="form-group">
                       <input type="text" class="form-control" placeholder="Téléphone" id="contact-Phone" name="tel" required="">
                     </div>
                   </div><!-- /.col-lg-6 -->
                   <div class="col-sm-6 col-md-6 col-lg-6">
                     <div class="form-group">
                       <select name="services">
                         <option value="" disabled selected>Sélectionnez Vos services</option>
                         <option value="electrique">Sécteur Électrique</option>
                         <option value="automatisme">Sécteur D'automatisme</option>
                         <option value="solaire">Sécteur D'energie Solaire</option>
                       </select>
                     </div>
                   </div><!-- /.col-lg-6 -->
                   <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="form-group">
                       <textarea class="form-control" placeholder="Message" placeholder="Message" id="contact-messgae" name="message" required=""></textarea>
                     </div>
                   </div><!-- /.col-lg-12 -->
                   <div class="col-sm-12 col-md-12 col-lg-12">
                     <button type="submit" class="btn btn__secondary">
                       <i class="icon-arrow-right"></i><span>Envoyer</span>
                     </button>
                     <div class="contact-result"></div>
                   </div><!-- /.col-lg-12 -->
                 </div><!-- /.row -->
               </form>
             </div><!-- /.contact__panel -->
           </div><!-- /.col-lg-12 -->
         </div><!-- /.row -->
       </div><!-- /.container -->
     </section><!-- /.contact layout 1 -->



<?php require 'footer.php'; ?>   