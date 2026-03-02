<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ID Card Karyawan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .card-page {
            page-break-after: always;
            width: 85.6mm;
            height: 54mm;
            overflow: hidden;
        }
        .card-page:last-child {
            page-break-after: avoid;
        }

        .id-card {
            width: 85.6mm;
            height: 54mm;
            margin: 0;
            background-color: #ffffff;
            overflow: hidden;
        }

        /* ─── Header ─── */
        .card-header {
            background-color: #343a40;
            color: #ffffff;
            padding: 2.5mm 3mm 2mm 3mm;
            text-align: center;
        }

        .card-header .company-name {
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #ffffff;
        }

        .card-header .card-title {
            font-size: 6px;
            color: #adb5bd;
            margin-top: 0.5mm;
            letter-spacing: 0.5px;
        }

        /* ─── Accent bar ─── */
        .accent-bar {
            height: 1mm;
            background-color: #007bff;
        }

        /* ─── Body ─── */
        .card-body {
            padding: 2mm 3mm;
            display: table;
            width: 100%;
        }

        .photo-col {
            display: table-cell;
            width: 18mm;
            vertical-align: top;
            padding-right: 2mm;
        }

        .photo-wrapper {
            width: 16mm;
            height: 20mm;
            border: 0.5mm solid #dee2e6;
            border-radius: 1mm;
            overflow: hidden;
            background-color: #adb5bd;
            display: table;
            text-align: center;
        }

        .photo-wrapper span {
            display: table-cell;
            vertical-align: middle;
            font-size: 5px;
            color: #fff;
        }

        .photo-wrapper img {
            width: 16mm;
            height: 20mm;
        }

        .info-col {
            display: table-cell;
            vertical-align: top;
        }

        .employee-name {
            font-size: 9px;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 0.3mm;
            border-bottom: 0.3mm solid #007bff;
            padding-bottom: 0.5mm;
        }

        .employee-nip {
            font-size: 6px;
            color: #6c757d;
            margin-bottom: 0.5mm;
        }

        .employee-nip strong {
            color: #343a40;
        }

        .employee-position {
            font-size: 6.5px;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 1.5mm;
            text-transform: uppercase;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr td {
            font-size: 6px;
            padding: 0.3mm 0;
            vertical-align: top;
            color: #495057;
            line-height: 1.2;
        }

        .info-table tr td.label {
            color: #6c757d;
            width: 14mm;
            font-weight: bold;
        }

        .info-table tr td.separator {
            width: 2mm;
            color: #adb5bd;
        }

        .info-table tr td.value {
            color: #343a40;
        }

        @page {
            size: 85.6mm 54mm landscape;
            margin: 0;
        }
    </style>
</head>
<body>

@foreach ($employees as $employee)
<div class="card-page">
    <div class="id-card">

        <!-- Header -->
        <div class="card-header">
            <div class="company-name">{{ $settings->company_name ?? 'PT. PERUSAHAAN INDONESIA' }}</div>
            <div class="card-title">KARTU TANDA KARYAWAN</div>
        </div>
        <div class="accent-bar"></div>

        <!-- Body -->
        <div class="card-body">

            <!-- Foto -->
            <div class="photo-col">
                <div class="photo-wrapper">
                    @if (!empty($employee['photo_base64']))
                        <img src="{{ $employee['photo_base64'] }}" alt="foto">
                    @else
                        <span>FOTO</span>
                    @endif
                </div>
            </div>

            <!-- Info -->
            <div class="info-col">
                <div class="employee-name">{{ $employee['name'] }}</div>
                <div class="employee-nip">NIP: <strong>{{ $employee['nip'] }}</strong></div>
                <div class="employee-position">{{ $employee['job'] }}</div>

                <table class="info-table">
                    <tr>
                        <td class="label">Tgl Lahir</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $employee['date_of_birth'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tempat Lahir</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $employee['place_of_birth'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Provinsi</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $employee['province'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kabupaten</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $employee['city'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kecamatan</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $employee['district'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kelurahan</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $employee['village'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kode Pos</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $employee['post_code'] }}</td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</div>
@endforeach

</body>
</html>