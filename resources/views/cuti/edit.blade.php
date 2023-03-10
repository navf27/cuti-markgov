@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Edit Cuti</h5>
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

                        <form class="needs-validation" action="{{ route('cuti.update', $cuti->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="previous_url" id="previous_url" value="{{url()->previous()}}">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="kategori">Kategori Cuti</label>
                                    <select name="kategori" id="kategori" class="form-control" required style="width: 95%" disabled>
                                        <option @if($cuti->kategori == "1") selected @endif value="1">Cuti Tahunan</option>
                                        <option @if($cuti->kategori == "2") selected @endif value="2">Cuti Sakit</option>
                                        <option @if($cuti->kategori == "3") selected @endif value="3">Cuti Dispensasi</option>
                                    </select>
                                </div>
                                <div class="col-md-6" id="field_surat_pendukung">
                                    <label class="form-label" for="surat_pendukung">Surat Pendukung</label>
                                    @if($cuti->surat_pendukung) <a href="{{$cuti->file_path}}" target="_blank">{{$cuti->file_path}}</a> @endif
                                    <input type="file" name="surat_pendukung" class="form-control" id="surat_pendukung"
                                        aria-describedby="surat_pendukung" style="width: 95%">
                                </div>
                            </div>
                            <br>
                            
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="tgl_awal_cuti">Tanggal Awal Cuti</label>
                                    <input type="tgl_awal_cuti" name="tgl_awal_cuti" class="form-control" id="tgl_awal_cuti"
                                        aria-describedby="tgl_awal_cuti" style="width: 95%" value="{{$cuti->tgl_awal_cuti}}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="tgl_akhir_cuti">Tanggal Akhir Cuti</label>
                                    <input type="tgl_akhir_cuti" name="tgl_akhir_cuti" class="form-control"
                                        id="tgl_akhir_cuti" aria-describedby="tgl_akhir_cuti" style="width: 95%" value="{{$cuti->tgl_akhir_cuti}}">
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="5" style="width: 95%" required>{{$cuti->keterangan}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="status">Status</label>
                                            <input type="status" name="status" class="form-control" id="status"
                                                aria-describedby="status" style="width: 95%" value="{{$cuti->status_cuti}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row" id="pj_field">
                                        <div class="col-md-12">
                                            <label class="form-label" for="pj">Penanggungjawab Sementara</label>
                                            <select name="pj" id="pj" class="form-control">
                                                @if ($cuti->pj_sementara)
                                                    <option value="{{$cuti->pj_sementara}}" selected>{{$cuti->pj_sementara}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="menyetujui">Menyetujui</label>
                                    <select name="menyetujui" id="menyetujui"  class="form-control" style="width: 95%">
                                        <option value="{{$cuti->mengetahui}}">{{$cuti->mengetahui}}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="mengetahui">Mengetahui</label>
                                    <input type="mengetahui" name="mengetahui" class="form-control" id="mengetahui"
                                        aria-describedby="mengetahui" style="width: 95%" required value="{{$direktur->name}}" disabled>
                                </div>
                            </div>
                            <br>
                    </div>
                    <br>
                    <button class="btn btn-primary" type="submit">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js')
    <script>
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

        if("{{$cuti->kategori}}" == "1"){
            $('#field_surat_pendukung').hide();
        } else {
            $('#field_surat_pendukung').show();
        }

        $("#tgl_awal_cuti").daterangepicker({
            timePicker: false,
            singleDatePicker: true,
            minDate: moment().add(0, 'days'),
            startDate: "{{$cuti->tgl_awal_cuti}}",
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
