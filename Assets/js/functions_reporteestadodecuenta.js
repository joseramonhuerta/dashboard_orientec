let tableReporteEstadoDeCuenta;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

window.addEventListener('load', function(){
    fillUsuarios();
    $("#txtFechaInicio").datepicker({
        dateFormat: 'dd/mm/yy'
    });
    $('#txtFechaInicio').datepicker("setDate", new Date());

    $("#txtFechaFin").datepicker({
        dateFormat: 'dd/mm/yy'
    });
    $('#txtFechaFin').datepicker("setDate", new Date());

   

}, false);

document.addEventListener('DOMContentLoaded', function(){
    var divLoading = document.querySelector("#divLoading");
    if(document.querySelector("#formReporteEstadoDeCuenta")){
        let formReporteEstadoDeCuenta = document.querySelector("#formReporteEstadoDeCuenta");
        formReporteEstadoDeCuenta.onsubmit = function(e){
            e.preventDefault();


            let strUsuario = document.querySelector("#select_usuario").value;

            if(strUsuario == '' || strUsuario == 0)
            {
                swal("Atención", "Seleccione un usuario." , "error");
                return false;
            }
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let arrUsuarios = [];
            var ajaxUrl = base_url + '/Reporteestadodecuenta/getReporteEstadoDeCuenta';
            var formData = new FormData(formReporteEstadoDeCuenta);
            request.open("POST", ajaxUrl, true);  
            request.send(formData);
            
            request.onreadystatechange = function(){        
                if(request.readyState != 4) return;
                if(request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    let datos = objData.data;
                    
                    //swal("Atención", objData.msg, "error");
                    if(objData.success)
                    {
                        fillTableEstadoCuenta(datos);


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

    }
   

}, false);

function  fillUsuarios(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let arrUsuarios = [];
    var ajaxUrl = base_url + '/Reporteestadodecuenta/getUsuariosEstadoDeCuenta';
    var formData = new FormData(formReporteEstadoDeCuenta);

    request.open("POST", ajaxUrl, true);  
    request.send(formData);
      
    request.onreadystatechange = function(){        
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            let datos = objData.data;
            
            //swal("Atención", objData.msg, "error");
            if(objData.success)
            {
                //alert('success');
                var cadena = '<option value="0">Seleccione...</option>';

                for(var i = 0; i < datos.length; i++)
                {
                    cadena += "<option value=" + datos[i].id_usuario + ">" + datos[i].nombre_usuario + "</option>";
                }

                $("#select_usuario").html(cadena);


            }
        }
        return false;
    }
    
}

function fillTableEstadoCuenta(datos){
   

    
    tableReporteEstadoDeCuenta = $('#tableReporteEstadoDeCuenta').dataTable({
        
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "data": datos,
        "columns":[            
            {"data":"fecha"},
            {"data":"concepto"},
            {"data":"tipo"},
            {"data":"cargo"},
            {"data":"abono"},
            {"data":"saldo"}           
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10
    });
}