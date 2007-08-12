/*
This file is part of Banbury.

Banbury is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License.

Banbury is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// TODO: Funktion BWOpen(Target) dokumentieren

function BWOpen(Target){
	window.open(Target,Target);
	return false; // Wegen XHTML ...
}

function winkeldiff(winkel1, winkel2) {
	while (winkel1 < -180) winkel1 += 360;
	while (winkel1 > 180)  winkel1 -= 360;
	while (winkel2 < -180) winkel2 += 360;
	while (winkel2 > 180)  winkel2 -= 360;
	r = Math.abs(winkel1 - winkel2);
	if (r > 180) r = 360 - r;
	return r;
}

function bild(bname, x, y) {
	this.x = x;
	this.y = y;
	this.winkel = 0.0;
	this.zielwinkel = 0.0;
	this.objektid = bname;
	this.richtung = 0;

	this.positionXY = function(posx, posy) {
		bild = document.getElementById(this.objektid);
		bild.style.left = posx - bild.width/2;
		bild.style.top = posy - bild.height/2;
	}

	this.bewege = function() {
		while (this.winkel < -180) this.winkel += 360;
		while (this.winkel > 180) this.winkel -= 360;
		r = false;
		if (this.richtung == 0) {
			if (Math.abs(this.zielwinkel - this.winkel) > 180) this.richtung = -1; else this.richtung = 1;
		}
		if (winkeldiff(this.zielwinkel, this.winkel) >= 2 ) {
			this.winkel += this.richtung*Math.floor(1+Math.sqrt(winkeldiff(this.zielwinkel, this.winkel)));
			r = true;
		}
		this.positionXY(
			Math.floor(center + radius * Math.cos((-90+this.winkel)*3.14/180.0)),
			Math.floor(center + radius * Math.sin((-90+this.winkel)*3.14/180.0)));
		return r;
	}
}

function hardwaresystemUI() {

	anzahlTeile = 0;
	aktivesTeil = 0;
	aktiv = "";

	bewegungen = new Array();
	bilder = new Array();

	this.add = function() {
		hwuielem = document.getElementById("hwui");
		neuessymbol = this.teilbild("fragezeichen.png", "neu");
		hwuielem.appendChild(neuessymbol);
	}

	this.del = function() {
		if (bilder[aktivesTeil].objektid.substr(0,2) != "QQ") {
			bilderneu = new Array();
			for (var i = 0; i < anzahlTeile; i++) {
				if (i != aktivesTeil) {
					bilder[i].richtung = 0;
					bilderneu.push(bilder[i]);
				} else {
					b = document.getElementById("ank" + bilder[i].objektid);
					pank = b.parentNode;
					pank.removeChild(b);
				}
			}
			anzahlTeile = bilderneu.length;
			bilder = bilderneu;
			aktivesTeil = aktivesTeil % anzahlTeile
			bewegungen = new Array();
			bewegungen.push("nix,distribute");
		}
	}

	this.nameAktivesTeil = function() {
		name = bilder[aktivesTeil].objektid;
		return name;
	}

	this.pl = function() {
		this.springeZu((aktivesTeil + 1) % anzahlTeile);
	}

	this.mn = function() {
		this.springeZu((aktivesTeil + anzahlTeile - 1) % anzahlTeile);
	}

	this.springeZuNamen = function(teilname) {
		ziel = -1;
		for (var i = 0; i < anzahlTeile; i++) {
			if (bilder[i].objektid == teilname) { ziel = i; }
		}
		if (ziel >= 0) this.springeZu(ziel);
	}

	//Der Benutzer klickt im großen Kreis auf ein Symbol
	//es drehen sich alle Symbole im äußeren Kreis,
	//bis das angeklickte Symbol im Bearbeiten-Feld steht
	this.springeZu = function (teilnummer) {
		mitte = anzahlTeile / 2;

		//abstand zw. aktivem und teiln muss kl sein als mitte
		abstand = (aktivesTeil - teilnummer + anzahlTeile) % anzahlTeile;
		if (abstand <= mitte) r = 1; else r = -1;

		aktivesTeil = teilnummer % anzahlTeile;
		for (var i = 0; i < anzahlTeile; i++) {
			bilder[i].richtung = r;
		}
		bewegungen = new Array();
		bewegungen.push("nix,distribute");
	}

	this.bewegen = function() {
		neue_bewegungen = new Array();
		for (var i = 0; i < bewegungen.length; i++) {
			zeile = bewegungen[i];
			objekt = zeile.substr(0, zeile.indexOf(","));
			ani = zeile.substr(zeile.indexOf(",")+1, zeile.length);
			if (ani == "distribute") {
				bilder[aktivesTeil].zielwinkel = 0;
				if (anzahlTeile > 2) {
					winkelschritt = 360 / anzahlTeile;
					zielwinkel = winkelschritt;
					if (zielwinkel < sperrwinkel / 2) {
						zielwinkel = sperrwinkel / 2;
						winkelschritt = (360-sperrwinkel) / (anzahlTeile - 2);
					}
					debugTxT = "aktivesTeil: " + aktivesTeil;
					debugTxT = debugTxT + ",anzahlTeile: " + anzahlTeile;
					for (var i = 1; i < anzahlTeile; i++) {
						bilder[(aktivesTeil + i) % anzahlTeile].zielwinkel = zielwinkel;
						//alert(zielwinkel + "," + winkelschritt);
						debugTxT = debugTxT + ", bild[" + ((aktivesTeil + i) % anzahlTeile ) + "]="+ zielwinkel;
						zielwinkel = (zielwinkel + winkelschritt) % 360;
					}
					debugTxT = debugTxT + ", " + zielwinkel;
					dp = document.getElementById("debug");
					dp.firstChild.nodeValue= "Debug: " + debugTxT;
				} else {
					if (anzahlTeile == 2) {
						bilder[(aktivesTeil+1)%2].zielwinkel = 180;
					}
				}
				for (var i = 0; i < anzahlTeile; i++) {
					neue_bewegungen.push(bilder[i].objektid + ",move");
				}
			}
			if (ani == "move") {
				for (var i = 0; i < anzahlTeile; i++) {
					if (bilder[i].bewege()) neue_bewegungen.push(zeile);
				}
			}
		}
		bewegungen = neue_bewegungen;
	}

	function loeschenFrage(teilenummer) {

	}

	function loeschen(teilenummer) {
		hardwaresystemC.loesche(teilnummer);
	}

	function loeschanimation(teilenummer) {
		//verkleinere das Symbol
		//bewege alle Symbole auf neue Positionen
	}

	function neuanimation() {
	}

	this.init = function () {
		hwuielem = document.getElementById("hwui");
		hwuielem.style.backgroundImage = "url(kreishintergrund.png)";
		hwuielem.style.height = "300px";
		hwuielem.style.width = "300px";

		hwuielem.appendChild(this.auswahlrahmen());
		hwuielem.appendChild(this.teilbild("fragezeichen.png", "QQsystem"));
		hwuielem.appendChild(this.teilbild("teil1.png", "festplatte"));
		hwuielem.appendChild(this.teilbild("teil2.png", "cdrom"));
		hwuielem.appendChild(this.teilbild("teil3.png", "mouse"));
		hwuielem.appendChild(this.teilbild("teil4.png", "monitor"));
		hwuielem.appendChild(this.teilbild("teil5.png", "festplatte2"));
		hwuielem.appendChild(this.teilbild("teil6.png", "ram"));

		bewegungen.push("nix,distribute");
		aktiv = window.setInterval("hwsysc.animation()", 100);
	}

	this.stop = function() {
		window.clearInterval(aktiv);
	}

	this.teilbild2 = function(src, name) {
		tbimg = document.createElement("img");
		tbimg.src = src;
		tbimg.style.position="absolute";
		tbimg.style.left = 210;
		tbimg.style.top = 100;
		tbimg.zIndex = 25;
		tbimg.id = name;
		/*abild = new bild(name, 150, 150);
		abild.winkel = 0;
		abild.zielwinkel = 0;
		bilder.push(abild);*/

		ank = document.createElement("a");
		ank.setAttribute('href', 'javascript:hwsysc.jt("' + name + '");');
		ank.appendChild(tbimg);
		ank.setAttribute('id', 'ank' + name);

		anzahlTeile++;

		return ank;
	}
	
	this.teilbild = function(src, name) {
		tbimg = document.createElement("img");
		tbimg.src = src;
		tbimg.style.position="absolute";
		tbimg.style.left = 210;
		tbimg.style.top = 100;
		tbimg.zIndex = 25;
		tbimg.id = name;
		abild = new bild(name, 150, 150);
		abild.winkel = 0;
		abild.zielwinkel = 0;
		bilder.push(abild);

		ank = document.createElement("a");
		ank.setAttribute('href', 'javascript:hwsysc.jt("' + name + '");');
		ank.appendChild(tbimg);
		ank.setAttribute('id', 'ank' + name);

		anzahlTeile++;

		return ank;
	}

	this.auswahlrahmen = function() {
		arahmen = document.createElement("img");
		arahmen.src = "auswahlrahmen.png";
		arahmen.style.left=88;
		arahmen.style.top=-20;
		arahmen.style.zIndex = 99;
		arahmen.style.position="relative";

		return arahmen;
	}
 }

 function hardwaresystemC() {

	 hwui = new hardwaresystemUI();

	 function neu() {
		 hardwaresystemUI.neuanimation();
	 }

	 function loesche(teilnummer) {
		 //lösche das n-te Element (n = teilnummer) aus teile
		 aktualisiereUI();
	 }

	 function aktualisiereUI() {
		 hardwaresystemUI.anzahlTeile = teile.anzahl;
		 loeschanimation(teilenummer);
	 }

	 this.init = function () {
		hwui.init();
	 }

	 this.animation = function () {
		 hwui.bewegen();
	 }

	 this.stop = function() {
		 hwui.stop();
	 }

	 this.pl = function() {
		 hwui.pl();
	 }

	 this.mn = function() {
		 hwui.mn();
	 }

	 this.jt = function(teil) {
		 hwui.springeZuNamen(teil);
	 }

	 this.del = function() {
		 hwui.del();
	 }
	 
	 this.add = function() {
		 hwui.add();
	 }
 }

var center = 150;
var radius = 125.0;
var sperrwinkel = 120;

 var hwsysc = new hardwaresystemC();
 hwsysc.init();
