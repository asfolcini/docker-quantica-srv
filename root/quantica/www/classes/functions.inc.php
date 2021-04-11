<?php



/**
 *  CSV DOWNLOAD
 */
function array_to_csv_download($array, $filename = "export.csv", $delimiter) {
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    
    $f = fopen('php://output', 'w');
    
    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
}
    
    
    
?>