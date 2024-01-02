const formulario=document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    boleta: /^(PE|PP|\d{2})\d{8}$/,
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    apellidoP: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    apellidoM: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{10}$/,
    curp: /^[A-Z]{4}\d{6}[A-Z]{6}[A-Z0-9]\d{1}$/,
    prom: /^[0-9]+(.[0-9]{2})?$/,
    direccion: /^[a-zA-ZÀ-ÿ.\s]{1,40}$/,
    colonia: /^[a-zA-ZÀ-ÿ.\s]{1,40}$/,
    cp: /^\d{5}$/,
    escuela: /^[a-zA-ZÀ-ÿ(1-9)\s]{1,40}$/
}

const campos = {
	boleta: false,
    nombre: false,
    apePate: false,
    apeMate: false,
    correoElectronico: false,
    telefono: false,
    curp: false,
    promedio: false,
    direccion: false,
    colonia: false,
    codigoPostal: false,
    nombreEscuela: false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "boleta":
            validarCampo(expresiones.boleta, e.target,'boleta');
        break;
        case "nombre":
            validarCampo(expresiones.nombre, e.target,'nombre');
        break;
        case "apellidopa":
            validarCampo(expresiones.apellidoP, e.target,'apePate');
        break;
        case "apellidoma":
            validarCampo(expresiones.apellidoM, e.target,'apeMate');

        break;
        case "Correo":
            validarCampo(expresiones.correo, e.target,'correoElectronico');
        break;
        case "Numero":
            validarCampo(expresiones.telefono, e.target,'telefono');
        break;
        case "CURP":
            validarCampo(expresiones.curp, e.target,'curp');
        break;
        case "Promedio":
            validarCampo(expresiones.prom,e.target,'promedio');
        break;
        case "Direccion":
            validarCampo(expresiones.direccion, e.target,'direccion');

        break;
        case "Colonia":
            validarCampo(expresiones.colonia, e.target,'colonia');

        break;
        case "Postal":
            validarCampo(expresiones.cp, e.target,'codigoPostal');

        break;
    }
}

const validarCampo = (expresion, input, campo) => {
    if(expresion.test(input.value)){
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-correcto');
		document.querySelector(`#grupo_${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo_${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo_${campo} .formulario_input_error`).classList.remove('formulario_input_error-activo');
        campos[campo] = true;
    } else{
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-correcto');
		document.querySelector(`#grupo_${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo_${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo_${campo} .formulario_input_error`).classList.add('formulario_input_error-activo');
        campos[campo] = false;
    }
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});


formulario.addEventListener('submit', (e) => {
	if(campos.boleta && campos.nombre && campos.apePate && campos.apeMate && campos.correoElectronico && campos.telefono && campos.curp && campos.promedio && campos.direccion && campos.colonia && campos.codigoPostal){
		document.getElementById('formulario_mensaje-exito').classList.add('formulario_mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario_mensaje-exito').classList.remove('formulario_mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario_grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario_grupo-correcto');
		});
	console.log("Llenado");

	}else{
        e.preventDefault();
		document.getElementById('formulario_mensaje').classList.add('formulario_mensaje-activo');
		console.log("llena campos");

	}
});
