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

const MAX_TRIES = 20;

$path = __DIR__ . '/vendor/autoload.php';

$tries = 0;
$backtrace = '';

while($tries < MAX_TRIES) {
    
    if(file_exists($path)) {
        
        require_once $path;
        
        return;
        
    } else {
        
        $backtrace .= '../';
        
        $path = __DIR__ . $backtrace . 'vendor/autoload.php';
        
    }
    
}

throw new Exception("After $tries tries I still couldn't find the composer autoload. Install the library via composer.");
