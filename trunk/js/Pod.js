
function winkeldiff(winkel1, winkel2) {
	while (winkel1 < -180) winkel1 += 360;
	while (winkel1 > 180)  winkel1 -= 360;
	while (winkel2 < -180) winkel2 += 360;
	while (winkel2 > 180)  winkel2 -= 360;
	r = Math.abs(winkel1 - winkel2);
	if (r > 180) r = 360 - r;
	return r;
}

// derzeitiger Winkel der Komponenten
var winkel = new Array();

// einzunehmender Winkel jeder Komponente
var zielwinkel = new Array();

// Feld aller Objektnamen
var objektid = new Array();

// Bewegungsrichtungen der Komponenten
var richtung = new Array();

// Zentrum der Grafiken
var center = 150;

// Radius
var radius = 115.0;

// In diesem Winkel hält sich nur das zur Zeit ausgewählte Symbol auf
var sperrwinkel = 120;

// die Anzahl der Komponenten
var anzahlTeile = 0;

// die Nummer der gerade aktiven Komponente
var aktivesTeil = 0;

// Liste der auszuführenden Bewegungsbefehle
var bewegungen = new Array();

// Sucht die Position des Bildes mit dem Namen bname

function indexByObjectid(bname) {
	r = -1;
	for (var i=0; i<objektid.length; i++) if (objektid[i] == bname) r = i;
	return r;
}


// Positioniere das Bild zentriert auf den Koordinaten x und y

function bildpositionXY(bname, x, y) {
	bild = document.getElementById(bname);
	bild.style.left = (x - bild.width/2) + "px";
	bild.style.top = (y - bild.height/2) + "px";
}


// Bewege ein Bild

function bildBewegung(bindex) {
	if (bindex > -1) {
		while (winkel[bindex] < -180) winkel[bindex] += 360;
		while (winkel[bindex] > 180) winkel[bindex] -= 360;
		r = false;
		if (richtung[bindex] == 0) {
			if (Math.abs(zielwinkel[bindex] - winkel[bindex]) > 180) richtung[bindex] = -1; else richtung[bindex] = 1;
		}
		if (winkeldiff(zielwinkel[bindex], winkel[bindex]) >= 2 ) {
			winkel[bindex] += richtung[bindex]*Math.floor(1+Math.sqrt(winkeldiff(zielwinkel[bindex], winkel[bindex])));
			bildpositionXY(objektid[bindex],
				Math.floor(center + radius * Math.cos((-90+winkel[bindex])*3.14/180.0)),
				Math.floor(center + radius * Math.sin((-90+winkel[bindex])*3.14/180.0)));
			r = true;
		}
		return r;
	}
}



// Erzeuge das Objekt zur Repräsentation des Auswahlrahmens

function auswahlrahmen() {
	arahmen = document.createElement("img");
	arahmen.src = ImagesFolder+"auswahlrahmen.png";
	arahmen.style.left="80px";
	arahmen.style.top="-25px";
	arahmen.style.zIndex = 99;
	arahmen.style.position="relative";

	return arahmen;
}


// Erstellt eine neue Komponente

function teilbild(src, name) {
	tbimg = document.createElement("img");
	tbimg.src = src;
	tbimg.style.position="absolute";
	tbimg.style.left = "210px";
	tbimg.style.top = "100px";
	tbimg.style.borderWidth = "0px";
	tbimg.zIndex = 25;
	tbimg.id = name;
	/*winkel.push(-5);
	zielwinkel.push(0);
	objektid.push(name);
	richtung.push(0);
	*/
	winkel.splice(aktivesTeil, 0, -5);
	zielwinkel.splice(aktivesTeil, 0, 0);
	objektid.splice(aktivesTeil, 0, name);
	richtung.splice(aktivesTeil, 0, 0);

	ank = document.createElement("a");
	ank.setAttribute('href', 'javascript:springeZuNamen("' + name + '");');
	ank.setAttribute('id', 'ank' + name);
	ank.appendChild(tbimg);


	anzahlTeile = objektid.length;

	return ank;
}


function einzigartigerObjektname(vorlage) {
	l = vorlage.length;
	max = 0;
	for (var i = 0; i < objektid.length; i++) {
		objvorlage = objektid[i].substr(0, l);
		if (objvorlage == vorlage) {
			altmax = objektid[i].substr(l, objektid[i].length-1);
			max = Math.max(max, altmax);
		}
	}
	return vorlage + (max+1);
}


