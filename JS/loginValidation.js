
function validation()
{
    const firstname = document.getElementById('name').value.trim();
    const password = document.getElementById('password').value;

    if(firstname=="")
    {
        document.getElementById("nameerr").innerHTML = "Name is empty";
        return false;    
    }

    if(password=="")
    {
        document.getElementById("passworderr").innerHTML = "Email is empty";
        return false;  
    }

    return true;

}

document.getElementById('name').addEventListener("keypress",function(e) 
{
    document.getElementById("nameerr").innerHTML = "";
    document.getElementById("use").innerHTML = "";
});

document.getElementById('password').addEventListener("keypress",function(e) 
{
    document.getElementById("passworderr").innerHTML="";
    document.getElementById("pass").innerHTML = "";
});
