@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Edit Data Pegawai</h5>
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

                    <form class="needs-validation" action="/pegawai/{{ $pegawai->id }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="nama_depan">Nama Depan</label>
                                <input type="nama_depan" name="nama_depan" class="form-control" id="nama_depan"
                                    aria-describedby="nama_depan" value="{{ $pegawai->nama_depan }}" style="width: 95%">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="nama_belakang">Nama Belakang</label>
                                <input type="nama_belakang" name="nama_belakang" class="form-control" id="nama_belakang"
                                    aria-describedby="nama_belakang" value="{{ $pegawai->nama_belakang }}">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="divisi">Divisi</label>
                                <select type="divisi" name="divisi" class="form-control" id="divisi"
                                    aria-describedby="divisi" style="width: 95%">
                                    <option value="{{$pegawai->divisi->id}}" selected>{{$pegawai->divisi->nama_divisi}}
                                    </option>
                                    @foreach ($divisi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    aria-describedby="email" value="{{ $pegawai->user->email }}">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                                    aria-describedby="tgl_lahir" value="{{ $pegawai->tgl_lahir }}" style="width: 95%">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="no_hp">Nomor Telp</label>
                                <input type="no_hp" name="no_hp" class="form-control" id="no_hp"
                                    aria-describedby="no_hp" value="{{ $pegawai->no_hp }}">
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                        <select type="jenis_kelamin" name="jenis_kelamin" class="form-control" style="width: 95%"
                                            id="jenis_kelamin" aria-describedby="jenis_kelamin">
                                            <option @if($pegawai->jenis_kelamin == 'Laki - Laki') selected @endif value="Laki - Laki">Laki - Laki</option>
                                            <option @if($pegawai->jenis_kelamin == 'Perempuan') selected @endif value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label" for="role">Role</label>
                                        <select type="role" name="role" class="form-control" id="role" style="width: 95%"
                                            aria-describedby="role">
                                            <option @if($pegawai->user->role == "1") selected @endif value="1">Admin</option>
                                            <option @if($pegawai->user->role == "2") selected @endif value="2">Kepala</option>
                                            <option @if($pegawai->user->role == "3") selected @endif value="3">Pegawai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea type="alamat" name="alamat" class="form-control" id="alamat"
                                    aria-describedby="alamat" rows="5">{{ $pegawai->alamat }}</textarea>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <select type="provinsi" name="provinsi" class="form-control" id="provinsi"
                                    aria-describedby="provinsi" style="width: 95%">
                                    @if ($pegawai->province)
                                    <option value="{{$pegawai->province->id}}" selected>{{$pegawai->province->name}}
                                    </option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="kota">Kota</label>
                                <select type="kota" name="kota" class="form-control" id="kota" aria-describedby="kota">
                                    @if ($pegawai->regency)
                                    <option value="{{$pegawai->regency->id}}" selected>{{$pegawai->regency->name}}
                                    </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="kecamatan">Kecamatan</label>
                                <select name="kecamatan" class="form-control kecamatan" id="kecamatan"
                                    aria-describedby="kecamatan" style="width: 95%">
                                    @if ($pegawai->district)
                                    <option value="{{$pegawai->district->id}}" selected>{{$pegawai->district->name}}
                                    </option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="desa">Desa</label>
                                <select type="desa" name="desa" class="form-control" id="desa" aria-describedby="desa">
                                    @if ($pegawai->village)
                                    <option value="{{$pegawai->village->id}}" selected>{{$pegawai->village->name}}
                                    </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-1">
                                <button class="btn btn-primary" type="submit">Edit</button>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-light" href="{{route('pegawai.index')}}">Batal</a>
                            </div>
                        </div>

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
    $('#provinsi').select2({
        ajax: {
            url: "{{ route('getProvinsi') }}",
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
        minimumInputLength: 3,
        placeholder: 'Pilih Provinsi',
        width: '95%'
    });

    $(document).ready(function(){
        onChangeSelect('{{ route("cities") }}', $('#provinsi').val(), 'kota');
        onChangeSelect('{{ route("districts") }}', $('#kota').val(), 'kecamatan');
        onChangeSelect('{{ route("villages") }}', $('#kecamatan').val(), 'desa');
    });

    // function get data when select2 changes
    function onChangeSelect(url, id, name) {
        var placeholder_select = '';
        switch (name) {
            case 'kota':
                placeholder_select = 'Kabupaten/Kota';
                break;
            case 'kecamatan':
                placeholder_select = 'Kecamatan';
                break;
            case 'desa':
                placeholder_select = 'Desa';
                break;
            default:
                placeholder_select = 'Pilih';
                break;
        }
        $('#'+name).select2({
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    id: id
                }
    
                return query;
            },
        },
        width: '95%',
        placeholder: placeholder_select,
        });
    }

    $(function () {
        $('#provinsi').on('change', function () {
            onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            $('#kota').empty();
            $('#kecamatan').empty();
            $('#desa').empty();
        });
        $('#kota').on('change', function () {
            onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            $('#kecamatan').empty();
            $('#desa').empty();
        });
        $('#kecamatan').on('change', function () {
            onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
        });
    });
</script>
@endpush