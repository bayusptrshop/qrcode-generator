@include('layouts.header')
<title>Log in - TPMI</title>
<style>
    body {
        background-image: url('{{ asset("storage/gambar2.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    .h-custom {
        height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
    .form-label,
    .divider p,
    .form-check-label {
        color: white !important;
    }
</style>
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('storage/logo.png') }}" class="img-fluid" alt="TPMI Logo">
                    <h3 style="color: white;">PT. TOPY PALINGDA MANUFACTURING INDONESIA</h3>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Log in</p>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="user_code">User Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="user_code" id="user_code" placeholder="Please enter your user code" required>
                        </div>
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Please enter your password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="remember_me">
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>
                            <a href="#" class="text-body">Forgot password?</a>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Log in now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
</body>
</html>
