<?php
    include_once 'db.php';

    $do = trim(strip_tags($_GET['do']));
    if($do == 'save'){
        $title = trim($_POST['title']);

        $res = $db->prepare("INSERT IGNORE INTO tests (`title`) VALUES (:title)");
        $res->execute([
            ':title' => $title,
        ]);
        $testId = $db->lastInsertId();

        $questionNum = 1;
        while (isset($_POST['question_' . $questionNum])) {
            $questionNum = trim($_POST['question_' . $questionNum]);

            $res = $db->prepare("INSERT IGNORE INTO questions (`test_id`,`question`) VALUES (:test_id, :question)");
            $res->execute([
                ':test_id' => $testId,
                ':question' => $question,
            ]);
            $questionId = $db->lastInsertId();

            $answerNum = 1;
            while (isset($_POST['answer_text_'. $questionNum .'_' . $answerNum])) {
                $answer = trim($_POST['answer_text_' . $questionNum . '_' . $answerNum]);
                $score = trim($_POST['answer_score_' . $questionNum . '_' . $answerNum]);

                $res = $db->prepare("INSERT IGNORE INTO answers (`question_id`,`answer`,`score`) VALUES (:question_id, :answer, :score)");
                $res->execute([
                    ':question_id' => $questionId,
                    ':answer' => $answer,
                    ':score' => $score,
                ]);

                $answerNum++;
            }
            $questionNum++;
        }

        $resultNum = 1;
        while (isset($_POST['result_'. $resultNum])) {
            $result = trim($_POST['result_' . $resultNum]);
            $scoreMin = trim($_POST['result_score_min_' . $resultNum]);
            $scoreMax = trim($_POST['result_score_max_' . $resultNum]);

            $res = $db->prepare("INSERT IGNORE INTO results (`test_id`,`score_min`,`score_max`,`result`) VALUES (:test_id, :score_min, :score_max, :result)");
            $res->execute([
                ':test_id' => $testId,
                ':score_min' => $scoreMin,
                ':score_max' => $scoreMax,
                ':result' => $result,
            ]);

            $resultNum++;
        }
    }

    if($do != 'add'){
        $do = 'list';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Система тестирование</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <?php include_once 'inc/'. $do . '.php'; ?>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>