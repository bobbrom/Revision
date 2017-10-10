<?php 
include_once 'head.php'; 
echo head('Binary to Decimal');
?>

	<script>
		function newNumber(){
		return (Math.floor( (Math.random()*64) + 1 )).toString(2);
		}
		$('body').ready( function(){
			var newQuestion = newNumber();
			document.getElementById('question').innerHTML = newQuestion
		
			var amountCorrect = (localStorage.getItem("correct_bin2dec"))*1;
			document.getElementById('correct').innerHTML = amountCorrect;
		
			var amountWrong = (localStorage.getItem("wrong_bin2dec"))*1;
			document.getElementById('wrong').innerHTML = amountWrong;
		});
		
		function answer(){
		var num = document.getElementById('question').innerHTML
		var realAnswer = parseInt(num, 2);
		var givenAnswer = ($('#answer').val())*1
		if(givenAnswer){
			if(realAnswer == givenAnswer){
				var result = 'Well done that is correct!'
				$("#result").css("color","green");
				
				var newQuestion = newNumber();
				document.getElementById('question').innerHTML = newQuestion
				
				var amountCorrect = (localStorage.getItem("correct_bin2dec"))*1;
				var amountCorrect = amountCorrect + 1
				localStorage.setItem("correct_bin2dec", amountCorrect);
				document.getElementById('correct').innerHTML = amountCorrect;
				$('#answer').val('')
				
			}else{
				var result = 'Sorry that was incorrect the actual answer is '+realAnswer
				$("#result").css("color","red");
				
				var newQuestion = newNumber();
				document.getElementById('question').innerHTML = newQuestion
				
				var amountWrong = (localStorage.getItem("wrong_bin2dec"))*1;
				var amountWrong = amountWrong + 1
				localStorage.setItem("wrong_bin2dec", amountWrong);
				document.getElementById('wrong').innerHTML = amountWrong;
				$('#answer').val('')
			}
			
			
			
			document.getElementById('result').innerHTML = result
			document.getElementById('result2').innerHTML = "The question was "+num
			document.getElementById('result1').innerHTML = "Your answer was "+givenAnswer
			}
		}
		
		
		$("#answer").keyup(function(event){
			if(event.keyCode == 13){
			if(!event.shiftKey){
				answer()
			}
			}
		});
		
		$("#answer").keyup(function(event){
			if(event.keyCode == 82){
			if(event.shiftKey){
				localStorage.setItem("correct_bin2dec", 0);
				localStorage.setItem("wrong_bin2dec", 0);
				
				var amountCorrect = (localStorage.getItem("correct_bin2dec"))*1;
				document.getElementById('correct').innerHTML = amountCorrect;
				
				var amountWrong = (localStorage.getItem("wrong_bin2dec"))*1;
				document.getElementById('wrong').innerHTML = amountWrong;
			}
			}
		});
	</script>
	
</body>