// Fügt ein leeres Symbol ein

function add() {
	hwuielem = document.getElementById("hwui");
	name = einzigartigerObjektname("neu");
	hwuielem.appendChild(teilbild(ImagesFolder+"fragezeichen.png", name));
	springeZuNamen(name);
}


function del() {
	if (objektid[aktivesTeil].substr(0,2) != "QQ") {
		b = document.getElementById("ank" + objektid[aktivesTeil]);
		pank = b.parentNode;
		pank.removeChild(b);

		winkel.splice(aktivesTeil, 1);
		zielwinkel.splice(aktivesTeil, 1);
		objektid.splice(aktivesTeil, 1);
		richtung.splice(aktivesTeil, 1);

		anzahlTeile = objektid.length;
		aktivesTeil = aktivesTeil % anzahlTeile;
		bewegungen.push("distribute");
	}
}

function drehpl() {
	springeZu((aktivesTeil + 1) % anzahlTeile);
}

function drehmn() {
	springeZu((aktivesTeil + anzahlTeile - 1) % anzahlTeile);
}


function springeZuNamen(teilname) {
	ziel = indexByObjectid(teilname);
	if (ziel >= 0) this.springeZu(ziel);
}


function springeZu(teilnummer) {
	mitte = anzahlTeile / 2;
	abstand = (aktivesTeil - teilnummer + anzahlTeile) % anzahlTeile;
	if (abstand <= mitte) r = 1; else r = -1;

	aktivesTeil = teilnummer % anzahlTeile;
	for (var i = 0; i < anzahlTeile; i++) {
		richtung[i] = r;
	}
	bewegungen.push("distribute");
}

function bewegen() {
	aktion = bewegungen.shift();
	if (aktion == "distribute") {
		zielwinkel[aktivesTeil] = 0;
		if (anzahlTeile > 2) {
			winkelschritt = 360 / anzahlTeile;
			rzielwinkel = winkelschritt;
			if (rzielwinkel < sperrwinkel / 2) {
				rzielwinkel = sperrwinkel / 2;
				winkelschritt = (360-sperrwinkel) / (anzahlTeile - 2);
			}
			for (var i = 1; i < anzahlTeile; i++) {
				zielwinkel[(aktivesTeil + i) % anzahlTeile] = rzielwinkel;
				rzielwinkel = (rzielwinkel + winkelschritt) % 360;
			}
		} else {
			if (anzahlTeile == 2) {
				zielwinkel[(aktivesTeil+1)%2] = 180;
			}
		}
		if (bewegungen.length == 0 || (bewegungen.length > 0 && bewegungen[0] != "move")) bewegungen.push("move");
	}
	if (aktion == "move") {
		weiterbewegen = false;
		for (var i = 0; i < anzahlTeile; i++) {
			weiterbewegen = bildBewegung(i) || weiterbewegen;
			}
		bewegungen.push("move");
	}
	while ((bewegungen.length > 2) && (bewegungen[0] == bewegungen[1])) bewegungen.shift();
	// NOTE: Debugcode entfernen
	dp = document.getElementById("debug");
	dp.firstChild.nodeValue= "Debug: " + bewegungen.join(", ");
}

function init() {
	hwuielem = document.getElementById("hwui");
	hwuielem.style.backgroundImage = "url("+ImagesFolder+"kreishintergrund.png)";
	hwuielem.style.height = "280px";
	hwuielem.style.width = "280px";
	hwuielem.style.backgroundColor = "red";

	hwuielem.appendChild(auswahlrahmen());
	hwuielem.appendChild(teilbild(ImagesFolder+"fragezeichen.png", "QQsystem"));
	hwuielem.appendChild(teilbild(ImagesFolder+"teil1.png", "festplatte"));
	hwuielem.appendChild(teilbild(ImagesFolder+"teil2.png", "cdrom"));
	hwuielem.appendChild(teilbild(ImagesFolder+"teil3.png", "mouse"));
	hwuielem.appendChild(teilbild(ImagesFolder+"teil4.png", "monitor"));
	hwuielem.appendChild(teilbild(ImagesFolder+"teil5.png", "festplatte2"));
	hwuielem.appendChild(teilbild(ImagesFolder+"teil6.png", "ram"));

	bewegungen.push("distribute");
	aktiv = window.setInterval("bewegen()", 100);
}

function anistop() {
	window.clearInterval(aktiv);
}

init();