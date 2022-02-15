
<form action="index.php" id="formulario" method="POST" class="">
    <div class="row">
        <div class="col">
            <label class="label" for="firstname">
                Nombre<span class="form-required">*</span>
            </label>
            <input
                id="firstname"
                class="hs-input"
                type="text"
                name="firstname"
                required=""
                value=""
                placeholder="Nombre*"
            />
        </div>
        <div class="col">
            <label class="label" for="lastname">
                    Apellido <span class="form-required">*</span>
            </label>
            <input
                id="lastname"
                class="hs-input"
                type="text"
                name="lastname"
                required=""
                value=""
                placeholder="Apellido*"
                inputmode="text"
            />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label class="label" for="email">
                Email <span class="form-required">*</span>
            </label>
            <input
                id="email"
                class="hs-input"
                type="email"
                name="email"
                required=""
                placeholder="Email*"
                value=""
                autocomplete="email"
                inputmode="email"
            />
        </div>
        <div class="col">
            <label class="label" for="mobilephone">
                Número de teléfono celular <span class="hs-form-required">*</span>
            </label>
            <input
                id="mobilephone"
                class="hs-input"
                type="tel"
                name="mobilephone"
                required=""
                value=""
                placeholder="Número de teléfono celular*"
                inputmode="tel"/>
        </div>
    </div>
    <div class="row">
        <label class="label" for="empresa">
            Empresa de procedencia 
        </label>
        <input
            id="empresa"
            class="hs-input"
            type="text"
            name="empresa"
            required=""
            value=""
            placeholder="Empresa de procedencia*"
            inputmode="text"/>    
    </div>
    <div class="row">
        <label class="label" for="posgrado">
            Posgrado de interés 
        </label>
        <select 
            id="posgrado" 
            class="hs-input" 
            name="posgrado"
            required="">
            <option disabled selected value="">Posgrado de interés*</option>
            <option value="Maestría en Ingeniería">Maestría en Ingeniería</option>
            <option value="Maestría en Negocios de Innovación Tecnológica">Maestría en Negocios de Innovación Tecnológica</option>
            <option value="Maestría en Estructuras">Maestría en Estructuras</option>
            <option value="Maestría en Administración de la Construcción">Maestría en Administración de la Construcción</option>
            <option value="Especialidad en Dirección de Operaciones">Especialidad en Dirección de Operaciones</option>
            <option value="Especialidad en Ingeniería y Gestión de Proyectos">Especialidad en Ingeniería y Gestión de Proyectos</option>
        </select>
    </div>
    
    <div class="row">
        <label class="label" for="experiencia">
            Experiencia laboral
        </label>
        <select 
            id="experiencia" 
            class="hs-input" 
            name="experiencia"
            required="">
            <option disabled selected value="">Experiencia laboral*</option>
            <option value="No tengo experiencia">No tengo experiencia</option>
            <option value="2 a 5 años">2 a 5 años</option>
            <option value="mas de 5 años">Más de 5 años</option>
        </select>
    </div>
    <!--div class="row">
        <label class="label" for="escolaridad">
            Nivel de escolaridad
        </label>
        <input type="text" id="escolaridad" class="hs-input" name="escolaridad" placeholder="Nivel de escolaridad">
    </div-->
    <div class="row">
        <a href="#" id="button-send" class="Nav__link boton go-to" value="" onclick="sendForm()">Registrarme</a>
    </div>  
</form>
