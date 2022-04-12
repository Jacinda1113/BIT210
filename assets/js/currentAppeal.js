//function to retrieve appealID
function getAppealID(appealID){
    document.getElementById("appealID").value = appealID;
    document.getElementById("displayAppealID").innerHTML = appealID;
}

//generate contribution id
function getContributionID(countContribution){
    return "C" + (countContribution + 1);
}

cashDonation.addEventListener("submit", (e) => {
    e.preventDefault();
    if(validateCashDonationForm())
      document.getElementById("contributionID").value = getContributionID(noOfContribution);
      cashDonation.submit();
  });

  /* validate cash donation form */
  function validateCashDonationForm(){
    const amount = cashDonation.amount.value;
    const payment = cashDonation.paymentMethod.value;
    const reference = cashDonation.referenceNo.value;
    if(amount == 0){
      alert("Please fill out the amount!");
      cashDonation.amount.focus();
      return false;
    }
    else if(amount < 0){
      alert("Invalid amount!");
      return false;
    }
    else if(payment == "-1"){
      alert("Please choose your payment method!");
      return false;
    }
    else if(reference == ""){
      alert("Please fill in the reference number!");
      cashDonation.referenceNo.focus();
      return false;
    }
    else{
      return true;
    }
  }