<?php
/* ********************************************************************
 * 
 *  File Name : SearsAPI.Class.php
 *  Version   : 0.1
 *
 * ==================================================================
 * 
 *  Date      : JUNE-14-2014
 *  Author    : schinskul@plugpuzzle.com
 *  CopyRight : PlugPuzzle , Inc
 *
 *  Note      : This PHP Class library was 
 *     written for supporting Sears API v2.1.
 *     This Class has 7 main methods and 1 sub method to use.
 *  
 *    + Function querySearsAPI ( Custom Data , Keyword )
 *    + Function topSellAPI ( Category ) 
 *    + Function storeInfoAPI ( Zip Code ) 
 *       - function storeCountAPI ( Zip Code )  
 *    + Function dailySpecialAPI ( )
 *    + Function dailyAllAPI ( )
 *    + Function weeklyDealsCategoriesAPI ( ) 
 *    + Function weeklyDealsAPI ( Category ) 
 * 
 * ******************************************************************** 
*/
 
Class SearsAPI {

  public  $version; 

  public  $apiKey;
  public  $customData;
  public  $keyword;
  public  $category;
  public  $zipcode;

  private $baseURL;
  private $searchURI;
  private $topsellURI;
  private $storeinfoURI;

  private $dailyspecialURI;
  private $dailyallURI;
  private $weeklydealscategoriesURI;
  private $weeklydealsURI;

  const BASE_URL = 'http://api.developer.sears.com/';
  const VERSION  = 'v2.1';

  public function __construct ( $token_key , $t_data_type='' , $t_store=''  ) {

     $this->setAPIKey( $token_key );  

     $this->setBaseURL ( self::BASE_URL );
     $this->setVersion ( self::VERSION );

     if ( $t_data_type && $t_store ) {

          $this->setSearchURL ( $t_data_type , $t_store );
          $this->setTopSellURL ( $t_data_type , $t_store );
          $this->setStoreInfoURL ( $t_data_type , $t_store );

          $this->setDailySpecialURL ( $t_store );
          $this->setDailyAllURL ( $t_store );
          $this->setWeeklyDealsCategoriesURL ( $t_store );
          $this->setWeeklyDealsURL ( $t_store );

     }

  }
  
  public function __destruct ( ) { 
  }

  private function setAPIKey ( $token_key='' ) {
     if ( $token_key ) {
          $this->apiKey = $token_key; 
     }
  }

  private function setBaseURL ( $t_url='' ) {
     if ( $t_url ) {
          $this->baseURL = $t_url; 
     }
  } 

  private function setVersion ( $t_version='' ) {
     if ( $t_version ) {
          $this->version = $t_version; 
     }
  }
  
  private function setSearchURL ( $t_data_type='' , $t_store='' ) {
     if ( $t_data_type && $t_store ) {
          $this->searchURI = $this->version . '/products/search/' . $t_store . '/' . $t_data_type . '/keyword/';
     }
  }

  private function setTopSellURL ( $t_data_type='' , $t_store='' ) {
     if ( $t_data_type && $t_store ) {
          $this->topsellURI = $this->version . '/products/browse/topSellers/' . $t_store . '/' . $t_data_type . '/searchType/view/'; 
     }
  }

  private function setStoreInfoURL ( $t_data_type='' , $t_store='' ) {
     if ( $t_data_type && $t_store ) {
          $this->storeinfoURI = $this->version . '/stores/storeInfo/' . $t_store . '/' . $t_data_type . '/zip/';
     }
  }

  private function setDailySpecialURL ( $t_store='' ) {
     if ( $t_store ) { 
          $this->dailyspecialURI = $this->version . '/deals/fetchDailySpecial?store=' . $t_store;
     }
  } 

  private function setDailyAllURL ( $t_store='' ) {
     if ( $t_store ) {
          $this->dailyallURI = $this->version . '/deals/fetchDailyAll?store=' . $t_store;
     }
  }

  private function setWeeklyDealsCategoriesURL ( $t_store='' ) {
     if ( $t_store ) {
          $this->weeklydealscategoriesURI = $this->version . '/deals/fetchCategories?store=' . $t_store;
     }
  } 
 
  private function setWeeklyDealsURL ( $t_store='' ) {
     if ( $t_store ) {
          $this->weeklydealsURI = $this->version . '/deals/fetchWeeklyDeals?store=' . $t_store;
     }
  }

  public function querySearsAPI ( $t_customData , $t_keyword ) {

     $this->customData = $t_customData; 
     $this->keyword    = $t_keyword;

     $parameters  = $this->keyword . '?customData=' . $this->customData . '&apikey=' . $this->apiKey;
     $completeUrl = $this->baseURL . $this->searchURI . $parameters;
     $response    = $this->sendGetRequest( $completeUrl );
  
     $response = json_decode( $response );

   return $response;
  }

  public function topSellAPI ( $t_category='' ) {

     $this->category = $t_category;  

     $parameters  = '?category=' . $this->category . '&apikey=' . $this->apiKey;
     $completeUrl = $this->baseURL . $this->topsellURI . $parameters;
     $response    = $this->sendGetRequest( $completeUrl );
     
     $response = json_decode( $response );

   return $response;
  }

  public function storeInfoAPI ( $t_zip='' ) {

     $this->zipcode = $t_zip;
  
     $parameters  = $this->zipcode . '?apikey=' . $this->apiKey;
     $completeUrl = $this->baseURL . $this->storeinfoURI . $parameters;
     $response    = $this->sendGetRequest( $completeUrl );
       
     $response = json_decode( $response );

   return $response;
  }

  public function storeCountAPI ( $t_zip='' ) {

     $objArrs = $this->storeInfoAPI ( $t_zip );
     $count   = $objArrs->showstoreinfo->getstoreInfo->StoreCount; 
  
   return $count;
  }
 
  public function dailySpecialAPI () {

     $parameters  = '&apikey=' . $this->apiKey;
     $completeUrl = $this->baseURL . $this->dailyspecialURI . $parameters;
     $response    = $this->sendGetRequest( $completeUrl );

     $response = json_decode( $response );

   return $response;
  }

  public function dailyAllAPI () {

     $parameters  = '&apikey=' . $this->apiKey;
     $completeUrl = $this->baseURL . $this->dailyallURI . $parameters;
     $response    = $this->sendGetRequest( $completeUrl );

     $response = json_decode( $response );

   return $response;
  }

  public function weeklyDealsCategoriesAPI () {

     $parameters  = '&apikey=' . $this->apiKey;
     $completeUrl = $this->baseURL . $this->weeklydealscategoriesURI . $parameters;
     $response    = $this->sendGetRequest( $completeUrl );

     $response = json_decode( $response );

   return $response;
  }

  public function weeklyDealsAPI ( $t_category='' ) {

     $parameters  = '&category=' . $t_category . '&apikey=' . $this->apiKey;
     $completeUrl = $this->baseURL . $this->weeklydealsURI . $parameters;
     $response    = $this->sendGetRequest( $completeUrl );

     $response = json_decode( $response );

   return $response;
  }

  public function sendGetRequest ( $completeUrl ) {

     $con = curl_init();
     curl_setopt( $con, CURLOPT_URL, $completeUrl );
     curl_setopt( $con, CURLOPT_RETURNTRANSFER, 1 );
     $result = curl_exec( $con );
     curl_close($con);  

   return $result;
  }

}
?>
