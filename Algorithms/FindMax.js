let Tab = [20,15,24,19,100,22,33];
let Max = Tab[0];
for (let i = 0 ; i < Tab.length; i++){
    if (Tab[i] > Max){
        Max = Tab[i];
    }
}
console.log(Max);
