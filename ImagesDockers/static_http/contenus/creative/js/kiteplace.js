$(function() {
  console.log("chargement emplacement kite");

  function loadKitePlace(){

    // Permet de lancer la fonction kiteplace une fois que l'on a reçu do JSON
    $.getJSON( "/api/kiteplace/", function (kiteplace) {
      console.log(kiteplace);
      var message = "Aucune place de kite";
      if(kiteplace.length > 0){
        message = kiteplace[0].address + " " + kiteplace[0].city + " " + kiteplace[0].country + " " + kiteplace[0].ip;
      }
      $(".kite").text(message);
      // Ne fonctionne pas...
      $(".text-faded mb-5").text(message);
    });
  };

  loadKitePlace();

  setInterval(loadKitePlace, 1000);
}); // End of use strict
