require(["react", "jsx!scripts/components/example"], function(React, CommentBox) {
    React.renderComponent(new CommentBox(), document.getElementById('content'));
});