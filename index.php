<!DOCTYPE html>
<html>
<head>
    <title>BlackVault - Anonymous File Sharing</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var progressBar = $('.progress-bar');
            var progressBarContainer = $('.progress-bar-container');
            var copyUrlButton = $('.copy-url-button');
            var uploadCopyUrl = $('.upload-copy-url');

            $('.upload-button').click(function() {
                $('#file').trigger('click');
            });

            $('#file').change(function() {
                var files = this.files;
                uploadFiles(files);
            });

            // Enable drag and drop functionality
            var dropZone = $('.upload-container');
            dropZone.on('dragover', handleDragOver);
            dropZone.on('drop', handleFileDrop);

            // Handle file drag over event
            function handleDragOver(event) {
                event.preventDefault();
                event.stopPropagation();
                dropZone.addClass('drag-over');
            }

            // Handle file drop event
            function handleFileDrop(event) {
                event.preventDefault();
                event.stopPropagation();
                dropZone.removeClass('drag-over');

                var files = event.originalEvent.dataTransfer.files;
                uploadFiles(files);
            }

            // Upload files
            function uploadFiles(files) {
                var formData = new FormData();
                $.each(files, function(index, file) {
                    formData.append('file[]', file);
                });

                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                var percent = Math.round((e.loaded / e.total) * 100);
                                progressBar.width(percent + '%');
                                progressBar.text(percent + '%');
                            }
                        });
                        return xhr;
                    },
                    beforeSend: function() {
                        progressBarContainer.show();
                    },
                    success: function(data) {
                        progressBarContainer.hide();
                        uploadCopyUrl.find('.upload-copy-url-input').val(data);
                        uploadCopyUrl.show();
                    },

                    error: function() {
                        progressBarContainer.hide();
                        alert('Error uploading files.');
                    }
                });
            }

            copyUrlButton.click(function() {
                uploadCopyUrl.select();
                document.execCommand('copy');
                alert('URL copied to clipboard.');
            });
        });
    </script>
</head>
<body>
    <header>
        <h1>BlackVault</h1>
    </header>

    <main>
        <div class="upload-container">
            <label class="upload-button">
                <span class="drag-drop-text">Upload Files</span>
                <input type="file" name="file[]" id="file" multiple style="display: none;">
            </label>
        </div>
        <div class="progress-bar-container">
            <div class="progress-bar"></div>
        </div>
        <div class="input-group upload-copy-url" style="display: none;">
            <input type="text" class="upload-copy-url-input" readonly>
            <button type="button" class="copy-url-button">Copy URL</button>
        </div>
        <p>Donations:</p>
        <p1>Bitcoin:</p1>
        <code class="btc-address-box center-block text-center" style="word-break: break-all; margin-bottom:10px;">bc1q3wfudu39vyslk3cd7kn7a7k4y0gj0wwwd22wzq</code>
        <p2>Monero:</p2>
        <code class="monero-address-box center-block text-center" style="word-break: break-all; margin-bottom:10px;">4AT8oUR472o7tLMoppuX37VKoUKoAfMA8eAysjpsat2N4TGoY3zDBFueUF641uXpXKGaSA8M5NkmHXiuB7rdyQ7tCLk1XRG</code>
        <hr class="line-separator"> <!-- Line separator -->
        <div class="content">
            <a href="termsofuse.php">Terms Of Use</a>
        </div>
    </main>
</body>
</html>
