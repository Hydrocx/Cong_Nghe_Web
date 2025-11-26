<?php
// Đọc nội dung từ file quiz.txt
$filename = "Quiz.txt";
$content = file_get_contents($filename);
$blocks = preg_split("/\n\s*\n/", trim($content));

$questions = [];
foreach ($blocks as $block) {
    $lines = explode("\n", trim($block));
    $qText = array_shift($lines);
    $answers = [];
    $correct = "";

    foreach ($lines as $line) {
        if (strpos($line, "ANSWER:") !== false) {
            $correct = trim(str_replace("ANSWER:", "", $line));
        } else {
            $answers[] = $line;
        }
    }

    $questions[] = [
        "text" => $qText,
        "answers" => $answers,
        "correct" => $correct
    ];
}

$isSubmitted = isset($_POST["submit"]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài thi trắc nghiệm</title>
    <style>
        body { font-family: Arial; width: 800px; margin: auto; padding-top: 20px; }
        .question { background: #f5f5f5; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
        .correct { color: green; font-weight: bold; }
        .wrong { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h2>Bài thi trắc nghiệm</h2>

<form method="post">

<?php
$index = 1;

foreach ($questions as $q):
?>
    <div class="question">
        <h3><?php echo $index . ". " . htmlspecialchars($q["text"]); ?></h3>

        <?php foreach ($q["answers"] as $ans): 
            $value = $ans[0]; // A, B, C...
        ?>
            <label>
                <input type="radio" name="q<?php echo $index; ?>" value="<?php echo $value; ?>"
                    <?php if ($isSubmitted && isset($_POST["q$index"]) && $_POST["q$index"] == $value) echo "checked"; ?>>
                <?php echo htmlspecialchars($ans); ?>
            </label><br>
        <?php endforeach; ?>

        <?php if ($isSubmitted): 
            $user = isset($_POST["q$index"]) ? $_POST["q$index"] : "(chưa chọn)";
            $correct = $q["correct"];
        ?>
            <p>
            <?php
                if ($user === $correct) {
                    echo "<span class='correct'>Đúng! ($correct)</span>";
                } else {
                    echo "<span class='wrong'>Sai. Bạn chọn: $user — Đúng: $correct</span>";
                }
            ?>
            </p>
        <?php endif; ?>

    </div>
<?php
$index++;
endforeach;
?>

<?php if (!$isSubmitted): ?>
    <button type="submit" name="submit">Nộp bài</button>
<?php else: ?>
    <button onclick="location.href='quiz.php'; return false;">Làm lại</button>
<?php endif; ?>

</form>

</body>
</html>
