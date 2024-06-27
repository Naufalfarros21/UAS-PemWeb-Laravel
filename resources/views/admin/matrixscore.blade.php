@extends('admin.layout.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Matrix Score</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Matrix Score</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah
                                    Data</button>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">ID</th>
                                        <th style="width: 30%;">Program</th>
                                        <th style="width: 10%;">C1</th>
                                        <th style="width: 10%;">C2</th>
                                        <th style="width: 10%;">C3</th>
                                        <th style="width: 10%;">C4</th>
                                        <th style="width: 10%;">C5</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $m)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $m->alternatif->name }}</td>
                                        <td>{{ $m->c1 }}</td>
                                        <td>{{ $m->c2 }}</td>
                                        <td>{{ $m->c3 }}</td>
                                        <td>{{ $m->c4 }}</td>
                                        <td>{{ $m->c5 }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#modal-edit{{ $m->id }}">
                                                <i class="fas fa-pen"></i> Edit
                                            </button>
                                            <form action="{{ route('admin.matrix.destroy', ['id' => $m->id]) }}"
                                                method="post" style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="modal-edit{{ $m->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modalEditLabel{{ $m->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditLabel{{ $m->id }}">Edit Matrix
                                                        Score</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.matrix.update', ['id' => $m->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="form-group">
                                                            <label for="alternatif_id">Program</label>
                                                            <select name="alternatif_id" class="form-control" required>
                                                                @foreach($alternatif as $a)
                                                                <option value="{{ $a->id }}"
                                                                    {{ $a->id == $m->alternatif_id ? 'selected' : '' }}>
                                                                    {{ $a->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="c1">C1</label>
                                                            <input type="number" name="c1" class="form-control" max="10"
                                                                value="{{ $m->c1 }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="c2">C2</label>
                                                            <input type="number" name="c2" class="form-control" max="10"
                                                                value="{{ $m->c2 }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="c3">C3</label>
                                                            <input type="number" name="c3" class="form-control" max="10"
                                                                value="{{ $m->c3 }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="c4">C4</label>
                                                            <input type="number" name="c4" class="form-control" max="10"
                                                                value="{{ $m->c4 }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="c5">C5</label>
                                                            <input type="number" name="c5" class="form-control" max="10"
                                                                value="{{ $m->c5 }}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Add Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Tambah Matrix Score</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.matrix.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="alternatif_id">Program</label>
                        <select name="alternatif_id" class="form-control" required>
                            <option value="" disabled selected>Pilih Alternatif</option>
                            @foreach($alternatif as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="c1">C1</label>
                        <input type="number" name="c1" class="form-control" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="c2">C2</label>
                        <input type="number" name="c2" class="form-control" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="c3">C3</label>
                        <input type="number" name="c3" class="form-control" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="c4">C4</label>
                        <input type="number" name="c4" class="form-control" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="c5">C5</label>
                        <input type="number" name="c5" class="form-control" max="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection