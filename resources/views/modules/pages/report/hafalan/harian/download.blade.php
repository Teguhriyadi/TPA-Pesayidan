<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>.: Laporan_Hafalan_Siswa :.</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <div class="title">
        Laporan Hafalan {{ $kategori }}
    </div>
    <div class="subtitle">
        Tanggal Cetak : {{ \Carbon\Carbon::parse(date("Y-m-d H:i:s"))->translatedFormat('H:i:s - d F Y') }}
    </div>
    <hr>
    <table style="width: 100%;" border="1" cellpadding="10" cellspacing="0">
        <thead style="background-color: lime;">
            <tr>
                <th class="text-center">No.</th>
                <th class="text-left">Siswa</th>
                <th class="text-center">Kelas</th>
                <th class="text-center">Tanggal</th>
                <th class="text-left">Guru</th>
                <th class="text-center">Penilaian</th>
                <th class="text-left">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomer = 1;
            @endphp
            @foreach ($hafalan as $item)
                <tr>
                    <td class="text-center">{{ $nomer++ }}.</td>
                    <td>{{ $item->siswa->nama }}</td>
                    <td class="text-center">{{ $item->siswa->kelas->namaKelas }} - {{ $item->siswa->kelas->jenjang }} </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('H:i:s - d F Y') }}</td>
                    <td>{{ $item->guru->users->nama }}</td>
                    <td class="text-center">{{ $item->penilaian }}</td>
                    <td>{{ $item->keterangan ? $item->keterangan : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
