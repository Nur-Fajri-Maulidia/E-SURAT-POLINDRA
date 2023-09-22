<?php

return [
    'node' => null,
    'npm' => null,
    'timeout' => 0,
    'bypassHeadless' => false,
    'noSandbox' => true, // Add this line to fix Chrome launch issues
    'options' => [
        'args' => ['--disable-gpu', '--headless', '--no-sandbox', '--disable-dev-shm-usage'], // Add this line to fix Chrome launch issues
    ],
];
