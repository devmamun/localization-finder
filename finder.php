<?php
ini_set('max_execution_time', 10000);
$path   = 'F:\wampp\www\multi_vendor';

$list = [];
function listFolderFiles($dir, &$list)
{
    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);
    
    
    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;

    $totalFiles = 0;
    foreach ($ffs as $ff) {
        $totalFiles++;
        if (file_exists($dir . '/' . $ff) && !is_dir($dir . '/' . $ff)) {
            $list[] = $dir . '/' . $ff;
        }
        if (is_dir($dir . '/' . $ff)) listFolderFiles($dir . '/' . $ff, $list);
    }
}

function test($path) {
    listFolderFiles($path, $list);
    // listFolderFiles($jsPath, $list);
    $text = '';
    $arr = [];
    $count = 1;
    foreach ($list as $item) {
        $fileData = [
            'file_counter' => $count++,
            'total_files' => count($list)
        ];
        if ($count % 20 == 0) {
            $textFile = fopen("F:/wampp/www/package-development/localization-finder/assets/file/file.txt", "w");
            fwrite($textFile, json_encode($fileData));
        }
        $fh = fopen($item, 'r');

        while ($line = fgets($fh)) {
            preg_match_all('#\_\_\([\'\"](.*?)[\'\"][( ,),\)]#', $line, $match);
            preg_match_all('#jsLang\([\'\"](.*?)[\'\"][( ,),\)]#', $line, $jsMatch);

            foreach ($match[1] as $key => $value) {
                if (!in_array($value, $arr)) {
                    $arr[] = $value;
                    $text .= '    "' . $value . '": "' . $value . '",' . "\n";
                }
            }
            foreach ($jsMatch[1] as $key => $value) {
                if (!in_array($value, $arr)) {
                    $arr[] = $value;
                    $text .= '    "' .  $value . '": "' . $value . '",' . "\n";
                }
            }
        }
        fclose($fh);
    }

    $text = str_replace("\'", "'", $text);

    $text = "{\n" . $text . "}";
    $text = str_replace(",\n}", "\n}", $text);
    // echo $text;

    $lang = fopen("F:/wampp/www/package-development/localization-finder/assets/lang/en.json", "w");
    fwrite($lang, $text);
    fclose($lang);

    $textFile = fopen("F:/wampp/www/package-development/localization-finder/assets/file/file.txt", "w");
    fwrite($textFile, '');
    fclose($textFile);
    echo 'success';
}

if ($_REQUEST['query'] == 'test') {
    test($path);
}

