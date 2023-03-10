@extends('layout.app')
@section('content')
<div class="container-fluid">
    <form action="{{ route('cuti.laporan.cetak') }}" method="get" target="blank">
        @csrf
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Rekap Laporan Cuti Per Pegawai</h5>
                    </div>
                    <div class="card-body">

                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="nama">Nama</label>
                                <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{$pegawai->id}}">
                                <input type="nama" name="nama" id="nama" class="form-control"
                                    value="{{$pegawai->nama_pegawai}}" disabled>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="divisi">Divisi</label>
                                <input type="divisi" name="divisi" id="divisi" class="form-control"
                                    value="{{$pegawai->divisi->nama_divisi}}" disabled>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="tgl_awal">Filter Tanggal Awal</label>
                                <input type="tgl_awal" name="tgl_awal" class="form-control" id="tgl_awal"
                                    aria-describedby="tgl_awal" style="width: 95%" required>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="tgl_akhir">Filter Tanggal Akhir</label>
                                <input type="tgl_akhir" name="tgl_akhir" class="form-control" id="tgl_akhir"
                                    aria-describedby="tgl_akhir" style="width: 95%" required>
                            </div>
                        </div>
                        <br>

                        <button class="btn btn-primary" type="button" id="filter_button">Filter</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>

        <div class="row" id="laporan_tabel">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="mb-3">Tabel Cuti Pegawai</h5>
                        <button class="btn btn-primary" id="button_cetak" type="submit">Cetak Laporan</button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Kategori Cuti</th>
                                        <th>Tanggal Awal Cuti</th>
                                        <th>Tanggal Akhir Cuti</th>
                                        <th>Lama Cuti</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    $('#laporan_tabel').hide();
    $('#button_cetak').hide();

    $("#tgl_awal").daterangepicker({
        timePicker: false,
        singleDatePicker: true,
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

    $('#filter_button').on('click', function(e){
        e.preventDefault();

        $('#laporan_tabel').show();
        var dataLength = 0;
            $.ajax({
                type: 'GET',
                data: {
                    tgl_awal: $('#tgl_awal').val(),
                    tgl_akhir: $('#tgl_akhir').val(),
                    id_pegawai: $('#id_pegawai').val()
                },
                url: "{{ route('cuti.laporan.pegawai.data') }}",
                success: function($messages) {
                    $('.data_laporan').remove();
                    $.each($messages, function(i, data) {
                        dataLength = data.length;
                        $.each(data, function(j, message) {
                            $('#table_body').append(
                                '<tr class="text-center data_laporan">'+
                                    '<td>'+(j+1)+'</td>'+
                                    '<td>'+ message.nama_kategori +'</td>'+
                                    '<td>'+ message.tgl_awal_cuti +'</td>'+
                                    '<td>'+ message.tgl_akhir_cuti +'</td>'+
                                    '<td>'+ message.jumlah_cuti + ' Hari</td>'+
                                    '<td>'+ message.keterangan +'</td>'+
                                '</tr>'
                            );
                        });
                    });
                },
                error: function() {
                    // alert('error loading message');
                    console.log('error loading list');
                }
            });
            $(document).ajaxStop(function() {
                console.log("jumlah data :");
                console.log(dataLength);
                $('.row_empty').remove();
                $('#button_cetak').show();

                if(dataLength == 0){
                    $('#button_cetak').hide();
                    $('#table_body').append(
                        '<tr class="row_empty">'+
                            '<td colspan="6">'+
                                '<div class="text-center">'+
                                    '<h4>DATA TIDAK DITEMUKAN</h4>'+
                                '</div>'+
                            '</td>'+
                        '</tr>'
                    );
                }
            });
    });
</script>
@endpush