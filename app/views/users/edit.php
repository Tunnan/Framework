<h2>Edit</h2>

<form action="/users/<?= $user->id ?>/update" method="post">
  <?= csrf() ?>
  <p>Username</p>
  <input type="text" name="username" value="<?=  $user->username ?>" /><br>
  <input type="submit" value="Update" />
</form>
