@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Detail Divisi</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Nama Divisi: </b>{{ $divisi->nama_divisi }}</li>
                            <li class="list-group-item"><b>Nama Kepala: </b>{{ $divisi->nama_kepala }}</li>
                            <li class="list-group-item"><b>Tertanda: </b></li>
                        </ul>
                        <img src="{{ $divisi->ttd }}" width="200px" height="200px">
                    </div>
                    <br>
                    <a class="btn btn-success mt-3" href="/divisi">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
