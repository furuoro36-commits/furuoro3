<?php
    $data = [];
    $select = "";
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        if (isset($_POST['tag'])){
            $select = $_POST['tag'];
        }
        else{
            $select='';
        }
        $arr = [
            $_POST['m'],
            $_POST['x'],
            $_POST['y'],
            $_POST['z'],
            $select
        ];
        $f = fopen('position.csv','a');
        if ($f != false){
            fputcsv($f,$arr);
            fclose($f);
        }
    }
    $f = @fopen('position.csv','r');
    if ($f != false){
        while($row = fgetcsv($f)) {
        array_unshift($data,$row);
    }
    fclose($f);
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
        <link rel="icon" type="image/png" href="image/Grass_Block_JE7_BE6.png">
    </head>
    <body>
        <h1>座標ページ</h1>
        <aside>
            <ul id="side_bar">
                <li><a href=index.php>ホームへ戻る</a></li>
                <li><a href="description.html">マイクラ掲示板について（準備中）</a></li>
                <li><a href=project.php>大規模プロジェクトへ（準備中）</a></li>
            </ul>
        </aside>
        <table id="tweet">
        <form method="post" action="position.php">
            <tr>
                <th id="tweet_a"><label>名称</label></th>
                <td id="tweet_b"><input type="text" name="m"></td>
            </tr>
            <tr>
                <th id="tweet_a"><label>ｘ座標</label></th>
                <td id="tweet_b"><input type="text" name="x"></td>
            </tr>
            <tr>
                <th id="tweet_a"><label>ｙ座標</label></th>
                <td id="tweet_b"><input type="text" name="y"></td>
            </tr>
            <tr>
                <th id="tweet_a"><label>ｚ座標</label></th>
                <td id="tweet_b"><input type="text" name="z"></td>
            </tr>
            <tr>
                <th id="tweet_a"><label>タグ</label></th>
                <td id="tweet_b">
                    <select name="tag" size='1' id="tag">
                        <option value="拠点" <?=$select=='拠点'?'selected':'' ?>>拠点</option>
                        <option value="トラップ" <?=$select=='トラップ'?'selected':'' ?>>トラップ</option>
                        <option value="ダンジョン" <?=$select=='ダンジョン'?'selected':'' ?>>ダンジョン</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="投稿" id="decision"></td>
            </tr>
        </form>
        </table>
        <table id="msg">
            <tr id=table_top><th>投稿内容</th><th>ｘ座標</th><th>ｙ座標</th><th>ｚ座標</th><th>タグ</th></tr>
            <?php foreach($data as $item){ ?>
            <tr>
                <td><?= $item[0] ?></td>
                <td><?= $item[1] ?></td>
                <td><?= $item[2] ?></td>
                <td><?= $item[3] ?></td>
                <td><?= $item[4] ?></td>
            </tr>
        <?php } ?>
        </table>
    </body>
</html>
