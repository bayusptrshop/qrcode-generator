<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Labels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-size: 11px;
        }

        .label-card {
            /* border: 1px solid #000; */
            border-radius: 5px;
            padding: 0;
            margin: 2px;
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
            font-size: 16px;
            font-weight: bold;
            margin: 2px 0;
        }

        .header-section {
            font-weight: bold !important;
            font-size: 17px !important;
        }

        td,
        th {
            padding: 1px !important;
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
                width: 99%;
                padding: 0;
            }

            .label-card {
                margin-top: 5px;
                margin-left: 0;
                width: 99%;
                page-break-inside: avoid;
            }

            .table {
                width: 99%;
                height: 99%;
                border-spacing: 5px;
            }

            @page {
                size: A4 portrait;
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print();">
    <div class="row g-0">
        @foreach ($data as $label)
            <div class="col-6 text-center">
                <div class="label-card mb-2">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td colspan="5" class="header-title">TOPY PALINGDA MANUFACTURING INDONESIA</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="header-title" style="font-size: 21px !important">RAW MATERIAL
                                    TAG</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="header-title" style="font-size: 21px !important">
                                    {{ $label->model_name }}</td>
                            </tr>
                            <tr>
                                <td rowspan="5" colspan="2" class="text-center p-2">
                                    <div class="qr-container">
                                        <div class="qr-code" id="qrcode-{{ $loop->index }}"></div>
                                        <div class="header-section" style="font-size: 17px !important;">
                                            {{ $label->rm_id }}</div>
                                    </div>
                                </td>
                                <th colspan="1" style="font-size: 17px">Qty/Pallet</th>
                                <td colspan="3" style="font-size: 17px">{{ $label->qty }}</td>
                            </tr>
                            <tr>
                                <th colspan="1" style="font-size: 17px">Invoice No</th>
                                <td colspan="3" style="font-size: 17px">{{ $label->invoice_no }}</td>
                            </tr>
                            <tr>
                                <th colspan="4" style="font-size: 17px" rowspan="2">
                                    Heat No
                                    <p>
                                        {{ $label->furnace_no }}
                                        lorem ipsum dolor sit amet
                                    </p>
                                </th>
                                {{-- <td colspan="3" style="font-size: 17px">{{ $label->furnace_no }}</td> --}}
                            </tr>
                            <tr>
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
            new QRCode(document.getElementById(`qrcode-${index}`), {
                text: label.rm_id,
                width: 120,
                height: 120,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
        });

        window.onbeforeprint = function() {
            window.addEventListener('afterprint', function() {
                window.history.back();
            });
        };
    </script>
</body>

</html>
