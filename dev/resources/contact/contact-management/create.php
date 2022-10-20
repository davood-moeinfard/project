<?php $this->include("contact/layouts/header") ?>
<section class="pt-3 pb-1 mb-2 border-bottom">
  <h1 class="h5">Create Contact</h1>
</section>

  <form method="post" action="<?= $this->url("contact/storeContact")?>" enctype="multipart/form-data">
    <section class="form-row">
        <div class="form-group col-12 col-md-6">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name ..." required autofocus>
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name ..." required autofocus>
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="mobile_number">Mobile Number</label>
          <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter mobile number ..." required autofocus> 
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="phone_number">Phone Name</label>
          <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number ...">
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Enter address ...">
        </div>
        <div class="form-group col-12 col-md-6">
          <label for="image">Contact Photo</label>
          <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="col-12 border-top pt-3 mt-1">
          <input type="submit" class="btn btn-primary" value="store">
        </div>
    </section>
  </form>
<?php $this->include("contact/layouts/footer") ?>