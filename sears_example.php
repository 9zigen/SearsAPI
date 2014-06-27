<?php
require( 'SearsAPI.Class.php' );

$apiKey   = 'ADD YOUR SEARS API KEY HERE';
$dataType = 'json';   // json , xml 
$store    = 'Sears';  // Sears , Kmart , Mygofer , Craftsman , Kenmore

$sears = new SearsAPI( $apiKey , $dataType , $store );


/* - querySearsAPI - */
/*
$customData = ''; 
$keyword = 'Watch';
$results = $sears->querySearsAPI( $customData , $keyword );
print_r( $results ); exit;
*/


/* - topSellAPI - */
/*
$category = 'Baby&Kids';
$results = $sears->topSellAPI( $category );
print_r( $results ); exit;
*/


/* - storeInfoAPI - */
/*
$zipcode = '11373';
$results = $sears->storeInfoAPI( $zipcode );
print_r( $results ); exit;
*/


/* - storeCountAPI - */
/*
$zipcode = '11373';
$results = $sears->storeCountAPI( $zipcode );
print_r( $results ); exit;
*/


/* - dailySpecialAPI - */
/*
$results = $sears->dailySpecialAPI();
print_r( $results ); exit;
*/


/* - dailyAllAPI - */
/*
$results = $sears->dailyAllAPI();
print_r( $results ); exit;
*/


/* - weeklyDealsCategoriesAPI - */
/*
$results = $sears->weeklyDealsCategoriesAPI();
print_r( $results ); exit;
*/


/* - weeklyDealsAPI - */
/*
$category = 'Sears_Appliance';
$results = $sears->weeklyDealsAPI( $category );
print_r( $results ); exit;
*/



?>
