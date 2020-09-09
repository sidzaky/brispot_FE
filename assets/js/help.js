function inputformhelp(){
    if ($("#question").val()!=""){
        var data1 = {
            question:  $("#question").val(),
        };
        $.ajax({
                type: "POST",
                url: "./help/inputformhelp",
                data: data1,
                success: function (msg) {
                alert("pertanyaan berhasil di input");
                $("#sbt").removeAttr("disabled");
                $("#modal").hide();
                $("#table-cluster").DataTable().ajax.reload(null, false);
                },
            });
        }
    else alert ("harap isi form diatas");
}

function getform(i = null) {
    $("#modal").show();
}

var idha = "";

function answer(i){
    idha = i;
    document.getElementById('set_question').innerHTML=document.getElementById('q_'+i).innerHTML;
    $("#modalanswer").show();
}

function sendanswer(){
    if ($("#answer").val()!=""){
        var data1 = {
            id_help :  idha,
            answer  :  $("#answer").val(),
        };
        $.ajax({
                type: "POST",
                url: "./help/answerformhelp",
                data: data1,
                success: function (msg) {
                alert("Jawaban berhasil di Kirim");
                $("#sbt").removeAttr("disabled");
                $("#modalanswer").hide();
                $("#table-cluster").DataTable().ajax.reload();
                },
            });
        }
    else alert ("harap isi form diatas");


}