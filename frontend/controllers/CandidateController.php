<?php

namespace frontend\controllers;

use candidate\forms\candidate\CandidateForm;
use candidate\forms\candidate\search\RequestAndTokenSearchForm;
use candidate\readModels\candidate\RequestAndTokenReadRepository;
use candidate\services\candidate\CandidateService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * CandidateController implements the CRUD actions for Candidate model.
 */
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
     * @return string|Response
     */
    public function actionCreate()
    {
        $form = new CandidateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $model = $this->service->create($form);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Nomzodingiz yuborildi iltimos tekshirish kodingizni saqlab oling!') . '<br>Ariza raqami: ' . $model->request_no . '<br>Holatni tekshirish kodi: ' . $model->token);
                return $this->redirect(['site/index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'form' => $form,
        ]);
    }

    /**
     * @return string
     */
    public function actionCheck(): string
    {
        $queryParams = Yii::$app->request->queryParams;
        $searchForm = new RequestAndTokenSearchForm();
        $searchForm->load($queryParams);
        $dataProvider = $this->requestAndTokenReadRepository->search($searchForm);
        return $this->render('check', [
            'searchForm' => $searchForm,
            'dataProvider' => $dataProvider,
            'queryParams' => $queryParams
        ]);
    }
}