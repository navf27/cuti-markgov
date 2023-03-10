@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Pengajuan Cuti Pegawai</h5>
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

                    <form class="needs-validation" action="{{ route('cuti.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="kategori">Kategori Cuti</label>
                                <select name="kategori" id="kategori" class="form-control" required style="width: 95%">
                                    <option value="" disabled selected>Pilih Kategori Cuti</option>
                                    <option value="1">Cuti Tahunan</option>
                                    <option value="2">Cuti Sakit</option>
                                    <option value="3">Cuti Dispensasi</option>
                                </select>
                            </div>
                            <div class="col-md-6" id="field_surat_pendukung">
                                <label class="form-label" for="surat_pendukung">Surat Pendukung</label>
                                <input type="file" name="surat_pendukung" class="form-control" id="surat_pendukung"
                                    aria-describedby="surat_pendukung" style="width: 95%">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="tgl_awal_cuti">Tanggal Awal Cuti</label>
                                <input type="tgl_awal_cuti" name="tgl_awal_cuti" class="form-control" id="tgl_awal_cuti"
                                    aria-describedby="tgl_awal_cuti" style="width: 95%">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="tgl_akhir_cuti">Tanggal Akhir Cuti</label>
                                <input type="tgl_akhir_cuti" name="tgl_akhir_cuti" class="form-control"
                                    id="tgl_akhir_cuti" aria-describedby="tgl_akhir_cuti" style="width: 95%">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" style="width: 95%"
                                rows="5" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="status">Status</label>
                                        <input type="status" name="status" class="form-control" id="status"
                                            aria-describedby="status" style="width: 95%" value="Pengajuan" disabled>
                                    </div>
                                </div>
                                <div class="row" id="pj_field">
                                    <div class="col-md-12">
                                        <label class="form-label" for="pj">Penanggungjawab Sementara</label>
                                        <select name="pj" id="pj" class="form-control"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="menyetujui">Menyetujui</label>
                                <select name="menyetujui" id="menyetujui" class="form-control" style="width: 95%">
                                    <option value="{{$divisi->nama_kepala}} (Kepala {{$divisi->nama_divisi}})">
                                        {{$divisi->nama_kepala}} (Kepala {{$divisi->nama_divisi}})</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="mengetahui">Mengetahui</label>
                                <input type="mengetahui" name="mengetahui" class="form-control" id="mengetahui"
                                    aria-describedby="mengetahui" style="width: 95%"
                                    value="{{$direktur->name}}" disabled>
                            </div>
                        </div>
                        <br>
                </div>
                <br>
                <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#field_surat_pendukung').hide();
    const array_kategori = ['1', '4'];

    $('#pj').select2({
        ajax: {
            url: "{{ route('pj') }}",
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
        placeholder: 'Pilih Penanggungjawab Sementara',
        width: '95%'
    });

        $('#kategori').on('change', function(e){
            e.preventDefault();
            if($(this).val() == '1'){
                $('#field_surat_pendukung').hide();
            } else {
                $('#field_surat_pendukung').show();
            }

            // set batas tanggal awal
            if(array_kategori.includes($(this).val())){
                $("#tgl_awal_cuti").daterangepicker({
                    timePicker: false,
                    singleDatePicker: true,
                    minDate: moment().add(0, 'days'),
                    locale: {
                        format: "Y-M-D",
                    }
                });
            } else {
                $("#tgl_awal_cuti").daterangepicker({
                    timePicker: false,
                    singleDatePicker: true,
                    minDate: moment().add(-44, 'days'),
                    locale: {
                        format: "Y-M-D",
                    }
                });
            }

            if($(this).val() == '2'){
                $('#status').val('Diterima');
            } else {
                $('#status').val('Pengajuan');
            }
        });

        $("#tgl_awal_cuti").daterangepicker({
            timePicker: false,
            singleDatePicker: true,
            minDate: moment().add(0, 'days'),
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