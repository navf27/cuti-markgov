@extends('layout.app')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Data Cuti Saya</h5>
            <span>
                Berisi data cuti saya.
            </span>
        </div>

        <div class="card-body">
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th scope="col">Kategori Cuti</th>
                                    <th scope="col">Tanggal Awal Cuti</th>
                                    <th scope="col">Tanggal Akhir Cuti</th>
                                    <th scope="col">Keterangan Cuti</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Acc Kepala</th>
                                    <th scope="col" width="250px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuti as $item)
                                <tr class="text-center">
                                    <td>{{$item->kategori_cuti}}</td>
                                    <td>{{ $item->tgl_awal_cuti }}</td>
                                    <td>{{ $item->tgl_akhir_cuti }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{$item->status_cuti}}</td>
                                    <td>{{ $item->status_kepala }}</td>
                                    @if ($item->id_jadwal_cuti == null)
                                    <td>
                                        @if ($item->kategori != 4)
                                        <a class="btn btn-warning btn-sm my-2" href="/pengajuan/cetak/{{ $item->id }}" target="_blank"> <i
                                            class="fas fa-file"></i> Cetak Pengajuan </a>

                                        @if ($item->status != '1' && $item->acc_kepala != 1)
                                        <a class="btn btn-primary btn-sm my-2" href="/cuti/{{ $item->id }}/edit"> <i
                                                class="fas fa-pen"></i> Edit </a>
                                        @endif

                                        @if ($item->tgl_akhir_cuti > now() || $item->kategori != null)
                                        @if ($item->status == '0')
                                        <a class="btn btn-danger btn-sm my-2 delete-confirm" data-id="{{$item->id}}"> <i class="fas fa-trash"></i>
                                            Delete </a>
                                        @endif
                                        @endif
                                        @endif
                                    </td>
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