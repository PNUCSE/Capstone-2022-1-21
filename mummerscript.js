

$(document).ready(function() {

    $('#submitMummerButton').click(function() {
        $('#uploadMummerForm').ajaxForm({
            target: '#outputMummerImage',
            url: 'uploadmummer.php',
            beforeSubmit: function() {
                $("#outputMummerImage").hide();
                if ($("#mummerfile").val() == "") {
                    $("#outputMummerImage").show();
                    $("#outputMummerImage").html("<div class='alert alert-danger'>Choose a file to upload.</div>");
                    return false;
                }

                $("#progressDivId").css("display", "block");

                var percentValue = '0%';

                $('#progressMummerBar').width(percentValue);
                $('#percentMummer').html(percentValue);

            },

            uploadProgress: function(event, position, total, percentComplete) {

                var percentValue = percentComplete + '%';
                $("#progressMummerBar").animate({
                    width: '' + percentValue + ''
                }, {
                    duration: 100,
                    easing: "linear",
                    step: function(x) {
                        percentText = Math.round(x * 100 / percentComplete);
                        $("#percentMummer").text(percentText + "%");
                        if (percentText == "100") {
                            $("#outputMummerImage").show();
                            $("#errorMummer").html("<div class='alert alert-success mt-2'>File Successfully Uploaded.</div>");

                        }
                    }
                });
            },
            error: function(response, status, e) {
                // alert('Oops something went.');
            },

            complete: function(xhr) {
                if (xhr.responseText && xhr.responseText != "error") {
                    $("#outputMummerImage").html(xhr.responseText);
                } else {
                    $("#outputMummerImage").show();
                    // $("#outputFastaImage").html("<div class='alert alert-danger'>Problem in uploading file.</div>");
                    $("#progressMummerBar").stop();
                }
            }
        });
    });
});