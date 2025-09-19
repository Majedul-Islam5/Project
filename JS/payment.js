function showPaymentOptions() 
{
    var method=document.getElementById('paymentMethod').value;
    var onlineDiv=document.getElementById('onlineOptions');
    var cardDiv=document.getElementById('cardOptions');

    if (method=='online') 
    {
        onlineDiv.style.display='block';
        cardDiv.style.display='none';
    } 
    else if(method=='card') 
    {
        onlineDiv.style.display='none';
        cardDiv.style.display='block';
    } 
    else 
    {
        onlineDiv.style.display='none';
        cardDiv.style.display='none';
    }
}
