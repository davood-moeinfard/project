<?php $this->include("contact/layouts/header") ?>
<div class="row mt-3">

  <div class="col-sm-6 col-lg-3">
    <a href="<?= $this->url("contact/contactManagement") ?>" class="text-decoration-none">
      <div class="card text-white bg-juicy-orange mb-3">
        <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-users"></i> Contacts</span> <span class="badge badge-pill right"></span><?= count($contacts)?></div>
      </div>
    </a>
  </div>
</div>

<div class="row mt-2">
  <div class="col-12">
    <h2 class="h6 pb-0 mb-0">
      Contacts
    </h2>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>name</th>
            <th>Phone Number</th>
            <th>Mobile Number</th>
            <th>Avatar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count=1;
          foreach ($contacts as $contact) {?>
          <tr>
              <td><?= $count++ ?></td>
              <td><?= $contact->first_name ." ". $contact->last_name ?></td>
              <td><?= $contact->mobile_number ?></td>
              <td><?= $contact->phone_number ?></td>
              <td>
              <?php if ($contact->image==null) { ?>
                  <img src="<?= $this->asset("image/default.png") ?>" alt="Avatar" width="50" height="50">
              <?php }else{?>
                  <img src="<?= $this->asset($contact->image) ?>" alt="Avatar" width="50" height="50">
              <?php }?>
              </td>
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<?php $this->include("contact/layouts/footer") ?>