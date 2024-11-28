<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Bài kiểm tra trắc nghiệm</h1>
    <form action="result.php" method="POST">
        <?php
        // Đường dẫn đến tệp câu hỏi
        $filename = "quiz.txt";

        // Kiểm tra tệp có tồn tại hay không
        if (!file_exists($filename)) {
            echo "<div class='alert alert-danger'>Không tìm thấy tệp <strong>quiz.txt</strong>!</div>";
            exit;
        }

        // Đọc nội dung từ tệp
        $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $currentQuestion = [];
        $questionList = [];
        foreach ($questions as $line) {
            if (strpos($line, "Câu") === 0) {
                if (!empty($currentQuestion)) {
                    $questionList[] = $currentQuestion;
                }
                $currentQuestion = [$line];
            } else {
                $currentQuestion[] = $line;
            }
        }
        if (!empty($currentQuestion)) {
            $questionList[] = $currentQuestion;
        }

        // Hiển thị câu hỏi
        foreach ($questionList as $index => $question) {
            echo "<div class='card mb-4'>";
            echo "<div class='card-header'><strong>{$question[0]}</strong></div>";
            echo "<div class='card-body'>";
            for ($i = 1; $i < count($question) - 1; $i++) {
                $answer = substr($question[$i], 0, 1); // Lấy A, B, C, D
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='question{$index}' value='{$answer}' id='question{$index}{$answer}' required>";
                echo "<label class='form-check-label' for='question{$index}{$answer}'>{$question[$i]}</label>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </div>
    </form>
</div>
</body>
</html>
