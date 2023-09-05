@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Unit')
@section('subtitle', 'Daftar Unit')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-end">
            <button class="btn btn-sm mb-5 btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <form action="{{ route('sektor.tambah') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Sektor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label for="inputNamaSektor" class="form-label">Nama Sektor</label>
                                <input type="text" class="form-control" id="inputNamaSektor" name="nama_sektor" placeholder="Nama Sektor">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Sektor</th>
                        <th>Jumlah Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sektor as $key => $item)
                    <tr>
                        <td>{{ $item->nama_sektor }}</td>
                        <td>{{ $item->unit->count() }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#ubahSektorModal{{ $item->id }}">Ubah</button>
                            <form action="{{ route('sektor.hapus', $item->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="ubahSektorModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <form action="{{ route('sektor.ubah', $item->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Sektor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <label for="inputNamaSektor" class="form-label">Nama Sektor</label>
                                                <input type="text" class="form-control" id="inputNamaSektor" name="nama_sektor" value="{{ $item->nama_sektor }}" placeholder="Nama Sektor">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
