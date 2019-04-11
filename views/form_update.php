<h3>Update Form '<? echo $form['title'] ?>'</h3>

<form action="/forms/update" method="POST">
    Title:
    <input type="text" name="form[title]" value="<?php echo $form['title'] ?>"/>
    <br>
    Content:
    <textarea name="form[content]" placeholder="<?php echo $form['content'] ?>"></textarea>
    <input type="text" name="id" value="<?= $form['id'] ?> " hidden/>
    <br>
    <input type="submit" value="Update"/>
</form>