<?php

namespace cabinet\controllers\auth;

use pm\forms\auth\OneIdAuthForm;
use Yii;
use pm\services\auth\OneIdAuthService;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

/**
 * @OA\Schema(
 *     schema="OneIdAuthForm",
 *     type="object",
 *     required={"code", "state"},
 *     @OA\Property(
 *         property="code",
 *         type="string"
 *     )
 * )
 */
class OneIdController extends Controller
{
    private $oneIdAuthService;

    public function __construct(
        $id,
        $module,
        OneIdAuthService $oneIdAuthService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->oneIdAuthService = $oneIdAuthService;
    }

    protected function verbs(): array
    {
        return [
            'get-auth-url' => ['GET'],
            'auth' => ['POST']
        ];
    }

    /**
     * @OA\Get(
     *      path="/auth/one-id/get-auth-url",
     *      tags={"Auth"},
     *      summary="Get OneID auth url",
     *      @OA\Response (
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="auth_url", type="string",)
     *          )
     *      )
     * )
     */
    public function actionGetAuthUrl(): array
    {
        return [
            'auth_url' => $this->oneIdAuthService->generateAuthUrl(),
        ];
    }

    /**
     * @OA\Post(
     *      path="/auth/one-id/auth",
     *      tags={"Auth"},
     *      summary="Auth by OneID",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/OneIdAuthForm")
     *         )
     *      ),
     *      @OA\Response (
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="access_token", type="string",),
     *              @OA\Property(property="refresh_token", type="string",)
     *          )
     *      )
     * )
     */
    public function actionAuth()
    {
        $form = new OneIdAuthForm();
        $form->load(Yii::$app->request->getBodyParams(), '');

        if ($form->validate()) {
            try {
                $tokenData = $this->oneIdAuthService->auth($form);
                return [
                    'access_token' => (string)$tokenData['access_token'],
                    'refresh_token' => (string)$tokenData['refresh_token'],
                ];
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), 0, $e);
            }
        }

        return $form;
    }
}