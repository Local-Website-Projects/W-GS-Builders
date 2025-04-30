!function (e) {
    "use strict";

    function a() {
    }

    a.prototype.createDonutChart = function (a, t, e) {
        Morris.Donut({element: a, data: t, barSize: .2, resize: !0, colors: ["#7638ff", "#FDA600", "#0D8D80", "#6a139c"], backgroundColor: "transparent"})
    }, a.prototype.init = function () {
        var t;
        a = ["#7638ff", "#FDA600", "#0D8D80", "#6a139c"];
        (t = e("#lifetime-sales").data("colors")) && (a = t.split(",")), this.createDonutChart("lifetime-sales",
            [{label: " Total Sales ", value: 12},
                {label: " Campaign Send", value: 30},
                {label: " Daily Sales ", value: 20},
                {label: " New Sales ", value: 20}], a)
    }, e.Dashboard4 = new a, e.Dashboard4.Constructor = a
}(window.jQuery), function () {
    "use strict";
    window.jQuery.Dashboard4.init()
}();