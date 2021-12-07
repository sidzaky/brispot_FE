$( document ).ready(function() {
    getdataclusterpengajuan();
    getdatafaq();
    getDataNotification();
 });



function getdataclusterpengajuan() { 
      var address = baseURL+"/sidebar/getdataclusterpengajuan";
      var get = sendajaxreturn("", address, "");
      if (get!=0){
        var z = document.getElementById("cpclaster");
        z.innerHTML  = z.innerHTML + '<span  class="label label-warning pull-right">'+get+'</span>' ;
      }
}

function getdatafaq(){
    var address = baseURL+"/sidebar/getdatafaq";
    var get = sendajaxreturn("", address, "");
    if (get!=0){
        var z = document.getElementById("cpfaq");
        z.innerHTML  = z.innerHTML + '<span  class="label label-warning pull-right">'+get+'</span>' ;
    }
}

function getDataNotification() { 
    var address = baseURL+"/sidebar/getDataNotification";
    var get = sendajaxreturn("", address, "");
    if (get.length > 0)  document.getElementById("cNotif").innerHTML=get.length;
    var z=document.getElementById("setnotif");
    var notif = "";
    get.forEach(function (value) {
       notif  = notif + '<li>  <label for="thedata with-border" class="col-sm-12 control-label"> <h5>' +value.kelompok_usaha+ ' belum di update selama 6 bulan  </h5></label> </li> <hr>  ';
    });
    if (notif!="") z.innerHTML += '<ul  class="dropdown-menu" role="menu">' + notif + '</ul>';
}

