function hexToRGB(a, e) {
    var r = parseInt(a.slice(1, 3), 16), t = parseInt(a.slice(3, 5), 16), o = parseInt(a.slice(5, 7), 16);
    return e ? "rgba(" + r + ", " + t + ", " + o + ", " + e + ")" : "rgb(" + r + ", " + t + ", " + o + ")"
}

!function (i) {
    "use strict";

    function a() {
        this.$body = i("body"), this.charts = []
    }

    a.prototype.respChart = function (e, r, t, o) {
        var s = e.get(0).getContext("2d");
        Chart.defaults.global.defaultFontColor = "#8391a2", Chart.defaults.scale.gridLines.color = "#8391a2";
        var n = i(e).parent();
        return function () {
            var a;
            switch (e.attr("width", i(n).width()), r) {
                case"Bar":
                    a = new Chart(s, {type: "bar", data: t, options: o});
                    break;
            }
            return a
        }()
    }, a.prototype.initCharts = function () {
        var a = [], e = ["#1abc9c", "#f1556c", "#1abc9c", "#e3eaef"];
        if (0 < i("#projections-actuals-chart").length) {
            var t, o, s = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales Analytics",
                    backgroundColor: (o = (t = i("#projections-actuals-chart").data("colors")) ? t.split(",") : e.concat())[0],
                    borderColor: o[0],
                    hoverBackgroundColor: "#A36Eff",
                    hoverBorderColor: o[0],
                    data: [65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81],
                    barPercentage: .7,
                    categoryPercentage: .9
                }, {
                    label: "Dollar Rate",
                    backgroundColor: "#FDA600",
                    borderColor: o[1],
                    hoverBackgroundColor: "#FDD559",
                    hoverBorderColor: o[1],
                    data: [89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 65, 59],
                    barPercentage: .7,
                    categoryPercentage: .9
                }]
            };
            a.push(this.respChart(i("#projections-actuals-chart"), "Bar", s, {
                maintainAspectRatio: !1,
                legend: {display: !1},
                scales: {
                    yAxes: [{gridLines: {display: !1}, stacked: !1, ticks: {stepSize: 20}}],
                    xAxes: [{stacked: !1, gridLines: {color: "rgba(0,0,0,0.01)"}}]
                }
            }))
        }
        return a
    }, a.prototype.init = function () {
        var e = this;
        Chart.defaults.global.defaultFontFamily = "Nunito,sans-serif", e.charts = this.initCharts(), i(window).on("resize", function (a) {
            i.each(e.charts, function (a, e) {
                try {
                    e.destroy()
                } catch (a) {
                }
            }), e.charts = e.initCharts()
        })
    }, i.ChartJs = new a, i.ChartJs.Constructor = a
}(window.jQuery), function () {
    "use strict";
    window.jQuery.ChartJs.init()
}();