@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Pengaturan')
@section('subtitle', 'Data pengaturan')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('pengaturan.save') }}" method="POST">
            @csrf
            <div class="col-md-12">
                <label for="inputPengaturan" class="form-label">Nama Jemaat</label>
                <input class="form-control" id="inputPengaturan" name="nama_jemaat" required value="{{ $pengaturan->nama_jemaat ?? '' }}">
            </div>
            <div class="col-md-12">
                <label for="inputWaktuNotif" class="form-label">Waktu Notifikasi</label>
                <br>
                <small>* = setiap menit, Notif jam 5 sore = 17:00</small>
                <input class="form-control" id="inputWaktuNotif" name="waktu_notifikasi" value="{{ $pengaturan->waktu_notifikasi ?? '' }}" placeholder="Masukan salah satu format">
            </div>
            <div class="col-md-12">
                <label for="inputDurasiNotif" class="form-label">Durasi Notifikasi</label>
                <br>
                <small>Masukan durasi hari notifkasi. Pisahkan dengan tanda (,). Cth : 7,3,1</small>
                <input class="form-control" id="inputDurasiNotif" name="durasi_notifikasi" value="{{ $pengaturan->durasi_notifikasi ?? '' }}" placeholder="Masukan durasi notifikasi">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>

<script>

</script>
@endsection
