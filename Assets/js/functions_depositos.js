let tableDepositos;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
    tableDepositos = $('#tableDepositos').dataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Depositos/getUsuariosDepositos",
            "dataSrc":""
        },
        "columns":[
            
            {"data":"nombre_usuario"},
            {"data":"saldo"},
            {"data":"options"}
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
        "iDisplayLength": 10,
        "order":[[0,"desc"]] 
    });


    if(document.querySelector("#formDeposito")){
        let formDeposito = document.querySelector("#formDeposito");
        formDeposito.onsubmit = function(e){
            e.preventDefault();

            let importe = parseFloat(document.querySelector("#txtImporte").value);
            let saldo = parseFloat(document.querySelector("#txtSaldo").value);

            if(importe == '' || importe == 0){
                swal("Atención", "Introduzca el importe", "error");
                return false;

            }

            if(importe > saldo){
                swal("Atención", "El importe no puede ser mayor al saldo actual.", "error");
                return false;     
            }
            
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Depositos/setDeposito';
            let formData = new FormData(formDeposito);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);            
                    if(objData.success){
                       tableDepositos.api().ajax.reload();
                       $('#modalFormDeposito').modal("hide");
                       formDeposito.reset();
                       swal("Depositos", objData.msg,"success");     
                    }else{
                       swal("Error",objData.msg,"error");     
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);



function fntDepositar(idusuario){
    //document.querySelector('#titleModal').innerHTML ="Actualizar Usuario";
    //document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    //document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    //document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Depositos/getUsuarioDeposito/'+idusuario;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.success)
            {
                document.querySelector("#idUsuario").value = objData.data.id_usuario;
                document.querySelector("#txtNombreUsuario").value = objData.data.nombre_usuario;
                document.querySelector("#txtSaldo").value = objData.data.saldo;
                document.querySelector("#txtImporte").value = '0.00';
                document.querySelector("#txtNuevoSaldo").value = objData.data.saldo;              
                
            }
        }
    
        $('#modalFormDeposito').modal('show');
    }
}

$('#txtImporte').change(function(){
    fntActualizarSaldo();
});

function fntActualizarSaldo(){
    let importe = document.querySelector('#txtImporte').value;
    let saldo = document.querySelector('#txtSaldo').value;

    var nuevoSaldo = saldo - importe;

    if(nuevoSaldo > 0){
       $('#txtNuevoSaldo').val(nuevoSaldo);
    }else{
        $('#txtNuevoSaldo').val(0.00);
    }

}

