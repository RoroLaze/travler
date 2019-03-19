am4core.useTheme(am4themes_animated);
// Themes end

// Create map instance
var chart = am4core.create("chartdiv", am4maps.MapChart);

// Set map definition
chart.geodata = am4geodata_worldHigh;

// Set projection
chart.projection = new am4maps.projections.Mercator();

// Export
chart.exporting.menu = new am4core.ExportMenu();

// Zoom control
chart.zoomControl = new am4maps.ZoomControl();

var homeButton = new am4core.Button();
homeButton.events.on("hit", function () {
    chart.goHome();
});

homeButton.icon = new am4core.Sprite();
homeButton.padding(7, 5, 7, 5);
homeButton.width = 20;
homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
homeButton.marginBottom = 10;
homeButton.parent = chart.zoomControl;
homeButton.insertBefore(chart.zoomControl.plusButton);

// Center on the groups by default
chart.homeZoomLevel = 3.5;
chart.homeGeoPoint = {
    longitude: 0,
    latitude: 52
};

var groupData = [
    {
        "name": "available countries",
        "color": "#b1dd04",
        "data": [
            {
                "title": "France",
                "id": "FR",
                "visits": "1"
      }
    ]
  }
];

// This array will be populated with country IDs to exclude from the world series
var excludedCountries = ["AQ"];

// Create a series for each group, and populate the above array
groupData.forEach(function (group) {
    var series = chart.series.push(new am4maps.MapPolygonSeries());
    series.name = group.name;
    series.useGeodata = true;
    var includedCountries = [];
    group.data.forEach(function (country) {
        includedCountries.push(country.id);
        excludedCountries.push(country.id);
    });
    series.include = includedCountries;

    series.fill = am4core.color(group.color);

    // By creating a hover state and setting setStateOnChildren to true, when we
    // hover over the series itself, it will trigger the hover SpriteState of all
    // its countries (provided those countries have a hover SpriteState, too!).
    series.setStateOnChildren = true;
    var seriesHoverState = series.states.create("hover");

    // Country shape properties & behaviors
    var mapPolygonTemplate = series.mapPolygons.template;
    // Instead of our custom title, we could also use {name} which comes from geodata  
    mapPolygonTemplate.fill = am4core.color(group.color);
    mapPolygonTemplate.fillOpacity = 0.8;

    // States  
    var clickState = mapPolygonTemplate.states.create("hover");
    clickState.properties.fill = am4core.color("#00C1C0");

    // Tooltip
    mapPolygonTemplate.tooltipText = "{visits} visite disponible"; // enables tooltip
    // series.tooltip.getFillFromObject = false; // prevents default colorization, which would make all tooltips red on hover
    // series.tooltip.background.fill = am4core.color(group.color);

    // MapPolygonSeries will mutate the data assigned to it, 
    // we make and provide a copy of the original data array to leave it untouched.
    // (This method of copying works only for simple objects, e.g. it will not work
    //  as predictably for deep copying custom Classes.)
    series.data = JSON.parse(JSON.stringify(group.data));
});

// The rest of the world.
var worldSeries = chart.series.push(new am4maps.MapPolygonSeries());
var worldSeriesName = "world";
worldSeries.name = worldSeriesName;
worldSeries.useGeodata = true;
worldSeries.exclude = excludedCountries;
worldSeries.fillOpacity = 0.8;
worldSeries.hiddenInLegend = true;

// Add line bullets
var cities = chart.series.push(new am4maps.MapImageSeries());
cities.mapImages.template.nonScaling = true;

var city = cities.mapImages.template.createChild(am4core.Circle);
city.radius = 6;
city.fill = am4core.color("#00C1C0");
city.strokeWidth = 2;
city.stroke = am4core.color("#fff");

function addCity(coords, title) {
    var city = cities.mapImages.create();
    city.latitude = coords.latitude;
    city.longitude = coords.longitude;
    city.tooltipText = title;
    return city;
}

var paris = addCity({
    "latitude": 48.8567,
    "longitude": 2.3510
}, "Paris");
