<table>
  <thead>
    <tr>
      <th>Nama Desa</th>
      <th>Kecamatan</th>
      <th>Kabupaten</th>
      <th>Provinsi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($desa as $item)
      <tr>
        <td>{{ $item->nama}}</td>
        <td>{{ $item->kecamatan->nama}}</td>
        <td>{{ $item->kecamatan->kabupaten->nama}}</td>
        <td>{{ $item->kecamatan->kabupaten->provinsi->nama}}</td>
      </tr>

    @endforeach
  </tbody>
</table>
