@yield('content')
<table class="table" id="myTable">
    <thead>
        <tr>
            <th class="d-flex"><input type="checkbox" id="select_all_ids" class="me-2"> Pilih
            </th>
            <th>No</th>
            <th>Nama Wali</th>
            <th>Nama</th>
            <th>Angkatan</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($murids as $index => $item)
            <tr>
                <td><input type="checkbox" value="{{ $item->id }}" class="checksAll" name="ids"></td>
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
                <td class="d-flex">

                    <a href="{{ route('admin.murid.show', $item->id) }}" class="btn btn-primary me-2"><i
                            class="bx bx-detail"></i>
                    </a>
                    <a href="{{ route('admin.murid.edit', $item->id) }}" class="btn btn-warning me-2"><i
                            class="bx bx-edit-alt"></i>
                    </a>
                    <form action="{{ route('admin.murid.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger show_confirm" type="submit"><i class="bx bx-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
