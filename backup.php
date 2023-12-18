<?php
// veritabanı bağlantısı
$db = new mysqli('localhost', 'lotustr_lasty', '[J*k0]w3le-]', 'lotustr_partner'); 

// tüm tabloları alalım
if ($tables == '*') {
    $tables = array();
    $result = $db->query("SHOW TABLES");
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
} else {
    $tables = is_array($tables) ? $tables : explode(',', $tables);
}

// dosyaya yazdırılacak SQL sorguları
$return = '';

// tablolar içerisinde dönelim
foreach ($tables as $table) {
    $result = $db->query("SELECT * FROM $table");
    $numColumns = $result->field_count;

    $result2 = $db->query("SHOW CREATE TABLE $table");
    $row2 = $result2->fetch_row();

    $return .= "\n\n".$row2[1].";\n\n";

    while ($row = $result->fetch_row()) {
        $return .= "INSERT INTO $table VALUES(";
        for ($j = 0; $j < $numColumns; $j++) {
            $row[$j] = addslashes($row[$j]);
            $row[$j] = ereg_replace("\n", "\\n", $row[$j]);
            if (isset($row[$j])) {
                $return .= '"' . $row[$j] . '"';
            } else {
                $return .= '""';
            }
            if ($j < ($numColumns-1)) {
                $return .= ',';
            }
        }
        $return .= ");\n";
    }

    $return .= "\n\n\n";
}

// dosyayı kaydedelim
$filename = 'backups/db-backup-'.time().'.sql';
if (file_put_contents($filename, $return)) {
    echo "Backup created successfully at $filename";
} else {
    echo "Error creating backup";
}
?>
