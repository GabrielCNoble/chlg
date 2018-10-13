<html lang = "en">

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>






<body>

<?php 

require 'utils.php';

if(isset($_POST['Delete_button']))
{
    $records = get_records();
    $record = $records[$_POST['Delete_record']];
    drop_record($record['Name'], $record['Email'], $record['Phone']);
}

$records = get_records();
$count = count($records);

print("<div CLASS = container>");
    print("<table CLASS = 'table table-bordered table-condensed'>");
        print("<thead>");
            print("<tr>");
                print("<th>Name</th>");
                print("<th>Email</th>");
                print("<th>Phone</th>");
            print("</tr>");
        print("</thead>");
        
        print("<tbody>");
            for($i = 0; $i < $count; $i++)
            {
                $record = $records[$i];
                
                print("<tr>");
                    print("<td CLASS = col-sm-2>$record[Name]</td>");
                    print("<td CLASS = col-sm-2>$record[Email]</td>");
                    print("<td CLASS = col-sm-2>$record[Phone]</td>");
                    print("<td CLASS = col-sm-2>");
                        print("<form CLASS = form-horizontal METHOD = POST ACTION = list.php>");
                            print("<input CLASS = 'btn btn-block' TYPE = SUBMIT NAME = Delete_button  VALUE = Delete>");
                            print("<input TYPE = HIDDEN  NAME = Delete_record  VALUE = $i>");
                        print("</form>");
                    print("</td>");
                print("</tr>");
            }
        print("</tbody>");
        
    print("</table>");
print("</div>");


?>

<div CLASS = "container">

<FORM

	METHOD = "POST"
	ACTION = "front.php"
	ID = "super"
	CLASS = "form-horizontal"
>

	<INPUT
		CLASS = "form-control row col-sm-12"
		NAME = "Done_button"
		TYPE = "Submit"
		VALUE = "Doge"
	>

</FORM>

</div>


</body>
</html>



