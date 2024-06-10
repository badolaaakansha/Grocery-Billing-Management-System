document.getElementById("demo").innerHTML=(new Date().toLocaleDateString('en-GB'));
function printInvoice(){
    window.print();
}

function back(){
    window.location="welcomehome.php";
}