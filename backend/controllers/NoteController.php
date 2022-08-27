<?php


namespace backend\controllers;

use candidate\forms\candidate\NoteForm;
use candidate\repositories\candidate\CandidateRepository;
use candidate\repositories\candidate\NoteRepository;
use candidate\services\candidate\NoteService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class NoteController extends Controller
{
    private $noteService;
    private $note;
    private $candidate;

    public function __construct($id, $module,
        NoteService $noteService,
        NoteRepository $note,
        CandidateRepository $candidate,$config = []) {

        parent::__construct($id, $module, $config);
        $this->noteService = $noteService;
        $this->note = $note;
        $this->candidate = $candidate;
    }

    /**
     * @param $id
     * @return string|Response
     */
    public function actionCreate($id)
    {
        $candidate = $this->candidate->get($id);
        $form = new NoteForm([
            'candidate_id' => $candidate->id,
        ]);
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax){
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                try {
                    $model = $this->noteService->create($form);
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Intervyu vaqti saqlandi'));
                    return $this->redirect(['candidate/view', 'id' => $model->candidate_id]);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }
            return $this->renderAjax('_form', [
                'form' => $form,
                'model' => null,
            ]);
        }
        return $this->render('create', [
            'form' => $form,
            'model' => null,
        ]);
    }

    public function actionUpdate($candidate_id)
    {
        $model = $this->note->get($candidate_id);

        $form = new NoteForm($model);
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax) {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                try {
                    $this->noteService->edit($model->candidate_id, $form);
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Intervyu vaqti tahrirlandi') . ' (id: ' . $model->candidate_id . ')');
                    return $this->redirect(['candidate/view', 'id' => $model->candidate_id]);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }
            return $this->renderAjax('_form', [
                'form' => $form,
                'model' => null,
            ]);
        }
        return $this->render('update', [
            'form' => $form,
            'model' => $model,
        ]);
    }

}