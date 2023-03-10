@component('mail::message')
# Pengajuan Cuti

Pengajuan {{$data->kategori_cuti}} Anda pada tanggal {{$data->tgl_awal_cuti}} s/d. {{$data->tgl_akhir_cuti}}
telah {{strtolower($data->status_cuti)}}. Terimakasih telah menunggu cuti dikonfirmasi.
Untuk melihat detail cuti anda dapat klik link di bawah ini.

@component('mail::button', ['url' => route('cuti.index')])
Check website
@endcomponent

Hormat Kami,<br>
PT. Scomptec
@endcomponent
