@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Tambah Data</h5>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="needs-validation" action="{{ route('divisi.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="nama_divisi">Nama Divisi</label>
                                    <input type="nama_divisi" name="nama_divisi" class="form-control" id="nama_divisi"
                                        aria-describedby="nama_divisi">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="nama_kepala">Nama Kepala</label>
                                    <input type="nama_kepala" name="nama_kepala" class="form-control" id="nama_kepala"
                                        aria-describedby="nama_kepala">
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label class="form-label" for="ttd">Tertanda</label>
                                <input type="file" class="form-control" name="ttd"><br>
                            </div>
                    </div>
                    <br>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
