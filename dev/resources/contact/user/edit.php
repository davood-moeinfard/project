<?php $this->include("contact/layouts/header") ?>
<section class="pt-3 pb-1 mb-2 border-bottom">
  <h1 class="h5">Edit User</h1>
</section>

<section class="row my-3">
  <section class="col-12">

    <form method="post" action="<?= $this->url("user/update/".$user->id)?>" enctype="multipart/form-data">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username ..." value="<?=$user->username?>" required autofocus>
      </div>
      <div class="form-group">
        <label for="user_photo">User Photo</label>
        <input type="file" class="form-control" id="user_photo" name="user_photo">
      </div>
      <img src="<?= $this->asset($user->user_photo)?>" width="50" height="50"  alt="" >
      <div class="col-12 border-top pt-3 mt-2">
        <button type="submit" class="btn btn-primary btn-sm">update</button>
      </div>
      
      <span style="color:red; display:inline-block; direction:rtl"><?= $this->flash("fillAll") ?></span>
    </form>

  </section>
</section>
<?php $this->include("contact/layouts/footer") ?>