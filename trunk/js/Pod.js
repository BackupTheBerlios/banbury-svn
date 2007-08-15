	var hwuielem = document.getElementById("hwui");
	var tplvalues = document.getElementById('tplvalues');
	var url = "CallFunc.php";
	var target = document.getElementById('PODDisplay'); // Scrollen ...
	var targetTable = document.getElementById('PODTable'); // Inhalt des Displays ...
	var myEffects = target.effects({duration: 1000, transition:Fx.Transitions.Sine.easeInOut});

	function SlideF(){
		myEffects.start({'left':[300,0],duration: 1000}).chain(function(){
			target.style.overflow = 'auto';
		});
	}
	function SlideB(){
		myEffects.start({'left':[-300,0],duration: 1000}).chain(function(){
			target.style.overflow = 'auto';
		});
	}
	function genPODDisplay(Menu,Tags){
		target.style.overflow = 'hidden';

		LoadTPLOne(Tags);

		var MyAjax = myEffects.start({'left':[0,-300],duration: 300}).chain(function(){

			new Ajax(url, {
				method: 'post',
				data: "Function=PODDisplay&Menu=" + Menu,
				update: targetTable,
				onComplete: SlideF,

			}).request();
		})
	}
	function genPODDisplayBack(Menu,Tags){
		target.style.overflow = 'hidden';

		LoadTPLOne(Tags);


		var MyAjax = myEffects.start({'left':[0,300],duration: 300}).chain(function(){

			new Ajax(url, {
				method: 'post',
				data: "Function=PODDisplay&Menu=" + Menu,
				update: targetTable,
				onComplete: SlideB,

			}).request();
		})
	}

	function NewPODDisplay(Menu){
		var MyAjax = myEffects.start({'left':[0,-300],duration: 300}).chain(
			function(){
				new Ajax(url, {
				method: 'post',
				data: "Function=NewPODDisplay&Menu=" + Menu,
				update: targetTable,
				onComplete: SlideF,

				}).request();
			}
		);

	}
	function AddPOD(){
		Name = document.getElementById('NewPODName').value;
		Menu = document.getElementById('NewPODMenu').value;

		new Ajax(url, {
			method: 'post',
			data: "Function=AddToPODDisplay&Name=" + Name + "&" + "Menu=" + Menu,
			update: targetTable,
			onComplete: genPODDisplayBack(Menu),

		}).request();


	}
	genPODDisplay('');


//
// Eriks Rad
//



function winkeldiff(winkel1, winkel2) {
	while (winkel1 < -180) winkel1 += 360;
	while (winkel1 > 180)  winkel1 -= 360;
	while (winkel2 < -180) winkel2 += 360;
	while (winkel2 > 180)  winkel2 -= 360;
	r = Math.abs(winkel1 - winkel2);
	if (r > 180) r = 360 - r;
	return r;
}

function indexByObjectid(bname) {
	r = -1;
	for (var i=0; i<objektid.length; i++) if (objektid[i] == bname) r = i;
	return r;
}


// Positioniere das Bild zentriert auf den Koordinaten x und y

function bildpositionXY(bname, x, y) {
	bild = document.getElementById(bname);
	bild.style.left = (x - bild.width/2 ) + "px"; // Aus unbekannten Gr¸nden m¸ssen hier 4 Pixel addiert werden.
	bild.style.top = (y - bild.height/2 ) + "px";
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



// Erzeuge das Objekt zur Repr√§sentation des Auswahlrahmens

function auswahlrahmen() {
	arahmen = document.createElement("img");
	arahmen.src = ImagesFolder+"auswahlrahmen.png";
	arahmen.style.left= (center-(PictureSize/2))+KorrekturPixel+"px";
	arahmen.style.top= center - radius - (PictureSize/2) + "px";
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

// L‰dt eine Template ID ..

function LoadTPLOne(Tags){
	objekte = objektid.length;
	while(objekte > 0){
		del();
		objekte--;
	}
	bewegungen.push("distribute");
	aktiv = window.setInterval("bewegen()", 100);

	var MyAjax = new Ajax(url, {
		method: 'post',
		data: "Function=LoadPODTPL&Tags=" + Tags,
 		update: tplvalues, 
		onComplete: LoadTPLTwo,

	}).request();

}

function LoadTPLTwo(){
	LoadedValues = tplvalues;
	if(LoadedValues.childNodes.length > 0){
		for (var i = 0; i < LoadedValues.childNodes.length;i++){
			var Pic = LoadedValues.childNodes[i].getAttribute('Pic');
			var Value = LoadedValues.childNodes[i].innerHTML;
			name = einzigartigerObjektname(Value);
			hwuielem.appendChild(teilbild(ImagesFolder+Pic,Value));
		//	springeZuNamen(name);
		}
		bewegungen.push("distribute");
		aktiv = window.setInterval("bewegen()", 100);

	}
}


// F¸gt ein leeres Symbol ein

function add() {
	name = einzigartigerObjektname("neu");
	hwuielem.appendChild(teilbild(ImagesFolder+"-Kern.png", name));
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
	 dp.firstChild.nodeValue= "Debug: " + document.getElementById(objektid[aktivesTeil]).style.left;
}

function init() {
	hwuielem.style.backgroundImage = "url("+ImagesFolder+"kreishintergrund.png)";
	hwuielem.style.backgroundPosition = ((center)-150) +"px "+((center)-150) +"px ";
	hwuielem.style.height = (2*center)+"px";
	hwuielem.style.height = (2*center)+"px";
	hwuielem.style.width = (2*center)+"px";

	hwuielem.appendChild(auswahlrahmen());
/*	hwuielem.appendChild(teilbild(ImagesFolder+"Pieces.png", "QQsystem"));
	hwuielem.appendChild(teilbild(ImagesFolder+"0-Kern.png", "festplatte"));
	hwuielem.appendChild(teilbild(ImagesFolder+"SpeakerBox_wood.png", "cdrom"));
	hwuielem.appendChild(teilbild(ImagesFolder+"scanner.png", "mouse"));
	hwuielem.appendChild(teilbild(ImagesFolder+"hdd_unmount.png", "monitor"));
	hwuielem.appendChild(teilbild(ImagesFolder+"keyboard.png", "festplatte2"));
	hwuielem.appendChild(teilbild(ImagesFolder+"1-System.png", "ram"));*/
	hwuielem.appendChild(teilbild(ImagesFolder+"1-System.png", "QQsystem"));

	bewegungen.push("distribute");
	aktiv = window.setInterval("bewegen()", 100);
}

function anistop() {
	window.clearInterval(aktiv);
}

init();

