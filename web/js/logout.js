const btnLogout = document.querySelector("#btnLogout");

if( btnLogout ){
    btnLogout.addEventListener('click', e => {
        e.preventDefault();
        const url = urlApi+'/users/logout';

        fetch(url, {
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
            if( dataJson != null && ({}).hasOwnProperty.call(dataJson, 'error') ){
                errorResponse(dataJson.error);
                return;
            }
           
            alertMessage('success', `Cerraste session`, 'Éxito', 
                { 
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500 
                }
            );
            
            localStorage.removeItem("token");

            setTimeout(() => {
                redirect("/");
            }, 500);
        })
        .catch(function(err) {
            errorResponse(err.error);
            
            return undefined;
        });
    });
}