<?php

return <<< html
<div class="alert alert-{$msg['type']} alert-dismissible fade show" role="alert">
  {$msg['msg']}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
html;
