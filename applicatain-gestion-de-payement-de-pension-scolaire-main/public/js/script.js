$(document).ready(function() {

    // Fonction pour mettre à jour le lien actif et le titre de la page
    function updateActiveState() {
        // Obtient le hash de l'URL (ex: #home, #add-student)
        // S'il n'y a pas de hash, utilise '#home' par défaut.
        var currentHash = window.location.hash || '#home';

        // Enlève la classe 'active' de tous les liens du menu
        $('#sidebarMenu .nav-link').removeClass('active');

        // Trouve le lien qui correspond au hash actuel
        var $activeLink = $('#sidebarMenu .nav-link[href="' + currentHash + '"]');

        // Si aucun lien ne correspond (par exemple, au chargement initial sans hash),
        // sélectionne le lien '#home' par défaut.
        if ($activeLink.length === 0) {
            $activeLink = $('#sidebarMenu .nav-link[href="#home"]');
        }

        // Ajoute la classe 'active' au lien trouvé
        $activeLink.addClass('active');

        // --- Mise à jour du titre H1 (Optionnel) ---
        // Prend le texte du lien actif (sans l'icône)
        var pageTitle = $activeLink.clone().children().remove().end().text().trim();
        // Met à jour le contenu du H1 dans la zone principale
        $('#page-title-placeholder').text(pageTitle || 'Home'); // Utilise 'Home' si le texte est vide

    }

    // Met à jour l'état actif au chargement initial de la page
    updateActiveState();

    // Écoute les changements de hash dans l'URL (quand on clique sur un lien #...)
    $(window).on('hashchange', function() {
        updateActiveState();

        // Ferme automatiquement le menu s'il est ouvert en mode offcanvas (mobile)
        var sidebar = document.getElementById('sidebarMenu');
        if (sidebar.classList.contains('show')) { // Vérifie si l'offcanvas est visible
            var sidebarOffcanvas = bootstrap.Offcanvas.getInstance(sidebar);
            if (sidebarOffcanvas) { // Vérifie si l'instance Bootstrap existe
                sidebarOffcanvas.hide();
            }
        }
    });

    // Sécurité supplémentaire : Ferme le menu sur mobile si on clique sur un lien
    // même si le hash ne change pas (utile si on reclique sur le même lien)
    $('#sidebarMenu .nav-link').on('click', function() {
         var sidebar = document.getElementById('sidebarMenu');
         // Vérifie si on est en mode offcanvas (implicitement sur mobile/tablette)
         if (sidebar.classList.contains('offcanvas')) {
             var sidebarOffcanvas = bootstrap.Offcanvas.getInstance(sidebar);
              if (sidebarOffcanvas && sidebar.classList.contains('show')) {
                 sidebarOffcanvas.hide();
              }
         }
    });

});