<?php
    $massage = 'メッセージを投稿してください';
    $dat = [];
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $ar = [
            $_POST['m'],
            $_POST['x'],
            $_POST['y'],
            $_POST['z']
        ];
        $i = fopen('position.csv','a');
        if ($i != false){
            fputcsv($i,$ar);
            fclose($i);
        }
        $massage = 'データを追加しました';
    }
    $i = @fopen('.csv','r');
    if ($i != false){
        while($r = fgetcsv($i)) {
        array_unshift($dat,$r);
    }
    fclose($i);
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>マイクラ掲示板</title>
        <meta name="description" content="割と及第の掲示板です">
        <link rel="stylesheet" href="minecraft.css">
        <link rel="icon" type="image/png" href="image/club_logo.png">
    </head>
    <body>
        <h1>座標ページ</h1>
        <p><?= $massage ?></p>
        <table>
        <form method="post" action="project.php">
            <tr>
                <th><label>名称</label></th>
                <td><input type="text" name="m"></td>
            </tr>
            <tr>
                <th><label>ｘ座標</label></th>
                <td><input type="text" name="x"></td>
            </tr>
            <tr>
                <th><label>ｙ座標</label></th>
                <td><input type="text" name="y"></td>
            </tr>
            <tr>
                <th><label>ｚ座標</label></th>
                <td><input type="text" name="z"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="投稿"></td>
            </tr>
        </form>
        </table>
        <table>
            <tr><th>投稿内容</th><th>ｘ座標</th><th>ｙ座標</th><th>ｚ座標</th></tr>
            <?php foreach($dat as $item){ ?>
            <tr>
                <td><?= $item[0] ?></td>
                <td><?= $item[1] ?></td>
                <td><?= $item[2] ?></td>
                <td><?= $item[3] ?></td>
            </tr>
        <?php } ?>
        </table>
        <a href=index.php>ホームへ戻る</a>
    </body>
</html>
