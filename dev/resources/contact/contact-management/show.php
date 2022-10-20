<?php $this->include("contact/layouts/header") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h5"><i class="fas fa-newspaper"></i> Contact Info</h1>
</div>
<section class="table-responsive">
  <table class="table table-striped table-sm">
    <caption>Contact</caption>
    <div class="imgcontainer">
      <?php if ($contact->image==null) { ?>
        <img src="<?= $this->asset("image/default.png") ?>" alt="Avatar"class="rounded-circle" width="150" height="150">
      <?php }else{?>
        <img src="<?= $this->asset($contact->image) ?>" alt="Avatar" class="rounded-circle" width="150" height="150">
      <?php }?>
    </div>
    <thead>
      <tr>
        <th>name</th>
        <th>value</th>
      </tr>
    </thead>
    <tbody>

      <tr>
      <tr>
        <td>First Name</td>
        <td><?= $contact->first_name ?></td>
      </tr>
      <tr>
        <td>Last Name</td>
        <td><?= $contact->last_name ?></td>
      </tr>
      <tr>
        <td>Mobile Number</td>
        <td><?= $contact->mobile_number ?></td>
      </tr>
      <tr>
        <td>Phone Number</td>
        <td><?= $contact->phone_number ?></td>
      </tr>
      <tr>
        <td>Address</td>
        <td><?= $contact->address ?></td>
      </tr>
    </tbody>
  </table>
</section>
<?php $this->include("contact/layouts/footer") ?>