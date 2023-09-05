@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Pengurus Unit')
@section('subtitle', 'Daftar Pengurus Unit')

@section('content')
<div class="card">
    <div class="card-body">

        <div class="text-end">
            <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPengurusModal">Tambah</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="tambahPengurusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengurus Unit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengurus-unit.simpan') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="inputNama" class="form-label">Nama Lengkap</label>
                                <input required type="text" class="form-control" id="inputNama" name="nama_lengkap">
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input required type="email" class="form-control" id="inputEmail" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="inputTelp" class="form-label">No. Telp</label>
                                <input required type="text" class="form-control" id="inputTelp" name="telepon">
                            </div>
                            <div class="mb-3">
                                <label for="selectUnit" class="form-label">Unit</label>
                                <select required class="form-control" id="selectUnit" name="id_unit">
                                    @foreach ($unit as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="inputUsername" class="form-label">Username</label>
                                <input required type="text" class="form-control" id="inputUsername" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input required type="password" class="form-control" id="inputPassword" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                        {{-- <th>Verifikasi</th> --}}
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
                        {{-- <td>
                            <span class="badge bg-gradient-{{ $user->email_verified_at ? "quepal" : "bloody" }} text-white shadow-sm w-100">{{ $user->email_verified_at ? "Terverifikasi" : "Belum Diverifikasi" }}</span>
                        </td> --}}
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahPengurusModal{{ $user->id }}">Ubah</button>
                            {{-- @if (!$user->email_verified_at)

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
                            @endif --}}
                            <!-- Modal -->
                            <div class="modal fade" id="ubahPengurusModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Pengurus Unit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pengurus-unit.ubah', $user->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="mb-3">
                                                    <label for="inputNama" class="form-label">Nama Lengkap</label>
                                                    <input required type="text" class="form-control" id="inputNama" name="nama_lengkap" value="{{ $user->nama_lengkap }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputEmail" class="form-label">Email</label>
                                                    <input required type="email" class="form-control" id="inputEmail" name="email" value="{{ $user->email }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputTelp" class="form-label">No. Telp</label>
                                                    <input required type="text" class="form-control" id="inputTelp" name="telepon" value="{{ $user->telepon }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="selectUnit" class="form-label">Unit</label>
                                                    <select required class="form-control" id="selectUnit" name="id_unit">
                                                        @foreach ($unit as $itemUnit)
                                                        <option value="{{ $itemUnit->id }}" {{ $itemUnit->id == $user->id_unit ? 'selected' : '' }}>{{ $itemUnit->nama_unit }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="inputUsername" class="form-label">Username</label>
                                                    <input required type="text" class="form-control" id="inputUsername" name="username" value="{{ $user->username }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inputPassword" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="inputPassword" name="password">
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <form action="{{ route('pengurus-unit.hapus', $user->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
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
