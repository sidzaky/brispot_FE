
<?php if ($this->session->userdata('role')=='kasir') echo '<script>window.location.replace("'.base_url().'admin");</script>';?>

 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/morris.css">
	  <div class="content-wrapper" id="keuangan">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Penyakit 
          </h1>
				<button type="button" class="btn-tambah btn btn-primary btn-flat"  data-toggle="modal"  data-target="#modal" onclick="input('gejala');"><i class="fa fa-fw fa-plus"></i> Input Gejala</button>
				<button type="button" class="btn-tambah btn btn-primary btn-flat"  data-toggle="modal"  data-target="#modal" onclick="input('penyakit');"><i class="fa fa-fw fa-plus"></i> Input Penyakit</button>
				
          <ol class="breadcrumb">
          </ol>
        </section>

        <!-- Main content -->
		
		
	<section class="content">
			<div class="col-md-7">
              <div class="box box-info">
				  <div class="box-header with-border">
					<h3 class="box-title">Data Gejala dan Penyakitnya</h3>
				  </div>
				<div id="datagejala" class="box-body">
					<?php $con->getdatagejala();?>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div>
			<div class="col-md-5">
              <div class="box box-info">
				  <div class="box-header with-border">
					<h3 class="box-title">Data Penyakit</h3>
				  </div>
				<div id="datapenyakit" class="box-body">
					<?php $con->getdatapenyakit();?>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div>
        </section>
	` </div> 
	 </div> 
	 
	 
	
	  
	  <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Input data</h4>
            </div>
            <div class="modal-body">
				<div id="modal-content">
				
            </div>
            
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	   
	  
		<script>
		
		
		function input(i){
			$.ajax({
					   type:"POST",
					   url: '<?php echo base_url();?>listdata/input'+i,
					   success:function(msg){
								$('#modal-content').html(msg);
							}
						});
			
		}
		 
		function edit(i,j){
			
			var subject={
				'id_data' : i,
				'type' : j
			}
			$.ajax({
					   type:"POST",
					   url: '<?php echo base_url();?>listdata/update',
					   data: subject,
					   success:function(msg){
								$('#modal-content').html(msg);
							}
						});
			
		}

		
		function tambahform(id) {
				$.ajax({
						   type:"POST",
						   url: "<?php echo base_url();?>listdata/form"+id,
						   data: $('[id^="'+id+'_"]').last(),
						   success:function(msg){
							  $(".form"+id).append(msg);
								}
							});		
					
				}
		
		
		function minform(id) {
				$('#' + id).parent().remove();
		}
		
		function push(z){
			
			var data1 = { 	
							
							'id' : $('#id_'+z).val(),
							'nama' :  $('#nama_'+z).val(),
							'kode' :  $('#kode').val(),
							'CF': $('#CF').val(),
							'detail' : $('#detail').val(),
							'solusi' : $('#solusi').val(),
							'penyakit' : []
						}
						for (var i=1;i<=$('[id^=sumpenyakit]').last().val();i++){
								data1['penyakit'].push($('#penyakit_'+i).val());
						}	
			$.ajax({
						   type:"POST",
						   url: "<?php echo base_url();?>listdata/input"+z,
						   data: data1,
						   success:function(msg){
							  location.reload();
							   
								}
							});		
				
		}
		
		function del(id,i){
				if (confirm('Apakah anda yakin akan menghapus data ini?')){
					var data1={
						'id' : id
					}				
						$.ajax({
							   type:"POST",
							   url: "<?php echo base_url();?>listdata/del"+i,
							   data: data1,
							   success:function(msg){
								   $("#data"+i).html(msg);
									}
								});		
				}
			}
			
		</script>
		
		
		