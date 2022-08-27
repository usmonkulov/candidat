<?php

namespace api\controllers\candidate;

use api\providers\MapDataProvider;
use candidate\entities\candidate\Candidate;
use candidate\forms\candidate\CandidateForm;
use candidate\forms\candidate\search\RequestAndTokenSearchForm;
use candidate\helpers\GenderHelper;
use candidate\readModels\candidate\RequestAndTokenReadRepository;
use candidate\repositories\candidate\CandidateRepository;
use candidate\services\candidate\CandidateService;
use candidate\status\CandidateStatus;
use Closure;
use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class CandidateController extends Controller
{
    private $service;
    private $requestAndTokenReadRepository;

    public function __construct($id, $module,
        CandidateService $service,
        RequestAndTokenReadRepository $requestAndTokenReadRepository,
        $config = []) {

        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->requestAndTokenReadRepository = $requestAndTokenReadRepository;

    }

    /**
     * @return array
     */
    public function actionLabel(): array
    {
        $label = new CandidateForm();
        return $label->attributeApiSendLabels();
    }

    /**
     * @return array|CandidateForm
     * @throws BadRequestHttpException
     */
    public function actionSend()
    {
        $form = new CandidateForm();
        $form->load(Yii::$app->request->bodyParams, '');

        if ($form->validate()) {
            try {
                $candidate = $this->service->create($form);
                Yii::$app->response->setStatusCode(201);
                return [
                    "message" => "Nomzodingiz yuborildi iltimos tekshirish kodingizni saqlab oling!",
                    'success' => true,
                    'request' => [
                        'label' => Yii::t("app","Ariza raqami:"),
                        'request_no' => $candidate->request_no,
                    ],
                    'token' => [
                        'label' => Yii::t("app","Holatni tekshirish kodi:"),
                        'token_code' => $candidate->token,
                    ],
                ];
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage());
            }
        }
        return $form;
    }

    public function actionCheck()
    {
        $params = Yii::$app->request->bodyParams;
        $searchForm = new RequestAndTokenSearchForm();

        $searchForm->load($params,'');

        if ($searchForm->validate()) {
            return new MapDataProvider(
                $this->requestAndTokenReadRepository->search($searchForm),
                $this->serializeCheckItem()
            );
        }

        return $searchForm;
    }

    /**
     * @return array[]
     */
    public function actionCount(): array
    {
        return [
            'new' => [
                'count' => CandidateRepository::getCount(CandidateStatus::STATUS_NEW),
                'label' => CandidateStatus::getLabel(CandidateStatus::STATUS_NEW),
            ],
            'interview_scheduled' => [
                'count' => CandidateRepository::getCount(CandidateStatus::STATUS_INTERVIEW_SCHEDULED),
                'label' => CandidateStatus::getLabel(CandidateStatus::STATUS_INTERVIEW_SCHEDULED),
            ],
            'accepted' => [
                'count' => CandidateRepository::getCount(CandidateStatus::STATUS_ACCEPTED),
                'label' => CandidateStatus::getLabel(CandidateStatus::STATUS_ACCEPTED),
            ],
            'not_accepted' => [
                'count' => CandidateRepository::getCount(CandidateStatus::STATUS_NOT_ACCEPTED),
                'label' => CandidateStatus::getLabel(CandidateStatus::STATUS_NOT_ACCEPTED),
            ]
        ];
    }

    /**
     * @return Closure
     */
    public function serializeCheckItem(): Closure
    {
        return function (Candidate $candidate) {
            return [
                'id' => [
                    'label' => $candidate->getAttributeLabel('id'),
                    'value' => $candidate->id,
                ],
                'first_name' => [
                    'label' => $candidate->getAttributeLabel('first_name'),
                    'value' => $candidate->first_name,
                ],
                'last_name' => [
                    'label' => $candidate->getAttributeLabel('last_name'),
                    'value' => $candidate->last_name,
                ],
                'middle_name' => [
                    'label' => $candidate->getAttributeLabel('middle_name'),
                    'value' => $candidate->middle_name,
                ],
                'address' => [
                    'label' => $candidate->getAttributeLabel('address'),
                    'value' => $candidate->address,
                ],
                'country_origin' => [
                    'label' => $candidate->getAttributeLabel('country_origin'),
                    'value' => $candidate->country_origin,
                ],
                'email' => [
                    'label' => $candidate->getAttributeLabel('email'),
                    'value' => $candidate->email,
                ],
                'phone' => [
                    'label' => $candidate->getAttributeLabel('phone'),
                    'value' => $candidate->phone,
                ],
                'ago' => [
                    'label' => Yii::t("app","Yoshi"),
                    'value' => $candidate->ago,
                ],
                'hired' => [
                    'label' => $candidate->getAttributeLabel('hired'),
                    "value" => $candidate->hired == true ? Yii::t("app","Ha") : Yii::t("app","Yoq"),
                ],
                'gender' => [
                    "label" => $candidate->getAttributeLabel('gender'),
                    'value' => GenderHelper::getLabel($candidate->gender),
                ],
                'status' => [
                    'label' => $candidate->getAttributeLabel('status'),
                    "value" => CandidateStatus::getLabel($candidate->status),
                ]
            ];
        };
    }
}