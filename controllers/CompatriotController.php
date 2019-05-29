<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 2/13/19
 * Time: 10:28 PM
 */

namespace app\controllers;


use app\models\Awards;
use app\models\Person;
use Elyurt\CompatriotProfile\Application\Commands\ChangeAwardsCommand;
use Elyurt\CompatriotProfile\Application\Commands\CreateCompatriotProfileCommand;
use Elyurt\CompatriotProfile\Application\CompatriotProfileApplicationService;
use yii\base\Module;
use yii\web\Controller;

class CompatriotController extends Controller
{

    private $compatriotService;

    public function __construct(
        string $id,
        Module $module,
        CompatriotProfileApplicationService $compatriotService,
        array $config = [])
    {
        $this->compatriotService = $compatriotService;
        parent::__construct($id, $module, $config);
    }

    public function actionCreate()
    {
        $compatriotProfile = null;

        $person = new Person();
        $awards = new Awards();

        if (\Yii::$app->request->isPost) {
            $person->load(\Yii::$app->request->post());
            $awards->load(\Yii::$app->request->post());

            $compatriotProfile = $this->compatriotService->createCompatriotProfile(
                new CreateCompatriotProfileCommand(
                    $person->toArray(), 
                    $awards->toArray()
                )
            );
        }
        return $compatriotProfile;
    }

    public function actionUpdateAwards()
    {
        $compatriotProfile = null;

        $awards = new Awards();
        if (\Yii::$app->request->isPost) {
            $awards->load(\Yii::$app->request->post());

            $compatriotProfile = $this->compatriotService->changeAwards(
                new ChangeAwardsCommand(
                    $awards->toArray()
                )
            );
        }

        return $compatriotProfile;
    }
}
