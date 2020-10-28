<?php
/*****************************************************************************/
/* Constants */
/*****************************************************************************/

define("FILTER_BY", "filter-by");
define("SEARCH_TERM_REQUIRED", "search_term_required");
define("VOLUNTEER_FORM_FNAME", "volunteer-fname");
define("VOLUNTEER_FORM_LNAME", "volunteer-lname");
define("VOLUNTEER_FORM_TEL", "volunteer-tel");
define("VOLUNTEER_FORM_STREET", "volunteer-street");
define("VOLUNTEER_FORM_CITY", "volunteer-city");
define("VOLUNTEER_FORM_PROVINCE", "volunteer-province");
define("VOLUNTEER_FORM_POSTAL","volunteer-postal");
define("VOLUNTEER_FORM_WORKPLACE", "volunteer-workplace");
define("DRIVER_FORM_FNAME", "driver-fname");
define("DRIVER_FORM_LNAME", "driver-lname");
define("DRIVER_FORM_TEL", "driver-tel");
define("DRIVER_FORM_STREET", "driver-street");
define("DRIVER_FORM_CITY", "driver-city");
define("DRIVER_FORM_PROVINCE", "driver-province");
define("DRIVER_FORM_POSTAL", "driver-postal");
define("DRIVER_FORM_LICENCE", "driver-licence-number");
define("DRIVER_FORM_PLATE", "driver-licence-plate");

/*****************************************************************************/
/* Database */
/*****************************************************************************/
$dbh = new PDO('mysql:host=localhost;dbname=group26',"root","");


/*****************************************************************************/
/* Functions */
/*****************************************************************************/

function print_head($page_title){ ?>
  <head>
    <title><?= $page_title ?></title>
    <meta charset="utf-8"/>
    <meta name="author" content="Liam Fiebig"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <?php

}


function test_input($input){
  $input = trim($input);
  $input = trim($input, "!@#$%^&*()");
  if ($input) :
    return $input;
  else :
     return false;

  endif;
}
