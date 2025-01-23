<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('insert-data') ? 'active' : '' }} text-secondary" href="{{ route('insert.excel') }}">Insert Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('list-data') ? 'active' : '' }}" href="{{ route('list.data') }}">List Data</a>
                </li>
            </ul>
            <button class="btn btn-outline-danger" onclick="logout()">Logout</button>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function logout() {
        Swal.fire({
            title: "Are you sure?",
            text: "When you log out, you will be redirected to the login page.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }
</script>
