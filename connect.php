<?php

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $data_base = 'registration';

    $con = mysqli_connect( $host, $user, $password, $data_base );

    if ( ! $con ) {
        die( mysqli_error() );
    }

?>