<?php 
include_once 'head.php'; 
echo head('Quadratic Equations','Input the roots of this equation',false,2);
?>

	<script>
		function newNumber(){
		var a = Math.floor(Math.random()*10);
		var b = Math.floor(Math.random()*10);
		var sign1 = '';
		var sign2 = ''; 
		if(Math.floor(Math.random()*10) % 2 == 0){
			a = a*-1;
		} 
		
		var B = a + b;
		var C = a * b;
		
		if(Math.sign(B) == 1){
			sign1 = '+';
		}
		if((B) == 0){
			B = '';
		}else{
			B = B+'x';
		}
		if(Math.sign(C) == 1){
			sign2 = '+';
		}
		if((C) == 0){
			C = '';
		}
		$('#question').html('x²'+sign1+(B)+sign2+C);
		// $('#question').html('x²-5x')
		}
		$(document).ready(function(){
		newNumber();
		
			var amountCorrect = (localStorage.getItem("correctQE"))*1;
			document.getElementById('correct').innerHTML = amountCorrect;
			
			var amountWrong = (localStorage.getItem("wrongQE"))*1;
			document.getElementById('wrong').innerHTML = amountWrong;
		});
		
		
		function answer(){
		
		var equ = $('#question').html();
		// var equ = 'x²+5x+6'
		var sign1 = equ.charAt(equ.indexOf('²')+1);
		var sign2 = equ.charAt(equ.indexOf('x',equ.indexOf('x')+1)+1);
		var equArray = equ.split(/[+-]/);
		var a = equArray[0];
		var b = equArray[1];
		var c = equArray[2];
		if(equArray.length == 1){
			b = 0;
			c = 0;
		}
		
			
		if(a == 'x²'){
			a = 1;
		}
		
		if(sign2 == '-'){
			c = c*-1;
		}
		if(b == 0 || !b.includes('x')){
			c = b;
			b = 0;
		}
		
		if(!c){
			c = 0;
		}
		
		a = parseInt(a);
		b = parseInt(b);
		c = parseInt(c);
		
		if(equ.charAt(0) == '-'){
			a = a*-1;
		}
		if(sign1 == '-'){
			b = b*-1;
		}
		var sqt = Math.sqrt(b*b -4*a*c);  
			
		var ans1 = (((b*-1)+sqt)/(2*a));  
		var ans2 = (((b*-1)-sqt)/(2*a));
		
		
		
		var answer1 = $('#answer1').val();
		var answer2 = $('#answer2').val();
		
		var correct;
		if((answer1 == ans1 && answer2 == ans2 ) || (answer1 == ans2 && answer2 == ans1 )){
			correct = true;
			$('#result').html('Well done that is correct!');
			$('#result').css({'color':'green'});
			
				var amountCorrect = (localStorage.getItem("correctQE"))*1;
				var amountCorrect = amountCorrect + 1
				localStorage.setItem("correctQE", amountCorrect);
				document.getElementById('correct').innerHTML = amountCorrect;
		}else{
			correct = false;
			$('#result').html('Sorry that was incorrect the actual answers are '+ans1+' and '+ans2);
			$('#result').css({'color':'red'});
			var amountWrong = (localStorage.getItem("wrongQE"))*1;
				var amountWrong = amountWrong + 1
				localStorage.setItem("wrongQE", amountWrong);
				document.getElementById('wrong').innerHTML = amountWrong;
		}
		$('#answer1,#answer2').val('')
		$('#result2').html('The question was '+equ);
		$('#result1').html('Your answers were '+answer1+' and '+answer2);
		newNumber();
		}
		
		
		
		$('#answer1,#answer2').keyup(function(event){
			if(event.keyCode == 13){
			if(!event.shiftKey){
				answer()
			}
			}
		});
		
		$('#answer1,#answer2').keyup(function(event){
			if(event.keyCode == 82){
				if(event.shiftKey){
					localStorage.setItem("correctQE", 0);
					localStorage.setItem("wrongQE", 0);
					
					var amountCorrect = (localStorage.getItem("correctQE"))*1;
					document.getElementById('correct').innerHTML = amountCorrect;
					
					var amountWrong = (localStorage.getItem("wrongQE"))*1;
					document.getElementById('wrong').innerHTML = amountWrong;
				}
			}
		});
	</script>
	
</body>