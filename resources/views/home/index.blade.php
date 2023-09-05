@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Home')
@section('subtitle', 'Selamat datang ' . auth()->user()->nama_lengkap)

@section('content')
{{-- <div class="card">
    <div class="card-body">

    </div>
</div> --}}
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

