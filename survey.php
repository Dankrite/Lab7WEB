<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анкета</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            padding: 20px;
            max-width: 600px;
            margin: auto;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        label, input, textarea {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        input[type="text"], input[type="email"] {
            font-size: 1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Анкета</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Отримуємо дані з форми
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $question1 = $_POST['question1'] ?? '';
            $question2 = $_POST['question2'] ?? '';
            $question3 = $_POST['question3'] ?? '';

            // Формуємо контент для збереження у файл
            $data = [
                'name' => $name,
                'email' => $email,
                'question1' => $question1,
                'question2' => $question2,
                'question3' => $question3,
                'submitted_at' => date('Y-m-d H:i:s')
            ];

            // Збереження у форматі JSON
            $filename = "survey/response_" . date('Y-m-d_H-i-s') . ".json";
            file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            echo "<p>Дякуємо за заповнення анкети! Відправлено о " . date('Y-m-d H:i:s') . "</p>";
        } else {
        ?>
            <<form id="survey-form">
    <label>Ім'я:</label>
    <input type="text" name="name" required>
    
    <label>Email:</label>
    <input type="email" name="email" required>
    
    <label>Питання 1: Який ваш улюблений бренд техніки?</label>
    <input type="text" name="question1" required>
    
    <label>Питання 2: Як часто ви купуєте нові гаджети?</label>
    <input type="text" name="question2" required>
    
    <label>Питання 3: Яку категорію товарів ви шукаєте найчастіше?</label>
    <input type="text" name="question3" required>
    
    <button type="button" onclick="submitForm()">Відправити</button>
</form>
<script>
    function submitForm() {
        const formData = new FormData(document.getElementById('survey-form'));
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'survey.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Анкета успішно відправлена!');
            }
        };
        xhr.send(formData);
    }
</script>

        <?php } ?>
    </div>
</body>
</html>
