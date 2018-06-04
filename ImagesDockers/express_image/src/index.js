
var Chance = require('chance');
var chance = new Chance();

var express = require('express');
var app = express();

var ip_module = require('ip');

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
		
		//var ip = <?php echo ip.php?>;

		/*var ip;
		var dir;
		/*
		runner.exec("php " + "ip.php", function(err, phpResponse, stderr){
			console.log(phpResponse);
			ip = phpResponse;
		});
		runner.exec("ifconfig | grep inet | head -n 1 | tr -s ' ' | cut -d ' ' -f3", function (error, stdout, stderr){});*/
		/*dir = exec("ifconfig | grep inet | head -n 1 | tr -s ' ' | cut -d ' ' -f3", function (error, stdout, stderr){});
		dir.on('exit', function (code){
			ip = code;
		});*/
		var address_ip = ip_module.address();

		// Permet de retourner un nom de pays
		var pays = chance.country({ full: true });
		place.push({address : adresse, 
			areacode : zipCode, 
			city : ville, 
			country : pays,
			ip : address_ip
		});
	};
	console.log(place);
	return place;
}