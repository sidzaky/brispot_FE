<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends CI_Model
{
  function getReport($where)
  {
    $sql = '
    select FROM_UNIXTIME
      (timestamp, "%H:%i:%s %d %M %Y") as date, 
      kanwil, 
      kanca, 
      kode_kanca, 
      uker, 
      kode_uker,
      kaunit_nama,
      kaunit_pn,
      CONCAT("\'",kaunit_handphone) as kaunit_handphone,
      nama_pekerja,
      personal_number, 
      CONCAT("\'",handphone_pekerja) as handphone_pekerja,
      kelompok_usaha, 
      kelompok_jumlah_anggota,
      kelompok_anggota_pinjaman,
      lokasi_usaha,
      e.kode_pos,
      b.nama as provinsi,
      c.nama as kabupaten,
      d.nama as kecamatan,
      e.nama as kelurahan,
      sektor_usaha,
      jenis_usaha,
      hasil_produk,
      jenis_usaha_map, 
      pasar_ekspor,
      pasar_ekspor_tahun,
      pasar_ekspor_nilai,
      kelompok_pihak_pembeli, 
      CONCAT("\'",kelompok_pihak_pembeli_handphone) as  kelompok_pihak_pembeli_handphone,
      kelompok_suplier_produk,				
      CONCAT("\'",kelompok_suplier_handphone)  as kelompok_suplier_handphone,
      kelompok_luas_usaha,
      CONCAT("\'",kelompok_omset) as  kelompok_omset,
      kelompok_perwakilan,
      kelompok_jenis_kelamin,
      CONCAT("\'",kelompok_NIK) as kelompok_NIK,
      CONCAT("\'",kelompok_handphone) as kelompok_handphone,
      kelompok_perwakilan_tgl_lahir,
      kelompok_perwakilan_tempat_lahir,
      pinjaman,CONCAT("\'",nominal_pinjaman) as nominal_pinjaman, 
      CONCAT("\'",norek_pinjaman_bri) as norek_pinjaman_bri,
      kebutuhan_skema_kredit,
      kebutuhan_sarana, 
      kebutuhan_sarana_lainnya, 
      kebutuhan_pendidikan,
      simpanan_bank,
      agen_brilink 
    from cluster a
    left join provinsi b on a.provinsi=b.id
    left join kabupaten_kota c on a.kabupaten=c.id
    left join kecamatan d on a.kecamatan=d.id
    left join kelurahan e on a.kelurahan=e.id ' . $where;
    return $this->db->query($sql)->result_array();
  }
}
