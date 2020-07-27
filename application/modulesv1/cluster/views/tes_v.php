            <div class="container-fluid">
                <div class="row bg-title">
                </div>
				<div class="col-md-12">
					 
                        <div class="white-box">
                            <h3 class="box-title m-b-0"  align="center">TEST</h3>
							
							<div id="item-list">
								<input class="form-control" id="url" type="text" required placeholder="put url or instagram user">
								<button class="btn btn-success waves-effect waves-light" onclick="get();">get it!!!</button>
							</div>
							<div id="result">
							
							</div>
					</div>
				</div>
            </div>
     
	 
	 <!-- modal-->
	 
	 
	
	<script>
	 
		function get(){
			loading("result");
			var data1 = { 
							'url' :  $('#url').val(),
						};
			var address="<?php echo base_url();?>dlcont/test";
			$.ajax({ 
					   type:"POST",
					   url: address,
					   data: data1,
					   success:function(msg){
						   document.getElementById("result").innerHTML=msg;
						}
				});
			
			
			
			
		}
	
	</script>
	
	
       