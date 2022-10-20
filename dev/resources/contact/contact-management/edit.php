<?php $this->include("contact/layouts/header") ?>
<section class="pt-3 pb-1 mb-2 border-bottom">
  <h1 class="h5">Edit Contact</h1>
</section>

  <form method="post" action="<?= $this->url("contact/updateContact")."/".$contact->id ?>" enctype="multipart/form-data">
    <section class="form-row">
        <div class="form-group col-12 col-md-6">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $contact->first_name ?>" required autofocus>
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $contact->last_name ?>" required autofocus>
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="mobile_number">Mobile Number</label>
          <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?= $contact->mobile_number ?>" required autofocus>
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="phone_number">Phone Name</label>
          <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $contact->phone_number ?>">
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" value="<?= $contact->address ?>">
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="image">Contact Photo</label>
          <input type="file" class="form-control" id="image" name="image">
          <img src="<?= $this->asset($contact->image)?>" width="50" height="50" class="mt-2" >
        </div>
        <div class="col-12 border-top pt-3 mt-1">
          <input type="submit" class="btn btn-primary" value="update">
        </div>
    </section>
  </form>
<?php $this->include("contact/layouts/footer") ?>