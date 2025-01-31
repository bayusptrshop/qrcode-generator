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
            font-size: 35px;
            font-weight: bold;
            margin: 5px 0;
        }

        .header-section {
            font-weight: bold !important;
            font-size: 25px !important;
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
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
            }

            .label-card {
                width: 100%;
                page-break-inside: avoid;
            }

            .table {
                width: 100%;
                border: 1px solid #000;
                padding: 0;
            }

            tr,
            td {
                padding: 0 !important;
                margin: 0 !important;
            }

            @page {
                margin: 60px 20px 20px 20px;
            }
        }
    </style>
</head>

<body onload="window.print();">
    <div class="row justify-content-center g-0">
        @foreach ($data as $label)
            <div class="col-12 text-center mb-1" style="padding-left: 1px; padding-right: 1px;">
                <div class="label-card mb-3" style="margin: 0;">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td colspan="5">
                                    <div class="header-title" style="font-size: 20px !important">TOPY PALINGDA
                                        MANUFACTURING INDONESIA</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div class="header-title">RAW MATERIAL TAG</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div class="header-title" style="font-size: 26px !important">{{ $label->model_name }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="5" colspan="2" class="text-center">
                                    <div class="qr-container mt-2 p-0">
                                        <div class="qr-code mt-2" id="qrcode-{{ $loop->index }}"></div>
                                        <div class="mt-3 header-section" style="font-size: 20px !important">
                                            {{ $label->rm_id }}</div>
                                        <br>
                                    </div>
                                </td>
                                <th colspan="1" style="font-size: 18px">Qty/Pallet</th>
                                <td colspan="3">
                                    <div class="header-section mt-2 ms-1" style="text-align:left !important;">
                                        {{ $label->qty }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="1" style="font-size: 18px">Invoice No</th>
                                <td colspan="3">
                                    <div class="header-section mt-2 ms-1" style="text-align:left !important">
                                        {{ $label->invoice_no }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="1" style="font-size: 18px">Prod Date</th>
                                <td colspan="3">
                                    <div class="header-section mt-2 ms-1" style="text-align:left !important">
                                        {{ $label->prod_date }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="1" style="font-size: 18px">Furnace No</th>
                                <td colspan="3">
                                    <div class="header-section mt-2 ms-1" style="text-align:left !important">
                                        {{ $label->furnace_no }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="1" style="font-size: 18px">Batch No</th>
                                <td colspan="3">
                                    <div class="header-section mt-2 ms-1" style="text-align:left !important">
                                        {{ $label->batch_no }}</div>
                                </td>
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
                width: 220,
                height: 220,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
        });

        window.onbeforeprint = function(event) {
            window.addEventListener('afterprint', function() {
                window.history.back();
            });
        };
    </script>
</body>

</html>
