@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Tambah Jadwal Cuti / Libur Nasional</h5>
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

                    <form class="needs-validation" action="{{route('jadwal.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="required form-label" for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" style="width: 95%" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tipe" class="form-label">Tipe</label>
                                <select name="tipe" id="tipe" style="width: 95%" class="form-control">
                                    <option value="1">Cuti Bersama</option>
                                    <option value="2">Libur Nasional</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="tgl_awal" class="required form-label">Tanggal Awal</label>
                                <input type="tgl_awal" name="tgl_awal" id="tgl_awal" class="form-control" style="width: 95%" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_akhir" class="required form-label">Tanggal Akhir</label>
                                <input type="tgl_akhir" name="tgl_akhir" id="tgl_akhir" class="form-control" style="width: 95%" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $("#tgl_awal").daterangepicker({
            timePicker: false,
            singleDatePicker: true,
            minDate: moment().add(0, 'days'),
            locale: {
                format: "Y-M-D",
            }
        });

        $("#tgl_akhir").daterangepicker({
            timePicker: false,
            singleDatePicker: true,
            minDate: $("#tgl_awal").val(),
            locale: {
                format: "Y-M-D",
            }
        });

        $(document).on("change", "#tgl_awal", function() {
            $("#tgl_akhir").daterangepicker({
                timePicker: false,
                singleDatePicker: true,
                minDate: $("#tgl_awal").val(),
                locale: {
                    format: "Y-M-D",
                }
            });
            fillPeriod();
        });
    </script>
@endpush