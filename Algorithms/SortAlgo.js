let Tab = [10,1,27,30,2,100,3];
for(let i = 0 ; i < Tab.length ; i++){
    valeurMin = i;
    for(let j = i + 1 ; j < Tab.length ; j++){
        if(Tab[j] < Tab[valeurMin]){
            valeurMin = j;
        }
       
    }
    if(valeurMin !== i){
            let temp = Tab[i];
            Tab[i] = Tab[valeurMin];
            Tab[valeurMin] = temp;
           
        }
    
}
console.log(Tab);