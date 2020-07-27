function sendajax(data1,address,element,notif,tipe){
				$('#'+element).html('');
				$.ajax({ 
					   type:"POST",
					   url: address,
					   data: data1,
					   dataType:tipe, 
					   success:function(msg){
						   $('#'+element).html(msg);
						   if (notif!=null){
								toastr.success(notif);
								}
							return true;
							}
						});
			}


			
function sendajaxreturn(data1,address,tipe){
			var datareturn;
			$.ajax({ 
							   type:"POST",
							   url: address,
							   data: data1,
							   async:false,
							   dataType : 'json',
							   success:function(smsg){
										datareturn=JSON.parse(JSON.stringify(smsg));
									}
							});
			return datareturn;	
		}