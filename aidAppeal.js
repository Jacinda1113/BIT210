//date validation
function setDateLimit(fdate){
    let startDate = fdate.value;
    let endDate = document.getElementById("tdate");
    endDate.setAttribute("min", startDate);
    }

    //add appeal form validation
    function displaySubmissionStatus(){
    var fdate = appealForm.fdate.value;
    var tdate = appealForm.tdate.value;
    var description = appealForm.description.value;
    if(!fdate){
        alert("Please fill in From Date!");
        appealForm.fdate.focus();
        return false;
    }
    else if(!tdate){
        alert("Please fill in To Date!");
        appealForm.tdate.focus();
        return false;
    }
    else if(description==""){
        alert("Please fill in the description!");
        appealForm.description.focus();
        return false;
    }
    else{
        return true;        
    }
    }

    //generate appeal id
    function getappealID(){
    var appealForm = document.getElementById("appealForm");
    appealForm.appealID.value = "AP" + (numOfAppeals+1);
    console.log(appealID.value);
    }