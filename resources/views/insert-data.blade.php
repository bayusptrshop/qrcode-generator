<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <title>Import Excel File - TPMI</title>
    <style>
         .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .alert-success {
        background-color: #4CAF50;
        color: white;
    }
    .alert-danger {
        background-color: #f44336;
        color: white;
    }
        body {
            background-image: url('{{ asset("storage/gambar1.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .frame {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .upload-container {
            width: 400px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .title h1 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .dropzone {
            border: 2px dashed #007bff;
            padding: 30px;
            border-radius: 5px;
            cursor: pointer;
            position: relative;
            background: #f1f8ff;
            text-align: center;
        }

        .dropzone.dragover {
            background: #e0e7ff;
        }

        .dropzone input {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .dropzone img {
            width: 50px;
            margin-bottom: 10px;
        }

        .btn-upload {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-upload:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')


    <div class="frame">
        <div class="upload-container">
            <div class="title">
                <h1>Drop file to upload</h1>
            </div>

            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="dropzone">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7f/Cloud_upload_font_awesome.svg/1200px-Cloud_upload_font_awesome.svg.png" class="upload-icon" />
                    <input type="file" id="file" name="file" accept=".xlsx" required style="opacity: 0; position: absolute; width: 100%; height: 100%; cursor: pointer;">
                    <p class="upload-message">Click or Drag & Drop to Upload</p>
                    <p id="file-name" class="file-name hidden"></p>
                </div>

                <button type="submit" class="btn btn-upload mt-3">Upload File</button>
            </form>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        const dropzone = document.querySelector('.dropzone');
        const fileInput = document.querySelector('#file');
        const fileNameDisplay = document.querySelector('#file-name');
        const uploadMessage = document.querySelector('.upload-message');

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('dragover');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files;
                fileNameDisplay.textContent = files[0].name;
                fileNameDisplay.classList.remove('hidden');
                uploadMessage.classList.add('hidden');
            } else {
                uploadMessage.classList.remove('hidden');
                fileNameDisplay.classList.add('hidden');
            }
        });
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                fileNameDisplay.textContent = fileInput.files[0].name;
                fileNameDisplay.classList.remove('hidden');
                uploadMessage.classList.add('hidden');
            } else {
                uploadMessage.classList.remove('hidden');
                fileNameDisplay.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
