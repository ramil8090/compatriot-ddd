<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 21.01.19
 * Time: 17:04
 */

namespace app\events\handles;

class UserNotification
{
    public static function handleNewUser(\app\events\UserEvent $userEvent)
    {
        $email = $userEvent->user->email;
        $subject = \Yii::t('app', 'Success registration');
        $body = <<<EOF
Please visit http://elyurt.uz/cabinet to view your profile.
EOF;
        self::emailNotify($email, $subject, $body);

    }

    protected static function emailNotify($email, $subject, $body)
    {
        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->params['adminName']])
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();
    }

}