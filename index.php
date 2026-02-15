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
            $_POST['massage'],
            $_POST['tag']
        ];
        $f = fopen('massage.csv','a');
        if ($f != false){
            fputcsv($f,$arr);
            fclose($f);
        }
    }
    $f = @fopen('massage.csv','r');
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
        <h1>ホーム</h1>
        <aside>
            <ul id="side_bar">
                <li><a href=position.php>座標ページへ</a></li>
                <li><a href="description.html">マイクラ掲示板について（準備中）</a></li>
                <li><a href=project.php>大規模プロジェクトへ（準備中）</a></li>
            </ul>
        </aside>
        <table id="tweet">
        <form method="post" action=".">
            <tr>
                <th id="tweet_a"><label>投稿</label></th>
                <td id ="tweet_b"><input type="text" name="massage"></td>
            </tr>
            <tr>
                <th id="tweet_a"><label>タグ</label></th>
                <td id ="tweet_b">
                    <select name="tag" size='1' id="tag">
                        <option value="冒険" <?=$select=='冒険'?'selected':'' ?>>冒険</option>
                        <option value="建築" <?=$select=='建築'?'selected':'' ?>>建築</option>
                        <option value="開拓" <?=$select=='開拓'?'selected':'' ?>>開拓</option>
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
            <tr id=table_top><th>投稿内容</th><th>タグ</th></tr>
            <?php foreach($data as $item){ ?>
            <tr>
                <td><?= $item[0] ?></td>
                <td><?= $item[1] ?></td>
            </tr>
        <?php } ?>
        </table>
    </body>
</html>
