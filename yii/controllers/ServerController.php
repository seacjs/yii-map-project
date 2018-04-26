<?php

namespace app\controllers;

use app\models\Region;
use app\models\Village;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;

class ServerController extends Controller
{
    public function actionTest()
    {

        $villages = Village::find()->all();
        foreach($villages as $village) {
            $populationGrow =  + rand(0,1) + round($village->population / 100 * 5);
            $village->population = $village->population + $populationGrow;
            for($i = 1; $i <= $populationGrow; $i++) {
                $profession = \app\models\Village::randomProfession(rand(1,100));
                $village[$profession] = $village[$profession] + 1;
            }
            $village->save();
        }

        $scriptWork = 'Время: '. sprintf('%0.5f', Yii::getLogger()->getElapsedTime()) . ' | ' . round(memory_get_peak_usage()/(1024*1024),2) . 'MB';
        file_put_contents('PROVINCE.txt', $scriptWork);
    }

    public function actionCheck() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = [
            'changes' => 'check',
        ];

        for($i = 1; $i <= 7; $i++) {
            sleep(1);
            $result = [
                'changes' => 'in sleep, checking',
            ];
        }

        $result = [
            'changes' => 'no changes',
        ];

        //        (24 * 60 * 60 / 1000 * 0.2)


        if ( extension_loaded( "sockets" ) ) {
            $result[] =['sockets_loaded' => 'no'];
        } else {
            $result[] =['sockets_loaded' => 'no'];
        }

        if ( in_array( "sockets", get_loaded_extensions() ) ) {
           $result[] = ['sockets_is' => 'yes'];
        } else {
            $result[] =['sockets_is' => 'no'];
        }



        return json_encode($result, true);
    }
    public function actionInfo() {
        echo phpinfo();
        die();
    }

    public function actionProvince() {

        $this->layout = 'empty';

        $region = Region::find()
            ->andWhere([
                'id' => Yii::$app->request->get('id')
            ])
            ->with('villages')
            ->one();

        return $this->render('province',[
            'region' => $region,

        ]);
    }
    public function actionVillage() {

        $this->layout = 'empty';

        $test = rand(1,100);

        return $this->render('province',[
            'test' => $test
        ]);
    }
    public function actionCharacter() {

        $this->layout = 'empty';

        $test = rand(1,100);

        return $this->render('province',[
            'test' => $test
        ]);
    }
}
