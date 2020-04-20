#!/usr/bin/env php
<?php

$configFile = __DIR__ . '/config.json';
$json = file_get_contents($configFile);
$config = json_decode($json, true);

$distDir = __DIR__ . '/dist';
$installDir = __DIR__ . '/src';

$buildFile = <<<BASH
#!/bin/bash

set -e
\n
BASH;

function prepareNpmItem($item, $installDir, $distDir) {
    $libraryDir = sprintf('/%s/%s', $item['id'], $item['version']);
    $output = '';

    $output .= sprintf('mkdir -p %s%s', $installDir, $libraryDir) . "\n";
    $output .= sprintf('cd %s%s', $installDir, $libraryDir) . "\n";
    $output .= sprintf('if [ -f package.json ]; then yarn; else echo "{}" > package.json && yarn add %s@%s; fi', $item['id'], $item['version']) . "\n";

    $output .= sprintf('mkdir -p %s%s', $distDir, $libraryDir) . "\n";
    $output .= sprintf('cp -R %s%s%s/* %s%s', $installDir, $libraryDir, $item['dir'], $distDir, $libraryDir) . "\n";
    $output .= "\n";
    return $output;
}

function prepareHttpItem($item, $installDir, $distDir) {
    $libraryDir = sprintf('/%s/%s', $item['id'], $item['version']);
    $output = '';

    $parsedUrl = parse_url($item['url']);
    $pathInfo = pathinfo($parsedUrl['path']);
    $fileName = $pathInfo['basename'];

    $filePathForDownloadedFile = $installDir . $libraryDir . '/' . $fileName;
    $filePathForDistFile = $distDir . $libraryDir . '/' . $fileName;

    $output .= sprintf('mkdir -p %s%s', $installDir, $libraryDir) . "\n";
    $output .= sprintf('curl %s --output %s', $item['url'], $filePathForDownloadedFile) . "\n";
    $output .= sprintf('mkdir -p %s%s', $distDir, $libraryDir) . "\n";
    $output .= sprintf('cp %s %s', $filePathForDownloadedFile, $filePathForDistFile) . "\n";
    $output .= "\n";
    return $output;
}

foreach ($config as $item) {
    switch ($item['type']) {
        case 'npm': {
            $buildFile .= prepareNpmItem($item, $installDir, $distDir);
            break;
        }
        case 'http': {
            $buildFile .= prepareHttpItem($item, $installDir, $distDir);
            break;
        }
        default:
            $buildFile .= sprintf('# Unknown type "%s" for "%s". Skipping...', $item['type'], $item['id']) . "\n\n";
            break;
    }
}

echo $buildFile;
