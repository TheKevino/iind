let btnGuardar = document.getElementById('btnGuardar');
let btnCalcular = document.getElementById('btnCalcular');


btnCalcular.addEventListener('click', () => {
    let totalEstudiantes = document.getElementById('totalEstudiantes');
    let primeraOp = document.getElementById('primeraOp');
    let segundaOp = document.getElementById('segundaOp');
    let totalAcreditados = document.getElementById('totalAcreditados');
    let porcentajeAcreditados = document.getElementById('porcentajeAcreditados');
    let numNoAcreditados = document.getElementById('numNoAcreditados');
    let porcentajeNoAcreditados = document.getElementById('porcentajeNoAcreditados');
    let numDesertores = document.getElementById('numDesertores');
    let porcentajeDesertores = document.getElementById('porcentajeDesertores');

    if (totalEstudiantes.value.length < 1 || primeraOp.value.length < 1 || segundaOp.value.length < 1 || numDesertores.value.length < 1) {
        alert("Favor de llenar los campos obligatorios.");
    } else if (totalEstudiantes.value < 0 || primeraOp.value < 0 || segundaOp.value < 0 || numDesertores.value < 0) {
        alert("No se permiten valores negativos");
    } else {
        totalAcreditados.value = Math.round(primeraOp.value) + Math.round(segundaOp.value);
        porcentajeAcreditados.value = ((totalAcreditados.value * 100) / totalEstudiantes.value).toFixed(2);
        numNoAcreditados.value = Math.round(totalEstudiantes.value) - totalAcreditados.value;
        porcentajeNoAcreditados.value = ((numNoAcreditados.value * 100) / totalEstudiantes.value).toFixed(2);
        porcentajeDesertores.value = ((Math.round(numDesertores.value) * 100) / totalEstudiantes.value).toFixed(2);
    }
});