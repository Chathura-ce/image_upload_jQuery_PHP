<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
        h1 {
            margin: 0 auto;
            margin-top: 5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .image-preview-container {
            width: 50%;
            margin: 0 auto;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 3rem;
            border-radius: 20px;
        }

        .image-preview-container img {
            width: 50%;
            display: none;
            margin-bottom: 30px;
            transition: transform 0.25s;
        }

        .image-preview-container input {
            display: none;
        }

        .image-preview-container .action-btn-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-preview-container .action-btn {
            display: block;
            width: 45%;
            height: 45px;
            margin-left: 5%;
            text-align: center;
            background: #8338ec;
            color: #fff;
            font-size: 15px;
            text-transform: Uppercase;
            font-weight: 400;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .zoom:hover {
            transform: scale(2.5);  
        }
    </style>
</head>
<body>
<h1>Preview an Image Before Uploading Using JavaScript</h1>
<div class="image-preview-container">
    <div class="preview">
        <img style=""  class="zoom" id="preview-selected-image"/>
    </div>

    <div class="action-btn-container">
        <label class="action-btn" for="maintenance_img">Select Image</label>
        <label id="but_upload" class="action-btn">Upload Image</label>
        <label class="action-btn">Remove Image</label>
    </div>
    <form method="post" action="" enctype="multipart/form-data"
          id="myform">
        <input type="file" id="maintenance_img" accept="image/*" onchange="previewImage(event);"/>
    </form>
</div>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>
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

    $("#but_upload").click(function () {
        var fd = new FormData();
        var image = $('#maintenance_img')[0].files[0];
        fd.append('image', image);

        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    alert('file uploaded');
                } else {
                    alert('file not uploaded');
                }
            },
        });
    });
</script>