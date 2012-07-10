var line = '<li class="form_line" id="line"><span><label for="item">Item: </label><input type="text" required="required" placeholder="what item is this?" id="item" name="item[]></span><span><label for="amount">Amount: </label><input required="required"  type="number" id="amount" name="amount[]></span><span><label for="color">Color: </label><input type="text" required="required" class="color \{pickerClosable:true, hash:true ,pickerFaceColor:\'#ee5588\',pickerFace:3,pickerBorder:0,pickerInsetColor:\'black\'\}" id="color" name="color[]"></span></li>';

$(document).ready(function()        
{
		    
//		    $("form").delegate(".add", "click", function(){        
//		            $('ul').append(line); 
//		            }); // end of adding
		   
		   
		    var $ul = $('#formulario'); // the UL, select it once and r-use this selection
		             
		            $('.add').click(function(e) {
		            var $line = $(line);
		                 
		            $line.appendTo($ul);
		            new jscolor.color($line.find('input[name=color\\[\\]]')[0], {});         
		             
		              });  //end of add 
		             	             
		    $('.remove').click(function() {
		     	 	$('li').last().remove();
		     		}); //end of removing
		     	
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
		     			    
}); //end of main func 
