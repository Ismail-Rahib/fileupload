<!DOCTYPE html>
<html>

<head>
    <title>Upload File</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
</head>

<body class="d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="container text-center">
        
        <h5>Upload a File</h5>
        <div id="error-message" class="text-danger"></div>
        
        <!-- AJAX Upload Form -->
        <?php echo form_open_multipart('upload/do_upload', ['id' => 'uploadForm']); ?>
        <div class="mb-3">
            <input class="form-control" type="file" name="userfile" id="userfile" required />
        </div>
        <input class="btn btn-primary" type="submit" value="Upload" />
        </form>

        <br>
        <div id="success-message" class="text-success"></div>
        <div id="preview" class="mt-3"></div>
        
        <!-- Upload Another File Button -->
        <button id="upload-another" class="btn btn-secondary mt-3" style="display:none;">Upload Another File</button>
    </div>

    <script>
        $(document).ready(function () {
            $("#uploadForm").on("submit", function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $("#error-message").html("");
                $("#success-message").html("Uploading...");
                $("#upload-another").hide(); // Hide "Upload Another File" button when uploading

                $.ajax({
                    url: "<?php echo base_url('upload/do_upload'); ?>",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            $("#success-message").html("File Uploaded Successfully!");
                            if (response.file_ext.match(/(jpg|jpeg|png|gif)$/)) {
                                $("#preview").html('<img src="' + response.file_path + '" class="img-thumbnail" width="200">');
                            } else if (response.file_ext === ".pdf") {
                                $("#preview").html('<a href="' + response.file_path + '" target="_blank" class="btn btn-info btn-sm">View PDF</a>');
                            }
                            $("#upload-another").show(); // Show "Upload Another File" button
                        } else {
                            $("#error-message").html(response.error);
                        }
                    },
                    error: function () {
                        $("#error-message").html("An error occurred while uploading.");
                    }
                });
            });

            // Reset form when "Upload Another File" button is clicked
            $("#upload-another").click(function () {
                $("#uploadForm")[0].reset();
                $("#success-message").html("");
                $("#preview").html("");
                $(this).hide();
            });
        });
    </script>
</body>

</html>
