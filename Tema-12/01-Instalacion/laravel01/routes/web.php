<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return 'Hola Mundo Laravel';
});

// Ruta con parámetros
Route::get('/saludo/{nombre}', function ($nombre) {
    return "Hola, $nombre!";
});

// Ruta con varios parámetros 
// Route::get('/suma/{num1}/{num2}', function ($num1, $num2) {
//     $suma = $num1 + $num2;
//     return "La suma de $num1 y $num2 es: $suma";
// });

// Misma ruta con el segundo parámetro opcional
Route::get('/suma/{num1}/{num2?}', function ($num1, $num2 = 0) {
    $suma = $num1 + $num2;
    return "La suma de $num1 y $num2 es: $suma";
});