@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Detail Cuti Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Nama: </b>{{ $cuti->pegawai->nama_depan }} {{ $cuti->pegawai->nama_belakang }}</li>
                            <li class="list-group-item"><b>No Hp: </b>{{ $cuti->pegawai->no_hp }}</li>
                            <li class="list-group-item"><b>Divisi: </b>{{ $cuti->pegawai->divisi->nama_divisi }}</li>
                            <li class="list-group-item"><b>Kategori Cuti: </b>{{ $cuti->kategori_cuti }}</li>
                            <li class="list-group-item"><b>Tanggal Awal Cuti: </b>{{ $cuti->tgl_awal_cuti }}</li>
                            <li class="list-group-item"><b>Tanggal Akhir Cuti: </b>{{ $cuti->tgl_akhir_cuti }}</li>
                            <li class="list-group-item"><b>Keterangan Cuti: </b>{{ $cuti->keterangan }}</li>
                            <li class="list-group-item"><b>Status: </b>{{$cuti->status_cuti}}</li>
                            <li class="list-group-item"><b>Acc Kepala: </b>{{$cuti->status_kepala}}</li>
                            <li class="list-group-item"><b>Nomor Surat: </b>{{$cuti->no_surat ?? '-'}}</li>
                            <li class="list-group-item"><b>Menyetujui: </b>{{ $cuti->menyetujui }}</li>
                            <li class="list-group-item"><b>Mengetahui: </b>{{ $cuti->mengetahui }}</li>
                            @if($cuti->pj_sementara) <li class="list-group-item"><b>Penanggungjawab Sementara: </b>{{ $cuti->pj_sementara }}</li> @endif
                            @if($cuti->surat_pendukung) 
                            <li class="list-group-item"><b>Surat Pendukung: </b> <a href="{{$cuti->file_path}}" target="_blank">{{$cuti->file_path}}</a></li> 
                            @endif
                        </ul>
                    </div>
                    <br>
                    @if (Auth::user()->role == '1')
                    <a class="btn btn-success mt-3" href="{{route('cuti.admin.index')}}">Kembali</a>
                    @else
                    <a class="btn btn-success mt-3" href="{{route('cuti.kepala.index')}}">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
