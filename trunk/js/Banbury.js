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

var PictureSize = 32;
var KorrekturPixel = -4; // Diese Pixelanzahl muss am Auswahlrahmen links eingef¸gt werden. Keiner weiﬂ warum.
var ImagesFolder = "Icons/Tags/"+PictureSize+"/";

// derzeitiger Winkel der Komponenten
var winkel = new Array();

// einzunehmender Winkel jeder Komponente
var zielwinkel = new Array();

// Feld aller Objektnamen
var objektid = new Array();

// Bewegungsrichtungen der Komponenten
var richtung = new Array();

// Zentrum der Grafiken
var center = 120;

// Radius
var radius = 100.0;

// In diesem Winkel h√§lt sich nur das zur Zeit ausgew√§hlte Symbol auf
var sperrwinkel = 120;

// die Anzahl der Komponenten
var anzahlTeile = 0;

// die Nummer der gerade aktiven Komponente
var aktivesTeil = 0;

// Liste der auszuf√ºhrenden Bewegungsbefehle
var bewegungen = new Array();

// Sucht die Position des Bildes mit dem Namen bname

