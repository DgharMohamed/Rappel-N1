
const input = [4, 2, 7, 2, 8, 4, 2, 9, 7];
const input1 = [];

for (let i = 0; i < input.length; i++) {
  let isRepeated = false;
  for (let j = i + 1; j < input.length; j++) {
    if (input[i] === input[j]) {
      isRepeated = true;
      break; 
    }
  }

  if (isRepeated) {
    let alreadyAdded = false;
    for (let k = 0; k < input1.length; k++) {
      if (input1[k] === input[i]) {
        alreadyAdded = true;
        break;
      }
    }

    if (!alreadyAdded) {
      input1[input1.length] = input[i]; 
    }
  }
}

console.log("Repeated values:", input1); 









// const input = [4, 2, 7, 2, 8, 4, 2, 9, 7];
// let input1 = [];

// for (let i = 0 ; i< input.length ; i++){
//   for (let j = i+1  ; j< input.length; j++){
//     isRepeated = false;
//     if (input[i] === input[j] ){
//       isRepeated = true;
//       break;
//     }
//   }
//   if (isRepeated){
//     isAlreadyAdded = false;
//     for(let k = 0 ; k < input1.length; k++){
//       if(input1[k]=== input[i]){
//         isAlreadyAdded = true;
//         break;
//       }
//     }
//   }
//   if(!isAlreadyAdded){
//     input1[input.length] = input[i];
//   }
// }
// console.log(input1)

