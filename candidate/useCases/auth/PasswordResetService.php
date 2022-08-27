<?php

namespace candidate\useCases\auth;

use candidate\forms\auth\PasswordResetRequestForm;
use candidate\forms\auth\ResetPasswordForm;
use candidate\repositories\UserRepository;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private $mailer;
    private $users;

    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->users->getByEmail($form->email);

        if (!$user->isActive()) {
            throw new \DomainException(Yii::t('app','Foydalanuvchi faol emas.'));
        }

        $user->requestPasswordReset();
        $this->users->save($user);

        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/reset/confirm-html', 'text' => 'auth/reset/confirm-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject(Yii::t('app',"uchun parolni tiklash") . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException(Yii::t('app','Yuborish xatosi.'));
        }
    }

    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException(Yii::t('app','Parolni tiklash tokeni boʻsh boʻlishi mumkin emas.'));
        }
        if (!$this->users->existsByPasswordResetToken($token)) {
            throw new \DomainException(Yii::t("app","Parolni tiklash belgisi noto‘g‘ri."));
        }
    }

    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->users->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }
}