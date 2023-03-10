@extends('layout.app')

@section('content')
<div class="container">
    @if (Auth::user()->role == '2')
    <div class="row justify-content-center">
        {{-- <div class="col-md-4">
            <div class="card" style="background-color: #007BFF">
                <div class="card-body text-center text-light">
                    <h2>Cuti</h2>
                    <hr class="bg-light">
                    <h3>{{$jumlah_cuti}}</h3>
                </div>
            </div>
        </div> --}}

        <div class="col-md-4">
            <div class="card bg-warning">
                <div class="card-body text-center">
                    <h2>Pengajuan</h2>
                    <hr class="bg-light">
                    <h3>{{$jumlah_pengajuan}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger">
                <div class="card-body text-center">
                    <h2>Ditolak</h2>
                    <hr class="bg-light">
                    <h3>{{$jumlah_ditolak}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary">
                <div class="card-body text-center">
                    <h2>Pegawai</h2>
                    <hr class="bg-light">
                    <h3>{{$jumlah_pegawai}}</h3>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="row">
        <div class="col-md-3">
            <div class="card" style="background-color: #007BFF">
                <div class="card-body text-center text-light">
                    <h2>Cuti</h2>
                    <hr class="bg-light">
                    <h3>{{$jumlah_cuti}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning">
                <div class="card-body text-center">
                    <h2>Pengajuan</h2>
                    <hr class="bg-light">
                    <h3>{{$jumlah_pengajuan}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body text-center">
                    <h2>Diterima</h2>
                    <hr class="bg-light">
                    <h3>{{$jumlah_diterima}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger">
                <div class="card-body text-center">
                    <h2>Ditolak</h2>
                    <hr class="bg-light">
                    <h3>{{$jumlah_ditolak}}</h3>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Auth::user()->role == '2')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Pengajuan Cuti Bulan Ini</h5>
                </div>

                <div class="card-body">
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table">
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
                                        @forelse ($notifikasi as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->pegawai->nama_depan }} {{ $item->pegawai->nama_belakang }}
                                            </td>
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
                                                <a class="btn btn-warning btn-sm my-2"
                                                    href="/pengajuan/cetak/{{ $item->id }}" target="_blank"> <i
                                                        class="fas fa-file"></i> Cetak Pengajuan </a>
                                                @endif

                                                @if ($item->status != 1)
                                                <a class="btn btn-primary btn-sm my-2"
                                                    href="/cuti/{{ $item->id }}/edit"> <i class="fas fa-pen"></i> Edit
                                                </a>
                                                @endif

                                                @if (Auth::user()->role == '1')
                                                <a class="btn btn-primary btn-sm my-2"
                                                    href="/cuti/admin/show/{{ $item->id }}">
                                                    <i class="fas fa-eye"></i> Show </a>
                                                @else
                                                <a class="btn btn-primary btn-sm my-2"
                                                    href="/cuti/kepala/show/{{ $item->id }}">
                                                    <i class="fas fa-eye"></i> Show </a>
                                                @endif

                                                @if ($item->status != 1 || $item->tgl_akhir_cuti > now() ||
                                                $item->kategori == null)
                                                @if (Auth::user()->role == '2')
                                                <button type="button" class="btn btn-primary btn-sm my-2 updateStatus"
                                                    data-id="{{$item->id}}" data-bs-toggle="modal"
                                                    data-bs-target="#updateStatusModal">
                                                    <i class="fas fa-pen"></i> Update Status
                                                </button>
                                                @endif
                                                <a class="btn btn-danger btn-sm my-2 delete-confirm"
                                                    data-id="{{$item->id}}"> <i class="fas fa-trash"></i>
                                                    Delete </a>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="9">
                                                <div class="text-center">
                                                    <h4>TIDAK ADA DATA PENGAJUAN CUTI</h4>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>Notifikasi</h3>
                </div>
                <hr>

                <div class="card-body">
                    @forelse ($notifikasi as $notif)
                    @if ($notif->status == '1')
                    <div class="d-flex align-items-center bg-success rounded p-5 mb-7">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-1 me-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                    fill="black"></path>
                                <rect x="6" y="12" width="7" height="2" rx="1" fill="black"></rect>
                                <rect x="6" y="7" width="12" height="2" rx="1" fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Icon-->
                        <!--begin::Title-->
                        <div class="flex-grow-1 me-2">
                            <a href="{{route('cuti.index')}}" class="fw-bolder text-light text-hover-primary fs-6">Cuti
                                pada tanggal
                                {{$notif->tgl_awal_cuti}} s/d {{$notif->tgl_akhir_cuti}} telah di acc</a>
                        </div>
                        <!--end::Title-->
                    </div><br>

                    @elseif($notif->status == '2')
                    <div class="d-flex align-items-center bg-danger rounded p-5 mb-7">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-1 me-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                    fill="black"></path>
                                <rect x="6" y="12" width="7" height="2" rx="1" fill="black"></rect>
                                <rect x="6" y="7" width="12" height="2" rx="1" fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Icon-->
                        <!--begin::Title-->
                        <div class="flex-grow-1 me-2">
                            <a href="{{route('cuti.index')}}" class="fw-bolder text-light text-hover-primary fs-6">Cuti
                                pada tanggal
                                {{$notif->tgl_awal_cuti}} s/d {{$notif->tgl_akhir_cuti}} telah di tolak</a>
                        </div>
                        <!--end::Title-->
                    </div><br>

                    @else

                    @endif
                    @empty
                    <div class="d-flex align-items-center bg-secondary rounded p-5 mb-7">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-1 me-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                    fill="black"></path>
                                <rect x="6" y="12" width="7" height="2" rx="1" fill="black"></rect>
                                <rect x="6" y="7" width="12" height="2" rx="1" fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Icon-->
                        <!--begin::Title-->
                        <div class="flex-grow-1 me-2">
                            <a href="#" class="fw-bolder text-light text-hover-primary fs-6">Tidak Ada
                                Notifikasi</a>
                        </div>
                        <!--end::Title-->
                    </div><br>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endif
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
                        title: 'Success',
                        text: "Update Status Cuti Berhasil",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((hasil) => {
                        location.reload();
                    });
                }, error: function(response) {
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
                }        
            });
        });
</script>
@endpush