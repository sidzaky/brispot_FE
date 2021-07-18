$( document ).ready(function() {
    getdataclusterpengajuan();
    getdatafaq();
    getDataNotification();
 });

 var base_url="/brispot/";

function getdataclusterpengajuan() { 
      var address = base_url+"/sidebar/getdataclusterpengajuan";
      var get = sendajaxreturn("", address, "");
      if (get!=0){
        var z = document.getElementById("cpclaster");
        z.innerHTML  = z.innerHTML + '<span  class="label label-warning pull-right">'+get+'</span>' ;
      }
}

function getdatafaq(){
    var address = base_url+"/sidebar/getdatafaq";
    var get = sendajaxreturn("", address, "");
    if (get!=0){
        var z = document.getElementById("cpfaq");
        z.innerHTML  = z.innerHTML + '<span  class="label label-warning pull-right">'+get+'</span>' ;
    }
}

function getDataNotification() { 
    var address = base_url+"/sidebar/getDataNotification";
    var get = sendajaxreturn("", address, "");
    document.getElementById("cNotif").innerHTML=get.length;
    var z=document.getElementById("notif");
    get.forEach(function (value) {
        z.innerHTML  = z.innerHTML + '<li>  <label for="thedata with-border" class="col-sm-12 control-label"> <h5 >' +value.kelompok_usaha+ ' belum di update selama 6 bulan  </h5></label> </li> <hr>  ';
    });
}

