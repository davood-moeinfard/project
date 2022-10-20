<!-- Page Not Found -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>صفحه یافت نشد</title>
  <link rel="stylesheet" href="<?= $this->asset('css/product-preview.css') ?>">
</head>
<body>
  <div id="switcher">
    <div class="center">
      <ul class="links">
        <li class="close">
          <a href="<?= $this->url("contact/index") ?>">
          بازگشت
          </a>
        </li>
      </ul>
    </div>
    <div>
      <img src="<?=$this->asset('image/004.jpg') ?>" style="max-width:100%;max-height:100%;object-fit: contain">
    </div>
  </div>
</body>

</html>