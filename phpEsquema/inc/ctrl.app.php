<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$code = $_POST['code'];

switch ($code) {
    case "HJTX3gAAAANAQU592tpw/s3tSBFH6L74DGs3xYw3JY/D542qMPKp6quSWhQ03l8O+kIO6Xe6kE6gOPR2Hc2M3cga9MDTvITACg9ZSsbcjej6TQLvYQWpWS8quiqXdkOiN+yA7nTL+4lBEjjweGUsjWwujh3YCixXB7iKT8jipY4wDw1WYK5ttuG40dlq9hvH+Brsj+J6UFVnmRtJSMKqJ3Q2/gSiiD0GYL99VEspX6uDuTrjX0QWRanWrjnFwPW4x/zbZzfpJIslX3rw0a/a6a/UKnFm5dzWtpsQbLixZRUy/MOr9OahRuroDRugjSw96rjrejeWoxSJSzc=":
        $out = "http://localhost/phpEsquema/inc/clients.php";
        break;
    default:
        $out = '-1|Controlador no definido';
}

echo $out;
