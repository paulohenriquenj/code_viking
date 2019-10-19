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

    $html = require 'table.view.php';

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