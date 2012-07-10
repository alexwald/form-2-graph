<!DOCTYPE html> 
<html>
<head>
<meta charset="UTF-8">
<title>Graphing using PHP</title>
<!-- <link rel="stylesheet" type="text/css" href="css/normalize.css"/> -->
<!--<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.4.1/build/cssreset/cssreset-min.css">-->
<link rel="stylesheet" type="text/css" href="css/layout.css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>	
	<script>!window.jQuery && document.write('<script src="scripts/jquery.js"><\/script>')
	</script>
	<script src="scripts/jquery.lint.js"></script>
	<script src="scripts/jquery.form.js"></script>
			<script type="text/javascript" src="scripts/jscolor/jscolor.js"></script>
		<!--	<script type="text/javascript" src="scripts/jquery-ui.js"></script>-->
</head>	
<body>
<div class="container">
<!--	<form action="process.php" method="POST"> -->
	<form action="pie.php" method="POST" id="form">
<!--	<form action="xml.php" method="POST"> -->
<!--	<form action="bar.php" method="POST"> -->
	<ul id="formulario">
	
<!-- form line begins -->
				<li class="form_line" id="line0">
					
						<span>
							<label for="item0">Item: </label>
							<input type="text" required="required"
							placeholder="what item is this?"  name="item[]" id="item[]">
							</span>
							<span>
							<label for="amount0">Amount: </label>
							<input required="required"  type="number" name="amount[]" id="amount0">
							</span>
							<span>
							<label for="color0">Color: </label>
							<!-- class color will secure the use of jscolor library on this input -->
							<input type="text" required="required"  class="color {pickerClosable:true, hash:true ,pickerFaceColor:'#ee5588',pickerFace:3,pickerBorder:0,pickerInsetColor:'black'}" id="color0" name="color[]">
							</span>
			
				</li>
<!-- end of form line -->

<!-- form line begins -->
				<li class="form_line" id="line1">
					
						<span>
							<label for="item1">Item: </label>
							<input type="text" required="required"
							placeholder="what item is this?"  name="item[]" id="item1">
							</span>
							<span>
							<label for="amount1">Amount: </label>
							<input required="required"  type="number" name="amount[]" id="amount1">
							</span>
							<span>
							<label for="color1">Color: </label>
							<input type="text" required="required"  class="color {pickerClosable:true, hash:true ,pickerFaceColor:'#ee5588',pickerFace:3,pickerBorder:0,pickerInsetColor:'black'}" id="color1" name="color[]">
							</span>
			
				</li>
<!-- end of form line -->

<!-- form line begins -->
				<li class="form_line" id="line">
					
						<span>
							<label for="item2">Item: </label>
							<input type="text" required="required"
							placeholder="what item is this?" name="item[]" id="item2">
							</span>
							<span>
							<label for="amount2">Amount: </label>
							<input required="required"  type="number" name="amount[]" id="amount2">
							</span>
							<span>
							<label for="color2">Color: </label>
							<input type="text" required="required"  class="color  {pickerClosable:true, hash:true ,pickerFaceColor:'#ee5588',pickerFace:3,pickerBorder:0,pickerInsetColor:'black'}" id="color2" name="color[]">
							</span>
			
				</li>
				
	</ul> <!-- end of formulario -->
	
<div id="controls">

<!--<input class="add" type="reset" value="+"><br>-->
<input class="add" type="button" value="+"><br>
<input class="remove" type="button" value="-"><br>
<input class="graph_type" type="button" value="pie"><br>
<input type="submit" value="send"><br>
<input type="reset" value="reset">


<script> 
var line = '<li class="form_line" id="line"><span><label for="item">Item: </label><input type="text" required="required" placeholder="what item is this?" id="item" name="item[]></span><span><label for="amount">Amount: </label><input required="required"  type="number" id="amount" name="amount[]></span><span><label for="color">Color: </label><input type="text" required="required" class="color \{pickerClosable:true, hash:true ,pickerFaceColor:\'#ee5588\',pickerFace:3,pickerBorder:0,pickerInsetColor:\'black\'\}" id="color" name="color[]"></span></li>';

$(document).ready(function()        
{
		    
//		    $("form").delegate(".add", "click", function(){        
//		            $('ul').append(line); 
//		            }); // end of adding
		   
		   
		    var $ul = $('#formulario'); // the UL, select it once and r-use this selection
		            
		            //selector to choose the add button by class, adds a clickListener
		            $('.add').click(function(e) {
		            
		            var $line = $(line);
		            
		            // this will append the line with textfields to our form after clicking the add button
		            $line.appendTo($ul);
		            // this line is required to apply the jscolor picker script on the newly-added lines as well
		            new jscolor.color($line.find('input[name=color\\[\\]]')[0], {});         
		             
		              });  //end of add 
		     
		     // add clickListener to the remove button        	             
		    $('.remove').click(function() {
		    		// selector will find the last list-item element and remove it 
		     	 	$('li').last().remove();
		     		}); //end of removing
		     
		     // function to switch form action & button value 	
		    $('.graph_type').click(function() {
		    	
		    	if ($("form").attr("action")=="pie.php")
		    	  {
		    	  $("form").attr("action", "bar.php");
		    	  $('.graph_type').attr("value", "bar");
		    	  }
		    	else if ($("form").attr("action")=="bar.php")
		    	  {
		    	  $("form").attr("action", "xml.php");
		    	  $('.graph_type').attr("value", "xml");
		    	  } 	  
		    	else if ($("form").attr("action")=="xml.php")
		    	  {
		    	  $("form").attr("action", "pie.php");
		    	  $('.graph_type').attr("value", "pie");
		    	  } 
		     	  
		       	}); //end of graph type 	
		       	
		   //// ajaxform starts    
		   		// resulting graf will go into div #preview	
		       	$('#form').ajaxForm({ 
		       	        target: '#preview'
		       	    }); 
		   //// ajaxform end
		     			    
}); //end of main func 

</script>	

</div> <!--end of controls -->
</form>
<div id="preview"></div>
</div> <!--end of container -->
</body>
</html>
