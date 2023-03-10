@extends('layout.app')
@section('content')
<div class="col-sm-12">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Filter</h5>
                <form action="" method="get">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Pegawai <i
                                        class="text-danger"></i></label>
                                <select name="nama" id="nama" class="form-control js-example-basic-single">
                                    <option value="" selected>--- Pilih Pegawai ---</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id}}">{{ $item->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tempat Kegiatan <i
                                        class="text-danger"></i></label>
                                <input type="text" name="tempat" class="form-control" id="tempat">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Awal <i
                                        class="text-danger"></i></label>
                                <input type="date" name="tanggal_awal" class="form-control" id="tanggal_awal">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Akhir <i
                                        class="text-danger"></i></label>
                                <input type="date" name="tanggal_akhir" class="form-control" id="tanggal_akhir">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Data Daily Semua User</h5>
        </div>
        <div class="card-body">
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th scope="col">Nama</th>
                                    <th>Instansi</th>
                                    <th scope="col">Tanggal Kegiatan</th>
                                    <th scope="col">Jam Awal Kegiatan</th>
                                    <th scope="col">Jam Akhir Kegiatan</th>
                                    <th scope="col">Aktivitas</th>
                                    <th scope="col">Yang Di kunjungi</th>
                                    <th scope="col">No Cp</th>
                                    <th scope="col" width="250px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr class="text-center">
                                    <td>{{$item->user->name}}</td>
                                    <td>{{ $item->tempat }}</td>
                                    <td>{{ $item->tanggal->format('d F Y') }}</td>
                                    <td>{{ $item->jam_mulai->format('H:i') }}</td>
                                    <td>{{ $item->jam_akhir->format('H:i') }}</td>
                                    <td>{{$item->aktivitas}}</td>
                                    <td>{{ $item->nama_dinas }}</td>
                                    <td>{{ $item->no_cp }}</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm my-2 delete-confirm" data-id="{{$item->id}}"> <i class="fas fa-trash"></i>
                                            Delete </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script type="text/javascript">
    $(document).on('click', '.delete-confirm', function (e) {
        var id = $(this).data('id');
        var route = "{{ route('cuti.destroy', ':id') }}";
        route = route.replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                e.preventDefault();
                $.ajax({
                    type: "DELETE",
                    url: route,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function (data) {
                            
                    }         
                });
                $(document).ajaxStop(function(){
                    location.reload();
                });
            }
        });
    });
</script>
@endpush