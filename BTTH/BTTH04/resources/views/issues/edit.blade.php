<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin sự cố</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #212529;
        }

        .form-group label {
            font-weight: bold;
            color: #495057;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="form-title">Chỉnh sửa thông tin sự cố</h2>
        <form action="{{ route('issues.update', $isues->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Máy tính -->
            <div class="mb-3 form-group">
                <label for="computer_name" class="form-label">Computer_name</label>
                <select class="form-control @error('computer_name') is-invalid @enderror" name="computer_name" id="computer_name">
                    <option value="">-- Chọn máy tính --</option>
                    @foreach ($computer_name as $item) 
                    <option value="{{ $item->computer_name }}" {{ $item->computer_name == $isues->computer->computer_name ? 'selected' : '' }}>
                        {{ $item->computer_name }}
                    </option>
                    @endforeach
                </select>
                @error('computer_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Người báo cáo -->
            <div class="mb-3 form-group">
                <label for="reported_by" class="form-label">Reported_by</label>
                <input class="form-control @error('reported_by') is-invalid @enderror" type="text" name="reported_by" id="reported_by" value="{{ old('reported_by', $isues->reported_by) }}">
                @error('reported_by')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Thời gian báo cáo -->
            <div class="mb-3 form-group">
                <label for="reported_date" class="form-label">Reported_date</label>
                <input class="form-control @error('reported_date') is-invalid @enderror" type="datetime-local" name="reported_date" id="reported_date" value="{{ old('reported_date', date('Y-m-d\TH:i', strtotime($isues->reported_date))) }}">
                @error('reported_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mô tả -->
            <div class="mb-3 form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description', $isues->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mức độ sự cố -->
            <div class="mb-3 form-group">
                <label for="urgency" class="form-label">Urgency</label>
                <input class="form-control @error('urgency') is-invalid @enderror" type="text" name="urgency" id="urgency" value="{{ old('urgency',$isues->urgency) }}">
                @error('urgency')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Trạng thái -->
            <div class="mb-3 form-group">
                <label for="status" class="form-label">Status</label>
                <input class="form-control @error('status') is-invalid @enderror" name="status" id="status" value="{{ old('status', $isues->status) }}">
                    
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nút cập nhật -->
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
