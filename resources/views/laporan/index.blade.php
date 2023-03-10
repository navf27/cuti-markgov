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
                        <h5>Filter Rekap Laporan Cuti</h5>
                    </div>
                    <div class="card-body">

                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="kategori">Kategori Cuti</label>
                                <select name="kategori" id="kategori" class="form-control" style="width: 95%">
                                    <option value="0">Semua Kategori</option>
                                    <option value="1">Cuti Tahunan</option>
                                    <option value="2">Cuti Sakit</option>
                                    <option value="3">Cuti Dispensasi</option>
                                </select>
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
                        <div class="row g-2" id="fieldPegawai">
                            <div class="col-md-12">
                                <label class="form-label" for="pegawai">Daftar Pegawai</label>
                                <select name="pegawai" id="pegawai" class="form-control">
                                    <option value="0">Semua Pegawai</option>
                                </select>
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
                        <h5 class="mb-3">Rekap Laporan Cuti Pegawai</h5>
                        <button class="btn btn-primary" type="submit" id="button_cetak">Cetak Laporan</button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>File</th>
                                        <th>Nama</th>
                                        <th>Jenis Cuti</th>
                                        <th>No Surat</th>
                                        <th>Tanggal Surat</th>
                                        <th>Tanggal Awal</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Jumlah Cuti Hari Kerja</th>
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

    // function get table data
    const getData = () =>{
        var dataLength = 0;
            $.ajax({
                type: 'GET',
                data: {
                    kategori: $('#kategori').val(),
                    tgl_awal: $('#tgl_awal').val(),
                    tgl_akhir: $('#tgl_akhir').val(),
                    pegawai: $('#pegawai').val()
                },
                url: "{{ route('cuti.laporan.data') }}",
                success: function($messages) {
                    $('.data_laporan').remove();
                    $.each($messages, function(i, data) {
                        dataLength = data.length;
                        $.each(data, function(j, message) {
                            var url_show = "{{route('cuti.pengajuan.show', ':id_cuti')}}";
                            url_show = url_show.replace(':id_cuti', message.id);
                            console.log(url_show);
                            $('#table_body').append(
                                '<tr class="text-center data_laporan">'+
                                    '<td>'+(j+1)+'</td>'+
                                    '<td>'+ '<a href="' + url_show + '" target="_blank"><i class="fas fa-file"></i></a></td>'+
                                    '<td>'+ message.nama +'</td>'+
                                    '<td>'+ message.jenis_cuti +'</td>'+
                                    '<td>'+ message.no_surat +'</td>'+
                                    '<td>'+ message.tgl_surat +'</td>'+
                                    '<td>'+ message.tgl_awal_cuti +'</td>'+
                                    '<td>'+ message.tgl_akhir_cuti +'</td>'+
                                    '<td>'+ message.jumlah_cuti +' Hari</td>'+
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
                            '<td colspan="9">'+
                                '<div class="text-center">'+
                                    '<h4>DATA TIDAK DITEMUKAN</h4>'+
                                '</div>'+
                            '</td>'+
                        '</tr>'
                    );
                }
            });
    }

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
        getData();
    });
</script>
@endpush