<?php

App::uses('AppModel', 'Model');

class Conversation extends AppModel {
    public $hasMany = array(
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'conversation_id',
            'dependent' => true // Use 'dependent' if you want to delete associated messages when a conversation is deleted
        )
    );
    public $belongsTo = array(
        'User1' => array(
            'className' => 'User',
            'foreignKey' => 'user1'
        ),
        'User2' => array(
            'className' => 'User',
            'foreignKey' => 'user2'
        )
    );

}
