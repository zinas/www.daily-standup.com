define(['backbone'], function(backbone) {
    var Router = Backbone.Router.extend({
        routes: {
            "pages/home": "home",
            '*params':"default"
        }
    });

    var router = new Router();

    router.on('route:home', function () {
        require(['react', 'jsx!templates/home'], function (React, Template) {
            React.renderComponent(new Template(), document.getElementById('main'));
        });
    });

    router.on('route:default', function (params) {
        console.log('defaultRouter', params);
    });

    return router;
});