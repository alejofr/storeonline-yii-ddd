const token = localStorage.getItem("token");

if( token != null ){
    redirect("/dashboard")
}

const login = ( form, fields = [] ) => {
    const buttonForm = form.querySelector('button');
    const url = urlApi+'/users/login';

    buttonForm.addEventListener('click', (e) => {
        e.preventDefault();
        const inputs = form.querySelectorAll('input');
        let parameter = {};
        let isVerifyForm = true;

        inputs.forEach(element => {
            const name = element.name;
            const value = element.value;

            if( fields.includes(name) ){
                

                if( !validateRequired(value) ){
                    alertMessage('error', `${name} es requerido`);
                    isVerifyForm = false;
                    return;
                }

                if( name == 'email' && !validEmail(value)){
                    alertMessage('error', `${name} debe ser un email valido`);
                    isVerifyForm = false;
                    return;
                }

                parameter[name] = value;
            }
        });

        if( !isVerifyForm ){
            return;
        }

        fetch(url, {
            method: "POST",
            body: JSON.stringify(parameter),
            headers: {
                "Content-Type": "application/json",
            },
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(dataJson) {

            if( ({}).hasOwnProperty.call(dataJson, 'error') ){
                errorResponse(dataJson.error);
                return;
            }
           
            const token = dataJson.access_token;
            localStorage.setItem("token", token);
            window.location.replace("/dashboard");
        })
        .catch(function(err) {
            console.error(err);
            errorResponse(err.error);
            
            return undefined;
        });
    });
}

const register = ( form, fields = [] ) => {
    const buttonForm = form.querySelector('button');
    const url = urlApi+'/users';

    buttonForm.addEventListener('click', (e) => {
        e.preventDefault();
        const inputs = form.querySelectorAll('input');
        let parameter = {};
        let isVerifyForm = true;

        inputs.forEach(element => {
            const name = element.name;
            const value = element.value;

            if( fields.includes(name) ){
                

                if( !validateRequired(value) ){
                    alertMessage('error', `${name} es requerido`);
                    isVerifyForm = false;
                    return;
                }

                if( name == 'email' && !validEmail(value)){
                    alertMessage('error', `${name} debe ser un email valido`);
                    isVerifyForm = false;
                    return;
                }

                parameter[name] = value;
            }
        });

        if( !isVerifyForm ){
            return;
        }

        fetch(url, {
            method: "POST",
            body: JSON.stringify(parameter),
            headers: {
                "Content-Type": "application/json",
            },
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(dataJson) {

            if( ({}).hasOwnProperty.call(dataJson, 'error') ){
                errorResponse(dataJson.error);
                return;
            }
           
            alertMessage('success', `Usuario Creado`, 'Éxito', 
                { 
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500 
                }
            );

            resetForm(inputs);
        })
        .catch(function(err) {
            console.error(err);
            errorResponse(err.error);
            
            return undefined;
        });
    });
}

const formLogin = document.querySelector("#loginForm");
const formRegister = document.querySelector("#registerForm");

if( formLogin ){
    login(formLogin, ['email', 'password']);
}

if( formRegister ) {
    register(formRegister, ['name', 'email', 'password']);
}


