<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/site/logomail2.png') }}" class="logo" alt="Logo Brazil Beard Hair">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
