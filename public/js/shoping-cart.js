(function () {

    document.getElementById('shopcart').style.display = "none";
    $("#cart").on("click", function () {
        $(".shopping-cart").fadeToggle("fast");
    });

})();
