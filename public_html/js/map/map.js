"use strict";

let map = {
    config: {
        mapContainerId: 'map-container',
        scaleBase: 1,
        scaleSteep: 1.31,
        scaleSteepMax: 10,
        scaleSteepMin: 0.2,
        playerColors: [
            'rgba(76,255,255,1)',
            'rgba(76,189,255,1)',
            'rgba(76,255,121,1)',
            'rgba(98,76,255,1)',

            'rgba(166,76,255,1)',
            'rgba(98,255,76,1)',
            'rgba(76,121,255,1)',
            'rgba(76,255,189,1)'
        ],
        stageOptions: {
            container: 'map-container',
            width: window.innerWidth,
            height: window.innerHeight
        },
        layerOptions: {
            fill: '#7AA8CD',//'#00D2FF',
            stroke: 'black',
            strokeWidth: 4
        },
        mapBackgroundOptions: {
            x: 0,
            y: 0,
            width: 1000,
            height: 1000,
            fill: '#3b6f81', // c2c3b1
            stroke: 'black',
            strokeWidth: 1
        },
        mapGroupOptions: {
            x: 0,
            y: 0,
            width: 1000,
            height: 1000,
            fill: '#c2c3b1',
            stroke: 'red',
            strokeWidth: 10,
            draggable: true,
            dragDistance: 10
        },
        irelandPathOptions: {
            x: 0,
            y: 0,
            data: irelandPath,
            fill: '#3b6f81',  // ead6a4
            stroke: '#ead6a4', // b5b6a4
            strokeWidth: 1,
            shadowColor: '#000000',//'#ead6a4',  // b5b6a4
            shadowBlur: 8,
            shadowOffset: {x : 0, y : 10},
            shadowOpacity: 1,
            opacity: 0.25,
            scale: {
                x : 1,
                y : 1
            }
        }
    },
    mainStage: false,
    mainLayer: false,
    mapBackground: false,
    mapGroup: false,
    mapIreland: false,
    mapContainer: false,
    regions: [],
    loadConfig: function(config) {
        for(let element in this.config) {
            this.config[element] = config[element] ? config[element] : this.config[element];
        }
    },
    init: function () {
        this.mainStage = new Konva.Stage(this.config.stageOptions);
        this.mainLayer = new Konva.Layer(this.config.layerOptions);
        this.mainStage.add(this.mainLayer);
        this.mapBackground = new Konva.Rect(this.config.mapBackgroundOptions);
        this.mapGroup = new Konva.Group(this.config.mapGroupOptions);
        this.mapContainer = document.getElementById(this.config.mapContainerId);
        this.mapContainer.addEventListener("wheel", this.mapWheelEventListener.bind(this));
        this.mapGroup.add(this.mapBackground);
        this.mainLayer.add(this.mapGroup);

        this.mapIreland = new Konva.Path(this.config.irelandPathOptions);
        this.mapGroup.add(this.mapIreland);


        this.renderRegions();
        //this.renderRoads(); // of becouse lags
        //this.renderCastles(); // of becouse lags
    },
    renderRegions: function() {
        var id = 1;
        for(var i = 0; i < regions.length;i++) {
            //console.log(regions[i],id);
            let region = new Region(this, {
                data: regions[i+1],
                i: i,
                targetLayer: this.mainLayer,
                // todo: add province data from server(ajax)
                provinceData: {
                    id: id,
                    own: {},
                    count: 45,
                    logical: true,
                    villages: []
                }
            });

            id++;
            this.regions.push(region);
            //this.mapGroup.add(region);
            i++;
        }

        this.mainLayer.draw();
    },
    renderRoads: function() {
        for(var r = 1; r < roads.length;r++) {
            //console.log(regions.length);
            for(var i = 0; i < roads[r].length; i++) {
                var road = new Konva.Line({
                    points: [
                        castles[r][0],
                        castles[r][1],
                        castles[roads[r][i]][0],
                        castles[roads[r][i]][1],
                    ],
                    stroke: '#ead6a4', // c8b281
                    strokeWidth: 0.5,
                    lineCap: 'round',
                    lineJoin: 'round'
                });
                //road.moveToTop();
                this.mapGroup.add(road);
                road.moveToTop();
                //road.setZIndex(400);
            }
        }
    },
    renderCastles: function() {
        for(var i = 0; i < this.regions.length;i++) {
            this.regions[i].renderCastle();
        }
    },
    /*
    * EVENT LISTENERS
    * */
    mapWheelEventListener: function(e) {
        e.preventDefault();
        var oldScale = this.mainStage.scaleX();
        if((oldScale * this.scaleSteep > this.config.scaleSteepMax && e.deltaY <= 0) || (e.deltaY > 0 &&oldScale * this.scaleSteep < this.config.scaleSteepMin)) {
            return false;
        }
        var mousePointTo = {
            x: this.mainStage.getPointerPosition().x / oldScale - this.mainStage.x() / oldScale,
            y: this.mainStage.getPointerPosition().y / oldScale - this.mainStage.y() / oldScale,
        };
        var newScale = e.deltaY <= 0 ? oldScale * this.config.scaleSteep : oldScale / this.config.scaleSteep;

        this.mainStage.scale({ x: newScale, y: newScale });
        var newPos = {
            x: -(mousePointTo.x - this.mainStage.getPointerPosition().x / newScale) * newScale,
            y: -(mousePointTo.y - this.mainStage.getPointerPosition().y / newScale) * newScale
        };
        this.mainStage.position(newPos);
        this.mainStage.batchDraw();
    },
    /*
    *
    * */
    serverCheck: function () {
        /* not working -> see render.js */
        $.ajax({
            url: "/server/check",
            type: "POST",
            //data: {
            //    "id":id
            //},
            cache: false,
            timeout: 30000,
            async: true,
            success: function(result) {
                console.log('success',result);
                //$("#response").html(result);
                //setTimeout('getmess()',10000);
            },
            done: function(result) {
                console.log('done',result);
            },
            error: function(result) {
                console.log('error',result);
            }
        });
    },
    findMousePos: function () {
        this.mainLayer.addEventListener("mousemove", this.mapMoveEventListener.bind(this));

    },
    // показывает метонахождение курсора
    mapMoveEventListener: function () {

        var mousePos = this.mainStage.getPointerPosition();
        var x = mousePos.x - this.mapGroup.attrs.x;
        var y = mousePos.y - this.mapGroup.attrs.y;

        var textData = 'x: ' + x + ', y: ' + y;
        //console.log(textData);

    }

};

map.loadConfig(config);
map.init();
map.findMousePos();
//map.serverCheck();
//console.log(map);



/*---------------------------------------------------------*/

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