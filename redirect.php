<?php

class Redirect{

	
		public static function redirectTo( $location ) {
			if($location){
    		 header("Location: {$location}");}
    exit;
  	
	}
	
}
$redirect = new Redirect();

?>
