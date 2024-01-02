    var select = document.getElementById("grupo_escuela");
    var field = document.getElementById("grupo_nombreEscuela");
    var esc = document.getElementById("NombreE");
    
    console.log('Valor de la input: '+ esc.value);
    select.addEventListener("change", function() {
        var selectedValue = select.value;
        console.log('Valor de la lista: '+ selectedValue);

        if (selectedValue === "Otra") {
            field.style.display = "block";
        } 
        else {
            field.style.display = "none";
            esc.value = select.value;
        }
        console.log('Valor de la input: '+ esc.value);

    });