@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Home')
@section('subtitle', 'Selamat datang ' . auth()->user()->nama_lengkap)

@section('content')
@if(auth()->guard('admin')->user()->role == 'admin_jemaat')
<div class="card radius-10">
    <div class="card-content">
        <div class="row row-group row-cols-1 row-cols-xl-4">
            <div class="col">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Sektor</p>
                            <h4 class="mb-0 text-secondary">{{$totalSektor}}</h4>
                        </div>
                        <div class="ms-auto"><i class="bx bx-map-alt font-35 text-secondary"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 my-2" style="height:4px;">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
                    </div>
                    <p class="mb-0 font-13">Data total sektor dalam jemaat</p>
                </div>
            </div>
            <div class="col">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Unit</p>
                            <h4 class="mb-0 text-secondary">{{$totalUnit}}</h4>
                        </div>
                        <div class="ms-auto"><i class="bx bx-grid font-35 text-secondary"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 my-2" style="height:4px;">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
                    </div>
                    <p class="mb-0 font-13">Data total unit dalam jemaat</p>
                </div>
            </div>
            <div class="col">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Pengurus Sektor</p>
                            <h4 class="mb-0 text-secondary">{{$totalPengurusSektor}}</h4>
                        </div>
                        <div class="ms-auto"><i class="bx bx-user font-35 text-secondary"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 my-2" style="height:4px;">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
                    </div>
                    <p class="mb-0 font-13">Data total pengurus sektor dalam jemaat</p>
                </div>
            </div>
            <div class="col">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Pengurus Unit</p>
                            <h4 class="mb-0 text-secondary">{{$totalPengurusUnit}}</h4>
                        </div>
                        <div class="ms-auto"><i class="bx bx-male font-35 text-secondary"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 my-2" style="height:4px;">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
                    </div>
                    <p class="mb-0 font-13">Data total pengurus unit dalam jemaat</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-xl-6">
<div class="card radius-10">
    <div class="card-content">
            <div class="row row-group row-cols-1 row-cols-xl-2">
                <div class="col">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Total Unit Sektor</p>
                                <h4 class="mb-0 text-secondary">{{$totalUnit}}</h4>
                            </div>
                            <div class="ms-auto"><i class="bx bx-grid font-35 text-secondary"></i>
                            </div>
                        </div>
                        <div class="progress radius-10 my-2" style="height:4px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
                        </div>
                        <p class="mb-0 font-13">Data total sektor dalam jemaat</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Pengurus Unit</p>
                                <h4 class="mb-0 text-secondary">{{$totalPengurusUnit}}</h4>
                            </div>
                            <div class="ms-auto"><i class="bx bx-male font-35 text-secondary"></i>
                            </div>
                        </div>
                        <div class="progress radius-10 my-2" style="height:4px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
                        </div>
                        <p class="mb-0 font-13">Data total pengurus unit dalam jemaat</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>
    @endif
</div>
@endsection

@section('script')
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
{{-- <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script> --}}
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });

</script>
{{-- <script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyBWCXlRXEfUve5EeSiGXC5Y6xNna8BaESQ"
        , authDomain: "pelayanan-syukur-gpm.firebaseapp.com"
        , projectId: "pelayanan-syukur-gpm"
        , storageBucket: "pelayanan-syukur-gpm.appspot.com"
        , messagingSenderId: "919821735283"
        , appId: "1:919821735283:web:805540052993253632e106"
        , measurementId: "G-NEKRCJTRCV"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("updateFcmToken") }}'
                    , type: 'PUT'
                    , data: {
                        token: response
                    }
                    , dataType: 'JSON'
                    , success: function(response) {
                        alert('Token stored.');
                    }
                    , error: function(error) {
                        alert(error);
                    }
                , });
            }).catch(function(error) {
                alert(error);
            });
    }
    startFCM();
</script> --}}
@endsection

