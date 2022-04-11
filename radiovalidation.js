function validateForm(){
    var radios = document.getElementsByName("status");
    var formValid = false;
    var i = 0;
    while (!formValid && i<radios.length){
        if (radios[i].checked) formValid = true;
        i++;
    }
    if (!formValid) alert("Please pick an option!");
    else alert("Thanks for your reply");
    return formValid;
}