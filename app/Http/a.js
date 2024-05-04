let count = 0;

function cc(card) {
  // Cambia solo el código debajo de esta línea

  switch(card){
    case 2,3,4,5,6:
      count++;
      break;
    case 7,8,9:
      count + 0;
      break;
    case 10,"J","Q","K","A":
      count--;
      break;
    }


    return console.log(count);




 // Cambia solo el código encima de esta línea
}

