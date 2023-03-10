@component('mail::message')
# Pengajuan Cuti Pegawai 

Nama Pegawai : {{$data->pegawai->nama_pegawai}} <br>
Divisi Pegawai : {{$data->pegawai->divisi->nama_divisi}} <br>
Tanggal Cuti : {{$data->tgl_awal_cuti}} s/d. {{$data->tgl_akhir_cuti}} <br>
Lama Cuti : {{$data->lama_cuti}} hari <br>
Keterangan : {{$data->keterangan}} <br>
status Cuti : {{$data->status_cuti}} <br>
Acc Kepala : {{$data->status_kepala}} <br>

@if ($data->type_email == 1)
@component('mail::button', ['url' => route('updateStatusEmail', ['id' => $data->id, 'user_acc_id' => $data->user_acc_id, 'status' => 1, 'email' => $data->email]), 'color' => 'success'])
Terima Cuti
@endcomponent

@component('mail::button', ['url' => route('updateStatusEmail', ['id' => $data->id, 'user_acc_id' => $data->user_acc_id, 'status' => 2, 'email' => $data->email]), 'color' => 'error'])
Tolak Cuti
@endcomponent

@else
Update status untuk pengajuan di atas telah berhasil, terimakasih telah melakukan konfirmasi.   
<br>   
@endif

Hormat Kami,<br>
PT. Scomptec
@endcomponent
