<?php
function head($title, $note='',$difficulty = false,$noOfInputs = 1){
	if(strpos($title, 'to') !== false){
		$pieces = explode(' ', $title);
		$answerType = array_pop($pieces);
	}else{
		$answerType = $title;
	}
$html = 
"
	<head>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
		<link rel='stylesheet' href='style.css'>
		<title>$title Revision</title>
		<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0'/> <!--320-->
		<link rel='icon' href='favicon.png'>
	</head>
	<header>
		<nav class='primary_menu'>
			<ul>
				<li><a href='dec2bin'>Decimal to Binary</a></li>
				<li><a href='bin2dec'>Binary to Decimal</a></li>
				<li><a href='dec2hex'>Decimal to Hex</a></li>
				<li><a href='StandardForm'>Standard Form</a></li>
				<li><a href='QuadraticEquations'>Quadratic Equations</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<div class='score'>
				<h3 id='wrong'>00</h3>
				<h3 id='correct'>00</h3>
		</div>
		<h1>{$title} Test</h1>
		<h2>{$note}</h2>
		<h2 id='question'>420</h2>
		<div id='spacer'>";
			
		if($noOfInputs == 1){
			$html .=	"<input id='answer' placeholder='What is it in {$answerType}?'/>";
		}else{
			$maxWidth = 40/$noOfInputs;
			$width = 100/$noOfInputs;
			for($i = 1; $i <= $noOfInputs; $i++){
			$html .= "<input id='answer{$i}' style='width: {$width}%; max-width: {$maxWidth}vw;' class='answer' placeholder='' />";
			}
		}
	$html .= "
		</div>
		<div id='spacer1'>
			<button id='button' onclick='answer()'>Answer</button>
		</div>";
		
if($difficulty){
	$html .= "<select id='difficulty'>
				<option value='Easy'>Easy</option>
				<option value='Medium'>Medium</option>
				<option value='Hard'>Hard</option>
			</select>";
}	
$html .="
		<h2 id='result'></h2>
		<h2 id='result2'></h2>
		<h2 id='result1'></h2>
	</main>
	<footer>
		<h2>Press Shift + R in answer box to reset counter</h2>
	</footer>
	<script>
		$( window ).resize(function() {
			var headerHeight = $('header .primary_menu ul li a').height()
			$('header, .primary_menu, .primary_menu ul, primary_menu ul li').css({'min-height':headerHeight});
			$('main').css({'margin-top':headerHeight+2});
		});
		$('body').ready( function(){
			var headerHeight = $('header .primary_menu ul li a').height()
			$('header, .primary_menu, .primary_menu ul, primary_menu ul li').css({'min-height':headerHeight});
			$('main').css({'margin-top':headerHeight+2});
		});
	</script>
";
return $html;
}
?>