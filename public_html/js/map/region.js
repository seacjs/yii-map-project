"use strict";

let Region = function(map, options) {
    //console.log(map.mainLayer);
    this.map = map;
    this.targetLayer = map.mainLayer;
    this.castle = {};
    this.castleName = 0;
    this.region = {};
    this.options = {
        x: 0,
        y: 0,
        data: false,
        // todo:: fill what color own
        //fill: playerColors[helper.randomInt(0, playerColors.length - 1)],
        fill: '#A1CDE8', //'#7ca245', // ead6a4
        stroke: '#3b6f81',//'white',
        strokeWidth: 0, //0.2,
        opacity: 1,
        provinceOwner: false,
        provinceVillages: false,
        provinceData: {
            id: false,
            //id: i + 1,
            own: {},
            count: 45,
            logical: true,
            villages: []
        },
        lineCap: 'round',
        lineJoin: 'round',
        scale: {
            x : 1,
            y : 1
        }
    };
    this.loadOptions = function(options) {
        for(let element in this.options) {
            this.options[element] = options[element] ? options[element] : this.options[element];
        }
    };
    this.init = function (options, map) {
        this.loadOptions(options);
        var colorShield = colorsNew[helper.randomInt(0, colorsNew.length-1)];
        this.options.fill = colorShield;
        this.region = new Konva.Path(this.options);
        this.map.mapGroup.add(this.region);
        this.renderCastle();
        this.region.on('click', this.onMouseclick.bind(this.region, map));
        this.region.on('mouseover', this.onMouseover.bind(this.region, map));
        this.region.on('mouseout', this.onMouseout.bind(this.region, map));
    };
    this.renderCastle = function(colorShield) {

        //var colorShield = colorsNew[helper.randomInt(0, colorsNew.length-1)];

        this.region.attrs.castle = new Konva.Path({
            x: castles[this.options.provinceData.id][0],// - 5,
            y: castles[this.options.provinceData.id][1],// - 6,
            //data: castleIcons[helper.randomInt(0,castleIcons.length-1)],
            data: castleIconsShield[helper.randomInt(0,castleIconsShield.length-1)],
            //fill: colorsNew[helper.randomInt(0,colorsNew.length-1)] , //'blue',
            //stroke: '#1b2934',
            fill: '#ffffff',
            stroke: colorShield,
            strokeWidth: 40,
            shadowColor: colorShield, //'black',
            shadowBlur: 4 * 20,
            shadowOffset: {x : 0, y : 4 * 20},
            shadowOpacity: 0.25,
            //draggable: true,
            scale: {
                x : 0.02,
                y : 0.02
            }
        });

        // to Add Clip need
        // 1.create a Group Region
        // 2.create a Group Shield - add to region
        // 3.Group Shield set clip...

        this.region.attrs.castle.on('click', this.onMouseclick.bind(this.region, map));

        this.region.attrs.castle.on('dragstart', this.onDragstart.bind(this));
        this.region.attrs.castle.on('dragend', this.onDragend.bind(this));

        this.region.attrs.castle.on('mouseover', this.onMouseover.bind(this.region, map));
        this.region.attrs.castle.on('mouseout', this.onMouseout.bind(this.region, map));

        this.region.attrs.castleName = new Konva.Text({
            x: castles[this.options.provinceData.id][0] - 5,
            y: castles[this.options.provinceData.id][1] + 3,
            text: this.options.provinceData.id,
            align: 'center',
            width: 10,
            fontSize: 5,
            fontFamily: 'Calibri',
            fill: 'green'
        });

        // this.map.mapGroup.add(this.region);

        this.map.mapGroup.add(this.region.attrs.castleName);
        this.map.mapGroup.add(this.region.attrs.castle);
        //this.region.attrs.castleName.moveToTop();
        this.region.attrs.castle.moveToTop();
        this.region.attrs.castle.setZIndex(400);

    },
    this.setOwner = function(owner) {
        this.options.provinceOwner = owner;
        this.targetLayer.batchDraw();
    };

    /*
     * EVENTS CASTLES
     * */
    this.onDragstart = function() {
        console.log('map', this.map);
        this.map.renderRoads();
        this.map.mainLayer.batchDraw();
    };
    this.onDragend= function() {
        //this.map.mainLayer.batchDraw();
    };

    /*
    * EVENTS REGIONS
    * */
    this.onMouseclick = function(map) {
        //console.log('provinceData.id:', this.attrs.provinceData.id);

        $.ajax({
            url: "/server/province",
            type: "GET",
            data: {
                "id": this.attrs.provinceData.id
            },
            dataType: 'html',
            cache: false,
            async: true,
            success: function(result) {
                $('#right-menu').html(result);
                console.log('success');
            },
            done: function(result) {
                $('#right-menu').html(result);
                console.log('done');
            },
            error: function(result) {
                $('#right-menu').html(result);
                console.log('error');
            }
        });

        $('#right-menu').addClass('animated');

        /*
        * this.refreshProvinceData()
        * this.openRegionWindow();
        * this.show...
        *
        * Сделать по аналогии с modalAjaxYii
        * потому что там не надо ничего отрисовывать и можно сделать все в html
        *
        * */

        //this.provinceVillages = false;
        //this.moveToTop();
        //for(var i = 0; i < this.attrs.roads[this.attrs.provinceData.id].length; i++) {
        //    this.attrs.roads[this.attrs.provinceData.id][i].moveToTop();
        //}
        //this.attrs.castleName.moveToTop();
        //this.attrs.castle.moveToTop();
        //this.stroke('rgba(76,189,255,1)');
        //map.mainLayer.batchDraw();


        // todo: comment for test ->remove
        //$('#right-menu').addClass('animated bounceInRight');
    };
    this.onMouseover = function(map) {
        //this.moveToTop();
        //for(var i = 0; i < this.attrs.roads[this.attrs.provinceData.id].length; i++) {
            //this.attrs.roads[this.attrs.provinceData.id][i].moveToTop();
        //}
        //this.attrs.castleName.moveToTop();
        //this.attrs.castle.moveToTop();
        this.opacity(1);
        //this.fill('#c8b281');

        //this.attrs.castle.attrs.stroke = 'white';
        this.attrs.strokeWidth = 1;
        this.attrs.strokeColor = '#c8b281';

        document.body.style.cursor = 'pointer';
        map.mainLayer.batchDraw();

    };
    this.onMouseout = function(map) {
        //this.stroke('white');
        //this.fill('#ead6a4');
        //for(var i = 0; i < this.attrs.roads[this.attrs.provinceData.id].length; i++) {
            //this.attrs.roads[this.attrs.provinceData.id][i].moveToTop();
        //}

        //this.attrs.castle.attrs.stroke = '#1b2934';
        this.attrs.strokeWidth = 0.5;

        this.opacity(1);
        this.attrs.castle.moveToTop();
        document.body.style.cursor = 'pointer';
        map.mainLayer.batchDraw();
    };

    this.init(options, map);
    return this;
    //return this.region;
};
