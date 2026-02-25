<?php

use App\Services\Sanity;
use Illuminate\Support\Facades\Route;

Route::get('/sanity-test', function (Sanity $sanity) {
    // This works even before you create any schemas/content.
    // It just lists the first 5 document ids.
    $data = $sanity->query('*[defined(_id)][0..4]{_id,_type}');
    return response()->json($data);
});