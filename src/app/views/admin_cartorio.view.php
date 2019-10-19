<?php

return <<< html
<form class="mt-5" action="/admin/search/cartorio" method="POST" id="form-search-cartorio">
  <div class="form-group col-12 mb-2">
    <div class="form-group row">
        <input type="input" class="form-control" name="nome" id="nome" placeholder="Nome cartório">
    </div>
    <div class="form-group row">
        <input type="number" class="form-control" name="documento" id="documento" placeholder="Número Documento">
    </div>
    <div class="form-group row">
        <input type="input" class="form-control" name="tabeliao" id="tabeliao" placeholder="Tabelião">
    </div>

    <button checkFields="form-search-cartorio" class="btn btn-outline-primary btn-block mb-2">Pesquisar</button>
  </div>
</form>

<script>
    $(documento).ready(function(){
        $('button[checkFields]').on('click', function(e){
            e.preventDefault();
            let formId = $(this).attr('checkFields');
            let inputs = $('#' + formId + ' :input');
            let emptyfields = 0;

            inputs.each(function() {
                if ($(this).val() == '') {
                    emptyfields += 1;
                }
            });
            
            if (emptyfields > 3){
                alert("Pelo menos um campo deve ser informado.");
                return;
            }

            console.log('envio')
            $('#' + formId).submit();

        })
    });
</script>

html;
