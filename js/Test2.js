let correctas = [1,2,3];

let opcion_elegida=[];

let cantidad_correctas=[];

function respuesta(num_pregunta,seleccionada){
    opcion_elegida[num_pregunta]=seleccionada.value;
    id="p"+ num_pregunta;
    labels=document.getElementById(id).childNodes;
    labels[3].style.backgroundColor="white";
    labels[5].style.backgroundColor="white";
    labels[7].style.backgroundColor="white";

    seleccionada.parentNode.style.backgroundColor = "#CEC0FC";

}

function corregir(){
    cantidad_correctas=0
    for(i=0;i<correctas.length;i++){
        if(correctas[i]==opcion_elegida[i]){
            cantidad_correctas++;
        }
    }
    document.getElementById("resultado").innerHTML = cantidad_correctas;
}