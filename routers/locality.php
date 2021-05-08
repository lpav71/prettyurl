<?php

// GET /region/{regionId}/locality
if ($method === 'GET' && count($urlData) === 2 && $urlData[1] === 'locality') {
    echo 'locality ' . $urlData[0];
}


function route($method, $urlData, $formData)
{
    // GET /locality/create
    if ($method === 'GET' && count($urlData) === 1 && $urlData[0] === 'create') {
        echo 'locality';
    }
}
