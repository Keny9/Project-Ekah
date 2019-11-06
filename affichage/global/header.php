<?php
if(!isset($_SESSION)){
  session_start();
}

$seConnecterRedirect;

// Si pas connecté
if (!isset($_SESSION['logged_in_user_id'])){
  $seConnecterRedirect = "/Project-Ekah/affichage/global/login.php";
}
else{
  if($_SESSION['logged_in_user_type_id'] == 1){ // client
    $seConnecterRedirect = "/Project-Ekah/affichage/client/accueil_client.php";
  }
  else if($_SESSION['logged_in_user_type_id'] == 2){ // admin
    $seConnecterRedirect = "/Project-Ekah/affichage/admin/accueil_admin.php";
  }
}

 ?>
<header>
  <div id="logoWrapper" class="logo">
    <img id='logoHeader'src="../../img/logo_ekah_header.png" onclick="window.location.href='https://ekah.co'"  alt="Ekah">
  </div>

  <nav class="navi-header">
    <div class="inner-header">
      <div class="onglet">
        <a href="https://ekah.co">ACCUEIL</a>
      </div>
        <div id="onglet_service" class="onglet">
          <div id="folder_service" class="folder">SERVICES</div>
          <div id="service_header" class="sous-onglet">
            <div id="c-individu" class="collection">
              <a href="https://ekah.co/je-suis-un-individu">JE SUIS UN INDIVIDU</a>
            </div>
            <div id="c-equipe" class="collection">
              <a href="https://ekah.co/nous-sommes-une-quipe">NOUS SOMMES UNE ÉQUIPE</a>
            </div>
          </div>
        </div>
      <div id="onglet_retraite" class="onglet">
        <div id="folder_retraite" class="folder">RETRAITES</div>
        <div id="retraite" class="sous-onglet">
          <div id="c-francais" class="collection">
            <a href="https://ekah.co/retraite-transformationelle-dec-17">EN FRANÇAIS</a>
          </div>
          <div id="c-english" class="collection">
            <a href="https://ekah.co/retraite-transformationelle-dec-1-7">IN ENGLISH</a>
          </div>
        </div>
      </div>
      <div id="onglet_propos" class="onglet">
        <div id="folder_propos" class="folder">À PROPOS</div>
        <div id="propos" class="sous-onglet">
          <div id="c-ekah" class="collection">
            <a href="https://ekah.co/what-we-do">EKAH</a>
          </div>
          <div id="c-equipe-propos" class="collection">
            <a href="https://ekah.co/equipe">ÉQUIPE</a>
          </div>
        </div>
      </div>
      <div id="contactNav" class="btn-header">
        <a href="https://ekah.co/contact-1">CONTACT</a>
      </div>
      <div id="seConnecter" class="btn-header">
        <a href="<?php echo $seConnecterRedirect; ?>">ESPACE CLIENT</a>
      </div>
      <div class="dropdown_button">
        <span id="header_drop" class="header_drop"></span>
      </div>
      <nav id="header_nav">
        <?php
          if(isset($page_type)){
            if($page_type == 1){
              include "nav_client.php";
            }
            else if($page_type == 2){
              include "nav_admin.php";
            }
          }
         ?>
      </nav>
    </div>
    <div id="nav-mobile" class="nav-mobile">
      <span id="icon-mobile-menu" class="icon-nav-mobile"></span>
    </div>
    <div id="side-nav-m" class="side-nav">
      <div class="nav-wrapper">
        <div class="mobile-navigation">
          <div class="onglet onglet-m">
            <div class="folder" id="folder_accueil_m">
              <a href="https://ekah.co">ACCUEIL</a>
            </div>
          </div>
            <div id="onglet_service_m" class="onglet onglet-m">
              <div id="folder_service_m" class="folder">+ SERVICES</div>
              <div id="service_m" class="sous-onglet sous-onglet-m">
                <div class="collection_m">
                  <a href="https://ekah.co/je-suis-un-individu">JE SUIS UN INDIVIDU</a>
                </div>
                <div class="collection_m">
                  <a href="https://ekah.co/nous-sommes-une-quipe">NOUS SOMMES UNE ÉQUIPE</a>
                </div>
              </div>
            </div>
          <div id="onglet_retraite_m" class="onglet onglet-m">
            <div id="folder_retraite_m" class="folder">+ RETRAITES</div>
            <div id="retraite_m" class="sous-onglet sous-onglet-m">
              <div class="collection_m">
                <a href="https://ekah.co/retraite-transformationelle-dec-17">EN FRANÇAIS</a>
              </div>
              <div class="collection_m">
                <a href="https://ekah.co/retraite-transformationelle-dec-1-7">IN ENGLISH</a>
              </div>
            </div>
          </div>
          <div id="onglet_propos_m" class="onglet onglet-m">
            <div id="folder_propos_m" class="folder">+ À PROPOS</div>
            <div id="propos_m" class="sous-onglet sous-onglet-m">
              <div class="collection_m">
                <a href="https://ekah.co/what-we-do">EKAH</a>
              </div>
              <div class="collection_m">
                <a href="https://ekah.co/equipe">ÉQUIPE</a>
              </div>
            </div>
          </div>
          <div id="contactNav" class="btn-header btn-header-m">
            <a href="https://ekah.co/contact-1">CONTACT</a>
          </div>
          <div id="seConnecter" class="btn-header btn-header-m">
            <a href="<?php echo $seConnecterRedirect; ?>">ESPACE CLIENT</a>
          </div>
        </div>
      </div>

    </div>
  </nav>
</header>
