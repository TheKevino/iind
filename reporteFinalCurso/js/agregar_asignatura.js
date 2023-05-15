let btnGuardar = document.getElementById('btnGuardar');
let btnCalcular = document.getElementById('btnCalcular');

document.getElementById("totalEstudiantes").addEventListener("input", Calcular)
document.getElementById("primeraOp").addEventListener("input", Calcular)
document.getElementById("segundaOp").addEventListener("input", Calcular)
document.getElementById("numDesertores").addEventListener("input", Calcular)

function Calcular(){
    let totalEstudiantes = document.getElementById('totalEstudiantes');
    let primeraOp = document.getElementById('primeraOp');
    let segundaOp = document.getElementById('segundaOp');
    let totalAcreditados = document.getElementById('totalAcreditados');
    let porcentajeAcreditados = document.getElementById('porcentajeAcreditados');
    let numNoAcreditados = document.getElementById('numNoAcreditados');
    let porcentajeNoAcreditados = document.getElementById('porcentajeNoAcreditados');
    let numDesertores = document.getElementById('numDesertores');
    let porcentajeDesertores = document.getElementById('porcentajeDesertores');

    if ( ( totalEstudiantes.value.length > 0 || primeraOp.value.length > 0 || segundaOp.value.length > 0 || numDesertores.value.length > 0 )
        && ( parseInt(numDesertores.value) <= (parseInt(primeraOp.value) + parseInt(segundaOp.value)) && (parseInt(primeraOp.value) + parseInt(segundaOp.value) <= parseInt(totalEstudiantes.value)) )
        && parseInt(numDesertores.value) >= 0 ) {

        totalAcreditados.value = Math.round(primeraOp.value) + Math.round(segundaOp.value);
        porcentajeAcreditados.value = ((totalAcreditados.value * 100) / totalEstudiantes.value).toFixed(2);
        numNoAcreditados.value = Math.round(totalEstudiantes.value) - totalAcreditados.value;
        porcentajeNoAcreditados.value = ((numNoAcreditados.value * 100) / totalEstudiantes.value).toFixed(2);
        porcentajeDesertores.value = ((Math.round(numDesertores.value) * 100) / totalEstudiantes.value).toFixed(2);

    } else {
        totalAcreditados.value = "";
        porcentajeAcreditados.value = "";
        numNoAcreditados.value = "";
        porcentajeNoAcreditados.value = "";
        porcentajeDesertores.value = "";
        return false;
    }
    return true;
}