<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" />

    <style>
        .image-preview-container input {
            display: none;
        }
        .zoom:hover {
            transform: scale(2.5);
        }
    </style>
</head>
<body>
<br>
<div class="image-preview-container text-center">
    <div  class="col-md-12">
        <div onclick="document.getElementById('maintenance_img').click();" class="preview" style="border: 1px solid black;width: 150px;height: 200px;margin: 0 auto 5px auto">
            <img  src="noImageSelected.jpg" style="width: 100%;height: 100%;transition: transform 0.3s;"  class="" id="preview-selected-image"/>
        </div>
    </div>
    <button onclick="removeSelectedImage();" class="btn btn-primary">Remove</button>
    <form method="post" action="" enctype="multipart/form-data"
          id="myform">
        <input type="file" data-selected_image="" id="maintenance_img" accept="image/*" onchange="uploadImage(event);/*previewImage(event)*/;"/>
    </form>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>
<script>
    function uploadImage(event) {
        var fd = new FormData();
        var image = $('#maintenance_img')[0].files[0];
        fd.append('image', image);

        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#preview-selected-image').attr('src','loading.gif');
            },
            success: function (response) {
                try{
                    const obj = JSON.parse(response);
                    if (obj.status == true) {
                        $('#maintenance_img').data('selected_image',obj.fileName);
                        previewImage(event);
                    } else {
                        $('#maintenance_img').data('selected_image','');
                        $('#preview-selected-image').attr('src','noImageSelected.jpg');
                        alert(obj.msg);
                    }
                }catch (e) {
                    $('#maintenance_img').data('selected_image','');
                    $('#preview-selected-image').attr('src','noImageSelected.jpg');
                    alert("Something went wrong!\nPlease Try again!");
                }
            },
            error:function () {
                $('#maintenance_img').data('selected_image','');
                $('#preview-selected-image').attr('src','noImageSelected.jpg');
                alert("Please try again!");
            }
        });
    }

    const previewImage = (event) => {
        /**
         * Get the selected files.
         */
        const imageFiles = event.target.files;
        /**
         * Count the number of files selected.
         */
        const imageFilesLength = imageFiles.length;
        /**
         * If at least one image is selected, then proceed to display the preview.
         */
        if (imageFilesLength > 0) {
            /**
             * Get the image path.
             */
            const imageSrc = URL.createObjectURL(imageFiles[0]);
            /**
             * Select the image preview element.
             */
            const imagePreviewElement = document.querySelector("#preview-selected-image");
            /**
             * Assign the path to the image preview element.
             */
            imagePreviewElement.src = imageSrc;
            /**
             * Show the element by changing the display value to "block".
             */
            imagePreviewElement.style.display = "block";

        }
    };

    function removeSelectedImage() {
        $('#preview-selected-image').attr('src','noImageSelected.jpg');
    }
</script>