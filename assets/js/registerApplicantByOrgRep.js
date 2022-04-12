//validate the form and retrieve id

   //function to show document form
   function registerNextBtnOrg(){
        if(validateApplicantForm()){
            document.getElementById("applicant_details").hidden = true;
            document.getElementById("applicant_details_header").hidden = true;
            document.getElementById("upload_document").hidden = false;
            document.getElementById("upload_document_header").hidden = false;
        }
    }

    //function to show applicant details form
    function showApplicantDetailsFormOrg(){
        document.getElementById("applicant_details").hidden = false;
        document.getElementById("applicant_details_header").hidden = false;
        document.getElementById("upload_document").hidden = true;
        document.getElementById("upload_document_header").hidden = true;
    }
  
    function registBtnOrg(){
        if(validateDocumentForm() == true){
            document.getElementById("username").value = getApplicantID(noOfApplicant);
            document.getElementById("password").value = passwordGenerator();
            document.getElementById("docID").value = getDocumentID(noOfDocs);
            $("#addDocumentConfirm").modal("show");
        }
    }
    //function to submit form if the user want to add more document
    function submitForm(){
        document.getElementById("applicant_form").submit();
    }

    //function to submit form if the user doesn't want to add more document
    function submitLast(){
        document.getElementById("applicant_form").setAttribute('action', "registerApplicantOrg.php");
        document.getElementById("applicant_form").submit();
    }

    //generate applicant id(username)
    function getApplicantID(countApplicant){
        return "APP" + (countApplicant + 1);
    }
    
    //password generator
    function passwordGenerator(){
        //list of all characters
        var character = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*(){}\/?";
        var length = 12;
        var password = "";
    
        for(let i = 0; i < length; i++){
            //generate random integer
            randInt = Math.floor(Math.random() * character.length);
            password += character.substring(randInt, randInt+1);
        }
    
        return password;
    }
    
    //generate document id
    function getDocumentID(countDocs){
        return "DOC" + (countDocs + 1);
    }
    
    //validation for applicant details form
    function validateApplicantForm(){
        const name = applicantForm.name.value;
        const idNo = applicantForm.idNo.value;
        const address = applicantForm.address.value;
        const income = applicantForm.income.value;
    
        if(name == ""){
            alert("Please fill in the name!");
            applicantForm.name.focus();
            return false;
        }
        else if(idNo == ""){
            alert("Please fill in the ID Number!");
            applicantForm.idNo.focus();
            return false;
        }
        else if(address == ""){
            alert("Please fill in the address!");
            applicantForm.address.focus();
            return false;
        }
        else if(income == 0){
            alert("Please fill in the income!");
            applicantForm.income.focus();
            return false;
        }
        else if(income < 0){
            alert("Invalid income!");
            applicantForm.income.focus();
            return false;
        }
        else{
            return true;
        }
        }
    
    //function when RegistNext button clicked
    function registerNextBtn(){
        if(validateApplicantForm()){
            showDocumentForm();
        }
    }
    
    //validation for upload document form
    function validateDocumentForm(){
        const fileName = applicantForm.filename.value;
        const fileDesc = applicantForm.description.value;
        const file = applicantForm.doc.value;
    
        if(fileName == ""){
            alert("Please fill the file name!");
            applicantForm.filename.focus();
            return false;
        }
        else if(fileDesc == ""){
            alert("Please fill the file description!");
            applicantForm.description.focus();
            return false;
        }
        else if(file == ""){
            alert("No file selected!");
            return false;
        }
        else{
            return true;
        }
    }
  