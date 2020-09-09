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