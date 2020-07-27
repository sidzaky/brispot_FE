
<html><head>  <title>Sistem Informasi Akademik Mahasiswa</title>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
 </head><body bgcolor="#ffffff" >
 <table cellpadding="0" cellspacing="0" border="0" width="700" align="center"> 
	<td class="prtext">
		<table cellpadding="0" cellspacing="0" border="0">     
			<td valign="top" width="160">
				<img src="<?php echo base_url()?>assets/img/logoninadentalcare.png" style="width:140px;height:84px;padding-top:5px;border-right:5px;">
				
			</td>     
			<td class="prsmall" valign="top" width="410" style="padding-left:10px">    
				SIP 446.dg/331.1/35.73.306/2015 <br><?php echo $cabang[0]->alamat_clinic ?></br>
				SISTEM INFORMASI NINA DENTAL CLINIC
				<br>-------------------------------------------------------------------------------- <br>
						   
			</td>
			<td valign="top">
				Laporan Harian Clinic<br><br>
				<br>
				<br>---------------------------------<br>
			</td>
		</table>	
		</br>
		<div class="prtitle" align="center">LAPORAN CLOSING CLINIC CABANG
		 <div id="date"> Tanggal <?php echo $from; ?></div> 		
		</div>	
			<table cellpadding="0" cellspacing="0" border="0">  
			 <tr class="prtext" bgcolor="#ffffff" align="center">   
					<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td>
				 </tr>  
			 <tr class="prtext" bgcolor="#ffffff" align="center">   
				 
					 <td width="30" height="25"><b>No</b></td>    
					 <td width="250" align="left"><b>KETERANGAN</b></td>    
					 <td width="80" align="right"><b>Jumlah</b></td>		 
					 <td width="80" align="right"><b>Saldo</b></td>    
				<tr class="prtext" bgcolor="#ffffff" align="center">    
				<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>    
			<tr>
				 <td width="30" height="25"><b>1</b></td>    
					 <td width="250" align="left"><b>Total Pasien</b></td>    
					 <td width="80" align="right"><b><?php echo sizeof($harian)?></b></td>		 
					 <td width="80" align="right"><b>-</b></td>   
			</tr>
			
			<?php 
				$sumpemasukan=0;
				$sumpengeluaran=0;
				$saldo=0; 
				foreach ($laporan as $row){
					$sumpemasukan=$sumpemasukan+$row->pemasukan;
					$sumpengeluaran=$sumpengeluaran+$row->pengeluaran;
					$saldo=$saldo+$row->pemasukan-$row->pengeluaran;
				}
			?>
			<tr>
				 <td width="30" height="25"><b>2</b></td>    
					 <td width="250" align="left"><b>Pengeluaran</b></td>    
					 <td width="80" align="right"><b>-</b></td>		 
					 <td width="80" align="right"><b><?php echo $sumpemasukan ?></b></td>   
			</tr>
			
			
			<tr>
				 <td width="30" height="25"><b>3</b></td>    
					 <td width="250" align="left"><b>Pemasukan</b></td>    
					 <td width="80" align="right"><b>-<b></td>		 
					 <td width="80" align="right"><b><?php echo $sumpengeluaran?></b></td>   
			</tr>
			<tr class="prtext" bgcolor="#ffffff" align="center">    
				<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>    
			<tr>
				 <td width="30" height="25"><b>4</b></td>    
					 <td width="250" align="left"><b>Saldo</b></td>    
					 <td width="80" align="right"><b>-<b></td>		 
					 <td width="80" align="right"><b><?php echo $saldo ?></b></td>   
			</tr> 
			<tr class="prtext" bgcolor="#ffffff" align="center">    
				<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>    
		
		
		
	<table border="0" cellpadding="0" cellspacing="0">    
		<tbody>
			<tr>
				<td class="prtext" valign="top" width="550">     
		<td>    
		<td class="prtext" valign="top" align="center" width="200">      Malang, <?php echo date('d M Y')?>
			<br><br><br><br><br><br>______________________<br>drg. Nina Agustin</td></tr>    
			</tbody>
		</table>
	

</table>

