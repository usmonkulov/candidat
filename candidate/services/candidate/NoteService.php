<?php

namespace candidate\services\candidate;

use candidate\entities\candidate\Note;
use candidate\forms\candidate\NoteForm;
use candidate\repositories\candidate\NoteRepository;

class NoteService
{
    private $note;

    /**
     * NoteService constructor.
     * @param NoteRepository $note
     */
    public function __construct(
        NoteRepository $note
    ){
        $this->note = $note;
    }

    /**
     * @param NoteForm $form
     * @return Note
     */
    public function create(NoteForm $form)
    {
        $note = Note::create(
            $form->candidate_id,
            $form->deadline,
            $form->description,
        );
        $this->note->save($note);
        return $note;
    }

    /**
     * @param $id
     * @param NoteForm $form
     */
    public function edit($id, NoteForm $form)
    {
        $note = $this->note->get($id);
        $note->edit(
            $form->candidate_id,
            $form->deadline,
            $form->description
        );
        $this->note->save($note);
    }
}