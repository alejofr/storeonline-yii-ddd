const urlApi = 'http://localhost:8080';

const validateRequired = (value = "") => value !== "" && value !== null;
const validEmail = (value = "") => {
    const reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

    return reg.test(value);
}

const  validateNum = (value = "", isEntero = true) => {
    const valid = value % 1 == 0;

    if( valid && isEntero ){
        return true;
    }

    if( !valid && !isEntero ){
        return true;
    }

    return false;
};

const alertMessage = (type = 'error', message = '', title = 'Oops...', parameter = {}) => {
    Swal.fire({
        icon: type,
        title: title,
        text: message,
        ...parameter
    });
}

function isObject(obj){
    return obj === Object(obj);
}

const errorResponse = (error) => {
    let msg = error;
    if( isObject(error) ){
        for (const key in error) {
            msg = error[key][0];
            break;
        }
    }

    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: msg,
    });
}

const resetForm = (inputs = []) => {
    inputs.forEach(element => {
        element.value = '';
        element.setAttribute('value', '');
    });
}

const redirect = (url) => {
    window.location.replace(url);
}
