<?php
    /**
     * {
     *      "name":"generateToken",
     *      "param":{
     *          "email":"emlara35@gmail",
     *          "pass":"pass123"
     *       }
     * }
     */

     /**
      * token = eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDA4NzYzODYsImlzcyI6ImxvY2FsaG9zdCIsImV4cCI6MTYwMDg3NjQ0NiwidXNlcklkIjoiRWR3aW5NTGFyYSJ9.eqI45ozl5RmeVVgxxPekU1HcV-eBz1DQIoGT37jsHt4
     * {
     *      "name":"constructionData",
     *      "param":{
     *          "numero_recibo":"cadena"
     *       }
     * }
     */
    require_once('Api.php');

    $api = new Api();
    $api->processApi();
?>