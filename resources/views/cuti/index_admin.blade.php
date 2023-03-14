@extends('layout.app')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0">
            <h5>Table Cuti</h5>
            <span>
                Berisi data cuti pegawai.
            </span>
            <hr>
        </div>

        <div class="card-body">
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th scope="col">Nama</th>
                                    <th scope="col">No Hp</th>
                                    @if (Auth::user()->role == "1")
                                    <th scope="col">Divisi</th>
                                    @endif
                                    <th scope="col">Tanggal Awal Cuti</th>
                                    <th scope="col">Tanggal Akhir Cuti</th>
                                    <th scope="col">Kategori Cuti</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Acc Kepala</th>
                                    <th scope="col" width="250px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuti as $item)
                                <tr class="text-center">
                                    <td>{{ $item->pegawai->nama_depan }} {{ $item->pegawai->nama_belakang }}</td>
                                    <td>{{ $item->pegawai->no_hp }}</td>
                                    @if (Auth::user()->role == "1")
                                    <td>{{ $item->pegawai->divisi->nama_divisi }}</td>
                                    @endif
                                    <td>{{ $item->tgl_awal_cuti }}</td>
                                    <td>{{ $item->tgl_akhir_cuti }}</td>
                                    <td>{{ $item->kategori_cuti }}</td>
                                    <td>{{$item->status_cuti}}</td>
                                    <td>{{$item->status_kepala}}</td>
                                    @if ($item->id_jadwal_cuti == null)
                                    <td>

                                        @if ($item->status == '0')
                                        <a class="btn btn-warning btn-sm my-2" href="/pengajuan/cetak/{{ $item->id }}"
                                            target="_blank"> <i class="fas fa-file"></i> Cetak Pengajuan </a>
                                        @endif

                                        {{-- @if ($item->status != 1)
                                        <a class="btn btn-primary btn-sm my-2" href="/cuti/{{ $item->id }}/edit"> <i
                                                class="fas fa-pen"></i> Edit </a>
                                        @endif --}}

                                        @if (Auth::user()->role == '1')
                                        <a class="btn btn-primary btn-sm my-2" href="/cuti/admin/show/{{ $item->id }}">
                                            <i class="fas fa-eye"></i> Show </a>
                                        @else
                                        <a class="btn btn-primary btn-sm my-2" href="/cuti/kepala/show/{{ $item->id }}">
                                            <i class="fas fa-eye"></i> Show </a>
                                        @endif

                                        @if ($item->status != 1 || $item->tgl_akhir_cuti > now() || $item->kategori == null)
                                        @if (Auth::user()->role == '2')
                                        @if (Auth::user()->id == 7 && $item->status == '0')
                                        <button type="button" class="btn btn-primary btn-sm my-2 updateStatus"
                                            data-id="{{$item->id}}" data-bs-toggle="modal"
                                            data-bs-target="#updateStatusModal">
                                            <i class="fas fa-pen"></i> Update Status
                                        </button>
                                        @endif
                                        @if (Auth::user()->id != 7 && $item->acc_kepala == 0)
                                        <button type="button" class="btn btn-primary btn-sm my-2 updateStatus"
                                            data-id="{{$item->id}}" data-bs-toggle="modal"
                                            data-bs-target="#updateStatusModal">
                                            <i class="fas fa-pen"></i> Update Status
                                        </button>
                                        @endif
                                        @endif
                                        @if ($item->status == '0')
                                        <a class="btn btn-danger btn-sm my-2 delete-confirm" data-id="{{$item->id}}"> <i
                                                class="fas fa-trash"></i>
                                            Delete </a>
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
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Status Cuti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateStatusForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="required col-form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="1">Diterima</option>
                            <option value="2">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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

    // get id cuti on click button
    var id_cuti = null;
    $(document).on('click', '.updateStatus', function(e){
        e.preventDefault();
        id_cuti = $(this).data('id');
    });

    $('#updateStatusForm').submit(function(e) {
        e.preventDefault();
        
        var dataForm = new FormData(this);
        dataForm.append('id', id_cuti);
        console.log(dataForm);

        var url = "{{ Route::is('cuti.admin.index') ? route('cuti.admin.updateStatus') : route('cuti.kepala.updateStatus') }}";
        console.log(url);
        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: dataForm,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    customClass: {
                        confirmButton: 'btn btn-success',
                    },
                    title: 'Errors',
                    text: "Gagal update status",
                    icon: 'error', 
                    confirmButtonText: 'OK'
                }).then((hasil) => {
                    location.reload();
                });
            }, error: function(response) {
                Swal.fire({
                    customClass: {
                        confirmButton: 'btn btn-success',
                    },
                    title: 'Success',
                    text: "Update Status Cuti Berhasil",
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((hasil) => {
                    location.reload();
                });
            }        
        });
    });

    $(function () {
      $('#example').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endpush