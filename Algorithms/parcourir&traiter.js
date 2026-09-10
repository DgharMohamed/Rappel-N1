
const input = [4, 2, 7, 2, 8, 4, 2, 9, 7];
const duplicates = [];

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
    for (let k = 0; k < duplicates.length; k++) {
      if (duplicates[k] === input[i]) {
        alreadyAdded = true;
        break;
      }
    }

    if (!alreadyAdded) {
      duplicates[duplicates.length] = input[i]; 
    }
  }
}

console.log("Repeated values:", duplicates); 








// const input = [4, 2, 7, 2, 8, 4, 2, 9, 7];
// let input1 = [];

// for (let i = 0 ; i< input.length ; i++){
//   for (let j = i + 1 ; j< input.length; j++){
//     if (input[i] == input[j] ){
//       CountInput[i]
//     }
//   }
// }
// console.log(input1)

