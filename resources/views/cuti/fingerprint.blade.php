@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Check Fingerprint Pegawai</h5>
                    <span>
                        Input data manual pegawai yang tidak melakukan Fingerprint.
                    </span>
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

                    <form class="needs-validation" action="{{ route('cuti.admin.fingerprint.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row g-2" id="fieldPegawai">
                            <div class="col-md-12">
                                <label class="required form-label" for="pegawai">Daftar Pegawai</label>
                                <select name="pegawai" id="pegawai" class="form-control" required>
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="tgl_awal_cuti">Tanggal Awal Cuti</label>
                                <input type="tgl_awal_cuti" name="tgl_awal_cuti" class="form-control" id="tgl_awal_cuti"
                                    aria-describedby="tgl_awal_cuti">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="tgl_akhir_cuti">Tanggal Akhir Cuti</label>
                                <input type="tgl_akhir_cuti" name="tgl_akhir_cuti" class="form-control"
                                    id="tgl_akhir_cuti" aria-describedby="tgl_akhir_cuti">
                            </div>
                        </div>
                        <br>
                </div>
                <br>
                <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    $('#pegawai').select2({
        ajax: {
            url: "{{ route('listPegawai') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public',
                }
                return query;
            },
        },
        placeholder: 'Pilih Pegawai',
        width: '100%'
    });

        $("#tgl_awal_cuti").daterangepicker({
            timePicker: false,
            singleDatePicker: true,
            minDate: moment().add(-30, 'days'),
            locale: {
                format: "Y-M-D",
            }
        });

        $("#tgl_akhir_cuti").daterangepicker({
            timePicker: false,
            singleDatePicker: true,
            minDate: $("#tgl_awal_cuti").val(),
            locale: {
                format: "Y-M-D",
            }
        });

        $(document).on("change", "#tgl_awal_cuti", function() {
            $("#tgl_akhir_cuti").daterangepicker({
                timePicker: false,
                singleDatePicker: true,
                minDate: $("#tgl_awal_cuti").val(),
                locale: {
                    format: "Y-M-D",
                }
            });
            fillPeriod();
        });
</script>
@endpush