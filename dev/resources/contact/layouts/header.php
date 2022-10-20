<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="shortcut icon" href="" type="image/x-icon" />
    <link rel="stylesheet" href="<?= $this->asset("contact-panel/css/bootstrap.min.css") ?>" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="<?= $this->asset("contact-panel/css/style.css") ?>" rel="stylesheet" type="text/css">
</head>

<body>

    <nav class="navbar  navbar-light bg-gradiant-green-blue nav-shadow">

    <a href=""></a>
        <span class="dropdown"><span style="font-weight:bold"></span>
            <a class="dropdown-toggle text-decoration-none text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if ($_SESSION['user_photo']==null) {?>
                    <i class="fas fa-user"></i>
                <?php }else{?>
                    <img src="<?= $this->asset($_SESSION['user_photo'])?>" width="30" height="30" class="rounded-circle"  alt="" >
                <?php } ?>
            </a>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="fas fa-home pl-2"> Contact Panel</a>
                <a class="dropdown-item" href="<?= $this->url("auth/logout") ?>">logout</a>
            </div>
        </span>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block pt-3 bg-sidebar sidebar px-0">
                <a class="text-decoration-none d-block py-1 px-2 mt-1" href="<?= $this->url("contact/index") ?>"><i class="fas fa-home"></i> Home</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-1" href="<?= $this->url("contact/contactManagement") ?>"><i class="fas fa-clipboard-list"></i> Manage Contacts</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-1" href="<?= $this->url("user/edit") ?>"><i class="fas fa-user"></i> User</a>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">