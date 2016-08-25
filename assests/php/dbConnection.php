<?PHP

function setDbConnection(){
    
    $username = "dcsp06";
    $password = "ab1234";
    $hostname = "localhost";

    $conn = new mysqli($hostname, $username, $password, $username);

    if ($conn->connect_errno) 
    {
        header('Location: http://pluto.cse.msstate.edu/~dcsp06/500.html)
    }
}

?>