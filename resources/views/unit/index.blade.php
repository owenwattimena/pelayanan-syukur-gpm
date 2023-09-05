@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Unit')
@section('subtitle', 'Daftar Unit')

@section('content')
<div class="card">
    <div class="card-body">
        <form class="row g-3">
            <div class="col-auto">
                <select class="form-control" required name="id_sektor">
                    <option value="">---Pilih Sektor---</option>
                    @foreach ($sektor as $item)
                    <option value="{{ $item->id }}" {{ $id_sektor == $item->id ? 'selected' : '' }}>{{ $item->nama_sektor }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Pilih</button>
            </div>
        </form>
        @if (isset($unit))

        <div class="text-end">
            <button class="btn btn-sm mb-5 btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <form action="{{ route('unit.tambah', $id_sektor) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label for="inputNamaUnit" class="form-label">Nama Unit</label>
                                <input type="text" class="form-control" id="inputNamaUnit" name="nama_unit" placeholder="Nama Unit">
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
                        <th>Nama Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unit as $key => $item)
                    <tr>
                        <td>{{ $item->nama_unit }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahUnitModal{{ $item->id }}">Ubah</button>
                            <form action="{{ route('unit.hapus', [$id_sektor, $item->id]) }}" class="d-inline" method="POST">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="ubahUnitModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <form action="{{ route('unit.ubah', [$id_sektor, $item->id]) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Unit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <label for="inputNamaUnit" class="form-label">Nama Unit</label>
                                                <input type="text" class="form-control" id="inputNamaUnit" name="nama_unit" value="{{ $item->nama_unit }}" placeholder="Nama Unit">
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
        @endif

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
