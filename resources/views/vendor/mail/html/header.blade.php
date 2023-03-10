<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://scomptec.markgov.co.id/wp-content/uploads/2018/07/logo.png" class="logo" alt="Laravel Logo"> --}}
<img src="https://siva.jsstatic.com/id/16736/images/logo/16736_logo_0_255475.jpg" class="logo" alt="">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
