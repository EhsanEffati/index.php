<?php
function buildHTMLFromArrays(array $twoDimArray, array $tableHeadNames): string
{
    $htmlTable = '<table>';
    // TableHead erstellen
    $htmlTable .= '<tr>';
    foreach ($tableHeadNames as $headName) {
        $htmlTable .= '<th>' . $headName . '</th>';
    }
    $htmlTable .= '</tr>';

    // TableBody erstellen
    foreach ($twoDimArray as $user) {
        $htmlTable .= '<tr>';
        foreach ($user as $key => $value) {
            $htmlTable .= '<td>' . $value . '</td>';
        }
        $htmlTable  .= '</tr>';
    }

    $htmlTable .= '</table>';
    return $htmlTable;
}