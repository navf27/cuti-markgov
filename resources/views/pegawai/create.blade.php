@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Tambah Data</h5>
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

                        <form class="needs-validation" action="{{ route('pegawai.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="nama_depan">Nama Depan</label>
                                    <input type="nama_depan" name="nama_depan" class="form-control" id="nama_depan"
                                        aria-describedby="nama_depan" value="{{ old('nama_depan') }}" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="nama_belakang">Nama Belakang</label>
                                    <input type="nama_belakang" name="nama_belakang" class="form-control" id="nama_belakang"
                                        aria-describedby="nama_belakang" value="{{ old('nama_belakang') }}">
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="divisi">Divisi</label>
                                    <select type="divisi" name="divisi" class="form-control" id="divisi"
                                        aria-describedby="divisi" style="width: 95%">
                                        @foreach ($divisi as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_divisi }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        aria-describedby="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        aria-describedby="password" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="role">Role</label>
                                    <select type="role" name="role" class="form-control" id="role"
                                        aria-describedby="role">
                                        <option value="1">Admin</option>
                                        <option value="2">Kepala</option>
                                        <option value="3">Pegawai</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                                        aria-describedby="tgl_lahir" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="no_hp">Nomor Telp</label>
                                    <input type="no_hp" name="no_hp" class="form-control" id="no_hp"
                                        aria-describedby="no_hp">
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">

                                <div class="col-md-6">
                                    <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                    <select type="jenis_kelamin" name="jenis_kelamin" class="form-control"
                                        id="jenis_kelamin" style="width: 95%">
                                        <option> Laki - Laki</option>
                                        <option> Perempuan </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea type="alamat" name="alamat" class="form-control" id="alamat" aria-describedby="alamat"></textarea>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">

                                <div class="col-md-6">
                                    <label class="form-label" for="provinsi">Provinsi</label>
                                    {{-- {{dd($provinsi)}} --}}
                                    <select name="provinsi" id="provinsi" class="form-control" style="width: 95%">
                                        <option value="" selected disabled>PILIH PROVINSI</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label" for="kota">Kota</label>
                                    <select name="kota" class="form-control" id="kota">
                                        <option value="" selected disabled>PILIH KOTA</option>
                                        @foreach ($kota as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="kecamatan">Kecamatan</label>
                                    <select type="kecamatan" name="kecamatan" class="form-control" id="kecamatan"
                                        aria-describedby="kecamatan" style="width: 95%">
                                        <option value="" selected disabled>PILIH KECAMATAN</option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="desa">Desa</label>
                                    <select type="desa" name="desa" class="form-control" id="desa"
                                        aria-describedby="desa">
                                        <option value="" selected disabled>PILIH DESA</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                    </div>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#provinsi').change(function() {
                let id = $('#provinsi').val();
                if (id != null) {
                    // console.log(id);
                    $('#kota').prop('disabled', false);
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('getkota') }}" + "/" + id,
                        dataType: 'JSON',
                        success: function(data) {
                            // console.log(data)
                            $.each(data, function(key, item) {
                                $('#kota').append($('<option>', {
                                    value: item.id,
                                    text: item.name
                                }));
                            });
                        },
                        error: function(xmlhttprequest, textstatus, message) {}
                    });
                } else {
                    $('#kota').prop('disabled', true);
                }
                $('#kota').empty();
            });
        });

        $(document).ready(function() {
            $('#kota').change(function() {
                let id = $('#kota').val();
                if (id != null) {
                    // console.log(id);
                    $('#kota').prop('disabled', false);
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('getkecamatan') }}" + "/" + id,
                        dataType: 'JSON',
                        success: function(data) {
                            // console.log(data)
                            $.each(data, function(key, item) {
                                $('#kecamatan').append($('<option>', {
                                    value: item.id,
                                    text: item.name
                                }));
                            });
                        },
                        error: function(xmlhttprequest, textstatus, message) {}
                    });
                } else {
                    $('#kecamatan').prop('disabled', true);
                }
                $('#kecamatan').empty();
            });
        });

        $(document).ready(function() {
            $('#kecamatan').change(function() {
                let id = $('#kecamatan').val();
                if (id != null) {
                    // console.log(id);
                    $('#kecamatan').prop('disabled', false);
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('getdesa') }}" + "/" + id,
                        dataType: 'JSON',
                        success: function(data) {
                            // console.log(data)
                            $.each(data, function(key, item) {
                                $('#desa').append($('<option>', {
                                    value: item.id,
                                    text: item.name
                                }));
                            });
                        },
                        error: function(xmlhttprequest, textstatus, message) {}
                    });
                } else {
                    $('#desa').prop('disabled', true);
                }
                $('#desa').empty();
            });
        });
    </script>
@endpush
