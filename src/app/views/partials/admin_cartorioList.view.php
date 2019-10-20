<?php

if (!empty($cartorios)) {
    $table_head = ['Nome', 'Tabelião', 'Cidade', 'Editar', 'Delete'];
    $table_data = $cartorios;
    $table_draw = function ($data) {
        return '
        <td>' . utf8_encode($data['nome']) . '</td>
        <td>' . utf8_encode($data['tabeliao']) . '</td>
        <td>' . utf8_encode($data['cidade']) . '</td>
        <td><a href="/admin/edit/cartorio/info?id='.$data['id'].'" class="btn btn-outline-info">Editar</a></td>
        <td><a href="/admin/delete/cartorio?id='.$data['id'].'" class="btn btn-outline-danger" actionConfirm="">Apagar</a></td>
        ';
    };

    $html = require __DIR__.'/../table.view.php';

    if (!empty($page)) {
        $html .= '
            <div class="d-flex justify-content-center">
            <div class="col-6">' . (($page == 1)? '' : '<a href="/admin/list/cartorio?page='.($page - 1).'">Anterior</a>').'</div>
            <div class="col-6 text-right"><a href="/admin/list/cartorio?page='.($page+1).'">Próxima</a></div>
        </div>';
    }

    $html .= '
        <script>
            $(document).ready(function(){
                $("a[actionConfirm]").click(function(){
                    return confirm("Realmente deseja apagar as informações do cartório?");
                })
            });
        </script>
    ';
} else {
    $html = '<p>Nenhum item encontrado.</p>';
}

return $html;