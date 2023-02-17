let btnGuardar = document.getElementById('btnGuardar');

btnGuardar.addEventListener('click', (e)=>{
    let departamento = document.getElementById('departamento').value;
    let inicioSemestre = document.getElementById('inicioSemestre').value;
    let finSemestre = document.getElementById('finSemestre').value;
    let gruposAtendidos = document.getElementById('gruposAtendidos').value;
    let asignaturasDiferentes = document.getElementById('asignaturasDiferentes').value;

    if(departamento.length < 1 || gruposAtendidos.length < 1 || asignaturasDiferentes.length < 1){
        alert("Faltan campos por llenar");
        e.preventDefault();
    } else if(inicioSemestre >= finSemestre){
        alert("Fechas invalidas");
        e.preventDefault();
    } else if(gruposAtendidos <= 0){
        alert("Numero invalido de grupos atendidos");
        e.preventDefault();
    } else if(asignaturasDiferentes <= 0){
        alert("Numero invalido de asignaturas diferentes");
        e.preventDefault();
    }

});