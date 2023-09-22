@extends('templates.index')
@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection


@section('title', 'Profile')
@section('subtitle', 'Data Profile')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="mt-3">
                        <h4>{{ auth()->guard('admin')->user()->nama_lengkap }}</h4>
                        <p class="text-secondary mb-1"></p>
                        <p class="text-muted font-size-sm"></p>
                    </div>
                </div>
                <hr class="my-4" />
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Username</h6>
                        <span class="text-secondary">{{ auth()->guard('admin')->user()->username }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Level</h6>
                        <span class="text-secondary">{{ auth()->guard('admin')->user()->role }}</span>
                    </li>
                    @if (auth()->guard('admin')->user()->role == 'admin_sektor')
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Sektor</h6>
                        <span class="text-secondary">{{ auth()->guard('admin')->user()->sektor->first()->nama_sektor }}</span>
                    </li>

                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.password') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Password Baru</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="password" class="form-control" name="password" />
                            @error('confirm')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Konfirmasi Password</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="password" class="form-control" name="confirm" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Ubah Password" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>

<script>

</script>
@endsection
