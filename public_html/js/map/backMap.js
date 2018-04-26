"use strict";
/* init */

var map = {};
map.stage = 1;


var stage = new Konva.Stage({
    container: 'map-container',
    width: window.innerWidth,
    height: window.innerHeight
});

// add canvas element
var layer = new Konva.Layer({
    fill: '#00D2FF',
    stroke: 'black',
    strokeWidth: 4
});
stage.add(layer);

/*
* MAP desk
* */
var mapBackground = new Konva.Rect({
    x: 0,
    y: 0,
    width: 1000,
    height: 1000,
    fill: '#c2c3b1',
    stroke: 'black',
    strokeWidth: 1
});
var mapGroup = new Konva.Group({
    x: 0,
    y: 0,
    width: 1000,
    height: 1000,
    fill: '#c2c3b1',
    stroke: 'red',
    strokeWidth: 10,
    draggable: true,
    dragDistance: 10
});

/* MOUSE WHEEL START */

var scaleBy = 1.31;
var mapContainer = document.getElementById('map-container');
mapContainer.addEventListener('wheel', function(e) {

    e.preventDefault();
    var oldScale = stage.scaleX();
    if((oldScale * scaleBy > 10 && e.deltaY <= 0) || (e.deltaY > 0 &&oldScale * scaleBy < 0.2)) {
        return false;
    }
    var mousePointTo = {
        x: stage.getPointerPosition().x / oldScale - stage.x() / oldScale,
        y: stage.getPointerPosition().y / oldScale - stage.y() / oldScale,
    };
    var newScale = e.deltaY <= 0 ? oldScale * scaleBy : oldScale / scaleBy;
    stage.scale({ x: newScale, y: newScale });
    var newPos = {
        x: -(mousePointTo.x - stage.getPointerPosition().x / newScale) * newScale,
        y: -(mousePointTo.y - stage.getPointerPosition().y / newScale) * newScale
    };
    stage.position(newPos);
    stage.batchDraw();
});

/* MOUSE WHEEL END */

mapGroup.add(mapBackground);
layer.add(mapGroup);

var mapIreland = new Konva.Path({
    x: 0,
    y: 0,
    data: irelandPath,
    fill: '#ead6a4',
    stroke: '#b5b6a4',
    strokeWidth: 20,
    shadowColor: '#b5b6a4',
    shadowBlur: 20,
    shadowOffset: {x : 0, y : 0},
    shadowOpacity: 1,
    opacity: 1,
    scale: {
        x : 1,
        y : 1
    }
});

mapGroup.add(mapIreland);

var playerColors = [
    'rgba(76,255,255,1)',
    'rgba(76,189,255,1)',
    'rgba(76,255,121,1)',
    'rgba(98,76,255,1)',

    'rgba(166,76,255,1)',
    'rgba(98,255,76,1)',
    'rgba(76,121,255,1)',
    'rgba(76,255,189,1)',
];

var paths = [];
for(var i = 0; i < regions.length;i++) {
    console.log(regions[i]);
    paths[regions[i]] = new Konva.Path({
        x: 0,
        y: 0,
        data: regions[i+1],
        // todo:: fill what color own
        //fill: playerColors[helper.randomInt(0, playerColors.length - 1)],
        fill: '#ead6a4',
        stroke: 'white',
        strokeWidth: 0.2,
        opacity: 1,
        provinceData: {
            id: i+1,
            own: 'Ivan',
            count: 45,
            logical: true,
        },
        lineCap: 'round',
        lineJoin: 'round',
        scale: {
            x : 1,
            y : 1
        }
    });


    paths[regions[i]].on('click', function() {
        this.moveToTop();
        this.stroke('rgba(76,189,255,1)');
        console.log('this',this);
        layer.batchDraw();
        $('#right-menu').addClass('animated bounceInRight');
        console.log('animated');
        console.log('Province id:');
        console.log(this.attrs.provinceData);
    });
    paths[regions[i]].on('mouseover', function() {
        this.moveToTop();
        this.opacity(1);
        this.fill('#c8b281');
        //this.stroke('red');
        document.body.style.cursor = 'pointer';
        layer.batchDraw();
    });
    paths[regions[i]].on('mouseout', function() {
        this.stroke('white');
        this.fill('#ead6a4');
        this.opacity(1);
        document.body.style.cursor = 'pointer';
        layer.batchDraw();
    });

    mapGroup.add(paths[regions[i]]);
    i++;
}

/* tests */

layer.draw();

//
$('#right-menu .close').on('click', function() {
    $('#right-menu').addClass('bounceOutRight');
    setTimeout(function(){
        $('#right-menu').removeClass('animated');
        $('#right-menu').removeClass('bounceInRight');
        $('#right-menu').removeClass('bounceOutRight');
    },500);
});


//
//mapGroup.on('click', function() {
//    console.log('usual click on mapGroup');
//});
//
//layer.on('click', function() {
//    console.log('usual click on layer');
//});