@extends('admin.layout.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Profil Pengguna</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Gambar Profil -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if($user->image)
                                <img class="profile-user-img img-fluid img-circle" src="{{ Storage::url('profile_pictures/' . $user->image) }}" alt="Foto profil pengguna">
                                @else
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('asset/profile-user.png') }}" alt="Ikon pengguna default">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <div class="text-center mt-3">
                                <!-- Form untuk mengupload foto profil -->
                                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="profile_picture" class="form-control mb-2">
                                    <button type="submit" class="btn btn-primary btn-block">Ubah Foto Profil</button>
                                </form>

                                <!-- Form untuk menghapus foto profil -->
                                <form action="{{ route('admin.profile.delete') }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">Hapus Foto Profil</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <h3 class="card-title">Edit Profil</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputName" placeholder="Nama" value="{{ $user->name }}" readonly>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#" class="btn btn-tool"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ $user->email }}" readonly>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#" class="btn btn-tool"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Ubah Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" readonly>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#" class="btn btn-tool" data-toggle="modal" data-target="#changePasswordModal"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal Ubah Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.profile.change-password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection