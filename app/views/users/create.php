<h2>Create user</h2>
<form action="/users" method="post">
  <?= csrf() ?>
  <p>Name</p>
  <input type="text" name="name"/><br>
  <input type="submit" value="create"/>
</form>
