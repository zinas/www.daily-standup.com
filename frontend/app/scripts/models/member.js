define(['backbone'], function (Backbone) {
    return Member = Backbone.Model.extend({
        initialize: function() {
            console.log("member initialized");
        },
        urlRoot: function () {
            return '/daily-standup-backend/rest/';
        },
        url : function() {
            var base =  'members/';
            if (this.isNew()) return base;
            else return base + this.id;
        }
    });
});