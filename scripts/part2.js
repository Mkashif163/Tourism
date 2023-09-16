var PaymentDetails = JSON.parse(localStorage.getItem("PaymentDetails"));
window.onload = function () {
    document.getElementById("customerName").textContent = PaymentDetails.name;
    document.getElementById("productSelection").textContent = PaymentDetails.productname;
    document.getElementById("quantity").textContent = PaymentDetails.qty;
    document.getElementById("price").textContent = PaymentDetails.price;
};
function cancelOrder() {
    localStorage.clear();
    window.location.href = "index.html";
}
function isValidCardNumber(cardType, cardNumber) {
    var cardNumberRegex;
    switch (cardType) {
        case "Visa":
            cardNumberRegex = /^4\d{15}$/;
            break;
        case "Mastercard":
            cardNumberRegex = /^5[1-5]\d{14}$/;
            break;
        case "American Express":
            cardNumberRegex = /^3[47]\d{13}$/;
            break;
        default:
            return false;
    }
    return cardNumberRegex.test(cardNumber);
}
function isPositiveInteger(str) {
    return Number.isInteger(Number(str)) && Number(str) >= 0;
}
function validatePaymentForm() {
    clearErrorMessages();
    var isValid = true;
    var cardType = document.getElementById("cardType").value;
    if (cardType === "") {
        isValid = false;
        document.getElementById("cardTypeError").textContent = "Please select a card type.";
    }
    var cardName = document.getElementById("cardName").value;
    if (cardName === "") {
        isValid = false;
        document.getElementById("cardNameError").textContent = "Please enter the name on the card.";
    }
    var cardNumber = document.getElementById("cardNumber").value;
    if (cardNumber === "" || !isValidCardNumber(cardType, cardNumber)) {
        isValid = false;
        document.getElementById("cardNumberError").textContent = "Please enter a valid card number.";
    }
    var expiryDate = document.getElementById("expiryDate").value;
    if (expiryDate === "" || !isValidExpiryDate(expiryDate)) {
        isValid = false;
        document.getElementById("expiryDateError").textContent = "Please enter a valid expiry date (mm-yy).";
    }
    var cvv = document.getElementById("cvv").value;
    if (cvv === "" || !isPositiveInteger(cvv) || cvv.length !== 3) {
        isValid = false;
        document.getElementById("cvvError").textContent = "Please enter a valid CVV (3-digit number).";
    }

    return isValid;
}
function isValidExpiryDate(expiryDate) {
    return /^(0[1-9]|1[0-2])-[0-9]{2}$/.test(expiryDate);
}
function clearErrorMessages() {
    document.getElementById("cardTypeError").textContent = "";
    document.getElementById("cardNameError").textContent = "";
    document.getElementById("cardNumberError").textContent = "";
    document.getElementById("expiryDateError").textContent = "";
    document.getElementById("cvvError").textContent = "";
}
