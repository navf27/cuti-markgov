@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Daily Activity Pegawai</h5>
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

                    <form class="needs-validation" action="{{ route('daily.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="tempat">Tempat kegiatan</label>
                                <input type="text" name="tempat" class="form-control" id="tempat"
                                    aria-describedby="tempat" style="width: 95%">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="tanggal">Tanggal kegiatan</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal"
                                    aria-describedby="tanggal" style="width: 95%">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="jam_mulai">Jam Awal Kegiatan</label>
                                <input type="time" name="jam_mulai" class="form-control" id="jam_mulai"
                                    aria-describedby="jam_mulai" style="width: 95%">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="jam_akhir">Jam Akhir Kegiatan</label>
                                <input type="time" name="jam_akhir" class="form-control"
                                    id="jam_akhir" aria-describedby="jam_akhir" style="width: 95%">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="aktivitas">Aktivitas</label>
                                <textarea name="aktivitas" id="aktivitas" class="form-control" style="width: 95%"
                                rows="5" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="status">Nama yang di kunjungi</label>
                                        <input type="text" name="nama_dinas" class="form-control" id="nama_dinas"
                                            aria-describedby="nama_dinas" style="width: 95%">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label" for="no_cp">Nomor Hp yang di kunjungi</label>
                                        <input type="text" name="no_cp" class="form-control" id="no_cp"
                                            aria-describedby="no_cp" style="width: 95%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('js')
{{-- <script>
        $("#tanggal").daterangepicker({
            timePicker: false,
            singleDatePicker: true,
            minDate: moment().add(0, 'days'),
            locale: {
                format: "Y-M-D",
            }
        });
</script> --}}
@endpush