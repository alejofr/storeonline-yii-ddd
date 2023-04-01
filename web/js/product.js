const token = localStorage.getItem("token");
const url = urlApi+'/products';
let typeForm = 'create'; // create  or update
const modal = document.querySelector('#exampleModal');
let idGet = null;
const formProduct = document.querySelector("#formProduct");
const btnSaveProduct = document.querySelector("#btnSaveProduct");

function showModal(){
    const btnPorduct = document.querySelector('#btnPorduct');
    btnPorduct.click();
}

function closeModal(){
    modal.classList.remove("show");
    modal.style.display = "none";
    document.querySelector('.modal-backdrop').classList.remove("show");
}

if( token == null ){
    redirect("/")
}



const getAll = () => {
    fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer "+token
        },
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(dataJson) {

        if( ({}).hasOwnProperty.call(dataJson, 'error') ){
            errorResponse(dataJson.error);
        }
        
        $('#example').dataTable({
            "language": {
                'processing': true,
                'serverSide': true,
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "columnDefs": [
                { "orderable": false, "targets": 0 },
                { "orderable": false, "targets": 1 },
                { "orderable": false, "targets": 2 },
                { "orderable": false, "targets": 3 },
                { "orderable": false, "targets": 4 },
            ],
            data : dataJson,
            columns: [
                {"data": "name"},
                {"data": "description"},
                {"data": "stock"},
                {"data": "price"},
                {
                    "data": null,
                    "bSortable": false,
                    "mRender": function(data, type, value) {
                        return '<div class="d-flex justify-content-end"><button type="button" onClick="editItemProduct('+value["id"]+')" value='+value["id"]+' id='+value["id"]+'>Edit</button><button class="ml-3" type="button" onClick="deleteItemProduct('+value["id"]+')" value='+value["id"]+' id='+value["id"]+'>Delete</button></div>';
                    } 
                },
            ],
        });
    })
    .catch(function(err) {
        errorResponse(err.error);
        
        return undefined;
    });
}

$(document).ready(function() {
    getAll();
} );

const validateFom = (fields = [], inputs = [], isRequired = true) => {
    let parameter = {};
    let bool = true;

    inputs.forEach(element => {
        const name = element.name;
        const value = element.value;

        if( fields.includes(name) ){
            

            if( isRequired && !validateRequired(value) ){
                alertMessage('error', `${name} es requerido`);
                bool = false;
                return null;
            }

            if( name == 'stock' && !validateNum(value)){
                alertMessage('error', `${name} debe ser un valor numerico entero`);
                bool = false;
                return null;
            }

            if( name == 'price' && !validateNum(value, false)){
                alertMessage('error', `${name} debe ser un valor numerico flotantes`);
                bool = false;
                return null; 
            }

            parameter[name] = value;
        }
    });

    return bool ? parameter : null;
}


const createProduct = ( form, fields = [] ) => {
    const inputs = form.querySelectorAll('input');
    const parameter = validateFom(fields, inputs, true);

    if( parameter == null ){
        return;
    }

    fetch(url, {
        method: "POST",
        body: JSON.stringify(parameter),
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer "+token
        },
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(dataJson) {
        console.log(dataJson);
        if( ({}).hasOwnProperty.call(dataJson, 'error') ){
            errorResponse(dataJson.error);
            return;
        }
       
        alertMessage('success', `Producto Creado`, 'Éxito', 
            { 
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500 
            }
        );
        
        resetForm(inputs);
        closeModal();
        redirect("/dashboard");
        
    })
    .catch(function(err) {
        console.error(err);
        errorResponse(err.error);
        
        return undefined;
    });

}

const updateProduct = (form, fields = []) => {
    const inputs = form.querySelectorAll('input');
    const parameter = validateFom(fields, inputs, false);

    if( parameter == null ){
        return;
    }

    let data = {};

    for (const key in parameter) {
        if ( parameter[key] !== '' ) {
           data[key] = parameter[key]; 
        }
    }

    const id = idGet;

    fetch(url+'/'+id, {
        method: "PUT",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer "+token
        },
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(dataJson) {
        console.log(dataJson);
        if( ({}).hasOwnProperty.call(dataJson, 'error') ){
            errorResponse(dataJson.error);
            return;
        }
       
        alertMessage('success', `Producto Actualizado`, 'Éxito', 
            { 
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500 
            }
        );
        
        resetForm(inputs);
        closeModal();
        redirect("/dashboard");
        
    })
    .catch(function(err) {
        console.error(err);
        errorResponse(err.error);
        
        return undefined;
    });

}

function editItemProduct(id) {
    fetch(url+'/'+id, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer "+token
        },
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(dataJson) {

        if( ({}).hasOwnProperty.call(dataJson, 'error') ){
            errorResponse(dataJson.error);
        }

        const { id, name, description, stock, price } = dataJson;

        idGet = id;
        const inputs = formProduct.querySelectorAll('input');

        inputs.forEach(element => {
            switch (element.name) {
                case 'name':
                    element.value = name;
                    element.setAttribute('value', name);
                    break;
                case 'description':
                    element.value = description;
                    element.setAttribute('value', description);
                    break;
                case 'stock':
                    element.value = stock;
                    element.setAttribute('value', stock);
                    break;
                case 'price':
                    element.value = price;
                    element.setAttribute('value', price);
                    break;
            
                default:
                    break;
            }
        });
        
        typeForm = 'update';
        showModal();

        return;
    })
    .catch(function(err) {
        errorResponse(err.error);
        
        return undefined;
    });
}

function deleteItemProduct(id){
    fetch(url+'/'+id, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer "+token
        },
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(dataJson) {

        console.log(dataJson);
        if( ({}).hasOwnProperty.call(dataJson, 'error') ){
            errorResponse(dataJson.error);
            return;
        }
       
        alertMessage('success', `Producto Eliminado`, 'Éxito', 
            { 
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500 
            }
        );
        
        redirect("/dashboard");
    })
    .catch(function(err) {
        errorResponse(err.error);
        
        return undefined;
    });
}



if( btnSaveProduct ){
    btnSaveProduct.addEventListener('click', e => {
        e.preventDefault();
        const fields = ['name', 'description', 'stock', 'price'];

        if( typeForm == 'create' ){
            createProduct(formProduct, fields);
        }else{
            updateProduct(formProduct, fields)
        }
    })
}