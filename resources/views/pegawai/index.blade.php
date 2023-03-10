@extends('layout.app')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0">
            <h5>Table Pegawai</h5>
            <span>
                Berisi data Pegawai.
            </span>
            <hr>
        </div>

        <div class="card-body">
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        @if (Auth::user()->role == '1')
                        <div class="float-end mb-3">
                            <a class="btn btn-primary" href="/pegawai/create"> Input Data</a>
                        </div>
                        @endif
                        <table class="table" id="example">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th scope="col">Nama</th>
                                    <th scope="col">No Hp</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Divisi</th>
                                    <th scope="col">Jumlah Cuti</th>
                                    <th scope="col" width="350px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $item)
                                <tr class="text-center">
                                    <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->divisi->nama_divisi }}</td>
                                    <td>{{ $item->jum_cuti }}</td>
                                    <td>
                                        @if (Auth::user()->role == '1')
                                        <a class="btn btn-primary" href="/pegawai/{{ $item->id }}"> <i
                                                class="fas fa-eye"></i> Detail </a>

                                        <a class="btn btn-primary" href="/pegawai/{{ $item->id }}/edit"> <i
                                                class="fas fa-pen"></i> Edit </a>
                                        @else
                                        <a class="btn btn-primary" href="/pegawai_kepala/{{ $item->id }}"> <i
                                                class="fas fa-eye"></i> Detail </a>
                                        @endif

                                        {{-- <form action="/pegawai/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i>
                                                Delete </button>
                                        </form> --}}
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
<script>
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