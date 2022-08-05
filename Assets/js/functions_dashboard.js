let myChart;
let myChartIngreso;

fillMeses();
fillYears();

var divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
    if(document.querySelector("#formReporteGraficas")){
        let formReporteGraficas = document.querySelector("#formReporteGraficas");
        formReporteGraficas.onsubmit = function(e){
            e.preventDefault();            
            obtenerGraficas();

        }
    }

    obtenerGraficas();
});

function obtenerGraficas(){
    divLoading.style.display = "flex";
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let titulo = [];
    let cantidad = [];
    let colores = [];
    let importes = [];
    
    var ajaxUrl = base_url+'/Cursos/getReporteCursosVendidos'; 
    var formData = new FormData(formReporteGraficas);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            let datos = objData.data;
            if(objData.success)
            {
                for(var i = 0; i < datos.length; i++){
                    titulo.push(datos[i].mes);
                    cantidad.push(datos[i].cantidad);
                    colores.push(colorRGB(datos[i].color-1));
                    importes.push(datos[i].importe);
                }
                
                crearGrafica(titulo, cantidad, colores, 'bar', 'Cursos vendidos','myChart');

                crearGraficaIngreso(titulo, importes, colores, 'pie', 'Ingresos','myChartIngreso');

                //window.location.reload(false);
            }else{
                swal("Atención", objData.msg, "error");							
            }
        }else{
            swal("Atención","Error en el proceso", "error");
        }
        divLoading.style.display = "none";
        return false;
    }
}

function crearGrafica(titulo, cantidad, colores,  tipo, encabezado, id){
    let ctx = document.getElementById(id);
    
    if (myChart) {
        myChart.destroy();
    }
    
    myChart = new Chart(ctx, {
        type: tipo,
        data: {
            labels: titulo,
            datasets: [{
                label: encabezado,
                data: cantidad,
                backgroundColor: colores,
                borderColor: colores,
                borderWidth: 1
                
                
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}

function crearGraficaIngreso(titulo, cantidad, colores,  tipo, encabezado, id){
    let ctx = document.getElementById(id);
    
    if (myChartIngreso) {
        myChartIngreso.destroy();
    }
    
    myChartIngreso = new Chart(ctx, {
        type: tipo,
        data: {
            labels: titulo,
            datasets: [{
                label: encabezado,
                data: cantidad,
                backgroundColor: colores,
                borderColor: colores,
                borderWidth: 1
                
                
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}

function generarNumero(numero){
    return (Math.random()*numero).toFixed(0);
}

function colorRGB(opcion){
    let color = [
        "0,255,255",
        "0,0,128",
        "255,255,0",
        "255,128,128",
        "153,204,0",
        "0,51,0",
        "255,0,0",
        "128,128,128",
        "51,102,255",
        "255,0,255",
        "255,153,0",
        "0,0,255"];
    
    return "rgb(" + color[opcion] + ")";
}

function fillYears()
{
    let fechaActual = new Date();
    let year = fechaActual.getFullYear();
    var cadena = "";

    for(var i = year - 10; i < year + 1; i++)
    {
        cadena += "<option value=" + i + ">" + i + "</option>";
    }

    $("#select_anio").html(cadena);
    $("#select_anio").val(year);
}

function fillMeses(){
    const meses = ['Todos','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    var cadena = "";

    for(var i = 0; i < meses.length; i++)
    {
        cadena += "<option value=" + i + ">" +  meses[i] + "</option>";
    }

    $("#select_mes").html(cadena);

}


