@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Pelayanan Pernikahan')
@section('subtitle', 'Daftar Pelayanan Pernikahan')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="">
                <div class="input-group w-30 mb-3">
                    <select class="form-control" name="month">
                        @for($i=1; $i<=12; $i++)
                        <option value="{{$i}}" {{$i==$month? 'selected' :''}}>{{$i}}</option>
                        @endfor
                    </select>
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Pria</th>
                        <th>Nama Wanita</th>
                        <th>Tanggal Pernikahan</th>
                        <th>Unit</th>
                        <th>Alamat</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pernikahan as $item)
                    <tr>
                        <td>{{ $item->suami }}</td>
                        <td>{{ $item->istri }}</td>
                        <td>{{ $item->tanggal_menikah }}</td>
                        <td>{{ $item->nama_unit }}</td>
                        <td>{{ $item->alamat }}</td>
                        {{-- <td>
                            <button class="btn btn-danger btn-sm text-end"><i class="bx bx-trash"></i></button>
                        </td> --}}
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
