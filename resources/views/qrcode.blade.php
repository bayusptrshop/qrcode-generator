<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Labels</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .label-card {
            border: 2px solid #000;
            border-radius: 8px;
            padding: 16px;
            margin: 20px;
            text-align: center;
            width: 300px;
            background-color: #fff;
        }
        .qr-code {
            margin-bottom: 10px;
            justify-content: center;
        }
        .label-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .label-attribute {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        .label-attribute div {
            font-weight: bold;
            text-align: left;
        }
        .label-value {
            text-align: right;
        }
    </style>
</head>
<body onload="window.print();">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($data as $label)
                <div class="col-md-4">
                    <div class="label-card">
                        <div class="label-title">RAW MATERIAL TAG</div>
                        <div class="qr-code" id="qrcode-{{ $loop->index }}"></div>
                        <div class="label-attribute">
                            <div>RM ID:</div>
                            <div class="label-value">{{ $label->rm_id }}</div>
                        </div>
                        <div class="label-attribute">
                            <div>Model:</div>
                            <div class="label-value">{{ $label->model_name }}</div>
                        </div>
                        <div class="label-attribute">
                            <div>PO/Invoice No:</div>
                            <div class="label-value">{{ $label->po_no }}</div>
                        </div>
                        <div class="label-attribute">
                            <div>Batch No:</div>
                            <div class="label-value">{{ $label->cus_info_1 }}</div>
                        </div>
                        <div class="label-attribute">
                            <div>Prod No:</div>
                            <div class="label-value">{{ $label->cus_info_2 }}</div>
                        </div>
                        <div class="label-attribute">
                            <div>Qty/pallet:</div>
                            <div class="label-value">{{ $label->qty }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        const labelsData = @json($data);

        labelsData.forEach((label, index) => {
            const qrCodeElement = document.getElementById(`qrcode-${index}`);
            const qrCode = new QRCode(qrCodeElement, {
                text: label.rm_id,
                width: 128,
                height: 128,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
        });
    </script>
</body>
</html>
