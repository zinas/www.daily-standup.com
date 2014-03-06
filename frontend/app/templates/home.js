define(["react"], function(React) {
    return React.createClass({
      render: function() {
        return (
        <div>
            <div className="ui header promo purple inverted">
                <div className="ui page grid">
                    <div className="column">
                        <h1 className="ui header">
                            Daily Standup
                            <a className="ui black label" href="#">0.1.0</a>
                        </h1>
                        <h2>The new way of collaboration</h2>
                        <p>Empower your standups, save time and keep your team up to date.</p>
                    </div>

                </div>
            </div>
            <div className="ui vertically divided page grid center aligned">
                <div className="three column row">
                    <div className="column">
                        <div className="ui segment">
                            <i className="bolt icon huge"></i>

                            <p>Collaborate in a fast and efficient manner.</p>
                            <p>No more delays, no more 30 minutes standups in the morning.</p>
                        </div>
                    </div>
                    <div className="column">
                        <div className="ui segment">
                            <i className="cloud icon huge"></i>

                            <p>Reply at your own convenience.</p>
                            <p>No more stopping your work to attend the standup, or missing the standup because of that meeting.</p>
                        </div>
                    </div>
                    <div className="column">
                        <div className="ui segment">
                            <i className="users icon huge"></i>

                            <p>No more restrictions because of location.</p>
                            <p>You dont need a room, you dont need skype, you dont even need to be on the same planet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        );
      }
    });
});