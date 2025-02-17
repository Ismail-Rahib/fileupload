<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Panel</h1>
        <h3 class="text-left mb-4">Uploaded Files</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>File Name</th>
                    <th>Preview</th>
                    <th>Download</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="fileList">
                <?php if (!empty($files)): ?>
                    <?php foreach ($files as $file): ?>
                        <tr id="file-<?php echo $file['id']; ?>">
                            <td><?php echo $file['file_name']; ?></td>
                            <td>
                                <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/', $file['file_name'])): ?>
                                    <img src="<?php echo base_url($file['file_path']); ?>" width="100" class="img-thumbnail">
                                <?php elseif (preg_match('/\.(pdf)$/', $file['file_name'])): ?>
                                    <a href="<?php echo base_url($file['file_path']); ?>" target="_blank" class="btn btn-info btn-sm">View PDF</a>
                                <?php else: ?>
                                    <span class="text-muted">No preview available</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url($file['file_path']); ?>" download class="btn btn-success btn-sm">Download</a>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-file" data-id="<?php echo $file['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-danger">No files uploaded yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $(".delete-file").click(function () {
                var fileId = $(this).data("id");

                if (confirm("Are you sure you want to delete this file?")) {
                    $.ajax({
                        url: "<?php echo base_url('admin/delete/'); ?>" + fileId,
                        type: "POST",
                        dataType: "json",
                        success: function (response) {
                            if (response.status === "success") {
                                $("#file-" + fileId).fadeOut("slow", function () {
                                    $(this).remove();
                                });
                            } else {
                                alert("Error deleting file.");
                            }
                        },
                        error: function () {
                            alert("Error deleting file.");
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
