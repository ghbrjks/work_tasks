<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=comments', 'root', '');
$select_content = "SELECT content FROM comments";
$stmt = $pdo->query($select_content);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_content'])) {
    $add_comment = $pdo->prepare("INSERT INTO comments (content) VALUES(:content)");
    $add_comment->bindParam(':content', $_POST['comment_content']);
    $add_comment->execute();
}
