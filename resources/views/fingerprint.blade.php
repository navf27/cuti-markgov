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
                        Import data excel fingerprint pegawai dan compare data dengan sistem.
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

                    <form class="needs-validation" action="{{ route('cuti.admin.fingerprint.check') }}" method="post"
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
                                <label class="form-label" for="tahun_bulan">Tahun-Bulan</label>
                                <input type="month" name="tahun_bulan" class="form-control" id="tahun_bulan"
                                    aria-describedby="tahun_bulan" required>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2" id="field_import">
                            <div class="col-md-12">
                                <label class="form-label" for="import">Import Data Fingerprint (Format xlsx)</label>
                                <input type="file" name="import" class="form-control" accept=".xlsx"
                                    id="import" aria-describedby="import">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2" id="field_complete">
                            <div class="col-md-12">
                                <h3>Data fingerprint telah di compare dengan sistem</h3>
                                <button class="btn btn-danger mt-1" id="btn_hapus">Hapus Data</button>
                            </div>
                        </div>
                        <br>
                </div>
                <br>
                <button class="btn btn-primary" id="btn_submit" type="submit">Submit</button>
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
    $(document).ready(function(){
        $('#field_import').hide();
        $('#field_complete').hide();
    });

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

    $('#tahun_bulan').on('change', function(e){
        e.preventDefault();
        var data_bulan = $(this).val();
        var data_pegawai = $('#pegawai').val();
        console.log(data_bulan);

        var url = "{{ route('cuti.admin.fingerprint.getByMonth') }}";
        console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'tahun_bulan': data_bulan,
                'id_pegawai': data_pegawai
            },
            success: function(response) {
                console.log(response);
                if(response == true){
                    $('#field_import').hide();
                    $('#field_complete').show();
                    $('#btn_submit').hide();
                } else {
                    $('#field_import').show();
                    $('#field_complete').hide();
                    $('#btn_submit').show();
                }
            }, error: function(response) {
                console.log(response);
            }        
        });
    });

    $('#btn_hapus').on('click', function(e){
        e.preventDefault();
        var data_bulan = $('#tahun_bulan').val();
        var data_pegawai = $('#pegawai').val();
        console.log(data_bulan);

        var url = "{{ route('cuti.admin.fingerprint.destroy') }}";
        console.log(url);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'tahun_bulan': data_bulan,
                        'id_pegawai': data_pegawai
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) =>{
                            location.reload();
                        });
                    }, 
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message,
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }        
                });
            }
        });
    });
    
</script>
@endpush