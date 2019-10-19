<?php

return <<< html
<form class="form-inline mt-5" action="/admin/import/xmlfile" method="POST" enctype="multipart/form-data">
  <div class="form-group col-8 mb-2">
    <label for="file" class="sr-only">Password</label>
    <input type="file" class="form-control" name="file" id="file">
  </div>
  <button type="submit" class="btn btn-outline-primary mb-2">Importar arquivo</button>
</form>
html;
