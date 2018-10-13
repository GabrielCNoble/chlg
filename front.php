<html lang = "en">

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>


<body>

<?php 

require 'utils.php';


init_db();

$name_placeholder = "Enter your name";
$email_placeholder = "Enter your email";
$phone_placeholder = "Enter your phone";
$cheese_placeholder = "Enter 'Some Cheese'";


if(isset($_POST['Submit_button']))
{   
    $name = htmlspecialchars($_POST['Name_field']);
    $email = htmlspecialchars($_POST['Email_field']);
    $phone = htmlspecialchars($_POST['Phone_field']);
    $cheese = htmlspecialchars($_POST['Cheese_field']);
    
    if($name == "" || $email == "" || $phone == "" || $cheese == "")
    {
        $name_placeholder = "You MUST enter your name";
        $email_placeholder = "You MUST enter your email";
        $phone_placeholder = "You MUST enter your phone";
        $cheese_placeholder = "You MUST enter 'Some Cheese'";
    }
    else if($cheese != "Some Cheese")
    {
        $cheese_placeholder = "You must, LITERALLY, type 'Some Cheese' in the cheese field  >:(";
    }
    else
    {
        if(add_record($name, $email, $phone))
        {
            print("Record added!<BR>");
        }
        else
        {
            print("Duplicate record!<BR>");
        }
    }
}
else
{
    $name = "";
    $email = "";
    $phone = "";
    $cheese = "";
}

?>


<div CLASS = "container">
	<form
    	ID = "super"
    	NAME = "Data_form"
    	METHOD = "POST"
    	ACTION = "front.php"
    	CLASS = "form-horizontal"
    >
    
    	<div CLASS = "form-group">
    		<div CLASS = "row">
    			<label CLASS = "control-label col-sm-1" FOR = "Name_field" >Name:</label>
        		<div CLASS = "col-sm-11">
            		<input
                    	CLASS = "form-control"
                    	ID = "Name_field"
                    	NAME = "Name_field"
                    	TYPE = "TEXT"
                    	PLACEHOLDER = "<?php print $name_placeholder?>"
                    	VALUE = "<?php print $name ?>"
                	>
            	</div>
    		</div>
        </div>
        
      	
      	<div CLASS = "form-group">
      		<div CLASS = "row">
      			<label CLASS = "control-label col-sm-1" FOR = "Email_field" > Email: </label>
            	<div CLASS = "control-label col-sm-11">
            		<input
                		CLASS = "form-control"
                		ID = "Email_field"
                		NAME = "Email_field"
                		TYPE = "EMAIL"
                		PLACEHOLDER = "<?php print $email_placeholder?>"
                		VALUE = "<?php print $email ?>"
            		>
            	</div>
      		</div>
        </div>
        
    	
    	<div CLASS = "form-group">
    		<div CLASS = "row">
    			<label CLASS = "control-label col-sm-1" FOR = "Phone_field">Phone: </label>
            	<div CLASS = "col-sm-11">
                	<input
                		CLASS = "form-control"
                		NAME = "Phone_field"
                		TYPE = "TEL"
                		PLACEHOLDER = "<?php print $phone_placeholder?>"
                		VALUE = "<?php print $phone ?>"
                	>
            	</div>
    		</div>
        </div>
        
        
        <div CLASS = "form-group">
        	<div CLASS = "row">
            	<label CLASS = "control-label col-sm-1" FOR = "Cheese_field">Cheese: </label>
            	<div CLASS = "col-sm-11">
            		<input
            			CLASS = "form-control"
            			NAME = "Cheese_field"
            			TYPE = "TEXT"
            			PLACEHOLDER = "<?php print $cheese_placeholder?>"
            			VALUE = "<?php print $cheese?>"
            		>
            	</div>
        	</div>
        </div>
        
    	
    	<div CLASS = "form-group row col-sm-4">
        	<input
        		CLASS = "form-control"
        		NAME = "Submit_button"
        		TYPE = "SUBMIT"
        		VALUE = "Submit"
        	>
    	</div>
    </form>
    
    
    
    <form 
    	ID = "super"
    	ACTION = "list.php"
    	METHOD = "POST"
    	CLASS = "form-horizontal"
    >
    
    	<div CLASS = "form-group row col-sm-4">
    		<input
        		CLASS = "form-control"
        		NAME = "List_button"
        		TYPE = "SUBMIT"
        		VALUE = "See records"
        	>
    	</div>
    </form>
    
    
</div>







</body>


</html>