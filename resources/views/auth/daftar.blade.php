
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>Amdash - Bootstrap 5 Admin Template</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">
						<div class="my-4 text-center">
							<img src="assets/images/logo-img.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">DAFTAR</h3>
										<p>Sudah punya akun? <a href="{{ route('masuk') }}">Masuk di sini</a>
										</p>
									</div>
									<div class="form-body">
                                        @if(session('alert'))
                                        <div class="alert alert-{{ session('alert')['type'] }} border-0 bg-{{ session('alert')['type'] }} alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-white"><i class='bx bx-{{ session('alert')['type'] == 'danger' ? 'error-alt' : 'check' }}'></i>
                                                </div>
                                                <div class="ms-3">
                                                    {{-- <h6 class="mb-0 text-white">Primary Alerts</h6> --}}
                                                    <div class="text-white">{{ session('alert')['message'] }}</div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
										<form action="{{ route('daftar.proses') }}" class="row g-3" method="POST">
                                            @csrf
											<div class="col-sm-12">
												<label for="inputNama" class="form-label">Nama Lengkap</label>
												<input required type="text" class="form-control" id="inputNama" name="nama_lengkap" placeholder="Nama Lengkap">
											</div>
											<div class="col-12">
												<label for="inputEmail" class="form-label">Email</label>
												<input required type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
											</div>
											<div class="col-12">
												<label for="inputTelp" class="form-label">No. Telepon</label>
												<input required type="tel" class="form-control" id="inputTelp" name="telepon" placeholder="No. Telepon">
											</div>
											{{-- <div class="col-12">
												<label for="inputSektor" class="form-label">Sektor</label>
												<input required type="text" class="form-control" id="inputSektor" name="sektor" placeholder="Sektor">
											</div> --}}
                                            <div class="mb-3">
                                                <label class="form-label">Sektor</label>
                                                <select class="single-select" name="sektor">
                                                    @foreach ($sektor as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_sektor }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
											<div class="col-12">
												<label for="inputUsername" class="form-label">Username</label>
												<input required type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input required type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											{{-- <div class="col-12">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
													<label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
												</div>
											</div> --}}
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>DAFTAR</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
	<!--Password show & hide js -->
	<script>
        $('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
            tags: true
		});
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>
