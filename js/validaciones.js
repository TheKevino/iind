function validarSoloLetras(name) {
    var input = document.getElementById(name);
    var regex = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ-]+(\s+[a-zA-ZñÑáéíóúÁÉÍÓÚ-]+)*$/;

    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^a-zA-Z\sñÑáéíóúÁÉÍÓÚ-]/g, '');
    }
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