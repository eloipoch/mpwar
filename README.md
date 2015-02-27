Symfony MPWAR Edition
=====================

[![Build Status](https://travis-ci.org/eloipoch/mpwar.svg)](https://travis-ci.org/eloipoch/mpwar)

Bienvenidos al Symfony MPWAR Edition, un proyecto SF2 totalmente
funcional para que podais tocar con vuestras manos siguiendo la
filosofia seguida en el proyecto _Horus_ de [Akamon][1].

Este documento contiene información de como descargarlo, instalarlo y
empezar a usarlo.


1) Instalar Symfony MPWAR Edition
---------------------------------

### Hacer un fork del proyecto (*opcional*)

Abrir la web de [este proyecto en Github][2] y escoger la opción _fork_
situada en la parte superior de la derecha (solo visble si se está
loginado).

### Clonar el proyecto

Con _git_ clonar el proyecto en la ruta deseada:

    git clone https://github.com/eloipoch/mpwar ruta/nombre-carpeta

### Instalar las dependencias

[Composer][3] es la herramienta utilizada para instalar las dependencias.

Si todavía no tienes _Composer_ instalado descárgalo siguiendo las
instrucciones de http://getcomposer.org/ o simplemente ejecutando el
siguiente comando:

    curl -sS https://getcomposer.org/installer | php

Entonces usa el comando `composer install` para requerir las dependencias
desde la raíz de tu proyecto:

    php composer.phar install -o


2) Comprobar la Configuración del Sistema
-----------------------------------------

Antes de empezar a programar, estar seguros de que vuestro sistema
está correctamente configurado para trabajar con Symfony.

Ejecutar el script `check.php` desde la línea de comandos:

    php app/check.php


3) Ejecutar los Tests
----------------------

Comprobar que el código funciona ejecutando los tests:

    ./bin/phpunit -c app/


4) Empezar a Programar
----------------------

Enhorabuena!! Ya lo tienes todo preparado para empezar a programar :)


[1]:  http://akamon.com/
[2]:  https://github.com/eloipoch/mpwar
[3]:  http://getcomposer.org/
