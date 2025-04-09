<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agent Audio Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Agent Audio Report</h1>
            <p style="display: inline;">Start Month: {{ $startMonth }}</p>
            <p style="display: inline; margin-left: 10px;">End Month: {{ $endMonth }}</p>
            <p>Print Date: {{ now()->format('Y-m-d h:m:s') }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Agent Name</th>
                    <th>Month</th>
                    <th>Total Score</th>
                    <th>Remarks</th>
                    <th>Evaluated Files</th>
                    <th>Total Files</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData as $report)
                    <tr>
                        <td>{{ $report['agent_name'] }}</td>
                        <td>{{ $report['month'] }}</td>
                        <td>{{ $report['total_score'] }}</td>
                        <td>{{ mb_convert_encoding($report['remarks'], 'UTF-8', 'UTF-8') }}</td>
                        <td>{{ $report['evaluated_files'] }}</td>
                        <td>{{ $report['total_files'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
