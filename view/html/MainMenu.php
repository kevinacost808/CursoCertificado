<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href="../UsuHome/"><span>[</span>Empresa<span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
    <div class="br-sideleft-menu">

    <?php
        //Cuando sea un usuario
        if($_SESSION['rol_id']==1){
    ?>
        <a href="../UsuCurso/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-22"></i>
                <span class="menu-item-label">Mis Cursos</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
    <?php
        //Cuando sea un administrador
        }else{
    ?>
        <a href="../AdminCurso/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-22"></i>
                <span class="menu-item-label">Mtn. cursos</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="../AdminInstructor/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-22"></i>
                <span class="menu-item-label">Mtn. instructor</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="../AdminCategoria/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-22"></i>
                <span class="menu-item-label">Mtn. categoria</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="../AdminDetalleCertificado/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-22"></i>
                <span class="menu-item-label">Mtn. certificado</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="../AdminUsuario/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-22"></i>
                <span class="menu-item-label">Mtn. usuario</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
    <?php
        }
    ?>
        <a href="../UsuHome/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Inicio</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        
        <a href="../UsuPerfil/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-22"></i>
                <span class="menu-item-label">Perfil</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <a href="../html/Logout.php" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-power tx-22"></i>
                <span class="menu-item-label">Cerrar Sesion</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

    </div>
</div>
<!-- ########## END: LEFT PANEL ########## -->