<?php

namespace candidate\forms\candidate\traits;

use candidate\entities\candidate\Candidate;

trait CandidateTrait
{
    public $id;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $address;
    public $country_origin;
    public $email;
    public $phone;
    public $birthday;
    public $ago;
    public $hired;
    public $gender;
    public $status;
    public $is_deleted;
    public $request_no;
    public $token;
    public $created_by;
    public $updated_by;
    public $created_at;
    public $updated_at;

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        $label = new Candidate();
        return $label->attributeLabels();
    }

    /**
     * @return array
     */
    public function attributeApiSendLabels(): array
    {
        $label = new Candidate();
        return [
            'first_name'        => $label->getAttributeLabel('first_name'),
            'last_name'         => $label->getAttributeLabel('last_name'),
            'middle_name'       => $label->getAttributeLabel('middle_name'),
            'birthday'          => $label->getAttributeLabel('birthday'),
            'gender'            => $label->getAttributeLabel('gender'),
            'phone'             => $label->getAttributeLabel('phone'),
            'email'             => $label->getAttributeLabel('email'),
            'country_origin'    => $label->getAttributeLabel('country_origin'),
            'address'           => $label->getAttributeLabel('address'),
        ];
    }

}