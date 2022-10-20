</main>
</div>
</div>
<script src="<?= $this->asset("auth-panel/jquery/jquery-3.2.1.min.js") ?>"></script>
<script src="<?= $this->asset("contact-panel/js/bootstrap.min.js") ?>"></script>
<script src="<?= $this->asset("contact-panel/js/mdb.min.js") ?>"></script>
<script src="<?= $this->asset("contact-panel/js/sweetalert2@11.js") ?>"></script>
</body>
</html>
  <?php
  $this->include("alerts/sweetalert/success");
  $this->include("alerts/sweetalert/error");
  $this->include("alerts/sweetalert/delete-confirm");
  ?>