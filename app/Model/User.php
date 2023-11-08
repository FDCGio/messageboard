<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

    public $validate = array(
        'name' => array(
            'maxLength' => array(
                'rule' => array('between', 5, 20),
                'message' => 'Name must be between 5 and 20 characters.'
            )
        ),
        'email' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Please enter a valid email address.',
                'required' => false
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This email address is already taken.',
                'required' => false
            )
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a password'
            )
        ),
        'password_confirmation' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter confirm password'
            )
        )
    );
    
    public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['password'])) {
            App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
        return true;
    }
}
