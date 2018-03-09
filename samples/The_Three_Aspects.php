<?php

/* 
 * Copyright 2018 Flavo.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * 
 * In this sample, we use the three main "aspects" of phpTableMaster in order to
 * output a simple HTML table: The skinny, but bright librarian, the "Reader";
 * the wild and untamed "Elements"; and finally the strong engineer, the
 * "Builder". The Reader will be able to decipher an array and transform into
 * Elements, and with those Elements, The Builder will finally build the
 * HTML table.
 * 
 * Here, I will try to show how easy it is to build a HTML table with numerous
 * rows with the least possible lines.
 * 
 * For now we will be using arrays for The Reader to read, but I do
 * have plans to include Readers of other kinds of sources, like HTML
 * strings.
 * 
 * This is a "simple sample", therefore I won't be focusing much of my
 * time commenting each step of it. For more details on the usage of
 * phpTableMaster, please do check the documentation.
 * 
 */

require_once __DIR__ . '../../vendor/autoload.php';

use phpTableMaster\Reader\ArrayReader;
use phpTableMaster\Builder\TableBuilder;

/**
 * Here we are manually defining the dataset. Keep in mind however, that
 * this array can be generated through all kinds of manners, for instance,
 * it could be simply the result of a database query - in that case, you
 * would only need to set the $params, since the resulting array would already
 * have the desired format.
 */
$dataSet = [
    [
        "userID" => "1",
        "name" => "George",
        "age" => "25"
    ],
    [
        "userID" => "3",
        "name" => "Anna",
        "age" => "22"
    ],
    [
        "userID" => "20",
        "name" => "Laura",
        "age" => "23"
    ],
];

$params = [
    "userID" => [],
    "name" => [],
    "age" => []
];

$reader = new ArrayReader($dataSet, $params);

$table = $reader->getTable();

$builder = new TableBuilder($table);

?>
<!DOCTYPE>
<html>
    
    <body>
        
        <?= $builder->build() ?>
        
    </body>
    
</html>