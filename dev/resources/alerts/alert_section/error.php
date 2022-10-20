<?php if ($this->flash('alert_section_error')){
  print  "<div class='mb-2 alert alert-danger'> <small class='form-text text-danger'>{$this->flash("alert_section_error")}</small> </div>";
}
?>
