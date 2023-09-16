function ready(callback) {
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        callback();
    } else {
        document.addEventListener('DOMContentLoaded', callback);
    }
}

ready(function () {
    var productImage = document.querySelectorAll('img');
    productImage.forEach(function (image) {
        image.addEventListener('click', function () {
            window.location.href = "./enquire.html";
        });
    });
});
