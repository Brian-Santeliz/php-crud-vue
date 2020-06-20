const AgregarRegistro = new Vue ({
	el: '#AgregarRegistro',
	data: {
		usuarios: {
			RegistroNombre: '',
			RegistroApellido: '',
		},
	},
	methods: {
		Agregar: function() {
			$.ajax({
	            url:"php/registro/AgregarRegistro.php",
	            type:"POST",
	            data:this.usuarios,
	            async:true,
	            timeout: 10000,
	            success: function(data){
	            	try{
			            var user = JSON.parse(data);
			            if(user.status!=false){
			            	AgregarRegistro.usuarios.RegistroNombre='';
			            	AgregarRegistro.usuarios.RegistroApellido='';
			            	LeerRegistros.LeerRegistros();
			            	
							$('#registroModal').modal('hide');
						
			        	} else {
			        		console.log(user.message);
			        	}
		                	console.log("AgregarRegistro obtuvo respuesta");
	            	} catch(e) {
		        		console.log("Error: "+ e);
		        		console.log("Data JSON: "+ data);
			        }
	            },
	        });
		},
	}, 
});

const LeerRegistros = new Vue ({
	el:'#LeerRegistros',
	data: {
		registros: [],
		empty:true,
	},
	mounted : function(){
		this.LeerRegistros();
	},
	methods: {
		LeerRegistros: function(){
				$.ajax({
					url:"php/registro/LeerRegistros.php",
				    type:"GET",
				    async:true,
				    timeout: 10000,
				    success: function(data){
		        		try{
							user=JSON.parse(data);
							if (user.status!=false) {
								if(user.empty!=true){
					        	LeerRegistros.registros=user.values;
								}
								LeerRegistros.empty=user.empty;
					        } else {
					        	LeerRegistros.registros=[];
					        	console.log(user.message);
					        }
					            console.log("LeerRegistros obtuvo respuesta");
				            } catch(e) {
					       		console.log("Error: "+ e);
					       		console.log("Data JSON: "+ data);
				       		}
				     },
				});
			},
		ObtenerRegistro: function(RegistroID) {
			    	$.ajax({
			            url:"php/registro/LeerRegistro.php",
			            type:"POST",
			            data:{RegistroID:RegistroID},
			            async:true,
			            timeout: 10000,
			            success: function(data){
			            	try{
					            var user = JSON.parse(data);
					            if(user.status!=false){
						            actualizar.usuarios=user.values[0];
						            actualizar.showModal();
					        	}else{
					        		console.log(user.message);
					        	}
				                	console.log("LeerRegistro obtuvo respuesta");
			            	} catch(e) {
				        		console.log("Error: "+ e);
				        		console.log("Data JSON: "+ data);
			        		}
				        },
			       	});
		},
	    BorrarRegistro: function(RegistroID) {
			    var conf = confirm("¿Quieres eliminar esta cliente?");
			    if (conf == true) {
				    $.ajax({
				        url:"php/registro/BorrarRegistro.php",
				        type:"POST",
				        data:{RegistroID:RegistroID},
			            async:true,
			            timeout: 10000,
			            success: function(data){
			            	try{
				                var user = JSON.parse(data);
				                if(user.status==false){
				                    console.log(user.message);
				                }
				                LeerRegistros.LeerRegistros();
				                console.log("BorrarRegistro obtuvo respuesta");
			            	} catch(e) {
				        		console.log("Error: "+ e);
				        		console.log("Data JSON: "+ data);
			        		}
				        },
			        });
		    	}
		},
	},   	        
}); 

const actualizar = new Vue({
	el : '#ActualizarRegistro',
	data: {
		usuarios: {
			RegistroNombre: '',
			RegistroApellido: '',
			RegistroID: '',	
	    },
  	},
	methods: {
		Actualizar: function() {
		    	$.ajax({
		            url:"php/registro/ActualizarRegistro.php",
		            type:"POST",
		            data:this.usuarios,
		            async:true,
		            timeout: 10000,
					success: function(data){
						try{
							var user = JSON.parse(data);
				            if(user.status!=false){
				            actualizar.usuarios.RegistroNombre='';
			            	actualizar.usuarios.RegistroApellido='';
					        $("#ActualizarRegistroModal").modal('hide');
					        LeerRegistros.LeerRegistros();
				        	} else {
				        		console.log(user.message);
				        	}
				        	console.log("ActualizarRegistro obtuvo respuesta");
			        	} catch(e) {
			        		console.log("Error: "+ e);
			        		console.log("Data JSON: "+ data);
			        	}
		        	},
		    	});
		},
		showModal : function(){
            $("#ActualizarRegistroModal").modal("show");
		},
	}, 
});

