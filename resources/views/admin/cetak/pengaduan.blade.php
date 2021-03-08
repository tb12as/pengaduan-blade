<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Pengaduan Masyarakat</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            margin: 3px 20px;
        }

        table {
            border-collapse: collapse;
        }

        table td {
            padding: 5px;
            font-size: 13px;
        }

        hr {
            border: 0.5px solid rgba(0, 0, 0, 0.5);
            max-width: 50%;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .op-5 {
            opacity: 0.8;
            font-size: 14px;
        }

    </style>
</head>

<body>
    <div class="container">
        <center>
            <h2>Sistem Pengaduan Masyarakat</h2>
        </center>
        <center>
            <p>Laporan ini diterima pada {{ date('d-m-Y, H:i:s', strtotime($data->created_at)) }}</p>
        </center>
    </div>
    <hr>
    <div class="container">
        <h3>Detail Laporan</h3>
        <table>
            <tr>
                <td><b>Isi Laporan<b></td>
            </tr>
            <tr>
                <td><p class="op-5">{{ $data->isi_laporan }}</p></td>
            </tr>
            @if ($data->foto)
                <tr>
                    <td><b>Foto</b></td>
                </tr>

                <tr>
                    <td>
                        <img src="{{ public_path($data->foto) }}" style="width: 75%;" alt="">
                    </td>
                </tr>
            @endif
        </table>
    </div>

    <div class="container">
        <h3>Detail Pelapor</h3>
        <table>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $data->user->nik }}</td>
            </tr>

            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data->user->name }}</td>
            </tr>

            <tr>
                <td>No Telpon</td>
                <td>:</td>
                <td>{{ $data->user->telp }}</td>
            </tr>

            <tr>
                <td>Username</td>
                <td>:</td>
                <td>{{ $data->user->username }}</td>
            </tr>

            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $data->user->email }}</td>
            </tr>
        </table>
    </div>
    <hr>

    <div class="container">
        <h3>Tanggapan</h3>
        <table>
            <tr>
                <td><b>Isi Tanggapan<b></td>
            </tr>
            <tr>
                <td class="op-5">{{ $data->tanggapan->isi_tanggapan }}</td>
            </tr>
        </table>
    </div>

    <div class="container">
        <h3>Detail Pelapor</h3>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data->tanggapan->user->name }}</td>
            </tr>

            <tr>
                <td>Username</td>
                <td>:</td>
                <td>{{ $data->tanggapan->user->username }}</td>
            </tr>

            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $data->tanggapan->user->email }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
