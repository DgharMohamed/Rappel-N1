let Tab = [1,2,3,4,5,6,7,8,9,10];
let Max = Tab[0];
for (let i = 0 ; i < Tab.length; i++){
    if (Tab[i] > Max){
        Max = Tab[i];
        console.log(Max);
    }
}
console.log(Max);
