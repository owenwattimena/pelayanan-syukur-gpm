@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Pengurus Sektor')
@section('subtitle', 'Daftar Pengurus Sektor')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-end">
            <button class="btn btn-sm mb-5 btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form action="{{ route('pengurus-sektor.tambah') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Pengurus Sektor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label for="inputNamalengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="inputNamalengkap" name="nama_lengkap" placeholder="Nama Lengkap">
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-12">
                                <label for="inputTelp" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="inputTelp" name="telepon" placeholder="Telepon">
                            </div>
                            <div class="col-md-12">
                                <label for="selectSektor" class="form-label">Sektor</label>
                                <select class="form-control" id="selectSektor" name="sektor">
                                    @foreach ($sektor as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_sektor }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
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
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Sektor</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengurus as $key => $item)
                    <tr>
                        <td>{{ $item->admin->nama_lengkap }}</td>
                        <td>{{ $item->admin->email }}</td>
                        <td>{{ $item->admin->telepon }}</td>
                        <td>{{ $item->sektor->nama_sektor }}</td>
                        <td>{{ $item->admin->username }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#ubahSektorModal{{ $item->id }}">Ubah</button>
                            <form action="{{ route('pengurus-sektor.hapus', $item->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="ubahSektorModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <form action="{{ route('pengurus-sektor.ubah', $item->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Pengurus Sektor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <label for="inputNamalengkap" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="inputNamalengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="{{ $item->admin->nama_lengkap }}" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="{{ $item->admin->email }}" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputTelp" class="form-label">Telepon</label>
                                                <input type="text" class="form-control" id="inputTelp" name="telepon" placeholder="Telepon" value="{{ $item->admin->telepon }}" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="selectSektor" class="form-label">Sektor</label>
                                                <select class="form-control" id="selectSektor" name="sektor">
                                                    @foreach ($sektor as $itemSektor)
                                                    <option value="{{ $itemSektor->id }}" {{ $itemSektor->id == $item->id_sektor ? 'selected' : '' }}>{{ $itemSektor->nama_sektor }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputUsername" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="{{ $item->admin->username }}">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
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
