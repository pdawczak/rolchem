app.directive('growl', function () {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {
            scope.$on("UPDATE_ORDER_ITEM_COUNT", function (event) {
                $.gritter.add({
                    title: 'Super znicz',
                    text: 'Produkt został dodany do zamówienia.',
                    image: 'http://localhost:8000/media/cache/product_cart/images/products/536688cff0cfa.jpg'
                });
            });
        }
    };
});
