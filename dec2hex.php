<?php 
	include_once 'head.php'; 
	echo head('Decimal to Hex','',true);
?>

	<script>
		function newNumber(){
			var difficulty = $('#difficulty').val()
			//alert(difficulty)
			if(difficulty == 'Hard'){
				var newQuestion = 0
				while( (newQuestion < 10) || (newQuestion % 16 < 10) ){
					var newQuestion = Math.floor( (Math.random()*160) + 1 );
				}
			}else if(difficulty == 'Medium'){
				var newQuestion = Math.floor( (Math.random()*160) + 1 );
			}else{
				var newQuestion = Math.floor( (Math.random()*100) + 1 );
			}
			//alert(newQuestion % 16)
			return newQuestion
		}
		$('body').ready( function(){
			var amountCorrect = (localStorage.getItem("correct16"))*1;
			document.getElementById('correct').innerHTML = amountCorrect;
		
			var amountWrong = (localStorage.getItem("wrong16"))*1;
			document.getElementById('wrong').innerHTML = amountWrong;
			
			var difficulty = localStorage.getItem("difficulty16")
			$('#difficulty option[value="'+difficulty+'"]').attr("selected", "selected");
			
			var newQuestion = newNumber();
			document.getElementById('question').innerHTML = newQuestion
		});
		
		function answer(){
		var num = (document.getElementById('question').innerHTML)*1
		var realAnswer = num.toString(16);
		var givenAnswer = $('#answer').val().toLowerCase();
		if(givenAnswer){
			if(realAnswer == givenAnswer){
				var result = 'Well done that is correct!'
				$("#result").css("color","green");
				
				var newQuestion = num;
				while(num == newQuestion){
					var newQuestion = newNumber();
					document.getElementById('question').innerHTML = newQuestion
				}
				
				var amountCorrect = (localStorage.getItem("correct16"))*1;
				var amountCorrect = amountCorrect + 1
				localStorage.setItem("correct16", amountCorrect);
				document.getElementById('correct').innerHTML = amountCorrect;
				$('#answer').val('')
				
				
			}else{
				var result = 'Sorry that was incorrect the actual answer is '+realAnswer
				$("#result").css("color","red");
				
				var newQuestion = num;
				while(num == newQuestion){
					var newQuestion = newNumber();
					document.getElementById('question').innerHTML = newQuestion
				}
				
				var amountWrong = (localStorage.getItem("wrong16"))*1;
				var amountWrong = amountWrong + 1
				localStorage.setItem("wrong16", amountWrong);
				document.getElementById('wrong').innerHTML = amountWrong;
				$('#answer').val('')
			}
		
		
		
			document.getElementById('result').innerHTML = result
			document.getElementById('result2').innerHTML = "The question was "+num
			document.getElementById('result1').innerHTML = "Your answer was "+givenAnswer
		}
		}
		$('#difficulty').on( 'change', function(){
			var newQuestion = newNumber();
			document.getElementById('question').innerHTML = newQuestion
			
			var difficulty = $('#difficulty').val()
			localStorage.setItem("difficulty16", difficulty);
		});
		
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
					localStorage.setItem("correct16", 0);
					localStorage.setItem("wrong16", 0);
					
					var amountCorrect = (localStorage.getItem("correct16"))*1;
					document.getElementById('correct').innerHTML = amountCorrect;
					
					var amountWrong = (localStorage.getItem("wrong16"))*1;
					document.getElementById('wrong').innerHTML = amountWrong;
				}
			}
		});
	</script>
	
</body>