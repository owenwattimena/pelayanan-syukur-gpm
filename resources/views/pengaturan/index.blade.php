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
