<?php

namespace api\controllers\auth;

use candidate\forms\auth\LoginForm;
use candidate\services\auth\JwtAuthService;
use candidate\services\auth\RefreshTokenForm;
use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class AuthController extends Controller
{
    private $jwtAuthService;

    public function __construct($id, $module, JwtAuthService $jwtAuthService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->jwtAuthService = $jwtAuthService;
    }

    public function verbs(): array
    {
        return [
            'login' => ['POST'],
        ];
    }

    public function actionLogin()
    {
        $form = new LoginForm();
        $form->load(Yii::$app->request->getBodyParams(), '');

        if ($form->validate()) {
            try {
                $tokenData = $this->jwtAuthService->auth($form);
                return [
                    'access_token' => (string)$tokenData['access_token'],
                    'refresh_token' => (string)$tokenData['refresh_token'],
                ];
            } catch (\DomainException $e) {
                \Yii::$app->errorHandler->logException($e);
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }

        return $form;
    }

    public function actionRefreshToken()
    {
        $form = new RefreshTokenForm();
        $form->load(\Yii::$app->request->getBodyParams(), '');

        if ($form->validate()) {
            try {
                $tokenData = $this->jwtAuthService->refreshToken($form);
                return [
                    'access_token' => (string)$tokenData['access_token'],
                    'refresh_token' => (string)$tokenData['refresh_token'],
                ];
            } catch (\DomainException $e) {
                \Yii::$app->errorHandler->logException($e);
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }

        return $form;
    }

}