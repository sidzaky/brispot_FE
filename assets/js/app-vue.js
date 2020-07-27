// register modal component

// The Vue Modal template

Vue.component('Modal', {

  template: '#modal-template',

  props: ['show','onClose'],

  methods: {

    close: function () {

        this.onClose();

    }

  },

  ready: function () {

    document.addEventListener("keydown", (e) => {

      if (this.show && e.keyCode == 27) {

        this.onClose();

      }

    });

  }

});



Vue.component('DeleteModal', {

  template: '#delete-modal-template',

  props: ['show'],

  data: function () {

    return {

      title: '',

      body: ''

    };

  },

  methods: {

    close: function () {

      this.show = false;

    },

    removeData: function(obj){

      if(obj=='obat')

      {

        obat.removeData();

      }

      else if(obj == 'karyawan')

      {

        karyawan.removeData();

      }

  	  else if(obj == 'tindakan')

  	  {

  		  tindakan.removeData();

  	  }

  	  else if(obj == 'diagnosa')

  	  {

  		  diagnosa.removeData();

  	  }

      else if(obj == 'inventaris')

      {

        inventaris.removeData();

      }

      else if(obj == 'profesi')

      {

        profesi.removeData();

      }

    }

  }

});



Vue.component('EditModal', {

  template: '#edit-modal-template',

  props: ['show','edit', 'options'],

  methods: {

    close: function () {

      this.show = false;

    },

    saveData: function(obj){

      if(obj=='obat')

      {

        

      }

      else

      {

        karyawan.doneEdit();

      }

    }

  }

});

Vue.component('SettingModal', {

  template: '#setting-modal-template',

  props: ['show','setting'],

  methods: {

    close: function () {

      this.show = false;

    },

    saveSetting: function(){

      karyawan.saveSetting();

    }

  }

});

Vue.component('ViewModal', {

  template: '#view-modal-template',

  props: ['show','view'],

  methods: {

    close: function () {

      this.show = false;

    }

  }

});



Vue.component('AddModal', {

  template: '#add-modal-template',

  props: ['show','tambah'],

  methods: {

    close: function () {

      this.show = false;

    },

	  saveData: function(obj){

      if(obj=='tindakan')

      {

        tindakan.onSubmit();

      }

      else if(obj == 'profesi')

      {

        profesi.onSubmit();

      }

    }

  }

});

