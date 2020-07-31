<?php
    // データベース接続ファイルの読み込み
    require("./dbconnect.php");
    require("./header.php");

    $edit_post_id = $_POST['edit_post_id'];

    $sql = 'SELECT * FROM posts WHERE id=:edit_post_id';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':edit_post_id', $edit_post_id, PDO::PARAM_INT);
    $statement->execute();

    $array = $statement->fetchAll(PDO::FETCH_NUM);
    $array = $array[0];
    
    $professor_evolution = ["S", "A", "B", "C", "D"];
?>

<form action="edit_post_do.php" method="post">
    <input type="hidden" name="edit_post_id" value="<?php echo $edit_post_id; ?>">
    <div>
        <label>大学名：</label>
        <input type="text" name="univ_name" value="<?php echo $array[1]; ?>" required>
    </div>

    <div>
        <label>学部名：</label>
        <input type="text" name="faculity" value="<?php echo $array[2]; ?>" required>
    </div>

    <div>
        <label>教授の名前：</label>
        <input type="text" name="professor_name" value="<?php echo $array[3]; ?>" required>
    </div>

    <div>
        <label>教授の授業の評価：</label>
        <select name="easy_class" required>

            <option><?php echo $array[4]; ?></option>

            <?php foreach($professor_evolution as $str): ?>
                <?php if($str !== $array[4]): ?>
                    <option><?php echo $str; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>

        </select>

    </div>
    <br>
    <div>
        <textarea name="other_info" cols="30" rows="10" required><?php echo $array[5]; ?></textarea>
    </div>
    <br>
    <input type="submit" value="投稿する">

</form>

