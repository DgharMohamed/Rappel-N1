let Videos = [
    {titre : "PHP", duree : 40, views : 1900},
    {titre : "Python", duree :  6, views : 2000},
    {titre : "C", duree :  7, views : 2100},
    {titre : "JavaScript", duree : 10, views : 2001},
    {titre : "C#", duree :  3, views : 2200}
];

let Populaires = [];
let PopulairesTriees = [];
let Selection= [];
let TempsTotal = 0;
const MAX = 10;
let i;
let j;
let minIndex;
let temp;


for (i = 0; i < Videos.length; i++) {
    if (Videos[i].views >= 2000) {
        Populaires[Populaires.length] = Videos[i];
    }
}

for (i = 0; i < Populaires.length; i++) {
    minIndex = i;
    for (j = i + 1; j < Populaires.length; j++) {
        if (Populaires[j].duree < Populaires[minIndex].duree) {
            minIndex = j;
        }
    }
    if (minIndex !== i) {
        temp = Populaires[i];
        Populaires[i] = Populaires[minIndex];
        Populaires[minIndex] = temp;
    }
}
for (i = 0; i < Populaires.length; i++) {
    PopulairesTriees[i] = Populaires[i];
}


for (i = 0; i < PopulairesTriees.length; i++) {
    if (TempsTotal + PopulairesTriees[i].duree <= MAX) {
        Selection[Selection.length] = PopulairesTriees[i];
        TempsTotal = TempsTotal + PopulairesTriees[i].duree;
    }
}


console.log("Videos a regarder :");
for (i = 0; i < Selection.length; i++) {
    console.log(" - " + Selection[i].titre + " (" + Selection[i].duree + " min)");
}
console.log("Nombre de videos : " + Selection.length);
console.log("Temps total utilise : " + TempsTotal + " min");