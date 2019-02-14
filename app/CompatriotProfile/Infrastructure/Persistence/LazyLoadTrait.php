<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 5:19 PM
 */

namespace Elyurt\CompatriotProfile\Infrastructure\Persistence;



use ProxyManager\Factory\LazyLoadingValueHolderFactory;

trait LazyLoadTrait
{
    /**
     * @return object|LazyLoadingValueHolderFactory
     */
    protected static function getLazyFactory()
    {
        return \Yii::createObject(LazyLoadingValueHolderFactory::class);
    }
}