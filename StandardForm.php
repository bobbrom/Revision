<?php 
	include_once 'head.php'; 
	echo head('Standard Form', 'Please format your answer like so 100 -> 1e2');
?>
	<script>
		function newNumber(){
			var decimalPlace = Math.floor((Math.random() * 5)+1)
			var rand = 0
			while (rand == 0){
				var rand = Math.random().toFixed(decimalPlace)
			}
			var exp = 1
			while(exp <= 1){
				var exp =  Math.floor((Math.random() *4) +1)
			}
			var posNeg = Math.floor((Math.random() * 2)+1)
			
			if(posNeg === 1){
				var exp = exp*-1
			}
			
			var standardForm = parseFloat( (rand*Math.pow(10,exp)).toFixed(decimalPlace+Math.abs(exp)) )
			return standardForm
		}
		
		
		$('body').ready( function(){
			var newQuestion = newNumber()
			document.getElementById('question').innerHTML = newQuestion
			
			var amountCorrect = (localStorage.getItem("correctSF"))*1;
			document.getElementById('correct').innerHTML = amountCorrect;
			
			var amountWrong = (localStorage.getItem("wrongSF"))*1;
			document.getElementById('wrong').innerHTML = amountWrong;
		});

		function standardForm(question){
			var exp = Math.floor(Math.log10(question*1))
			var beforeE = parseFloat((question*Math.pow(10,exp*-1)).toFixed(Math.abs(7)))
			var answer = beforeE+'e'+exp
			return beforeE+'e'+exp
		}
		
		function answer(){
			var num = (document.getElementById('question').innerHTML)*1
			var realAnswer = standardForm(num);
			var givenAnswer = $('#answer').val()
			if(givenAnswer){
				if(realAnswer == givenAnswer){
					var result = 'Well done that is correct!'
					$("#result").css("color","green");
					
					document.getElementById('question').innerHTML = newNumber()
					
					var amountCorrect = (localStorage.getItem("correctSF"))*1;
					var amountCorrect = amountCorrect + 1
					localStorage.setItem("correctSF", amountCorrect);
					document.getElementById('correct').innerHTML = amountCorrect;
					$('#answer').val('')
					
				}else{
					var result = 'Sorry that was incorrect the actual answer is '+realAnswer
					$("#result").css("color","red");
					
					document.getElementById('question').innerHTML = newNumber()
					
					var amountWrong = (localStorage.getItem("wrongSF"))*1;
					var amountWrong = amountWrong + 1
					localStorage.setItem("wrongSF", amountWrong);
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
					localStorage.setItem("correctSF", 0);
					localStorage.setItem("wrongSF", 0);
					
					var amountCorrect = (localStorage.getItem("correctSF"))*1;
					document.getElementById('correct').innerHTML = amountCorrect;
					
					var amountWrong = (localStorage.getItem("wrongSF"))*1;
					document.getElementById('wrong').innerHTML = amountWrong;
				}
			}
		});
	</script>
	
</body>