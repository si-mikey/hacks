<html>
<head>
<?php



class lottoParser{

	public $data;

	public function __construct(){

		$json_file = file_get_contents(__DIR__ . "/" . "onepm.json");

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




	function straight_match($num1, $num2, $num3){

		$consecutive_matches = 0;

		for ($i =0; $i<279; $i++){

			
			$win_nums = $this->data[$i]["win_nums"];
			if( $win_nums[0] == $num1 && $win_nums[1] == $num2 && $win_nums[2] == $num3 ){

				echo "	There are previous sorteos/drawings that match this result set consecutively<br />";
				echo "	date => " . $this->data[$i]["date"] . " <br />"; 
				echo " 	Sorteo => " . $this->data[$i]["sorteo"] . " <br />";  
				echo "  Name => " . str_replace("<BR>", " ", $this->data[$i]["name"] . " <br />"); 
				echo "  Winning #'s " . $win_nums[0] . " " . $win_nums[1] . " " . $win_nums[2] . "<br />";

				$consecutive_matches += 1;	      


		}
				
		if ( $consecutive_matches == 0 ) {  echo "1. No consecutive matches were found \n"; }else{ echo "weird $consecutive_matches"; }


	}



}


}

$numbers =  $_POST["numbers"];

if( !$numbers ) { echo "Please enter search criteria."; exit;}




$s = new lottoParser;


$numbers = preg_split("/[\s]+/", $numbers);


$num1 = trim($numbers[0]);
$num2 = trim($numbers[1]);
$num3 = trim($numbers[2]);


$br = "<br />";

echo $br;

$s->straight_match($num1, $num2 , $num3);










?> 
<style>
*{padding: 0px; margin:0px;}
body{font-family: Arial, sans-serif, helvetica; font-size: 160%; }

#html,body{height: 100%; width:100%; } 

#content{ padding-top: 10%; padding-left:30%; min-width:500px; }
#numbers{ height: 35px; width: 200px; font-size: 18px; }
#submit { height: 35px; width:100px; }


</style>


</head>
<body>


<div id="main"> 

	<div id="content">
	
		<div id="form">
			<form action="parselotto.php" method="POST">
			
				<input type="text" name="numbers" id="numbers" placeholder="Enter desired lottery #'s" />
				<input type="submit" name="submit" id="submit" />

			</form>			

		</div>
	

	</div>


</div>





</body>
</html>
