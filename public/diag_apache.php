<?php
header('Content-Type: text/plain');
echo 'PHP: ' . PHP_VERSION . PHP_EOL;
echo 'SAPI: ' . PHP_SAPI . PHP_EOL;
echo 'sys_temp: ' . sys_get_temp_dir() . PHP_EOL;
echo 'open_basedir: ' . (ini_get('open_basedir') ?: '(none)') . PHP_EOL;
echo 'disable_functions: ' . (ini_get('disable_functions') ?: '(none)') . PHP_EOL;
echo 'opcache: ' . (function_exists('opcache_get_status') ? 'yes' : 'no') . PHP_EOL;
if (function_exists('opcache_get_status')) {
    $s = @opcache_get_status(false);
    echo 'opcache enabled: ' . ($s && $s['opcache_enabled'] ? 'yes' : 'no') . PHP_EOL;
}

try {
    $f = @tempnam(sys_get_temp_dir(), 'ap_');
    echo 'A sys: ' . ($f ?: 'FAIL') . PHP_EOL;
    if ($f) @unlink($f);
} catch (Throwable $e) {
    echo 'A ERR: ' . $e->getMessage() . PHP_EOL;
}

try {
    $viewsDir = '/var/www/html/storage/framework/views';
    if (!is_dir($viewsDir)) mkdir($viewsDir, 0777, true);
    $test = $viewsDir . '/apitest.php';
    file_put_contents($test, 'x');
    $rp = realpath($test) ?: $test;
    $f = @tempnam(dirname($rp), basename($rp));
    echo 'B view: ' . ($f ?: 'FAIL') . PHP_EOL;
    if ($f) { @unlink($f); @unlink($test); }
} catch (Throwable $e) {
    echo 'B ERR: ' . $e->getMessage() . PHP_EOL;
}

try {
    $f = @tempnam('/var/www/html/storage/framework/cache', 'f_');
    echo 'C cache: ' . ($f ?: 'FAIL') . PHP_EOL;
    if ($f) @unlink($f);
} catch (Throwable $e) {
    echo 'C ERR: ' . $e->getMessage() . PHP_EOL;
}
