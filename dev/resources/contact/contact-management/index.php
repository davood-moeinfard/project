<?php $this->include("contact/layouts/header") ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5"><i class="fas fa-newspaper"></i> Contacts</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a role="button" href="<?= $this->url("contact/createContact")?>" class="btn btn-sm btn-success">create
                </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <caption>List of contacts</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>mobile number</th>
                    <th>phone number</th>
                    <th>Avatar</th>
                    <th class=" text-right"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=1;
                foreach ($contacts as $contact) {?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $contact->first_name ?></td>
                    <td><?= $contact->last_name ?></td>
                    <td><?= $contact->mobile_number ?></td>
                    <td><?= $contact->phone_number ?></td>
                    <td>
                    <?php if ($contact->image==null) { ?>
                        <img src="<?= $this->asset("image/default.png") ?>" alt="Avatar" width="50" height="50">
                    <?php }else{?>
                        <img src="<?= $this->asset($contact->image) ?>" alt="Avatar" width="50" height="50">
                    <?php }?>
                    </td>
                    <td class=" text-right">
                        <a role="button" href="<?= $this->url("contact/showContact/")."/".$contact->contacts_id?>" class="btn btn-sm btn-primary my-0 mx-1 text-white">show</a>
                        <a role="button" href="<?= $this->url("contact/editContact/")."/".$contact->contacts_id?>" class="btn btn-sm btn-info my-0 mx-1 text-white">update</a>
                        <form method="post" action="<?= $this->url("contact/destroyContact/")."/".$contact->contacts_id?>" class=" d-inline" id="form">
                            <button class="btn btn-sm btn-danger my-0 mx-1 text-white">delete</button>
                        </form>
                    </td>
                </tr>        
                <?php }?>
            </tbody>
        </table>
    </div>

<?php $this->include("contact/layouts/footer") ?>