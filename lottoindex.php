<?php
error_reporting(0);


class lottoParser{

	public $data;
	public $sm = 0;
	public $rm = 0;
	public $f2 = 0;
	public $l2 = 0;

	public function __construct(){

		//$json_file = file_get_contents(__DIR__ . "/" . "onepm.json");
		$json_file = file_get_contents("http://geekydroid.com/hacks/onepm.json");

		$json_file = json_decode($json_file, TRUE);
		
		$data = array();
		
		for ( $i = 0; $i <= 279; $i++){

		 	
		 	$date =  $json_file["rows"][$i]["LotoFecha"];
		 	$sorteo = $json_file["rows"][$i]["NumSorteo"];
		 	$win_nums = preg_split("/[\s]+/", $json_file["rows"][$i]["ganadores"]);
			$win_nums_str = $win_nums[0] ." ". $win_nums[1] ." ". $win_nums[2];		 
		 	$name = $json_file["rows"][0]["nombre"];

		 	$data["$i"]["date"]  = $date;
			$data["$i"]["sorteo"] = $sorteo;
			$data["$i"]["win_nums"][0] = $win_nums[0];
			$data["$i"]["win_nums"][1] = $win_nums[1];
			$data["$i"]["win_nums"][2] = $win_nums[2];
			$data["$i"]["name"] = $name;

			
		}
		
	return $this->data = $data;	


		

	}


	public function straight_match($num1, $num2, $num3){

	if ( is_int($num1) && is_int($num2) && is_int($num3) ){
		

		for ($i =0; $i<=279; $i++){
			
			$win_nums = $this->data[$i]["win_nums"];
			
			if( $win_nums[0] == $num1 && $win_nums[1] == $num2 && $win_nums[2] == $num3 ){
			

				echo "<p><b>Consecutive Numeric Matches:</b></p>";
				echo "<p>date => " . $this->data[$i]["date"] . " <br />"; 
				echo " Sorteo => " . $this->data[$i]["sorteo"] . " <br />";  
				echo "  Name => " . str_replace("<BR>", " ", $this->data[$i]["name"] . " <br />"); 
				echo " Winning #'s: <b>" . $win_nums[0] . " " . $win_nums[1] . " " . $win_nums[2] . "</b></p>";
				
				$this->sm += 1;    
				

		}
		
	}

	if ( $this->sm == 0 ) {  echo "<p><b>No consecutive matches located:</b></p><p>  Pattern: <b>$num1, $num2, $num3</b></p>"; }

}

}


	public function rev_match($num1, $num2, $num3){

	if ( is_int($num1) && is_int($num2) && is_int($num3) ){
		
		$rev_matches = 0;

		for ($i =0; $i<=279; $i++){
			
			$win_nums = $this->data[$i]["win_nums"];
			
			if( $win_nums[0] == $num3 && $win_nums[1] == $num2 && $win_nums[2] == $num1 ){
			

				echo "<p><b>Reverse Numeric Matches:</b></p>";
				echo "<p> date => " . $this->data[$i]["date"] . " <br />"; 
				echo " Sorteo => " . $this->data[$i]["sorteo"] . " <br />";  
				echo " Name => " . str_replace("<BR>", " ", $this->data[$i]["name"] . " <br />"); 
				echo " Winning #'s: " . $win_nums[0] . " " . $win_nums[1] . " " . $win_nums[2] . "</p>";
				
				$rev_matches += 1;    

		}
		
	}

	if ( $rev_matches == 0 ) {  echo "<p><b>No reverse matches located:</b></p><p>  Pattern: <b>$num3, $num2, $num1</b></p>"; }

}

} 
 
	public function f2_match($num1, $num2, $num3){

	if ( is_int($num1) && is_int($num2) && is_int($num3) ){
		

		for ($i =0; $i<=279; $i++){
			
			$win_nums = $this->data[$i]["win_nums"];
			
			if( $win_nums[0] == $num1 && $win_nums[1] == $num2 ){
			

				echo "<p><b>First two Numeric Matches:</b></p>";
				echo "<p> date => " . $this->data[$i]["date"] . " <br />"; 
				echo " Sorteo => " . $this->data[$i]["sorteo"] . " <br />";  
				echo " Name => " . str_replace("<BR>", " ", $this->data[$i]["name"] . " <br />"); 
				echo " Winning #'s: <b>" . $win_nums[0] . " " . $win_nums[1] . " </b>" . $win_nums[2] . "</p>";
				
				$this->f2 += 1;  

		}
		
	}

	if ( $this->f2 === 0 ) {  echo "<p><b>No first two matches:</b></p><p>  Pattern: <b>$num1, $num2,</b> $num3</p>"; }

}

} 



	public function get_data(){
	
		return $this->data;
	
	}



}//END CLASS


if ( array_key_exists('numbers', $_GET) ) {

	$numbers =  $_GET["numbers"];

	$numbers = preg_split("/[\s]+/", $numbers);
	
	$num1 = trim($numbers[0]);
	$num2 = trim($numbers[1]);
	$num3 = trim($numbers[2]);
	$num1 = (int)$num1;
	$num2 = (int)$num2;
	$num3 = (int)$num3;
	
	
	$br = "<br />";
	
	if ( $num1 != 0 && $num2 != 0 && $num3 != 0){
		
		$game = new lottoParser;	
		$nums_avail = TRUE;
	}
}
 	
/* echo "<pre>";
	var_dump( $game->get_data() );
echo "</pre>"; */
  
  
?>
<html>
<head>
 
<style>
*{padding: 0px; margin:0px;}
body{font-family: Arial, sans-serif, helvetica; font-size: 160%; }
#html,body{height: 100%; width:100%; } 
#numbers{ height: 35px; width: 200px; font-size: 18px; }
#submit { height: 35px; width:100px; }

#formlotto{
	text-align: center;
	padding-top: 30px;
}

#str8_match, #rev_match, #f2_match{
	float: left;
	width: 420px;
	margin: 0px 0px 0px 5px;
	
}
#str8_match p , #rev_match p, #f2_match p{
	border: 3px solid #ddd;
	margin:0px 0px 3px 0px;
}

</style>


</head>
<body>


<div id="main"> 

	<div id="content">
	
		<div id="formlotto">
			<form action="lottoindex.php" method="GET">
			
				<input type="text" name="numbers" id="numbers" placeholder="Enter desired lottery #'s" />
				<input type="submit" name="submit" id="submit" />

			</form>
	</div>

		<div id="results">	
		
			<div id="str8_match">
			<?php 
			
				if ( $nums_avail === TRUE )	$game->straight_match($num1, $num2 , $num3); 
				
			?>
			</div>
			
			<div id="rev_match">
			<?php 
			
				if ( $nums_avail === TRUE )	$game->rev_match($num1, $num2 , $num3); 
				
			?>
			</div>
			
			<div id="f2_match">
			<?php 
			
				if ( $nums_avail === TRUE )	$game->f2_match($num1, $num2 , $num3); 
				
			?>
			</div>
			
			
		
		</div><!--end #swinners -->


	</div><!--end #content -->


</div>





</body>
</html>
