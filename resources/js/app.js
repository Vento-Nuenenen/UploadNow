require('./bootstrap');

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

var uploadField = document.getElementById("file");

uploadField.onchange = function() {
    if(this.files[0].size > 307200){
        alert("File is too big! Max file size is 200 Megabyte!");
        $(".custom-file-label").removeClass("selected").html("Choose file");
    };
};
