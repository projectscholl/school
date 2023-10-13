<table class="table table-bordered">
    <!-- A THEAD element is used to ensure the header of the table is repeated if it consumes more than one page. -->
    <thead>
        <tr class="table-secondary">
            <th>No</th>
            <th>NAMA TAGIHAN</th>
            <th>NAMA</th>
            <th>ANGKATAN</th>
            <th>BULAN TAGIHAN</th>
            <th>STATUS</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <!-- The single invoice items are all within the TBODY of the table. -->
    <tbody>
        @if ($biaya)
            <?php $i = 0; ?>
            @foreach ($biaya as $data)
                @foreach ($data->tagihans as $biayas)
                    @foreach ($datas as $murid)
                        <?php $i++; ?>
                        @php
                            $myDate = $biayas->start_date . '-' . date('Y');
                            $date = Carbon\Carbon::parse($myDate);
                            $datay = $date->format('F');
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <b>{{ $data->nama_biaya }}</b>
                            </td>
                            <td>
                                {{ $murid->name }}
                            </td>
                            <td>
                                {{ $murid->angkatans->tahun }}
                            </td>
                            <td>
                                {{ $biayas->mounth == null ? $datay : $biayas->mounth }}
                            </td>
                            <td class="text-danger">
                                {{ $biayas->status }}
                            </td>
                            <td>
                                Rp.{{ number_format($biayas->amount, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        @endif
    </tbody>
</table>
