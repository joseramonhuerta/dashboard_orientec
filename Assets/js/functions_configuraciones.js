let divLoading = document.querySelector("#divLoading");
let rowTable = ""; 
let tableCarrucel;
let tableBanner;
getConfiguracion();

function getConfiguracion(){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Configuraciones/getConfiguracion';
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.success)
            {
                document.querySelector("#idConfiguracion").value = objData.data.id_configuracion;
                document.querySelector("#txtBeneficiario").value = objData.data.beneficiario;
                document.querySelector("#txtNumeroCuenta").value = objData.data.numero_cuenta;
                document.querySelector("#txtLeyendaPago").value = objData.data.leyenda_pago_oxxo;
                document.querySelector("#txtCodigoRegistro").value = objData.data.codigo_registro;              
                document.querySelector("#txtComision").value = objData.data.comision;              
                
            }
        }
    
        $('#modalFormDeposito').modal('show');
    }
}

document.addEventListener('DOMContentLoaded', function(){
    if(document.querySelector("#formConfiguracion")){
        let formConfiguracion = document.querySelector("#formConfiguracion");
        formConfiguracion.onsubmit = function(e){
            e.preventDefault();

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Configuraciones/setConfiguracion';
            let formData = new FormData(formConfiguracion);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);            
                    if(objData.success){
                      swal("Configuraciones", objData.msg,"success");     
                    }else{
                       swal("Error",objData.msg,"error");     
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
            
            
        }
    }

    tableCarrucel = $('#tableCarrucel').dataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Configuraciones/getImagenesCarrucel",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_carrucel"},
            {"data":"imagen"},    
            {"data":"imagen_carrucel"},           
            {"data":"status_imagen"},
            {"data":"options"}

            //id_carrucel, descripcion_carrucel, imagen_carrucel, url_carrucel, orden, status_imagen
        ],
        'dom': 'lBfrtip',
        'buttons': [
            
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]] 
    });

    tableBanner = $('#tableBanner').dataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Configuraciones/getImagenesBanner",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_banner"},
            {"data":"imagen"},    
            {"data":"imagen_banner"},           
            {"data":"status_imagen"},
            {"data":"options"}            
        ],
        'dom': 'lBfrtip',
        'buttons': [
            
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]] 
    });

    if(document.querySelector("#formImagenes")){
        let formImagenes = document.querySelector("#formImagenes");
        formImagenes.onsubmit = function(e) {
            e.preventDefault();

            let tipo_imagen = document.querySelector('#tipo_imagen').value;

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) { 
                if(elementsValid[i].classList.contains('is-invalid')) { 
                    swal("Atención", "Por favor verifique los campos en rojo." , "error");
                    return false;
                } 
            } 
            divLoading.style.display = "flex";

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Configuraciones/setImagen'; 
            let formData = new FormData(formImagenes);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    
                    if(objData.success)
                    {                      
                        if(tipo_imagen == 1)
                            tableCarrucel.api().ajax.reload();
                        else
                            tableBanner.api().ajax.reload();
                        $('#modalFormImagenes').modal("hide");  
                        formImagenes.reset();
                        swal("Configuraciones", objData.msg ,"success");
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);

function openModalImagenes(tipo_imagen){
    document.querySelector("#tipo_imagen").value = tipo_imagen;
    $('#modalFormImagenes').modal('show');
}

function fntDelImagenCarrucel(idcarrucel){
    swal({
        title: "Desactivar imagen",
        text: "¿Realmente quiere desactivar la imagen?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, desactivar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Configuraciones/delImagenCarrucel';
            let strData = "idCarrucel="+idcarrucel;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);                    
                    let objData = JSON.parse(request.responseText);
                    if(objData.success)
                    {
                        swal("Desactivar!", objData.msg , "success");
                        tableCarrucel.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function fntDelImagenBanner(idbanner){
    swal({
        title: "Desactivar imagen",
        text: "¿Realmente quiere desactivar la imagen?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, desactivar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Configuraciones/delImagenBanner';
            let strData = "idBanner="+idbanner;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);                    
                    let objData = JSON.parse(request.responseText);
                    if(objData.success)
                    {
                        swal("Desactivar!", objData.msg , "success");
                        tableBanner.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}


