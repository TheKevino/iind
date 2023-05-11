let btnAgregarCarrera = document.getElementById('btnAgregarCarrera');

btnAgregarCarrera.addEventListener('click', (e) => {
    let nombreCarrera = document.getElementById('carrera').value;
    if (nombreCarrera.length < 1) {
        Swal.fire({
            title: 'Error!',
            text: 'Escribe el nombre de la carrera.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        e.preventDefault();
    }
});