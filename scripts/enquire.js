
document.addEventListener('DOMContentLoaded', function () {
    var selectElement = document.getElementById('product');
    var quantityInput = document.getElementById('qty');
    quantityInput.addEventListener('change', function () {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var productPrice = selectedOption.value;
        var productQuantity = parseInt(document.getElementById('qty').value);
        var totalPrice = productPrice * productQuantity;
        document.getElementById('price').value = totalPrice.toFixed(0);
    });
    selectElement.addEventListener('change', function () {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var productName = selectedOption.text;
        var productPrice = selectedOption.value;
        var productCode = selectedOption.value;
        document.getElementById('product-name').value = productName;
        document.getElementById('price').value = productPrice;
        document.getElementById('product-code').value = productCode;
        document.getElementById('qty').value = 1;
    });
});
function validateForm() {
    var firstName = document.forms["enquiry-form"]["first-name"].value;
    var lastName = document.forms["enquiry-form"]["last-name"].value;
    var email = document.forms["enquiry-form"]["email"].value;
    var streetAddress = document.forms["enquiry-form"]["street-address"].value;
    var suburbTown = document.forms["enquiry-form"]["suburb-town"].value;
    var state = document.forms["enquiry-form"]["state"].value;
    var postcode = document.forms["enquiry-form"]["postcode"].value;
    var phone = document.forms["enquiry-form"]["phone"].value;
    var contactMethod = document.forms["enquiry-form"]["contact-method"].value;
    var product = document.forms["enquiry-form"]["product"].value;
    var productName = document.forms["enquiry-form"]["product-name"].value;
    var productCode = document.forms["enquiry-form"]["product-code"].value;
    var enquiryDetails = document.forms["enquiry-form"]["enquiry-details"].value;
    if (
        firstName === "" ||
        lastName === "" ||
        email === "" ||
        streetAddress === "" ||
        suburbTown === "" ||
        state === "" ||
        postcode === "" ||
        phone === "" ||
        product === "0" ||
        productName === "" ||
        productCode === "" ||
        enquiryDetails === ""
    ) {
        alert("Please fill in all required fields.");
        return false;
    }
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.match(emailRegex)) {
        alert("Please enter a valid email address.");
        return false;
    }
    var phoneRegex = /^\d{10}$/;
    if (!phone.match(phoneRegex)) {
        alert("Please enter a valid phone number.");
        return false;
    }
    var name = document.getElementById("first-name").value + " " + document.getElementById("last-name").value;
    var quantity = document.getElementById("qty").value;
    var productName = document.getElementById("product-name").value;
    var productPrice = document.getElementById("price").value;
    var data = { name: name, qty: quantity, productname: productName, price: productPrice };
    localStorage.setItem("PaymentDetails", JSON.stringify(data));
    return true;
}