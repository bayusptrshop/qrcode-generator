@include('layouts.header')
<title>List</title>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
    .dataTables_wrapper {
        overflow-x: auto;
    }
</style>
</head>

<body>
    @include('layouts.navbar')
    <div class="p-4">
        <h2 class="mb-4">Data Raw Material</h2>
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

            const rows = document.querySelectorAll('.clickable-row');

            rows.forEach(row => {
                row.addEventListener('click', function() {
                    const checkbox = row.querySelector('.rm-checkbox');
                    checkbox.checked = !checkbox.checked;
                    updateButtonStatus();
                });
            });
        });
    </script>
</body>

</html>
