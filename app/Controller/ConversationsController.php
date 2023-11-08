<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class ConversationsController extends AppController
{
    public function new_convo()
    {
        $this->autoRender = false;
        $this->loadModel('Conversation');
        $this->loadModel('Message');
        
        if ($this->request->is('ajax')) {
            $receiverId = $this->request->data['receiver_id'];
            $messageText = $this->request->data['message'];
            $senderId = $this->Auth->user('id');

            // Check if a conversation between sender and receiver already exists
            $existingConversation = $this->Conversation->find('first', [
                'conditions' => [
                    'OR' => [
                        [
                            'user1' => $senderId,
                            'user2' => $receiverId,
                        ],
                        [
                            'user1' => $receiverId,
                            'user2' => $senderId,
                        ],
                    ],
                ],
            ]);

            if ($existingConversation) {
                // Conversation exists, add a new message
                $conversationId = $existingConversation['Conversation']['id'];
            } else {
                // Create a new conversation
                $convoData = [
                    'user1' => $senderId,
                    'user2' => $receiverId,
                ];

                if ($this->Conversation->save($convoData)) {
                    $conversationId = $this->Conversation->getLastInsertID();
                } else {
                    $response = 'Failed to save conversation';
                    $this->response->body(json_encode(['status' => $response]));
                    $this->response->type('json');
                    return;
                }
            }

            // Add the new message
            $messageData = [
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'message_text' => $messageText,
                'conversation_id' => $conversationId,
                'created_ip' => $_SERVER['REMOTE_ADDR'],
            ];

            if ($this->Message->save($messageData)) {
                $response = 'Success';
            } else {
                $response = 'Failed to save message';
            }

            $this->response->body(json_encode(['status' => $response]));
            $this->response->type('json');
        }
    }

}
