<?php

if (!empty($table_head) && !empty($table_data) && !empty($table_draw)) {
    $html = '<table class="table">';
        $html .= '<thead><tr>';
            foreach ($table_head as $header) {
                $html .= '<th scope="col">'.$header.'</th>';
            }
        $html .= '<tbody>';
            foreach ($table_data as $data) {
                $html .= '<tr>'.call_user_func($table_draw, $data).'</tr>';
            }
        $html .= '</tbody>';
    $html .= '<table>';
}

return $html;