var obat = new Vue({

  el: '#obat',

  data: {

    sortKey:'',

    search: '',

    reverse: 1,

    newObat:{},

    editedObat: {},

    obat: [],

	  laporan: {},

    per_page:5,

    pages:0,

    offset: 0,

    current_page:0,

    shine:'active',

    showDeleteModal: false,

    tmpDelete: {},

    tmpStok: '',

    tmpHarga: ''

  },

  ready: function(){

    this.getObat();

  },

  computed: {

    paginatedItems: function() {

      if (this.search.trim()) {

        return this.$options.filters.filterBy(this.obat, this.search);

      }

      else {

        return this.obat.slice(this.current_page * this.per_page, (this.current_page + 1) * this.per_page)

      }

    }

  },

  methods: {

    sortBy: function(sortKey){

      this.reverse = this.reverse*-1;

      this.sortKey = sortKey;

    },

  	getObat: function(){

		  this.$http.post("obat/getObat", function(data, status, response){

  			if(data == null){

  			  this.obat = [];

  			}

  			else{

  			  this.$set('obat', data);

  			}

  		})

  	},

    onSubmit:function(){

      this.$http.post("obat/simpanObat", this.newObat, function(data, status, response){

        this.$nextTick(function(){
          
          /*this.obat.push({

            'nama': this.newObat.nama,

            'harga': this.newObat.harga,

            'stok': this.newObat.stok,

            'prevStok' : '0',

            'edited': false

          });*/

          this.getObat();

          // hide the modal

          $('#modalObat').modal('hide');

          toastr.success('Data berhasil disimpan');

          // get the ID of previously added item
          this.getObatSingle();
        
        }.bind(this));

      })     

    },

    getObatSingle: function(){
      
      this.$http.post("obat/selectObat", this.newObat, function(data, status, response){
        
        this.$set('laporan', data);

        this.newObat = {};

        //save insert activity to laporan obat

        this.$nextTick(function(){
          
          //add info

          this.laporan['prevStok'] = 0;

          this.laporan['prevHarga'] = 0;
        
          this.laporan['status'] = 'tambah';

          this.laporan['keterangan'] = 'Barang Masuk';
        
          this.saveLaporanObat();
        
        }.bind(this));
      
      });

    },

    saveLaporanObat: function(){
      
      this.$http.post("obat/saveLaporanObat", this.laporan, function(data, status, response){
        
        this.$nextTick(function(){
        
          this.laporan = {};
        
        }.bind(this));
      
      })
    },

    editData: function(obat){

      obat.edited = true;

      this.tmpStok = obat.stok;

      this.tmpHarga = obat.harga;

    },

    doneEdit: function(obat,index){


      this.$http.post("obat/simpanObat", obat, function(data, status, response){

		    obat.edited = false;

        this.obat[index] = obat;

        toastr.success('Data berhasil diubah');

        //save update activity to laporan obat
        
        this.$nextTick(function()
        {
          
          this.$set('laporan', obat);

          this.laporan['prevStok'] = this.tmpStok; 

          this.laporan['prevHarga'] = this.tmpHarga;

          //add info
          this.laporan['status'] = 'edit';
        
          this.saveLaporanObat();
        
        }.bind(this));

      })

    },

    cancelEdit: function(obat){

      obat.edited = false;

    },

    hapus: function(obt) {

      this.showDeleteModal = true;

      this.tmpDelete = obt;

    },

    removeData: function(){

      this.$http.post("obat/hapusObat", this.tmpDelete, function(data, status, response){

        //save delete activity to laporan obat 
        
        this.$nextTick(function(){


          this.$set('laporan', this.tmpDelete); 

          //add info
          this.laporan['status'] = 'hapus';

          this.laporan['keterangan'] = 'Menghapus Data';

          this.laporan['prevHarga'] = this.tmpDelete['harga'];

          this.laporan['prevStok'] = this.tmpDelete['stok'];

          this.laporan['harga'] = 0;

          this.laporan['stok'] = 0;
        
          this.saveLaporanObat();

          this.obat.$remove(this.tmpDelete);

          // hide the modal

          this.showDeleteModal = false;

          this.tmpDelete = {};

          toastr.success('Data berhasil dihapus');
        
        }.bind(this));

      })

    }

  }

})

var laporanObat = new Vue({
  el: '#laporan-obat',
  data: {
    range: '',
    sortKey:'',
    search: '',
    reverse: 1,
    newLaporanObat:{},
    laporanObat: [],
    per_page:8,
    pages:0,
    offset: 0,
    current_page:0,
    showModal: false,
  },
  ready: function(){
    this.getLaporanObat();
  },
  computed: {
    paginatedItems: function() {
      if (this.search.trim()) {
        return this.$options.filters.filterBy(this.laporanObat, this.search);
      }
      else {
        return this.laporanObat.slice(this.current_page * this.per_page, (this.current_page + 1) * this.per_page)
      }
    }
  },
  methods: {
    sortBy: function(sortKey){
      this.reverse = this.reverse*-1;
      this.sortKey = sortKey;
    },

    getLaporanObat: function(){
      this.$http.post("obat/getLaporanObat", function(data, status, response){
        this.$set('laporanObat', data);
      })
    },

    filterLaporanObat: function(){

      if(this.range.length != 0)
      {
        var time = this.range.split(" - ");
        var data = {
          'start' : time[0],
          'end'   : time[1]
        };

        this.$http.post("obat/getFilterLaporan", data, function(data, status, response){
            this.$nextTick(function(){
                console.log(data);
                this.$set('laporanObat', data);
            });
        })
      }
      else
      {
        toastr.warning('Inputkan tanggal dan waktu terlebih dahulu');
      }
    }
  }
})

