<?php

namespace frontend\controllers\cabinet;

use candidate\forms\candidate\search\CandidateSearchForm;
use candidate\readModels\candidate\CandidateReadRepository;
use candidate\repositories\candidate\CandidateRepository;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CandidateController implements the CRUD actions for Candidate model.
 */
class CandidateController extends Controller
{
    private $candidateRead;
    private $candidate;

    public function __construct($id, $module,
        CandidateReadRepository $candidateRead,
        CandidateRepository $candidate, $config = []) {

        parent::__construct($id, $module, $config);
        $this->candidateRead = $candidateRead;
        $this->candidate = $candidate;
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $queryParams = Yii::$app->request->queryParams;
        $searchForm = new CandidateSearchForm();

        $searchForm->load($queryParams);
        $dataProvider = $this->candidateRead->search($searchForm, Yii::$app->user->id);

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
}