@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Jemaat')
@section('subtitle', 'Daftar Jemaat')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-end">
            <button class="btn btn-sm mb-5 btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('jemaat.tambah') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Kelahiran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label for="inputNoKK" class="form-label">No KK</label>
                                <input type="text" class="form-control" id="inputNoKK" name="no_kk" placeholder="Nomor KK" required>
                            </div>
                            <div class="col-md-12">
                                <label for="inputNamaLengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="inputNamaLengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-12">
                                <label for="selectStatusKeluarga" class="form-label">Status Keluarga</label>
                                <select type="date" class="form-control" id="selectStatusKeluarga" name="status_keluarga" required>
                                    @foreach (["Kepala keluarga", "Istri", "Suami", "Anak", "Cucu", "Keponakan", "Orang Tua", "Mertua", "Menantu", "Kakak", "Adik", "Ipar", "Om/Tente", "Sepupu", "Keluarga Lain", "Penghuni Kost", "Lainnya"] as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="selectJenisKelamin" class="form-label">Jenis Kelamin</label>
                                <select type="date" class="form-control" id="selectJenisKelamin" name="jenis_kelamin" required>
                                    @foreach (["Laki-laki", "Perempuan"] as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputTempatLahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="inputTempatLahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                            </div>
                            <div class="col-md-12">
                                <label for="inputTanggalLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="inputTanggalLahir" name="tanggal_lahir" placeholder="Tanggal" required>
                            </div>
                            <div class="col-md-12">
                                <label for="selectStatusDomisili" class="form-label">Status Domisili</label>
                                <select type="date" class="form-control" id="selectStatusDomisili" name="status_domisili" required>
                                    @foreach (["Aggota tetap GPM", "Anggota tidak tetap GPM"] as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="selectStatusMenikah" class="form-label">Status Menikah</label>
                                <select type="date" class="form-control" id="selectStatusMenikah" name="status_menikah" required>
                                    @foreach (["Belum Menikah", "Menikah"] as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputTanggalMenikah" class="form-label">Tanggal Menikah</label>
                                <input type="date" class="form-control" id="inputTanggalMenikah" name="tanggal_menikah" placeholder="Tanggal">
                            </div>
                            <div class="col-md-12">
                                <label for="inputAlamat" class="form-label">Alamat</label>
                                <textarea type="text" class="form-control" id="inputAlamat" name="alamat" placeholder="Alamat" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="selectIdUnit" class="form-label">Unit</label>
                                <select type="date" class="form-control" id="selectIdUnit" name="id_unit" required>
                                    @foreach ($unit as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_unit }}</option>
                                    @endforeach
                                </select>
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
                        <th>No</th>
                        <th>No KK</th>
                        <th>Nama Lengkap</th>
                        <th>Status Keluarga</th>
                        <th>Jenis Kelamin</th>
                        <th>TTL</th>
                        <th>Status Domisili</th>
                        <th>Status Menikah</th>
                        <th>Tanggal Menikah</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([] as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jam }}</td>
                            <td>{{ $item->unit->nama_unit }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm text-end"><i class="bx bx-trash"></i></button>
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
