<?php

// Create a PDO object and connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=treebase', 'root', 'root');

// Create a DirectoryModel object
$directoryModel = new DirectoryModel($pdo);

// Get all descendants of directory with ID 1 as a tree
$tree = $directoryModel->getDescendantsAsTree(1);

// Get all descendants of directory with ID 1 as a flat list
$flatList = $directoryModel->getDescendantsAsFlatList(1);

function displayTree($tree, $indent = 0) {
    foreach ($tree as $node) {
        echo str_repeat('-', $indent) . $node['name'] . PHP_EOL;
        if (isset($node['children'])) {
            displayTree($node['children'], $indent + 2);
        }
    }
}

displayTree($tree);

foreach ($flatList as $item) {
    echo $item['name'] . PHP_EOL;
}