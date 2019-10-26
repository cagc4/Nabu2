<?php

function home(){
    
?>

<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />

<style>
.mapboxgl-popup {
max-width: 400px;
font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
}
</style>



<div align='center'>
    <div id='map' style='width:100%; height:500px;'   ></div>
</div>


    
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiY2FnYzQiLCJhIjoiY2syNTh5bDR4MDF0ejNjcWhseTEwd3o1YyJ9.zWCBnoPdqisqgGfnhx8tGQ';
    var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-74.112451,4.657097],
    zoom: 10        
    });
    
    var size = 200;
 
var pulsingDot = {
width: size,
height: size,
data: new Uint8Array(size * size * 4),
 
onAdd: function() {
var canvas = document.createElement('canvas');
canvas.width = this.width;
canvas.height = this.height;
this.context = canvas.getContext('2d');
},
 
render: function() {
var duration = 1000;
var t = (performance.now() % duration) / duration;
 
var radius = size / 2 * 0.3;
var outerRadius = size / 2 * 0.7 * t + radius;
var context = this.context;
 
// draw outer circle
context.clearRect(0, 0, this.width, this.height);
context.beginPath();
context.arc(this.width / 2, this.height / 2, outerRadius, 0, Math.PI * 2);
context.fillStyle = 'rgba(255, 200, 200,' + (1 - t) + ')';
context.fill();
 
// draw inner circle
context.beginPath();
context.arc(this.width / 2, this.height / 2, radius, 0, Math.PI * 2);
context.fillStyle = 'rgba(255, 100, 100, 1)';
context.strokeStyle = 'white';
context.lineWidth = 2 + 4 * (1 - t);
context.fill();
context.stroke();
 
// update this image's data with data from the canvas
this.data = context.getImageData(0, 0, this.width, this.height).data;
 
// keep the map repainting
map.triggerRepaint();
 
// return `true` to let the map know that the image was updated
return true;
}
};
    
    
    map.on('load', function () {
        map.addImage('pulsing-dot', pulsingDot, { pixelRatio: 4 });
        map.addLayer({
            "id": "places",
            "type": "symbol",
            "source": {
                "type": "geojson",
                "data": {
                    "type": "FeatureCollection",
                    "features": [
                    {
                        "type": "Feature",
                        "properties": {
                            "description": "<br><strong>Distribuidor 1</strong><p>Direccion</p>",
                            "icon": "circle-stroked"
                        },
                        "geometry": {
                            "type": "Point",
                            "coordinates": [-74.080003,4.682590]
                        }
                    },
                      {           
                         "type": "Feature",
                        "properties": {
                            "description": "<br><strong>Distribuidor 2</strong><p>Direccion</p>",
                            "icon": "circle-stroked"
                        },
                        "geometry": {
                            "type": "Point",
                            "coordinates": [-74.040318,4.726496]
                        }         
                     },
                    {
                        "type": "Feature",
                        "properties": {
                            "description": "<br><strong>Distribuidor 3</strong><p>Direccion</p>",
                            "icon": "circle-stroked"
                        },
                        "geometry": {
                            "type": "Point",
                            "coordinates": [-74.153245,4.682025]
                        }
                    },
                      {           
                         "type": "Feature",
                        "properties": {
                            "description": "<br><strong>Distribuidor 4</strong><p>Direccion</p>",
                            "icon": "circle-stroked"
                        },
                        "geometry": {
                            "type": "Point",
                            "coordinates": [-74.070207,4.611246]
                        }         
                     }        
                    ],
                   
                       
                   
                    
                    
                    
                }
            },
            "layout": {
                "icon-image": "pulsing-dot",
                "icon-allow-overlap": true
            }
        })
    
    // When a click event occurs on a feature in the places layer, open a popup at the
// location of the feature, with description HTML from its properties.
map.on('click', 'places', function (e) {
var coordinates = e.features[0].geometry.coordinates.slice();
var description = e.features[0].properties.description;
 
// Ensure that if the map is zoomed out such that multiple
// copies of the feature are visible, the popup appears
// over the copy being pointed to.
while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
}
 
new mapboxgl.Popup()
.setLngLat(coordinates)
.setHTML(description)
.addTo(map);
});
 
// Change the cursor to a pointer when the mouse is over the places layer.
map.on('mouseenter', 'places', function () {
map.getCanvas().style.cursor = 'pointer';
});
 
// Change it back to a pointer when it leaves.
map.on('mouseleave', 'places', function () {
map.getCanvas().style.cursor = '';
});
        
map.addControl(new mapboxgl.NavigationControl());
    
    });
             
</script>
  
<?php
}
?>
