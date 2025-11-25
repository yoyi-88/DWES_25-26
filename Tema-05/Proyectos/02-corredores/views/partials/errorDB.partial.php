<?php

echo 'ERROR DE BASE DE DATOS' . '<br>';
echo 'Mensaje: ' . $e->getMessage() . '<br>';
echo 'Código de error: ' . $e->getCode() . '<br>';
echo 'Fichero: ' . $e->getFile() . '<br>';
echo 'Línea: ' . $e->getLine() . '<br>';