var inventaris = new Vue({

  el: '#inventaris',

  data: {

    sortKey:'',

    search: '',

    reverse: 1,

    newInventaris:{},

    editedInventaris: {},

    inventaris: [],

    laporan: {},

    per_page:5,

    pages:0,

    offset: 0,

    current_page:0,

    shine:'active',

    showDeleteModal: false,

    tmpDelete: {},

    tmpStok: ''

  },

  ready: function(){

    this.getInventaris();

  },

  computed: {

    paginatedItems: function() {

      if (this.search.trim()) {

        return this.$options.filters.filterBy(this.inventaris, this.search);

      }

      else {

        return this.inventaris.slice(this.current_page * this.per_page, (this.current_page + 1) * this.per_page)

      }

    }

  },

  methods: {

    sortBy: function(sortKey){

      this.reverse = this.reverse*-1;

      this.sortKey = sortKey;

    },

    getInventaris: function(){

      this.$http.post("inventaris/getInventaris", function(data, status, response){

        if(data == null){

          this.inventaris = [];

        }

        else{

          this.$set('inventaris', data);

        }

      })

    },

    onSubmit:function(){

      this.$http.post("inventaris/simpanInventaris", this.newInventaris, function(data, status, response){

        this.$nextTick(function(){

          this.getInventaris();

          // hide the modal

          $('#modalInventaris').modal('hide');

          toastr.success('Data berhasil disimpan');
          
          // get the ID of previously added item
          this.getInventarisSingle();
      
        }.bind(this));

        /*this.inventaris.push({

          'nama': this.newInventaris.nama,

          'keterangan': this.newInventaris.keterangan,

          'stok': this.newInventaris.stok,

          'edited': false

        });*/

      })

      
      

    },

    getInventarisSingle: function(){
      
      this.$http.post("inventaris/selectInventaris", this.newInventaris, function(data, status, response){
 
        this.$set('laporan', data);

        this.newInventaris = {};

        //save insert activity to laporan obat
        
        this.$nextTick(function(){
          
          //add info

          this.laporan['sebab'] = 'Barang Masuk';
        
          this.laporan['prevStok'] = 0;
        
          this.laporan['status'] = 'tambah';
        
          //this.saveLaporanInventaris();
        
        }.bind(this));
      
      });

    },

    saveLaporanInventaris: function(){
      
      this.$http.post("inventaris/saveLaporanInventaris", this.laporan, function(data, status, response){
        
        this.$nextTick(function(){
        
          this.laporan = {};
        
        }.bind(this));
      
      })
    },

    editData: function(inventaris){

      inventaris.edited = true;

      this.tmpStok = inventaris.stok;

    },

    doneEdit: function(inventaris,index){

      this.$http.post("inventaris/simpanInventaris", inventaris, function(data, status, response){

        inventaris.edited = false;

        this.inventaris[index] = inventaris;

        toastr.success('Data berhasil diubah');

        //save update activity to laporan obat
        
        this.$nextTick(function(){

          this.$set('laporan', inventaris); 

          //add info

          this.laporan['prevStok'] = this.tmpStok; 

          this.laporan['status'] = 'edit';

          this.saveLaporanInventaris();
        
        }.bind(this));

      })

    },

    cancelEdit: function(inventaris){

      inventaris.edited = false;

    },

    hapus: function(inventaris) {

      this.showDeleteModal = true;

      this.tmpDelete = inventaris;

    },

    removeData: function(){

      this.$http.post("inventaris/hapusInventaris", this.tmpDelete, function(data, status, response){
        
        this.$nextTick(function(){

          this.$set('laporan', this.tmpDelete); 

          //add info

          this.laporan['status'] = 'hapus';

          this.laporan['prevStok'] = this.tmpDelete['stok'];

          this.laporan['stok'] = 0;

          this.laporan['sebab'] = 'Barang dihapus';

          //save delete activity to laporan obat
        
          this.saveLaporanInventaris();

          this.inventaris.$remove(this.tmpDelete);

          // hide the modal

          this.showDeleteModal = false;

          this.tmpDelete = {};

          toastr.success('Data berhasil dihapus');
        
        }.bind(this));

      })

    }

  }

})

