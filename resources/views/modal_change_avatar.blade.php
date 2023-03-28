<div class="modal fade" id="changeAvatarModal" tabindex="-1" aria-labelledby="changeAvatarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Avatar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="changeAvatarForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="required col-form-label">Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="required col-form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name', Auth::user()->name )}}"> 
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
        $('#changeAvatarForm').submit(function(e) {
            e.preventDefault();

            var url = "{{ route('user.avatar.change') }}";
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
                        text: "Change Avatar Berhasil",
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
                        text: "Gagal mengganti avatar, pastikan file yang dipilih berupa gambar!",
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