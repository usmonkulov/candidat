<?php

namespace candidate\useCases\auth;

use candidate\access\Rbac;
use candidate\dispatchers\EventDispatcher;
use candidate\entities\user\User;
use candidate\forms\auth\SignupForm;
use candidate\repositories\UserRepository;
use candidate\services\RoleManager;
use candidate\services\TransactionManager;
use Yii;
use yii\mail\MailerInterface;

class SignupService
{
    private $mailer;
    private $users;
    private $roles;
    private $transaction;

    public function __construct(
        MailerInterface $mailer,
        UserRepository $users,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->mailer = $mailer;
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->phone,
            $form->password
        );
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
            $sent = $this->mailer
                ->compose(
                    ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                    ['user' => $user]
                )
                ->setTo($user->email)
                ->setSubject( Yii::t('app',"Ro'yxatdan o'tish uchun emailga hovola yuborildi") . Yii::$app->name)
                ->send();

            if (!$sent) {
                throw new \RuntimeException(Yii::t('app','Yuborish xatosi.'));
            }
        });
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException(Yii::t("app","Tasdiqlash belgisi bo'sh."));
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }
}