var laporanInventaris = new Vue({
  el: '#laporan-inventaris',
  data: {
    range: '',
    sortKey:'',
    search: '',
    reverse: 1,
    newLaporanInventaris:{},
    laporanInventaris: [],
    per_page:8,
    pages:0,
    offset: 0,
    current_page:0,
    showModal: false,
  },
  ready: function(){
    this.getLaporanInventaris();
  },
  computed: {
    paginatedItems: function() {
      if (this.search.trim()) {
        return this.$options.filters.filterBy(this.laporanInventaris, this.search);
      }
      else {
        return this.laporanInventaris.slice(this.current_page * this.per_page, (this.current_page + 1) * this.per_page)
      }
    }
  },
  methods: {
    sortBy: function(sortKey){
      this.reverse = this.reverse*-1;
      this.sortKey = sortKey;
    },

    getLaporanInventaris: function(){
      this.$http.post("inventaris/getLaporanInventaris", function(data, status, response){
        this.$set('laporanInventaris', data);
     })
    },
    
    filterLaporanInventaris: function(){

      if(this.range.length != 0)
      {
        var time = this.range.split(" - ");
        var data = {
          'start' : time[0],
          'end'   : time[1]
        };

        this.$http.post("inventaris/getFilterLaporan", data, function(data, status, response){
            this.$nextTick(function(){
                //console.log(data);
                this.$set('laporanInventaris', data);
            });
        })
      }
      else
      {
        toastr.warning('Inputkan tanggal dan waktu terlebih dahulu');
      }
    }
  }
})


var diagnosa = new Vue({

  el: '#diagnosa',

  data: {

    sortKey:'',

    search: '',

    reverse: 1,

    newDiagnosa:{},

    editedDiagnosa: {},

    diagnosa: [],

    per_page:5,

    pages:0,

    offset: 0,

    current_page:0,

    shine:'active',

    showDeleteModal: false,

    tmpDelete: {}

  },

  ready: function(){

    this.getDiagnosa();

  },

  computed: {

    paginatedItems: function() {

      if (this.search.trim()) {

        return this.$options.filters.filterBy(this.diagnosa, this.search);

      }

      else {

        return this.diagnosa.slice(this.current_page * this.per_page, (this.current_page + 1) * this.per_page)

      }

    }

  },

  methods: {

    sortBy: function(sortKey){

      this.reverse = this.reverse*-1;

      this.sortKey = sortKey;

    },

  	getDiagnosa: function(){

		this.$http.post("diagnosa/getDiagnosa", function(data, status, response){

			if(data == null){

			  this.diagnosa = [];

			}else

			{

			  this.$set('diagnosa', data);

			}

		})

  	},

    onSubmit:function(){

    this.$http.post("diagnosa/simpanDiagnosa", this.newDiagnosa, function(data, status, response){

      this.diagnosa.push({

        'nama': this.newDiagnosa.nama,

        'keterangan': this.newDiagnosa.keterangan,

        'edited': false

      });

      this.newDiagnosa = {};

      // hide the modal

      this.showAddModal = false;

      $('#modalDiagnosa').modal('hide');

          this.getDiagnosa();

          toastr.success('Data berhasil disimpan');

      })

    },

    editData: function(diagnosa){

      diagnosa.edited = true;

    },

    doneEdit: function(diagnosa,index){

      this.$http.post("diagnosa/simpanDiagnosa", diagnosa, function(data, status, response){

		    diagnosa.edited = false;

        this.diagnosa[index] = diagnosa;

        toastr.success('Data berhasil diubah');

      })

    },

    cancelEdit: function(diagnosa){

      diagnosa.edited = false;

    },

    hapus: function(diagnosa) {

      this.showDeleteModal = true;

      this.tmpDelete = diagnosa;

    },

    removeData: function(){

      this.$http.post("diagnosa/delDiagnosa", this.tmpDelete, function(data, status, response){

		console.log(data);

        this.diagnosa.$remove(this.tmpDelete);

        // hide the modal

        this.showDeleteModal = false;

        this.tmpDelete = {};

        toastr.success('Data berhasil dihapus');

      })

    }

  }	

})



