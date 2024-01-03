<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario</title>
        <link rel="stylesheet" href="../css/formulario.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
    <script>
        function validarFormulario() {
            var expresiones = {
                boleta: /^(PE|PP|\d{2})\d{8}$/,
                nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
                apellido_pat: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
                apellido_mat: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
                correo_electronico: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
                telefono: /^\d{10}$/,
                curp: /^[A-Z]{4}\d{6}[A-Z]{6}[A-Z0-9]\d{1}$/,
                direccion: /^[a-zA-ZÀ-ÿ.\s0-9#]{1,100}$/,
                colonia: /^[a-zA-ZÀ-ÿ.\s0-9#]{1,100}$/,
                cp: /^\d{5}$/
            };

            var boletaInput = document.getElementById('No.Boleta');
            var nombreInput = document.getElementById('NombreEstudiante');
            var apellidoPatInput = document.getElementById('ApellidoPaterno');
            var apellidoMatInput = document.getElementById('ApellidoMaterno');
            var correoInput = document.getElementsByName('correo_electronico')[0];
            var telefonoInput = document.getElementsByName('telefono')[0];
            var curpInput = document.getElementById('CURP');
            var direccionInput = document.getElementsByName('direccion')[0];
            var coloniaInput = document.getElementsByName('colonia')[0];
            var cpInput = document.getElementsByName('codigo_postal')[0];

            if(validarCampo(expresiones.boleta, boletaInput) &&
            validarCampo(expresiones.nombre, nombreInput) &&
            validarCampo(expresiones.apellido_pat, apellidoPatInput) &&
            validarCampo(expresiones.apellido_mat, apellidoMatInput) &&
            validarCampo(expresiones.correo_electronico, correoInput) &&
            validarCampo(expresiones.telefono, telefonoInput) &&
            validarCampo(expresiones.curp, curpInput) &&
            validarCampo(expresiones.direccion, direccionInput) &&
            validarCampo(expresiones.colonia, coloniaInput) &&
            validarCampo(expresiones.cp, cpInput)){
                return true;
            }

            return false;
        }

        function validarCampo(expresion, input) {
            var valor = input.value.trim();

            if (expresion.test(valor)) {
                input.nextElementSibling.classList.remove('fa-times-circle');
                console.log("Si ",valor);
                return true;
            } else {
                input.nextElementSibling.classList.add('fa-times-circle');
                console.log("No ",valor);
                return false;
            }
        }
    </script>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand">Ingresa los datos del justificante médico</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a href="index.php" class="nav-link">Inicio</a>
                        <a class="nav-link"><?= $_SESSION['usuario'] ?></a>
                        <a href="Cerrar_sesion.php" class="nav-link">Cerrar sesion</a>
                        <!--<a class="nav-link" href="php/Inicio_de_sesion.php">Iniciar sesion</a>
                        <a class="nav-link" href="php/Registro_de_usuario.php">Registrarme</a>-->
                    </div>
                </div>
            </div>
        </nav>
        <main>    
            <h1>Registro para justificante médico</h1>
            <h3>Ingresa los datos correctamente</h3>
            <br>
            <form action="Genera_justificante.php" method="POST" class="formulario" id="formulario" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                <!--Seccion Usuario-->
                <fieldset>
                    <legend>Identidad</legend>
                    <!--Boleta-->
                    <div class="formulario_grupo" id="grupo_boleta">
                        <label for="No.Boleta" class="formulario_label">No. de Boleta: </label>
                        <div class="formulario_grupo-input">
                            <input type="text" class="formulario_input" name="boleta" id="No.Boleta" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">La boleta debe contener 10 digitos iniciando por PE- o PP-.</p>
                        <br></br>
                    </div>
                    
                    <!--Nombre-->
                    <div class="formulario_grupo" id="grupo_nombre">
                        <label for="NombreEstudiante" class="formulario_label">Nombre: </label>
                        <div class="formulario_grupo-input">
                            <input type="text" class="formulario_input" name="nombre" id="NombreEstudiante" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">El nombre debe contener unicamente letras.</p>
                        <br></br>
                    </div>
                    
                    <!--Apellido Paterno-->
                    <div class="formulario_grupo" id="grupo_apePate">
                        <label for="ApellidoPaterno" class="formulario_label">Apellido Paterno: </label>
                        <div class="formulario_grupo-input">
                            <input type="text" class="formulario_input" name="apellido_pat" id="ApellidoPaterno" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">El apellido paterno debe contener unicamente letras.</p>
                        <br></br>
                    </div>
                        
                    <!--Apellido Materno-->
                    <div class="formulario_grupo" id="grupo_apeMate">
                        <label for="ApellidoMaterno" class="formulario_label">Apellido Materno: </label>
                        <div class="formulario_grupo-input">
                            <input type="text" class="formulario_input" name="apellido_mat" id="ApellidoMaterno" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">El apellido materno debe contener unicamente letras.</p>
                        <br></br>
                    </div>
                        
                    <!--Fecha de nacimiento-->

                    <div class="formulario_grupo" id="grupo_fechaNa">
                        <label for="FechaNacimiento" class="formulario_label">Fecha de Nacimiento: </label>
                        <div class="formulario_grupo-input">
                            <input type="date" class="formulario_input" name="fecha_nac" id="FechaNacimiento" required>
                        </div>
                        <br></br>
                    </div>

                    <!--Genero-->

                    <div class="formulario_grupo" id="grupo_genero" >
                        <label for="Genero" class="formulario_label">Género: </label>
                        <div class="formulario_grupo-input">
                            <select name="genero" required>
                                <option selected disabled="">Selecciona una opcion</option>    
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <p class="formulario_input_error">Selecciona tu genero</p>
                        <br></br>
                    </div>

                    <!--CURP-->
                    <div class="formulario_grupo" id="grupo_curp">
                        <label for="CURP" class="formulario_label" >CURP: </label>
                        <div class="formulario_grupo-input">
                            <input type="text" class="formulario_input" name="curp" id="CURP" maxlength="18" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">Ingresa correctamente el CURP.</p>
                        <br></br>
                    </div>
                </fieldset>
                <br><br>
                <!--Seccion Contacto-->
                <fieldset>
                    <legend>Contacto</legend>
                    <!--Direccion-->
                    <div class="formulario_grupo" id="grupo_direccion">
                        <label for="Direccion" class="formulario_label">Direccion: </label>
                        <div class="formulario_grupo-input">
                            <input type="text" class="formulario_input" name="direccion" id="Direccion" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">La direccion debe contener unicamente letras.</p>
                        <br>
                    </div>
                                
                    <!--Colonia-->
                    <div class="formulario_grupo" id="grupo_colonia">
                        <label for="Colonia" class="formulario_label">Colonia: </label>
                        <div class="formulario_grupo-input">
                            <input type="text" class="formulario_input" name="colonia" id="Colonia" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">Colonia debe contener unicamente letras.</p>
                        <br>
                    </div>
                                
                    <!--Estado de procedencia-->
                    <div class="formulario_grupo" id="grupo_estado">
                        <label for="EstadoProcedenencia" class="formulario_label">Estado de procedencia: </label>
                        <div class="formulario_grupo-input">
                            <select name="estado_proce" required>
                                <option value="none" selected disabled>Elija una opción</option>
                                <option value="Aguascalientes">Aguascalientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California Sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Ciudad de Mexico">Ciudad de México</option>
                                <option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
                                <option value="Colima">Colima</option>
                                <option value="Durango">Durango</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Guerrero">Guerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="Estado de Mexico">Estado de México</option>
                                <option value="Michoacán de Ocampo">Michoacán de Ocampo</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo León">Nuevo León</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Querétaro">Querétaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosí">San Luis Potosí</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz de Ignacio de la Llave">Veracruz de Ignacio de la Llave</option>
                                <option value="Yucatán">Yucatán</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        <p class="formulario_input_error">Ingresa el estado de procedencia.</p>
                        <br>
                    </div>
                                
                    <!--Codigo postal-->
                    <div class="formulario_grupo" id="grupo_codigoPostal">
                        <label for="Codigo_Postal" class="formulario_label">Codigo Postal :</label>
                        <div class="formulario_grupo-input">
                            <input type="number" class="formulario_input" name="codigo_postal" id="Codigo_Postal" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">El codigo postal unicamente debe contener numeros.</p>
                        <br>
                    </div>

                    <!--Telefono o celular-->
                    <div class="formulario_grupo" id="grupo_telefono">                            
                        <label for="Numero_Telefonico" class="formulario_label">Tel&eacute;fono o celular :</label>
                        <div class="formulario_grupo-input">
                            <input type="tel" class="formulario_input" name="telefono" id="Numero_Telefonico" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">El numero telefonico debe contener unicamente numeros con un maxico de 10 digitos.</p>
                        <br>
                    </div>

                    <!--Correo Electronico-->
                    <div class="formulario_grupo" id="grupo_correoElectronico">
                    <label for="Correo" class="formulario_label">Correo Electr&oacute;nico :</label>
                        <div class="formulario_grupo-input">
                            <input type="email" class="formulario_input" name="correo_electronico" required>
                            <i class="formulacion_validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario_input_error">Ingresa correctamente el correo electronico.</p>
                        <br>
                    </div>           
                </fieldset>
                <br><br>
                <!--Seccion Procedencia-->
                <fieldset>
                    <legend>Procedencia</legend>
                    <!--Escuela de procedencia-->
                    <div class="formulario_grupo" id="grupo_Escuela">
                        <label for="LblProcedencia" class="formulario_label">Escuela de procedencia: </label>
                        <div class="formulario_grupo-input">
                            <select name="escuela_proce" id="grupo_escuela" required>
                                <option value="none" selected disabled>Elija una opción</option>
                                <option value="CECyT 1 “Gonzalo Vázquez Vela”">CECyT 1 “Gonzalo Vázquez Vela”</option>
                                <option value="CECyT 2 “Miguel Bernard Perales”">CECyT 2 “Miguel Bernard Perales”</option>
                                <option value="CECyT 3 “Estanislao Ramírez Ruiz”">CECyT 3 “Estanislao Ramírez Ruiz”</option>
                                <option value="CECyT 4 “Lázaro Cárdenas del Río”">CECyT 4 “Lázaro Cárdenas del Río”</option>
                                <option value="CECyT 5 “Benito Juárez”">CECyT 5 “Benito Juárez”</option>
                                <option value="CECyT 6 “Miguel Othon de Mendizábal”">CECyT 6 “Miguel Othon de Mendizábal”</option>
                                <option value="CECyT 7 “Cuauhtémoc”">CECyT 7 “Cuauhtémoc”</option>
                                <option value="CECyT 8 “Narciso Bassols”">CECyT 8 “Narciso Bassols”</option>
                                <option value="CECyT 9 “Juan de Dios Bátiz Paredes”">CECyT 9 “Juan de Dios Bátiz Paredes”</option>
                                <option value="CECyT 10 “Carlos Vallejo Márquez”">CECyT 10 "Carlos Vallejo Márquez"</option>
                                <option value="CECyT 11 “Wilfrido Massieu”">CECyT 11 "Wilfrido Massieu"</option>
                                <option value="CECyT 12 “José María Morelos”">CECyT 12 "José María Morelos"</option>
                                <option value="CECyT 13 “Ricardo Flores Magón”">CECyT 13 "Ricardo Flores Magón"</option>
                                <option value="CECyT 14 “Luis Enrique Erro Soler”">CECyT 14 "Luis Enrique Erro Soler"</option>
                                <option value="CECyT 15 “Diódoro Antúnez Echegaray”">CECyT 15 "Diódoro Antúnez Echegaray"</option>
                                <option value="CECyT 16 “Hidalgo” ">CECyT 16 "Hidalgo"</option>
                                <option value="CECyT 17 “León - Guanajuato”">CECyT 17 "León Guanajuato"</option>
                                <option value="CECyT 18 “Zacatecas”">CECyT 18 "Zacatecas"</option>
                                <option value="CECyT 19 “Leona Vicario”">CECyT 19 "Leona Vicario"</option>
                                <option value="CET 1 “Walter Cross Buchanan”">CET 1 "Walter Cross Buchanan"</option>
                                <option value="CICS Unidad Santo Tomás">CICS Unidad Santo Tomás</option>
                                <option value="CICS Unidad Milpa Alta">CICS Unidad Milpa Alta</option>
                                <option value="ENBA">ENBA</option>
                                <option value="ENCB">ENCB</option>
                                <option value="ENMyH">ENMyH</option>
                                <option value="ESCA Unidad Santo Tomás">ESCA Unidad Santo Tomás</option>
                                <option value="ESCA Unidad Tepepan">ESCA Unidad Tepepan</option>
                                <option value="ESCOM">ESCOM</option>
                                <option value="ESE">ESE</option>
                                <option value="ESEO">ESEO</option>
                                <option value="ESFM">ESFM</option>
                                <option value="ESIME Unidad Zacatenco">ESIME Unidad Zacatenco</option>
                                <option value="ESIME Unidad Azcapotzalco">ESIME Unidad Azcapotzalco</option>
                                <option value="ESIME Unidad Culhuacán">ESIME Unidad Culhuacán</option>
                                <option value="ESIME Unidad Ticomán">ESIME Unidad Ticomán</option>
                                <option value="ESIQIE">ESIQIE</option>
                                <option value="ESIT">ESIT</option>
                                <option value="ESIA Unidad Tecamachalco">ESIA Unidad Tecamachalco</option>
                                <option value="ESIA Unidad Ticomán">ESIA Unidad Ticomán</option>
                                <option value="ESIA Unidad Zacatenco">ESIA Unidad Zacatenco</option>
                                <option value="ESM">ESM</option>
                                <option value="EST">EST</option>
                                <option value="UPIIC Campus Coahuila">UPIIC Campus Coahuila</option>
                                <option value="UPIBI">UPIBI</option>
                                <option value="UPIIG Campus Guanajuato">UPIIG Campus Guanajuato</option>
                                <option value="UPIIZ Campus Zacatecas">UPIIZ Campus Zacatecas</option>
                                <option value="UPIIH Campus Hidalgo">UPIIH Campus Hidalgo</option>
                                <option value="UPIIP Campus Palenque">UPIIP Campus Palenque</option>
                                <option value="UPIIT Campus Tlaxcala">UPIIT Campus Tlaxcala</option>
                                <option value="UPIICSA">UPIICSA</option>
                                <option value="UPIITA">UPIITA</option>
                                <option value="UPIEM">UPIEM</option>
                                <option value="Otra">Otro...</option>
                            </select>
                        </div>
                        <p class="formulario_input_error">Ingresa la escuela de procedencia.</p>
                        <br>
                    </div>
                </fieldset>
                <br><br>
                <div class="formulario_mensaje" id="formulario_mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i> <b>Error: </b>Por favor completa el formulario correctamente.</p>
                </div>
                <br><br>
                <!--Seccion Motivos-->
                <fieldset>
                    <legend>Motivos</legend>
                    <!--Fecha Inicio-->
                    <div class="formulario_grupo" id="fecha_ini">
                        <label for="FechaIni" class="formulario_label">Fecha o periodo de inicio a justificar: </label>
                        <div class="formulario_grupo-input">
                            <input type="date" class="formulario_input" name="fecha_ini" id="FechaIni" required>
                        </div>
                        <br></br>
                    </div>
                    <!--Fecha Fin-->
                    <div class="formulario_grupo" id="fecha_fin">
                        <label for="FechaFin" class="formulario_label">Fecha o periodo de término a justificar: </label>
                        <div class="formulario_grupo-input">
                            <input type="date" class="formulario_input" name="fecha_fin" id="FechaFin" required>
                        </div>
                        <br></br>
                    </div>
                    <!--Razón Ausencia-->
                    <div class="formulario_grupo" id="razon_aus">
                        <label for="RazonAus" class="formulario_label">Razón de la ausencia: </label>
                        <div class="formulario_grupo-input">
                            <!--<input type="text" class="formulario_input" name="razonaus" id="RazonAus">-->
                            <textarea class="formulario_input" name="razon_ausen" id="RazonAus"></textarea required>
                        </div>
                        <br></br>
                    </div>
                    <!--Comprobante médico-->
                    <div class="formulario_grupo" id="com_med">
                        <label for="ComMed" class="formulario_label">Archivo del comprobante médico: </label>
                        <div class="formulario_grupo-input">
                            <input type="file" name="archivo_com_med" id="ComMed" accept=".pdf" required>
                        </div>
                        <br></br>
                    </div>
                </fieldset>
                <br><br>
                <!--Botones-->
                    <div class="formulario_grupo formulario_grupo_boton_enviar">
                        <input type="submit" class="formulario_boton" value="Enviar" id="Senviar">
                        <br>
                    </div>
                    <br>
            </form>
        </main>
        <!--<script src="../js/formulario.js"></script>
        <script src="https://kit.fontawesome.com/245ba30982.js" crossorigin="anonymous"></script>
        <script src="../js/lista.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>-->
    </body>
</html>

