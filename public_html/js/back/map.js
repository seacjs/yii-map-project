

var stage = new Konva.Stage({
    container: 'map-container',
    width: window.innerWidth,
    height: window.innerHeight
});

// add canvas element
var layer = new Konva.Layer({
    fill: '#00D2FF',
    stroke: 'black',
    strokeWidth: 4,
});
stage.add(layer);

// create shape
var box = new Konva.Rect({
    x: 0,
    y: 0,
    width: 1000,
    height: 1000,
    fill: '#c2c3b1',
    stroke: 'black',
    strokeWidth: 1,
});
var group = new Konva.Group({
    x: 0,
    y: 0,
    width: 1000,
    height: 1000,
    fill: '#c2c3b1',
    stroke: 'red',
    strokeWidth: 10,
    draggable: true
});

//var scale = 1;

/* MOUSE WHEEL START */

var scaleBy = 1.31;
var mapContainer = document.getElementById('map-container');
mapContainer.addEventListener('wheel', function(e) {
    e.preventDefault();
    var oldScale = stage.scaleX();
    //if((oldScale * scaleBy > 3 && e.deltaY <= 0) || (e.deltaY > 0 &&oldScale * scaleBy < 0.2)) {
    //    return false;
    //}
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

group.add(box);
layer.add(group);

var mapIreland = new Konva.Path({
    x: 100,
    y: -50,
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
group.add(mapIreland);

/* IMAGE START */

var imageObj = new Image();
imageObj.onload = function() {
    var yoda = new Konva.Image({
        x: 50,
        y: 50,
        image: imageObj,
        width: 106,
        height: 118
    });
    // add the shape to the layer
    layer.add(yoda);
    // add the layer to the stage
    stage.add(layer);
};
imageObj.src = '/images/grass_06.jpg';

/* IMAGE END */

var paths = [];
for(var i = 0; i < regions.length;i++) {

    paths[regions[i]] = new Konva.Path({
        x: 100,
        y: -50,
        data: regions[i+1],
        fill: '#ead6a4',
        stroke: 'white',
        strokeWidth: 0.2,
        opacity: 1,

        //fillPatternImage: imageObj,
        //fillPatternX: 0,
        //fillPatternY: 0,
        //fillPatternOffset: {x:0, y:0},
        //fillPatternScale: {x:0.5, y:0.5},
        //fillPatternRepeat: 'repeat',

        lineCap: 'round',
        lineJoin: 'round',

        scale: {
            x : 1,
            y : 1
        }
    });

    paths[regions[i]].on('mouseover', function() {
        this.moveToTop();
        this.opacity(1);
        this.fill('#c8b281');
        this.stroke('red');
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
    paths[regions[i]].on('click', function() {
        this.stroke('blue');
        layer.batchDraw();
        //$('#right-menu').addClass('animated bounceInRight');
        console.log('animated');
    });

    group.add(paths[regions[i]]);
    i++;
}


layer.draw();/**
 * Created by Evgeny on 03.08.2017.
 */