var karyawan = new Vue({

  el: '#karyawan',

  data: {

    sortKey:'',

    search: '',

    reverse: 1,

    per_page:8,

    editedKaryawan:{},

    selectedKaryawan:{},

    pages:0,

    current_page:0,

    showViewModal: false,

    showDeleteModal: false,

    showEditModal: false,

    showSettingModal: false,

    karyawan: [],

    tmpDelete: {},

    index:'',

	  options: [],

    setting: {}

  },

  ready: function(){

    this.getKaryawan();

	  this.listProfesi();

  },

  computed: {

    paginatedItems: function() {

      if (this.search.trim()) {

        return this.$options.filters.filterBy(this.karyawan, this.search);

      }

      else {

        return this.karyawan.slice(this.current_page * this.per_page, (this.current_page + 1) * this.per_page)

      }

    }

  },

  methods: {

    sortBy: function(sortKey){

      this.reverse = this.reverse*-1;

      this.sortKey = sortKey;

    },

    getUserCredentials: function(){

      this.$http.post("staff/getUserCredentials", function(data, status, response){

      })

    },

    getKaryawan: function(){

      this.$http.post("staff/getKaryawan", function(data, status, response){

        if(data == null){

          this.karyawan = [];

        }else

        {

          this.$set('karyawan', data);

        }

      })

    },

	  listProfesi: function(){

      this.$http.post("staff/listProfesi", function(data, status, response){

        this.$set('options', data);

      })

    },

    viewKaryawan: function(karyawan){

      this.showViewModal = true;

      this.selectedKaryawan = karyawan;

  	  if(this.selectedKaryawan.foto == null || this.selectedKaryawan.foto =='')

  	  {

  		  this.selectedKaryawan.foto = 'assets/foto/unknown.jpg';  

  	  }

    },

    onSubmit:function(){

      var formData = new FormData();

      var foto = '';

      if ($('#foto_karyawan')[0].files[0] != null)

      {

        foto = $('#foto_karyawan')[0].files[0];

      }

      else

      {

        foto = '';

      }



      formData.append('nama', this.newKaryawan.nama);

      formData.append('alamat', this.newKaryawan.alamat);

      formData.append('tempat_lahir', this.newKaryawan.tempat_lahir);

      formData.append('tgl_lahir', this.newKaryawan.tgl_lahir);

      formData.append('jenis_kelamin', this.newKaryawan.jenis_kelamin);

      formData.append('telepon', this.newKaryawan.telepon);

      formData.append('profesi', this.newKaryawan.profesi);

      formData.append('SIP', this.newKaryawan.SIP);

      formData.append('email', this.newKaryawan.email);

	    formData.append('privilege', this.newKaryawan.privilege);

      formData.append('foto', foto);



      // insert karyawan

      this.$http.post('staff/addKaryawan', formData, function (data, status, request) {

        this.karyawan.push({

          'id_karyawan' : this.newKaryawan.id_karyawan,

          'nama': this.newKaryawan.nama,

          'alamat': this.newKaryawan.alamat,

          'tempat_lahir' : this.newKaryawan.tempat_lahir,

          'jenis_kelamin' : this.newKaryawan.jenis_kelamin,

          'telepon': this.newKaryawan.telepon,

          'profesi' : this.newKaryawan.profesi,

          'SIP' : this.newKaryawan.SIP,

          'email' : this.newKaryawan.email,

		      'peran' : this.newKaryawan.peran,

          'foto'  : foto,

          'edited': false

        });

        // clear

        this.newKaryawan = {};

        $('#foto_karyawan').val('');

        this.getKaryawan();

        // hide the modal

        $('#modalKaryawan').modal('hide');

		    this.getKaryawan();

        toastr.success('Data berhasil disimpan');



      }).error(function (data, status, request) {

          // clear

          this.newKaryawan = {};

          // hide the modal

          $('#modalKaryawan').modal('hide');

          toastr.success('Maaf data gagal disimpan');

      }); 

    },

    editKaryawan: function(karyawan,index){

      this.showEditModal = true;

      this.editedKaryawan = karyawan;

      this.index = index;

    },

    doneEdit: function(karyawan){

      var tempProfesi = {'nama':this.editedKaryawan.profesi}

      this.$http.post("staff/getIdProfesi", tempProfesi, function(data, status, request){    

        //console.log(data);  

        this.$nextTick(function(){

          var idProfesi = data;

          var formData = new FormData();

          var foto = '';

          if ($('#edit_foto_karyawan')[0].files[0] != null)

          {

            foto = $('#edit_foto_karyawan')[0].files[0];

          }

          else

          {

            foto = '';

          }

          // prepare data

          formData.append('id', this.editedKaryawan.id);

          formData.append('nama', this.editedKaryawan.nama);

          formData.append('alamat', this.editedKaryawan.alamat);

          formData.append('tempat_lahir', this.editedKaryawan.tempat_lahir);

          formData.append('tgl_lahir', this.editedKaryawan.tgl_lahir);

          formData.append('jenis_kelamin', this.editedKaryawan.jenis_kelamin);

          formData.append('telepon', this.editedKaryawan.telepon);

          formData.append('id_profesi', idProfesi);

          formData.append('SIP', this.editedKaryawan.SIP);

          formData.append('email', this.editedKaryawan.email);

          formData.append('privilege', this.editedKaryawan.privilege);

          formData.append('foto', foto);

          // update data karyawan

          this.$http.post("staff/updateKaryawan", formData, function(data, status, response){

            this.karyawan[this.index] = this.editedKaryawan;

            this.index = '';

            this.editedKaryawan = '';

            $('#edit_foto_karyawan').val('');

            this.showEditModal = false;

            toastr.success('Data berhasil diubah');

            this.$nextTick(function(){

              this.getKaryawan();
            
            }.bind(this));

          })
        })
      })

    },

    settingKaryawan: function(karyawan){

      this.$http.post("staff/getSetting", {'id':karyawan.id}, function(data, status, response){

        this.$nextTick(function(){

          if(data != null)
          {
            this.showSettingModal = true;

            this.setting = {

                'username' : data.username,

                'id_karyawan' : karyawan.id,

                'password' : data.password,

                'peran' : karyawan.privilege

            };
          }

          else

          {
            this.showSettingModal = true;

            this.setting = {

                'username' : '',

                'id_karyawan' : karyawan.id,

                'password' : '',

                'peran' : karyawan.privilege

            };
          }
            
          }.bind(this));

      });
    
    },

    saveSetting: function(){

      this.$http.post("staff/saveSetting", this.setting, function(data, status, response){

        this.$nextTick(function(){

          if(data.message == true)
          {
            toastr.success('Password berhasil disimpan');

            this.setting = {};
          }
          else
          {
            toastr.success('Password gagal disimpan');
          }
        
        }.bind(this));

        this.showSettingModal = false;

      })

    },

    hapus: function(karyawan) {

      this.showDeleteModal = true;

      this.tmpDelete = karyawan;

    },

    removeData: function(){

      this.$http.post("staff/hapusKaryawan", this.tmpDelete, function(data, status, response){

        this.karyawan.$remove(this.tmpDelete);

        // hide the modal

        this.showDeleteModal = false;

        this.tmpDelete = {};

        toastr.success('Data berhasil dihapus');

      })

    }

  }

})


