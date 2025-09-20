
document.addEventListener("DOMContentLoaded", function() {
            let modal=document.getElementById("successModal");
            let okBtn=document.getElementById("okButton");
            modal.style.display="flex";
            okBtn.onclick=function() {
                window.location.href="cusDashboard.php";
            };
});