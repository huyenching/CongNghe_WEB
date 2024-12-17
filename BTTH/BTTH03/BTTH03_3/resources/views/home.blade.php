<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sự cố máy tính</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <h1>Danh sách sự cố máy tính</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Người báo cáo</th>
                <th>Ngày báo cáo</th>
                <th>Mô tả sự cố</th>
                <th>Mức độ khẩn cấp</th>
                <th>Tên máy tính</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td> <!-- Số thứ tự -->
                    <td>{{ $item->reported_by }}</td> <!-- Người báo cáo -->
                    <td>{{ date('d/m/Y H:i', strtotime($item->reported_date)) }}</td> <!-- Ngày báo cáo (định dạng dd/mm/yyyy hh:mm) -->
                    <td>{{ $item->description }}</td> <!-- Mô tả sự cố -->
                    <td>
                        @if ($item->urgency === 'High')
                            <span style="color: red; font-weight: bold;">Khẩn cấp</span>
                        @elseif ($item->urgency === 'Medium')
                            <span style="color: orange; font-weight: bold;">Trung bình</span>
                        @else
                            <span style="color: green; font-weight: bold;">Thấp</span>
                        @endif
                    </td> <!-- Mức độ khẩn cấp -->
                    <td>{{ $item->computer_name }}</td> <!-- Tên máy tính -->
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Không có dữ liệu</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>