var tindakan = new Vue({

  el: '#tindakan',

  data: {

    sortKey:'',

    search: '',

    reverse: 1,

    newTindakan:{},

    editedTindakan:{},

    tindakan: [],

    per_page:10,

    pages:0,

    offset: 0,

    current_page:0,

	  showAddModal: false,

    showDeleteModal: false,

    tmpDelete: {}

  },

  ready: function(){

    this.getTindakan();

  },

  computed: {

    paginatedItems: function() {

      if (this.search.trim()) {

        return this.$options.filters.filterBy(this.tindakan, this.search);

      }

      else {

        return this.tindakan.slice(this.current_page * this.per_page, (this.current_page + 1) * this.per_page)

      }

    }

  },

  methods: {

    sortBy: function(sortKey){

      this.reverse = this.reverse*-1;

      this.sortKey = sortKey;

    },

  	getTindakan: function(){

		this.$http.post("tindakan/getTindakan", function(data, status, response){

			if(data == null){

			  this.tindakan = [];

			}else

			{

			  this.$set('tindakan', data);

			}

		})

  	},

	  tambahTindakan: function(){

		  this.showAddModal = true;

  	},

    onSubmit:function(){

		this.$http.post("tindakan/simpanTindakan", this.newTindakan, function(data, status, response){

			this.newTindakan = {};

			// hide the modal

			this.showAddModal = false;

			this.getTindakan();

			toastr.success('Data berhasil disimpan');

      })

    },

    editTindakan: function(tindakan){

      tindakan.edited = true;

    },

    doneEdit: function(tindakan,index){

      this.$http.post("tindakan/simpanTindakan", tindakan, function(data, status, response){

		    tindakan.edited = false;

        this.tindakan[index] = tindakan;

        toastr.success('Data berhasil diubah');

      })

    },

    cancelEdit: function(tindakan){

      tindakan.edited = false;

    },

    hapus: function(tindakan) {

      this.showDeleteModal = true;

      this.tmpDelete = tindakan;

    },

    removeData: function(){

      this.$http.post("tindakan/hapusTindakan", this.tmpDelete, function(data, status, response){

		    console.log(data);

        this.tindakan.$remove(this.tmpDelete);

        // hide the modal

        this.showDeleteModal = false;

        this.tmpDelete = {};

        toastr.success('Data berhasil dihapus');

      })

    }

  }	

})

