<table>

<tr>

<td width="180">Kode Barang</td>

<td>{{ $item->code }}</td>

</tr>

<tr>

<td>Nama Barang</td>

<td>{{ $item->name }}</td>

</tr>

<tr>

<td>Perusahaan</td>

<td>{{ $item->company?->company_name }}</td>

</tr>

<tr>

<td>Lokasi</td>

<td>{{ $item->location?->name }}</td>

</tr>

<tr>

<td>Status</td>

<td>

<small class="...">

Verified

</small>

</td>

</tr>

</table>