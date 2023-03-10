@extends('layout.app')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Table Divisi</h5>
            <span>
                Berisi data divisi.
            </span>
        </div>

        <div class="card-body">
            @if (Auth::user()->role == '1')
            <div class="float-right mb-3">
                @if (Route::is('divisi.trash'))
                <a class="btn btn-primary" href="{{route('divisi.index')}}"> Data</a>
                @else
                <a class="btn btn-primary" href="/divisi/create"> Input Data</a>
                <a class="btn btn-danger mx-3" href="{{route('divisi.trash')}}"><i class="fas fa-trash"></i> Trash</a>
                @endif
            </div>
            @endif

            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th scope="col">Nama Divisi</th>
                                    <th scope="col">Nama Kepala</th>
                                    <th scope="col">Tertanda</th>
                                    <th scope="col" width="350px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($divisi as $item)
                                <tr class="text-center">
                                    <td>{{ $item->nama_divisi }}</td>
                                    <td>{{ $item->nama_kepala }}</td>
                                    <td><img src="{{ $item->ttd }}" width="100" height="100"></td>
                                    <td>
                                        @if (Auth::user()->role == '1')
                                        @if (Route::is('divisi.trash'))
                                        <a class="btn btn-primary  btn-sm my-2 restore-confirm" data-id="{{$item->id}}"> <i
                                                class="fas fa-file"></i> Restore </a>

                                        <a class="btn btn-danger btn-sm my-2 delete-permanent-confirm" data-id="{{$item->id}}"> <i
                                                class="fas fa-trash"></i> Delete Permanent </a>
                                        @else
                                        <a class="btn btn-primary btn-sm my-2" href="/divisi/{{ $item->id }}"> <i
                                                class="fas fa-eye"></i> Detail </a>

                                        <a class="btn btn-primary  btn-sm my-2" href="/divisi/{{ $item->id }}/edit"> <i
                                                class="fas fa-pen"></i> Edit </a>

                                        @if ($item->id != 3)
                                        <a class="btn btn-danger btn-sm my-2 delete-confirm" data-id="{{$item->id}}"> <i
                                            class="fas fa-trash"></i> Delete </a>
                                        @endif
                                        @endif
                                        @else
                                        <a class="btn btn-primary btn-sm my-2" href="/divisi/{{ $item->id }}"> <i
                                            class="fas fa-eye"></i> Detail </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(document).on('click', '.delete-confirm', function (e) {
        var id = $(this).data('id');
        var route = "{{ route('divisi.destroy', ':id') }}";
        route = route.replace(':id', id);
        e.preventDefault();
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
                    type: "DELETE",
                    url: route,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(response) {
                            $("#success").html(response.message)
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Success',
                                text: "Divisi berhasil dihapus",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((hasil) => {
                                location.reload();
                            })
                        }, error: function(response) {
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Errors',
                                text: "Gagal menghapus divisi, divisi telah digunakan pada tabel pegawai",
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }        
                });
            }
        });
    });

    $(document).on("click", ".restore-confirm", function(e) {
            Swal.fire({
                customClass: {
                    confirmButton: 'btn btn-warning',
                    cancelButton: 'btn btn-secondary'
                },
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin ingin merestore data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Restore'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var route = "{{ route('divisi.restore', ':id') }}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url: route,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(response) {
                            $("#success").html(response.message)
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Success',
                                text: "Divisi berhasil direstore",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((hasil) => {
                                location.reload();
                            })
                        }
                    });
                }
            })
        });

        $(document).on("click", ".delete-permanent-confirm", function(e) {
            Swal.fire({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin ingin menghapus permanen data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var route = "{{ route('divisi.destroyPermanent', ':id') }}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url: route,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(response) {
                            $("#success").html(response.message)
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Success',
                                text: "Divisi dihapus permanen",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((hasil) => {
                                location.reload();
                            })
                        }, error: function(response) {
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Errors',
                                text: "Divisi gagal dihapus permanen",
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
                }
            })
        });
</script>
@endpush