var user = new Vue({

  el: '#user',

  data: {

    sortKey:'',

    search: '',

    reverse: 1,

    user:{}  

  },

  ready: function(){

    this.getUser();

  },

  methods: {

    getUser: function(){

      this.$http.post("user/getUser", function(data, status, response){

        //console.log(data);

        this.$nextTick(function(){

          this.user = data;

        }.bind(this))

      })

    },

    editProfile: function(){

      this.user.edited = true;

    },

    cancel: function(){

      this.user.edited = false;

    },

    saveSetting: function(){

      this.$http.post("user/saveSetting", this.user, function(data, status, response){

        this.$nextTick(function(){

          if(data.status == true)
          {

            toastr.success(data.message);

            this.user.edited = false;

          }
          else
          {

            toastr.error(data.message);

            this.user.edited = false;

          }

          

        }.bind(this))

      })

    }

  }

})

var profesi = new Vue({

  el: '#profesi',

  data: {

    sortKey:'',

    search: '',

    reverse: 1,

    newProfesi:{},

    editedProfesi:{},

    profesi: [],

    per_page:10,

    pages:0,

    offset: 0,

    current_page:0,

    showAddModal: false,

    showDeleteModal: false,

    tmpDelete: {}

  },

  ready: function(){

    this.getProfesi();

  },

  computed: {

    paginatedItems: function() {

      if (this.search.trim()) {

        return this.$options.filters.filterBy(this.profesi, this.search);

      }

      else {

        return this.profesi.slice(this.current_page * this.per_page, (this.current_page + 1) * this.per_page)

      }

    }

  },

  methods: {

    sortBy: function(sortKey){

      this.reverse = this.reverse*-1;

      this.sortKey = sortKey;

    },

    getProfesi: function(){

      this.$http.post("profesi/listProfesi", function(data, status, response){

        if(data == null){

          this.profesi = [];

        }else

        {

          this.$set('profesi', data);

        }

      })

    },

    tambahProfesi: function(){

      this.showAddModal = true;

    },

    onSubmit:function(){

    this.$http.post("profesi/simpanProfesi", this.newProfesi, function(data, status, response){

      this.newProfesi = {};

      // hide the modal

      this.showAddModal = false;

      this.getProfesi();

      toastr.success('Data berhasil disimpan');

      })

    },

    editProfesi: function(profesi){

      profesi.edited = true;

    },

    doneEdit: function(profesi,index){

      this.$http.post("profesi/simpanProfesi", profesi, function(data, status, response){

        profesi.edited = false;

        this.profesi[index] = profesi;

        toastr.success('Data berhasil diubah');

      })

    },

    cancelEdit: function(profesi){

      profesi.edited = false;

    },

    hapus: function(profesi) {

      this.showDeleteModal = true;

      this.tmpDelete = profesi;

    },

    removeData: function(){

      this.$http.post("profesi/hapusProfesi", this.tmpDelete, function(data, status, response){

        console.log(data);

        this.profesi.$remove(this.tmpDelete);

        // hide the modal

        this.showDeleteModal = false;

        this.tmpDelete = {};

        toastr.success('Data berhasil dihapus');

      })

    }

  } 

})