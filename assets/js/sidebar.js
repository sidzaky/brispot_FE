$( document ).ready(function() {
    getdataclusterpengajuan();
    getdatafaq();
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

