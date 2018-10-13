


<?php


require 'config.php';

/*
 ==========================
 connect
 
 returns a connection handle to the database
 ==========================
 */
function connect()
{
    return mysqli_connect(RT_SERVER, RT_USER, RT_PASSWORD);
}


/*
 ==========================
 init_db
 
 initialize the database for this demo
 ==========================
 */
function init_db()
{
    $conn = connect();
    
    if(!$conn)
    {
        print("couldn't connect to MySQL server! Is the server process running?");
        exit;
    }
    
    
    $db_handle = mysqli_select_db($conn, RT_DATABASE);
    
    if(!$db_handle)
    {
        /* db for this demo doesn't exist, so create one... */
        mysqli_query($conn, "CREATE DATABASE " . RT_DATABASE);
        
        $db_handle = mysqli_select_db($conn, $DATABASE);

        if(!$db_handle)
        {
            /* something tragic happened. Shutdown and burn everything... */
            print("Couldn't create the database! <BR>");
            exit;
        }
        
        /* add the table... */
        mysqli_query($conn, "CREATE TABLE " . $DATABASE . ".user_data ( Name TEXT NOT NULL , Email TEXT NOT NULL , Phone TEXT NOT NULL );");

        mysqli_close($conn);
    }
}


/*
 ==========================
 check_duplicate
 
 check for a duplicate record
 ==========================
 */
function check_duplicate($name, $email, $phone)
{
    $conn = connect();
    
    if($conn)
    {
        $db_exists = mysqli_select_db($conn, RT_DATABASE);
        
        if(!$db_exists)
        {
            printf("Database doesn't exist, but by now it should... <BR>");
            exit;
        }
        
        $db_query = mysqli_query($conn, "SELECT * FROM " . RT_DATABASE . ".user_data WHERE Name = '$name' AND Email = '$email' AND Phone = '$phone'");
        
        if(mysqli_fetch_assoc($db_query))
        {
            //print("Duplicate record! <BR>");
            return true;
        }
        
        mysqli_close($conn);
    }
    
    return false;
}


/*
 ==========================
 add_record
 
 adds a record to the database
 ==========================
 */
function add_record($name, $email, $phone)
{  
    $conn = connect();
    
    $success = false;
    
    if($conn)
    {
        $db_exists = mysqli_select_db($conn, RT_DATABASE);
        
        if(!$db_exists)
        {
            printf("Database doesn't exist, but by now it should... <BR>"); 
            exit;
        }
        
        if(!check_duplicate($name, $email, $phone))
        {
            mysqli_query($conn, "INSERT INTO ". RT_DATABASE. ".user_data (Name, Email, Phone) VALUES ('$name', '$email', '$phone');");
            $success = true;
        }
           
        mysqli_close($conn);
    }
    else
    {
        print("Could not connect to mysql server!");
        exit;
    }
    
    return $success;
}


/*
 ==========================
 drop_record
 
 drops the record from the database
 ==========================
 */
function drop_record($name, $email, $phone)
{
    $conn = connect();
    
    if($conn)
    {
        $db_exists = mysqli_select_db($conn, RT_DATABASE);
        
        if(!$db_exists)
        {
            printf("Database doesn't exist, but by now it should... <BR>");
            exit;
        }
        
        mysqli_query($conn, "DELETE FROM " . RT_DATABASE . ".user_data WHERE Name = '$name' AND Email = '$email' AND Phone = '$phone'");
        
        print(mysqli_error($conn));
    }
}


/*
 ==========================
 get_records
 
 fills an array of associative arrays with all the records in the database
 ==========================
 */
function get_records()
{
    $conn = connect();
    
    if($conn)
    {
        $db_exists = mysqli_select_db($conn, RT_DATABASE);
        
        if(!$db_exists)
        {
            printf("Database doesn't exist, but by now it should... <BR>");
            exit;
        }
        
        $result = mysqli_query($conn, "SELECT * FROM " . RT_DATABASE . ".user_data");
        $records = array();
        
        while($record = mysqli_fetch_assoc($result))
        {
            $records[] = $record;
        }

        mysqli_close($conn);
        
        return $records;
    }
    else
    {
        print("Could not connect to mysql server!");
        exit;
    }
}


/*
 ==========================
 list_records
 
 plainly prints on the screen the records in the database (for debugging)
 ==========================
 */
function list_records()
{
    $conn = connect();
    
    if($conn)
    {
        $db_exists = mysqli_select_db($conn, RT_DATABASE);
        
        if(!$db_exists)
        {
            printf("Database doesn't exist, but by now it should... <BR>");
            exit;
        }
        
        $result = mysqli_query($conn, "SELECT * FROM " . RT_DATABASE . ".user_data");

        while($record = mysqli_fetch_assoc($result))
        {
            print("<p>Name: $record[Name] --- Email: $record[Email] --- Phone: $record[Phone] </p>");
        }
        
        mysqli_close($conn);
    }
    else
    {
        print("Could not connect to mysql server!");
        exit;
    }
}

?>