var Chance = require('chance');
var chance = new Chance();

var express = require('express');
var app = express();

app.get('/', function (req, res) {
  res.send(generateKitePlace());
});

app.listen(3000,function(){
	console.log('Accepting HTTP requests on port 3000');
});

//console.log("Amazing place at: " + chance.coordinates());
// Fonction permettant de générer des adresses complètes
function generateKitePlace(){
	var numberOfPlace = chance.integer({min: 0, max: 10});
	console.log(numberOfPlace);
	var place = [];
	for(var i = 0; i < numberOfPlace; ++i){
		// Permet d'obtenir une adresse
		var adresse = chance.address();

		// Permet d'obtenir un code postal
		var zipCode = chance.areacode();

		// Permet de retourner un nom de ville
		var ville = chance.city();

		// Permet de retourner un nom de pays
		var pays = chance.country({ full: true });
		place.push({address : adresse, 
			areacode : zipCode, 
			city : ville, 
			country : pays});
	};
	console.log(place);
	return place;
}