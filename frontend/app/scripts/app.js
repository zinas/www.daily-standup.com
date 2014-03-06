require(['backbone', 'router', 'react', 'jsx!templates/navbar'], function(backbone, router, React, Navbar) {
    React.renderComponent(new Navbar(), document.getElementById('main'));

    Backbone.history.start();
});