<table class="table" id="myTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Wali</th>
            <th>Nama</th>
            <th>Angkatan</th>
            <th>Jurusan</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($murids as $index => $item)
            <tr>
                <td>
                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                    <strong>
                        {{ $index + 1 }}
                    </strong>
                </td>
                <td>
                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                    <strong>{{ $item->User->name ?? 'Tidak ada wali murid' }}</strong>
                </td>
                <td><strong>{{ $item->name }}</strong></td>
                <td>{{ $item->angkatans->tahun ?? 'Tidak ada Angkatan' }}</td>
                <td>{{ $item->jurusans->nama ?? 'Tidak ada Jurusan' }}</td>
                <td>{{ $item->kelas->kelas ?? 'Tidak ada Kelas' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
