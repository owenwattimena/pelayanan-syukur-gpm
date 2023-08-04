@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Verifikasi')
@section('subtitle', 'Daftar Verifikasi Pengurus Unit')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Sektor</th>
                        <th>Unit</th>
                        <th>Username</th>
                        <th>Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telepon }}</td>
                        <td>{{ $user->unit->first()->sektor->nama_sektor }}</td>
                        <td>{{ $user->unit->first()->nama_unit }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <span class="badge bg-gradient-{{ $user->email_verified_at ? "quepal" : "bloody" }} text-white shadow-sm w-100">{{ $user->email_verified_at ? "Terverifikasi" : "Belum Diverifikasi" }}</span>
                        </td>
                        <td>
                            @if (!$user->email_verified_at)

                            <form action="{{ route('verifikasi.terima') }}" class="d-inline" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button class="btn badge bg-success btn-sm radius-30" onclick="return confirm('Yakin ingin menerima data?')">TERIMA</button>
                            </form>
                            <form action="{{ route('verifikasi.tolak') }}" class="d-inline" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button class="btn badge bg-danger btn-sm radius-30" onclick="return confirm('Yakin ingin menolak data?\nData yang ditolak akan terhapus')">TOLAK</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@endsection
