<?php

namespace candidate\services\candidate;

use candidate\entities\candidate\Candidate;
use candidate\forms\candidate\CandidateForm;
use candidate\repositories\candidate\CandidateRepository;
use candidate\status\CandidateStatus;
use yii\db\StaleObjectException;
use function Symfony\Component\String\s;

class CandidateService
{
    private $candidate;

    public function __construct(
        CandidateRepository $candidate
    ){
        $this->candidate = $candidate;
    }



    public function create(CandidateForm $form): Candidate
    {
        $candidate = Candidate::create(
            $form->first_name,
            $form->last_name,
            $form->middle_name,
            $form->address,
            $form->country_origin,
            $form->email,
            $form->phone,
            $form->birthday,
            $form->hired,
            $form->gender,
            $form->status,
            $form->is_deleted
        );
        $this->candidate->save($candidate);
        return $candidate;
    }



    public function edit($id, CandidateForm $form)
    {
        $candidate = $this->candidate->get($id);
        $candidate->edit(
            $form->first_name,
            $form->last_name,
            $form->middle_name,
            $form->address,
            $form->country_origin,
            $form->email,
            $form->phone,
            $form->birthday,
            $form->hired,
            $form->gender,
            $form->status,
            $form->is_deleted
        );
        $this->candidate->save($candidate);
    }

    public function activate($id)
    {
        $candidate = $this->candidate->get($id);
        if (++$candidate->status > CandidateStatus::STATUS_NOT_ACCEPTED) $candidate->status = CandidateStatus::STATUS_NEW;
        $this->candidate->save($candidate);
    }

    /**
     * @param $id
     */
    public function isDeleted($id){
        $candidate = $this->candidate->get($id);
        $candidate->is_deleted = 0;
        $this->candidate->save($candidate);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function remove($id)
    {
        $candidate = $this->candidate->get($id);
        $this->candidate->remove($candidate);
    }
}