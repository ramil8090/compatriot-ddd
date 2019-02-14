<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/12/19
 * Time: 10:41 PM
 */

namespace Elyurt\Common;


interface AggregateRoot
{
    /**
     * @return array
     */
    public function releaseEvents(): array;
}