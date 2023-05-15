function validarSoloLetrasID(name) {
    var input = document.getElementById(name);
    var regex = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ-]+(\s+[a-zA-ZñÑáéíóúÁÉÍÓÚ-]+)*$/;

    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^a-zA-Z\sñÑáéíóúÁÉÍÓÚ-]/g, '');
    }
}

function validarSoloLetras(name) {
    var regex = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ-]+(\s+[a-zA-ZñÑáéíóúÁÉÍÓÚ-]+)*$/;

    if (!regex.test(name)) {
        //input.value = input.value.replace(/[^a-zA-Z\sñÑáéíóúÁÉÍÓÚ-]/g, '');
        return false
    }
    return true
}

function validarNumerosYGuiones(id) {
    const input = document.getElementById(id);
    const valorInput = input.value;
    const patron = /^[\d-]+$/;
    const esValido = patron.test(valorInput);
    if (!esValido) {
        input.value = valorInput.replace(/[^\d-]/g, '');
    }
}

function claveMateria(id) {
    const input = document.getElementById(id);
    const valorInput = input.value;
    const patron = /^[a-zA-Z]{3}-\d{4}$/;
    const esValido = patron.test(valorInput);
    if (!esValido) {
        input.value = '';
    }
}