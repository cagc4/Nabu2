/*
    Fecha creacion		= 28-02-2015
	Desarrollador		= CAGC  
	Fecha modificacion	= 11-03-2017
	Fecha modificacion	= 22-09-2017
	Usuario Modifico	= CAGC
*/


function ChangeUrl(title, url) {
    if (typeof (history.pushState) != "undefined") {
        var obj = { Title: title, Url: url };
        history.pushState(obj, obj.Title, obj.Url);
    } 
}

var sendAjaxRequest = function (codva,vali,empresa,messa,parametros,sucFun){
    $.ajax({
        url: '../Events/webservice.php',
		data: {	'token': 'e53db2b5b93254fddb55de43a3323970',
				'codigovalidacion': codva,
                'validacion': vali,
			    'codigoemp' : empresa,
			    'messa' : messa,
			    'binds' : parametros
			  },
        dataType: 'json',
	    method: 'POST',
        success: sucFun,
        error: function (data){
                 console.log(data);
               }
	});
};

var getDataEvent = function (empresa,page,field,value,form) {
    
    var parametros = page+';'+field+';'+value;
    
    var sucFun = function(json){
        
        for (var field in json){
            var value = json[field];
            form.childrenByPropertyId[field].setValue(value);
        }
    };
    
    sendAjaxRequest('none','getData',empresa,'',parametros,sucFun);
};

var getDataSelect = function (empresa,ref,field,valueD,form){
       
    var parametros = ref+';'+valueD;
    
    var sucFun = function(json){
        
        var conten = JSON.parse(json);
        var descri =[];
        var valore = [];
        
        for (var i = 0; i<conten.length; i++){
            descri.push(conten[i].descr)
            valore.push(conten[i].id);
        }
        
        form.childrenByPropertyId[field].options.optionLabels =descri;
        form.childrenByPropertyId[field].schema.enum = valore;
        form.childrenByPropertyId[field].refresh();
    
    };
    
    sendAjaxRequest('none','getDataSelect',empresa,'',parametros,sucFun);
    
};

var saveUpdateForm= function(app,page,formu,accion){
    
    $.ajax({
            url: '../Events/eventSave.php',
            data: {
                'token': 'e53db2b5b93254fddb55de43a3323970',
                'app' :app,
                'formulario' :formu,
                'page' :page,
                'accion':accion
            },
            dataType: 'json',
            method: 'POST',
            success: function(jsonData){
                notie.alert(jsonData['tipo'],jsonData['mensaje'],jsonData['duracion']);
                var link =jsonData['link'];
                window.setTimeout (function(){document.location = "../Pages/nabu.php?p="+link;},500);
            }
        });
}

var validationWizards= function(codigoemp,callback,value,sqlValidacion,funcionWS,messa){
    
    $.ajax({
		url: '../Events/webservice.php',
		data: {
				'token': 'e53db2b5b93254fddb55de43a3323970',
				'sqlValidacion':sqlValidacion,
           	    'funcionWS': funcionWS,
				'codigoemp' : codigoemp,
				'messa' : messa,
				'binds' :value
		},
		dataType: 'json',
		method: 'POST',
        		success: function(result){
			callback(result);
		}
	});
}


