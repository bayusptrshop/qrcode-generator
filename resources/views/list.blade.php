@include('layouts.header')
<title>List</title>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
    .dataTables_wrapper {
        overflow-x: auto;
    }
    body {
            margin-top: 20px;
            background: #FFF5EE;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .avatar.sm {
            width: 2.25rem;
            height: 2.25rem;
            font-size: .818125rem;
        }

        .table-nowrap .table td,
        .table-nowrap .table th {
            white-space: nowrap;
        }

        .table>:not(caption)>*>* {
            padding: 0.75rem 1.25rem;
            border-bottom-width: 1px;
        }

        table th {
            font-weight: 600;
            background-color: #eeecfd !important;
        }

        .fa-arrow-up {
            color: #00CED1;
        }

        .fa-arrow-down {
            color:rgb(255, 238, 0);
        }
        body {
    background-color: #ADD8E6; /* LightBlue */
}



</style>
</head>

<body>
    @include('layouts.navbar')
    <div class="p-4">
        <h2 class="mb-4">Data Raw Material</h2>
        <div class="row align-items-center mb-5">
            <div class="col-auto">
                <label for="invoice_no">Invoice No</label>
                <select id="invoice_no" name="invoice_no" class="form-select">
                    <option value="">All</option>
                    @foreach ($invoices as $invoice)
                        <option value="{{ $invoice }}" {{ request('invoice_no') == $invoice ? 'selected' : '' }}>{{ $invoice }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label for="item_name">Item Name</label>
                <select id="item_name" name="item_name" class="form-select">
                    <option value="">All</option>
                    @foreach ($items as $item)
                        <option value="{{ $item }}" {{ request('item_name') == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label for="created_at">Created At</label>
                <input type="date" value="{{ request('created_at') ?? '' }}" id="created_at" name="created_at" class="form-control">
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger mt-4" onclick="resetButton()">Reset</button>
                <button type="button" class="btn btn-primary mt-4" onclick="filterButton()">Filter</button>
            </div>
        </div>
        <button type="button" class="btn btn-primary mb-3" id="printButton">Print</button>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>RM ID</th>
                    <th>Item Name</th>
                    <th>Invoice No</th>
                    <th>Qty</th>
                    <th>Production Date</th>
                    <th>Furnace No</th>
                    <th>Batch No</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="clickable-row" data-id="{{ $item->rm_id }}">
                        <td><input type="checkbox" class="rm-checkbox" name="rm_ids[]" value="{{ $item->rm_id }}">
                        </td>
                        <td>{{ $item->rm_id }}</td>
                        <td>{{ $item->model_name }}</td>
                        <td>{{ $item->invoice_no }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->prod_date }}</td>
                        <td>{{ $item->furnace_no ?? '-' }}</td>
                        <td>{{ $item->batch_no }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "pageLength": 10,
                "scrollX": true
            });
            const updateButtonStatus = () => {
                const selectedCheckboxes = document.querySelectorAll('input[name="rm_ids[]"]:checked');
                const printButton = document.getElementById('printButton');
                printButton.disabled = selectedCheckboxes.length === 0;
            };

            updateButtonStatus();
            $('.rm-checkbox').on('change', function() {
                updateButtonStatus();
            });
            document.getElementById('printButton').addEventListener('click', function() {
                const selectedCheckboxes = document.querySelectorAll('input[name="rm_ids[]"]:checked');
                let selectedIds = [];

                selectedCheckboxes.forEach((checkbox) => {
                    selectedIds.push(checkbox.value);
                });
                const rmIdsParam = selectedIds.join(',');
                const url = "{{ route('qrcode.generate') }}";
                const redirectUrl = url + '?rmid=' +
                    rmIdsParam;
                window.location.href = redirectUrl;
            });

            const tbody = document.querySelector('#example tbody');

            tbody.addEventListener('click', function(event) {
                const row = event.target.closest('.clickable-row');
                if (row) {
                    const checkbox = row.querySelector('.rm-checkbox');
                    checkbox.checked = !checkbox.checked;
                    updateButtonStatus();
                }
            });
        });

        function filterButton() {
            const invoiceNo = document.getElementById('invoice_no').value;
            const itemName = document.getElementById('item_name').value;
            const createdAt = document.getElementById('created_at').value;
            const url = "{{ route('list.data') }}";
            const redirectUrl = url + '?invoice_no=' + invoiceNo + '&item_name=' + itemName + '&created_at=' + createdAt;
            window.location.href = redirectUrl;
        }

        function resetButton() {
            const url = "{{ route('list.data') }}";
            window.location.href = url;
        }
    </script>
</body>

</html>
