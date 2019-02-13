<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 6:14 PM
 */

namespace app\bootstrap;


use Elyurt\CompatriotProfile\Infrastructure\Persistence\ARCompatriotProfileRepository;
use Elyurt\CompatriotProfile\Domain\Repositories\CompatriotProfileRepository;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use yii\base\BootstrapInterface;

class ContainerBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;
        $container->setSingleton(LazyLoadingValueHolderFactory::class);
        $container->setSingleton(CompatriotProfileRepository::class, ARCompatriotProfileRepository::class);
    }
}