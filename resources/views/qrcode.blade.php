<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Labels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .label-card {
            border: 2px solid #000;
            border-radius: 8px;
            padding: 0;
            margin: 0;
            text-align: center;
            background-color: #fff;
        }

        .qr-code {
            margin: 0 auto;
        }

        .qr-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            margin: 5px 0;
        }

        .header-section {
            font-weight: bold;
        }

        td {
            font-size: 12px !important;
            padding: 0;
        }

        th {
            padding: 0;
        }

        .table {
            border: 1px solid #000;
            margin-bottom: 0;
        }

        tr {
            border-bottom: 1px solid #000;
        }

        @media print {
            body {
                margin-left: 20px !important;
                margin-top: 20px !important;
                margin-bottom: 20px !important;
                padding: 0;
                font-size: 12px;
            }

            .container {
                width: 100%;
            }

            .label-card {
                width: 95%;
                page-break-inside: avoid;
            }

            .table {
                width: 100%;
                border: 1px solid #000;
                padding: 0;
            }

            tr, td {
                padding: 0 !important;
                margin: 0 !important;
            }

            @page {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print();">
    <div class="row justify-content-center g-0">
        @foreach ($data as $label)
            <div class="col-6 text-center mb-1" style="padding-left: 1px; padding-right: 1px;">
                <div class="label-card mb-3" style="margin: 0;">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <div class="header-title">RAW MATERIAL TAG</div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2" class="text-center">
                                    <div class="qr-container mt-2">
                                        <div class="qr-code" id="qrcode-{{ $loop->index }}"></div>
                                        <div class="mt-2 header-section">{{ $label->rm_id }}</div>
                                    </div>
                                </td>
                                <th>Model</th>
                                <td>{{ $label->model_name }}</td>
                            </tr>
                            <tr>
                                <th>PO/Invoice No</th>
                                <td>{{ $label->po_no }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="header-section mt-1">Qty/pallet</div>
                                </td>
                                <th>Batch No</th>
                                <td>{{ $label->cus_info_1 }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="header-section mt-1">{{ $label->qty }}</div>
                                </td>
                                <th>Prod No</th>
                                <td>{{ $label->cus_info_2 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        const labelsData = @json($data);

        labelsData.forEach((label, index) => {
            const qrCodeElement = document.getElementById(`qrcode-${index}`);
            const qrCode = new QRCode(qrCodeElement, {
                text: label.rm_id,
                width: 100,
                height: 100,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
        });
    </script>
</body>

</html>
