<?php

return <<< html
<form class="mt-5" action="/admin/edit/news" method="POST" target="_blank">
  <div class="form-group col-12 mb-2 mx-auto">
    <label for="news" class="sr-only">Arquivo</label>
    <textarea class="form-control" name="news" id="news" height='300px'></textarea>
    <button type="submit" class="btn btn-outline-primary mt-2 btn-block ">Visualizar informativo</button>
  </div>
</form>
html;
