let inputUser = document.querySelector('.Usuario');
let inputPass = document.querySelector('.Password');


const ComienzaCon = () =>{
    let Perror= document.querySelector('#User .input-error');
    let primerValor=inputUser.value[0];
    if(primerValor!==undefined && primerValor.search(/[0-9]/) !== -1){
        inputUser.classList.add('User-incorrecto');
        Perror.innerHTML="El primer caracter del nombre debe ser una letra";
	 	Perror.classList.add('input-error-activo');
    }
    else{
        inputUser.classList.remove('User-incorrecto');
        Perror.innerHTML="";
        Perror.classList.remove('input-error-activo');
    }
	
}

const PasswCheck = () =>{
    let Perror = document.querySelector('#Pass .input-error');
	if(inputPass.value.length<6){
		inputPass.classList.add('Pass-incorrecto');
		Perror.innerHTML="La contraseña debe tener al menos 6 caracteres";
		Perror.classList.add('input-error-activo');
	}
	else if(inputPass.value.length>33){
		inputPass.classList.add('Pass-incorrecto');
		Perror.innerHTML="La contraseña no puede tener más de 33 caracteres";
		Perror.classList.add('input-error-activo');
	}
	else{
		inputPass.classList.remove('Pass-incorrecto');
        Perror.innerHTML="";
		Perror.classList.remove('input-error-activo');
	}
}

const checkFormUser = () => {
	if(document.getElementById('User').classList.contains('User-incorrecto')){
		return false;
	}
	else{
		return true;
	}
}

const checkFormPass = () =>{
	if(document.getElementById('Pass').classList.contains('Pass-incorrecto')){
		return false;
	}
	else{
		return true;
	}
}