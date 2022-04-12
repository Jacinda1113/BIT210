//function to retrieve appealID
function getAppealID(appealID, startDate, endDate){
    document.getElementById("appealID").value = appealID;
    document.getElementById("displayAppealID").innerHTML = appealID;
    document.getElementById("displayStartDate").innerHTML = startDate;
    document.getElementById("displayEndDate").innerHTML = endDate;
}

//generate contribution id
function getContributionID(countContribution){
  return "C" + (countContribution + 1);
}

//function to display form based on selection
donationType.addEventListener("change", () => {
    var selectedValue = donationType.options[donationType.selectedIndex].value;
    if(selectedValue == "cash"){
      document.getElementById("cashForm").hidden = false;
      document.getElementById("goodsForm").hidden = true;
    }
    else{
      document.getElementById("cashForm").hidden = true;
      document.getElementById("goodsForm").hidden = false;
    }
});

function submitContribution(){
  var donationType = document.getElementById("donationType");
  var selectedValue = donationType.options[donationType.selectedIndex].value;
  if(selectedValue == "cash"){
    if(validateCashDonation() == true){
      document.getElementById("contributionID").value = getContributionID(countContribution);
      recordContribution.submit();
    }
  }
  else{
    if(validateGoodsDonation() == true){
      document.getElementById("contributionID").value = getContributionID(countContribution);
      recordContribution.submit();
    }
  }
}

//Validate cash donation form
function validateCashDonation(){
  const amount = recordContribution.amount.value;
  const payment = recordContribution.paymentMethod.value;
  const reference = recordContribution.referenceNo.value;
  if(amount == 0){
    alert("Please fill out the amount!");
    recordContribution.amount.focus();
    return false;
  }
  else if(amount < 0){
    alert("Invalid amount!");
    recordContribution.amount.focus();
    return false;
  }
  else if(payment == "-1"){
    alert("Please choose the payment method!");
    return false;
  }
  else if(reference == ""){
    alert("Please fill in the reference number!");
    recordContribution.referenceNo.focus();
    return false;
  }
  else{
    document.getElementById("hideModal").click();
    return true;
  }
};

//Validate goods donation form
function validateGoodsDonation(){
  const description = recordContribution.description.value;
  const estValue = recordContribution.estValue.value;
  if(description == ""){
    alert("Please fill out the goods description!");
    recordContribution.amount.focus();
    return false;
  }
  else if(estValue == 0){
    alert("Please fill the estimated value!");
    recordContribution.amount.focus();
    return false;
  }
  else if(estValue < 0){
    alert("Invalid value!");
    recordContribution.amount.focus();
    return false;
  }
  else{
    document.getElementById("hideModal").click();
    return true;
  }
};

