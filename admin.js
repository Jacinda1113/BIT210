//add event handler for organisation representative form
var orgRepForm = document.getElementById("orgRepForm");

//function to get selected organization ID and organization Name
function displaySelectedID()
{
//get datalist element using id

var getValue = document.getElementById('orgID');
document.getElementById("displayOrgID").innerHTML = "Selected Organization ID: " + getValue.options[getValue.selectedIndex].text;
document.getElementById("displayOrgName").innerHTML = "Selected Organization Name: " + getValue.options[getValue.selectedIndex].value;

}

//get the input of organization ID
function inputOrgID(){    
var getValue = document.getElementById('orgID');
var selectedValue =getValue.options[getValue.selectedIndex].text;
document.getElementById("selectedOrgID").innerHTML = "<input type='text' readonly name='orgID' id='inputOrgID' value='" 
+ selectedValue + "'>";
console.log(document.getElementById("inputOrgID").value);

}

//Form validation
//function to validate organization representative form
function validateOrgForm(){
const username = orgRepForm.username.value;
const fullname = orgRepForm.fullname.value;
const email = orgRepForm.email.value;
const phone = orgRepForm.mobile.value;
const jobValue = orgRepForm.jobTitle.value;

if(username == ""){
    alert("Please fill in the username!");
    orgRepForm.username.focus();
    return false;
}
else if(username.length < 8){
    alert("Username should at least have 8 characters");
    orgRepForm.username.focus();
    return false;
}
else if(fullname == ""){
    alert("Please fill in the full name!");
    orgRepForm.fullname.focus();
    return false;
}
else if(email == ""){
    alert("Please fill in the email address!");
    orgRepForm.email.focus();
    return false;
}
else if(isEmail(email) == false){
    alert("Invalid email!");
    return false;
}
else if(phone == ""){
    alert("Please fill in the phone number");
    orgRepForm.mobile.focus();
    return false;
}
else if(!/^\+?([0-9]{4})\)?[-. ]?([0-9]{3,})$/.test(phone)){
    alert("Invalid phone number!");
    orgRepForm.mobile.focus();
    return false;
}
else if(jobValue == ""){
    alert("Please fill in the Job title");
    orgRepForm.jobTitle.focus();
    return false;
}
else{
    return true;
}
}

//function to check email format
function isEmail(email) {
return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

//password generator
function passwordGenerator(){
//list of all characters
var character = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*(){}\/?";
var password = "";

for(let i = 0; i < 12; i++){
    //generate random integer
    randInt = Math.floor(Math.random() * character.length);
    password += character.substring(randInt, randInt+1);
}

return password;
}

function submitMoreForm(){
    if(validateOrgForm()){
    document.getElementById("password").value = passwordGenerator();
    orgRepForm.setAttribute('action', "addRep.php");
    orgRepForm.submit();
    orgRepForm.reset();
    }
  }

  function submitForm(){
    if(validateOrgForm())
    document.getElementById("password").value = passwordGenerator();
    orgRepForm.submit();

}