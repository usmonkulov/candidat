<?php

namespace backend\controllers;

use candidate\forms\candidate\CandidateForm;
use candidate\forms\candidate\NoteForm;
use candidate\forms\candidate\search\CandidateSearchForm;
use candidate\forms\candidate\search\NoteSearchForm;
use candidate\readModels\candidate\CandidateReadRepository;
use candidate\readModels\candidate\NoteReadRepository;
use candidate\repositories\candidate\CandidateRepository;
use candidate\services\candidate\CandidateService;
use candidate\status\CandidateStatus;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CandidateController implements the CRUD actions for Candidate model.
 */
class CandidateController extends Controller
{
    private $candidateService;
    private $candidateRead;
    private $candidate;
    private $noteRead;

    public function __construct($id, $module,
        CandidateService $candidateService,
        CandidateReadRepository $candidateRead,
        CandidateRepository $candidate,
        NoteReadRepository $noteRead, $config = []) {

        parent::__construct($id, $module, $config);
        $this->candidateService = $candidateService;
        $this->candidateRead = $candidateRead;
        $this->candidate = $candidate;
        $this->noteRead = $noteRead;
    }

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST']
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $queryParams = Yii::$app->request->queryParams;
        $searchForm = new CandidateSearchForm();

        $searchForm->load($queryParams);
        $dataProvider = $this->candidateRead->search($searchForm);

        return $this->render('index', [
            'searchForm' => $searchForm,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        $candidate = $this->candidate->get($id);
        if (empty($candidate->is_deleted == 1))
            throw new NotFoundHttpException('The requested page does not exist.');

        return $this->render('view', [
            'model' => $candidate
        ]);
    }


    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $form = new CandidateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $model = $this->candidateService->create($form);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Nomzod saqlandi'));
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'form' => $form,
            'model' => null,
        ]);
    }


    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->candidate->get($id);
        if (empty($model->is_deleted == 1))
            throw new NotFoundHttpException('The requested page does not exist.');

        $form = new CandidateForm($model);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->candidateService->edit($model->id, $form);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Nomzod yangilandi').' (id: '.$model->id.')');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'form' => $form,
            'model' => $model,
        ]);
    }


    /**
     * @param $id
     * @param $status
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionActivate($id, $status): Response
    {
        $model = $this->candidate->get($id);
        if (empty($model->is_deleted == 1))
            throw new NotFoundHttpException('The requested page does not exist.');
        try {
            $this->candidateService->activate($model->id);
            if($model->status < 4){
                $candidateStatus = CandidateStatus::getLabel($model->status + 1);
            } else {
                $candidateStatus = CandidateStatus::getLabel(CandidateStatus::STATUS_NEW);
            }
            Yii::$app->session->setFlash('success', $candidateStatus .' (id: '.$model->id.')');
            if($status == 'index'){
                return $this->redirect('index');
            } elseif ($status == 'view') {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }


    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $model = $this->candidate->get($id);
        if (empty($model->is_deleted == 1))
            throw new NotFoundHttpException('The requested page does not exist.');
        try {
            $this->candidateService->isDeleted($model->id);
            Yii::$app->session->setFlash('success', Yii::t('app', 'Nomzod o\'chirildi') . ' (id: '.$model->id.')');
            return $this->redirect('index');
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }
}