<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sự cố</title>
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
        <h2 class="form-title">Thêm Sự Cố</h2>
        <form action="{{ route('issues.store') }}" method="POST">
            @csrf
            <div class="mb-3 form-group">
                <label for="computer_name" class="form-label">Computer_name</label>
                <select class="form-control @error('computer_name') is-invalid @enderror" name="computer_name" id="computer_name">
                    <option value="">-- Chọn Tên Máy Tính --</option>
                    @foreach ($computer as $item) 
                    <option value="{{ $item->computer_name }}" {{ old('computer_name') == $item->computer_name ? 'selected' : '' }}>
                        {{ $item->computer_name }}
                    </option>
                    @endforeach
                </select>
                @error('computer_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label for="reported_by" class="form-label">Reported_by</label>
                <input class="form-control @error('reported_by') is-invalid @enderror" type="text" name="reported_by" id="reported_by" value="{{ old('reported_by') }}">
                @error('reported_by')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label for="reported_date" class="form-label">Reported_date</label>
                <input class="form-control @error('reported_date') is-invalid @enderror" type="datetime-local" name="reported_date" id="reported_date" value="{{ old('reported_date') }}">
                @error('reported_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label for="urgency" class="form-label">Urgency</label>
                <select class="form-control @error('urgency') is-invalid @enderror" name="urgency" id="urgency">
                    <option value="">-- Chọn Mức Độ --</option>
                    <option value="Low" {{ old('urgency') == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ old('urgency') == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ old('urgency') == 'High' ? 'selected' : '' }}>High</option>
                </select>
                @error('urgency')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label for="status" class="form-label">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="">-- Chọn Trạng Thái --</option>
                    <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="In Process" {{ old('status') == 'In Process' ? 'selected' : '' }}>In Process</option>
                    <option value="Resolved" {{ old('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Thêm Sự Cố</button>
        </form>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
