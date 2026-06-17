@if(auth()->check())

<button
class="btn btn-outline-dark w-100"
...

>

Lihat Informasi Lengkap

</button>

<div class="collapse mt-3">

<table>

<tr>

<td>Harga</td>

<td>...</td>

</tr>

<tr>

<td>Vendor</td>

<td>...</td>

</tr>

<tr>

<td>Kondisi</td>

<td>...</td>

</tr>

</table>

</div>

@else

<a href="...">

Login untuk melihat informasi lengkap

</a>

@endif