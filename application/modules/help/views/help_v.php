<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Bantuan dan Pertanyaan
			<?php echo $this->session->userdata('name_uker'); ?><nbsp></nbsp>
		</h1>
	</section>
    <section class="content">
		<div class="box box-solid">
			<div id="result" class="box-body">
				<div class="container-fluid control-box">
					<div class="row">
						<?php 
							if ($this->session->userdata('permission') != 4 ) {
								echo '<button class="btn btn-success waves-effect waves-light btn-sm" onclick="getform()" type="button"><i class="fa fa-plus"></i> Ajukan Pertanyaan </button>';
							}
						?>
						
					</div>
				</div>
				<script>
					$(document).ready(function() {
						$('#table-help').DataTable({
							"scrollX": true,
							"searching": false,
							"processing": true,
							"serverSide": true,
							"deferRender": true,
							"stripeClasses" : [], 
							"columnDefs": [{ "width": "80%", "targets": 2 }],
							"ajax": {
								"url": "./help/getdataquestion",
								"type": "POST"
							},
						});
					});
				</script>
				<div class="table-responsive">
					<table id="table-help" class="table" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Uker</th>
								<th>Detil</th>
								<?php 
									if ($this->session->userdata('permission') == 4){
										echo '<th> Action </th>';
									}
								?>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Modal -->
<style>
	.modal-body {
		max-height: calc(100vh - 200px);
		overflow-y: auto;
	}

	.btn-file {
		position: relative;
		overflow: hidden;
	}

	.btn-file input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		min-width: 100%;
		min-height: 100%;
		font-size: 100px;
		text-align: right;
		filter: alpha(opacity=0);
		opacity: 0;
		outline: none;
		background: white;
		cursor: inherit;
		display: block;
	}

	.img-upload {
		width: 100%;
	}
</style>

<div class="modal " id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="$('#modal').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title">Form Pertanyaan</h5>
			</div>
			<div class="modal-body">
				<div id="mod-content">
                    <div class="col-sm-12">
							<label for="thedata" class="col-sm-12 control-label">
								<h3 align="center">Silahkan Ajukan pertanyaan</h3>
							</label>
						</div>
					<form>
                        <div class="form-group">
                            <textarea class="form-control required" id="question" value=""></textarea>
						</div>
                    </form>
                    <div class="modal-footer">
                        <button class="btn btn-primary waves-effect waves-light" onclick="$('#modal').hide();">Batal</button>
                        <button class="btn btn-success waves-effect waves-light" id="sbt" onclick="inputformhelp();">Kirim</button>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal " id="modalanswer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="$('#modalanswer').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title">Form Pertanyaan</h5>
			</div>
			<div class="modal-body">
				<div id="mod-content">
                    <div class="col-sm-12">
							<label for="thedata" class="col-sm-12 control-label">
								<h3 align="center">Jawab Pertanyaan</h3>
							</label>
					</div>
					<div class="form-group required">
							<label class="control-label">Pertanyaan</label>
							<p id="set_question"></p>
					</div>
					<form>
                        <div class="form-group">
                            <textarea class="form-control required" id="answer" value=""></textarea>
						</div>
                    </form>
                    <div class="modal-footer">
                        <button class="btn btn-primary waves-effect waves-light" onclick="$('#modalanswer').hide();">Batal</button>
                        <button class="btn btn-success waves-effect waves-light" id="sbt" onclick="sendanswer();">Kirim</button>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="./assets/js/send.js"></script>
<script src="./assets/js/help.js"></script>