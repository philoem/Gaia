/**
 * Page index.php, liste des messages
 * Gestion du bouton de confirmation de la fenêtre modal de Bootstrap pour avoir le même id du message que dans la liste des messages
 */
$(document).ready(function() {
  // Pour stocker le lien avec la bonne id du message
  var lien;
  // Affichage de la fenêtre
  $('.lien_id').click(function(e) {
    e.preventDefault(e);
    lien = $(this).attr('href');
    $("#myModal").modal("show");
  });
  // Lors du click passer l'url stockée dna sle lien href du bouton de confirmation
  $("#confirm").click(function(e) {
    window.location.href = lien;
  });
});