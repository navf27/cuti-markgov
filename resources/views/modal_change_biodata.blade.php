<div class="modal fade" id="changeBiodataModal" tabindex="-1" aria-labelledby="changeBiodataModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Biodata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="changeBiodataForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_depan" class="required col-form-label">Nama Depan</label>
                        <input type="text" name="nama_depan" id="nama_depan" class="form-control" value = "{{Auth::user()->pegawais->nama_depan}}"required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_belakang" class="required col-form-label">Nama Belakang</label>
                        <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="required col-form-label">Tanggal lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="required col-form-label">No Handphone</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="required col-form-label">Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="required col-form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" required>
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

@push('js')
    <script>
        $('#changeBiodataForm').submit(function(e) {
            e.preventDefault();

            var url = "{{ route('user.biodata.change') }}";
            console.log(url);
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: new FormData(this),
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
                        text: "Change Biodata Berhasil",
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
                        text: "Gagal mengganti biodata",
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