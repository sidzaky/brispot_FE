<!-- modal change password-->
<div class="modal" id="modalz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <button type="button" class="close" onclick="$('#modalz').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title">Form klaster <?php echo $this->session->userdata('nama_uker') ?></h5>
        </div>
        <div class="modal-body">

          <?php
          $dker = '
						<div class="form-group">
							<label class="control-label">Kode Uker</label>
							<div id="chker"></div>
							<input type="number" class="form-control" id="kode_uker_c" onchange="getuker(this.value);" placeholder="required" value="" required>
						</div>';
          echo ($this->session->userdata('permission') > 1 ? $dker : '');
          ?>
          <div class="form-group has-feedback">
            <label class="control-label">Password Baru</label>
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label">Ketik Ulang Password Baru</label>
            <input type="password" class="form-control" placeholder="Confirm Password" name="Cpassword" id="Cpassword">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-primary waves-effect waves-light" onclick="$('#modalz').hide();">Batal</button>
          <input type="submit" value="Simpan" class="btn btn-success waves-effect waves-light" disabled id="dsubmit" />
        </div>
      </form>
    </div>
  </div>
</div>