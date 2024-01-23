<?php
$filename = $argv[1]; 
 
$urls = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
 
echo "\n========== MUTAZI WEB SCANNER ==========\n\n";
 
function isInternetConnected()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    }
    return false;
}
 
if (isInternetConnected()) {
    echo "\nSuccess Connected Google!... \n\n";
 
	foreach ($urls as $url) {
    $html = file_get_contents($url);
    $keyword = 'var phpdebugbar = new PhpDebugBar.DebugBar();';
    $found = strpos($html, $keyword);
 
    echo "•> " . $url;
 
    if ($found !== false) {
        echo "   ";
        sleep(1);
        echo "===[LIVE]===\n";
        sleep(1);
 
        $result = $url . "\n";
        $filename = 'result-' . date('Y-m-d') . '.txt';
 
        // Menyimpan hasil ke file
        file_put_contents($filename, $result, FILE_APPEND);
    } else {
        echo "\n";
        sleep(1);
    }
}
 
sleep(1);
echo "\n========== PROSES SCAN TELAH SELESAI ==========\n";
 
 
} else {
    echo "\n===[ Pastikan Internet Terhubung ]===\n";
}