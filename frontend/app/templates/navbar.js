define(["react"], function(React) {
    return React.createClass({
      render: function() {
        return (

<div class="ui menu black inverted mainnav">
    <div class="container">
        <a class="item">About us</a>
        <a class="item">FAQ</a>
        <a class="item">Contact us</a>
        <div class="right menu">
            <a class="item">
                <i class="icon sign in"></i> Login
            </a>
        </div>
    </div>
</div>

        );
      }
    });
});