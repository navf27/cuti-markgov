@extends('layout.app')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Table Jadwal Cuti dan Libur Nasional</h5>
            <span>
                Berisi data cuti terjadwal dan libur nasional.
            </span>
        </div>

        <div class="card-body">
            @if (Auth::user()->role == '1')
            <div class="float-right mb-3">
                <a class="btn btn-primary" href="{{route('jadwal.create')}}"> Input Data</a>
            </div>
            @endif
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Tanggal Awal</th>
                                    <th scope="col">Tanggal Akhir</th>
                                    <th scope="col">Tipe</th>
                                    @if (Auth::user()->role == '1')
                                    <th scope="col" width="350px">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $item)
                                <tr class="text-center">
                                    <td>{{$item->keterangan}}</td>
                                    <td>{{$item->tgl_awal}}</td>
                                    <td>{{$item->tgl_akhir}}</td>
                                    <td>{{$item->tipe == 1 ? "Cuti Bersama" : "Libur Nasional"}}</td>
                                    @if (Auth::user()->role == '1')
                                    @if ($item->tipe == 1 && now() > $item->tgl_awal)

                                    @else
                                    <td>
                                        <a class="btn btn-primary  btn-sm my-2" href="/jadwal/{{ $item->id }}/edit"> <i
                                                class="fas fa-pen"></i> Edit </a>

                                        <a class="btn btn-danger btn-sm my-2 delete-confirm" data-id="{{$item->id}}"> <i
                                                class="fas fa-trash"></i> Delete </a>
                                    </td>
                                    @endif
                                    @endif
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
        var route = "{{ route('jadwal.destroy', ':id') }}";
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
                    success: function(response) {
                            $("#success").html(response.message)
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Success',
                                text: "Jadwal Cuti atau libur nasional berhasil dihapus",
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
                                text: "Gagal menghapus jadwal cuti atau libur nasional, data telah digunakan pada tabel cuti",
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }         
                });
            }
        });
    });
</script>
@endpush