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

foreach ($config as $item) {
    $libraryDir = sprintf('/%s/%s', $item['id'], $item['version']);

    $buildFile .= sprintf('mkdir -p %s%s', $installDir, $libraryDir) . "\n";
    $buildFile .= sprintf('cd %s%s', $installDir, $libraryDir) . "\n";
    $buildFile .= sprintf('if [ -f package.json ]; then yarn; else echo "{}" > package.json && yarn add %s@%s; fi', $item['id'], $item['version']) . "\n";

    $buildFile .= sprintf('mkdir -p %s%s', $distDir, $libraryDir) . "\n";
    $buildFile .= sprintf('cp -R %s%s%s/* %s%s', $installDir, $libraryDir, $item['dir'], $distDir, $libraryDir) . "\n";
}

echo $buildFile;
