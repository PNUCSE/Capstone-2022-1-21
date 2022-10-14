

$(document).ready(function() {

    $('#submitfastaButton').click(function() {
        $('#uploadFastaForm').ajaxForm({
            target: '#outputFastaImage',
            url: 'uploadfasta.php',
            beforeSubmit: function() {
                $("#outputFastaImage").hide();
                if ($("#file1").val() == "" || $("#file2").val() == "") {
                    $("#outputFastaImage").show();
                    $("#outputFastaImage").html("<div class='alert alert-danger'>Choose a file to upload.</div>");
                    return false;
                }

                $("#progressDivId").css("display", "block");

                var percentValue = '0%';

                $('#progressFastaBar').width(percentValue);
                $('#percentFasta').html(percentValue);

            },

            uploadProgress: function(event, position, total, percentComplete) {

                var percentValue = percentComplete + '%';
                $("#progressFastaBar").animate({
                    width: '' + percentValue + ''
                }, {
                    duration: 5000,
                    easing: "linear",
                    step: function(x) {
                        percentText = Math.round(x * 100 / percentComplete);
                        $("#percentFasta").text(percentText + "%");
                        if (percentText == "100") {
                            $("#outputFastaImage").show();
                            $("#fastaerror").html("<div class='alert alert-success mt-2'>File Successfully Uploaded.</div>");

                        }
                    }
                });
            },
            error: function(response, status, e) {
                // alert('Oops something went.');
            },

            complete: function(xhr) {
                if (xhr.responseText && xhr.responseText != "error") {
                    $("#outputFastaImage").html(xhr.responseText);
                } else {
                    $("#outputFastaImage").show();
                    $("#progressFastaBar").stop();
                }
            }
        });
    });
});