// Niz satnica
var satnice = ['7h-9h', '9h-11h', '11h-13h', '13h-15h', '15h-17h', '17h-19h', '19h-21h']

var boxevi = document.querySelector('.boxevi');

// Niz opcija
var options = document.getElementById('termin').querySelectorAll('option');


var termini = document.getElementById('termin');
termini.addEventListener('change', function () {
    var i = 0;
    for (; i < options.length; i++) {

        // Uklanjanje prethodnih elemenata
        while (boxevi.firstChild && !boxevi.firstChild.remove());

        var value = this.value;

        var j = 0;
        while (j < value) {

            // Kreiranje input checkboxa i postavljanje vrednosti na j
            var node = document.createElement('input');
            node.type = "checkbox";
            node.value = 1;
            node.setAttribute('name', satnice[j]);
            boxevi.appendChild(node);

            // Kreiranje labela
            var labela = document.createElement('label');
            labela.htmlFor = satnice[j];

            // Kreiranje teksta labela
            var text = document.createTextNode(satnice[j]);
            labela.appendChild(text);
            boxevi.appendChild(labela);
            j++;
        }

    }
})

