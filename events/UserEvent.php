<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 21.01.19
 * Time: 16:57
 */

namespace app\events;

use yii\base\Event;

class UserEvent extends Event
{
    const EVENT_NEW_USER = 'new-user';
}