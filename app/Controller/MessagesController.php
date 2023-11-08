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
class MessagesController extends AppController
{
    public function new_message()
    {   
        
    }

    public function message_list()
    {
        $this->loadModel('User');
        $this->loadModel('Conversation');
        $this->loadModel('Message');

        $currentUserId = $this->Auth->user('id');

        $conversations = $this->Conversation->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'Conversation.user1' => $currentUserId,
                    'Conversation.user2' => $currentUserId
                )
            ),
            'contain' => array(
                'Message' => array(
                    'fields' => array('message_text', 'created','sender_id',),
                    'order' => 'Message.id DESC'
                ),
                'User1' => array('fields' => array('name', 'profile_img')),
                'User2' => array('fields' => array('name', 'profile_img'))
            ),
            'order' => 'Conversation.id DESC',
            'limit' => 10
        ));
        $hasMore = count($conversations) >= 10;
        $this->set('conversations', $conversations);
        $this->set('hasMore', $hasMore);
        $this->set('currentUserId', $currentUserId);
    }

    public function show_more()
    {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel('User');
        $this->loadModel('Message');
        $this->loadModel('Conversation');

        if ($this->request->is('ajax')) {
            $currentUserId = $this->Auth->user('id');
            $offset = $this->request->data['offset'];
            $limit = $this->request->data['limit'];

            $conversations = $this->Conversation->find('all', [
                'conditions' => [
                    'OR' => [
                        'Conversation.user1' => $currentUserId,
                        'Conversation.user2' => $currentUserId
                    ]
                ],
                'contain' => [
                    'Message' => [
                        'fields' => ['message_text', 'created', 'sender_id'],
                        'order' => 'Message.created DESC',
                        'limit' => 1
                    ],
                    'User1' => ['fields' => ['name', 'profile_img']],
                    'User2' => ['fields' => ['name', 'profile_img']]
                ],
                'order' => 'Conversation.id DESC',
                'limit' => $limit,
                'offset' => $offset
            ]);

            $this->response->type('json');
            echo json_encode(['conversations' => $conversations]);
        }
    }

    public function reply_page()
    {
        $this->loadModel('Conversation');
        $this->loadModel('Message');
        $conversation_id = $this->request->query('conversation_id');
        $currentUserId = $this->Auth->User('id');
        $offset = $this->request->query('offset');

        $conversation = $this->Message->find('all', array(
            'fields' => array(
                'DISTINCT message.id',
                'conversation.*',
                'message.*',
                'sender.*',
                'receiver.*'
            ),
            'joins' => array(
                array(
                    'table' => 'conversations',
                    'alias' => 'conversationss',
                    'type' => 'INNER',
                    'conditions' => array(
                        'message.conversation_id = conversation.id'
                    )
                ),
                array(
                    'table' => 'users',
                    'alias' => 'sender',
                    'type' => 'INNER',
                    'conditions' => array(
                        'sender.id = message.sender_id'
                    )
                ),
                array(
                    'table' => 'users',
                    'alias' => 'receiver',
                    'type' => 'INNER',
                    'conditions' => array(
                        'receiver.id = message.receiver_id'
                    )
                )
            ),
            'conditions' => array(
                'message.conversation_id' => $conversation_id
            ),
            'order' => 'message.id DESC',
            'limit' => 10,
            'offset' => $offset
        ));
        $conversation = array_reverse($conversation);
        $hasMore = count($conversation) >= 10;
        $this->set(compact('conversation', 'currentUserId', 'hasMore'));
    }

    public function showConvo()
    {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel('Conversation');
        $this->loadModel('Message');
        $conversation_id = $this->request->query('conversation_id');
        $currentUserId = $this->Auth->User('id');
        $offset = $this->request->query('offset');
        $limit = $this->request->query('limit');

        $conversation = $this->Message->find('all', array(
            'fields' => array(
                'DISTINCT message.id',
                'conversation.*',
                'message.*',
                'sender.*',
                'receiver.*'
            ),
            'joins' => array(
                array(
                    'table' => 'conversations',
                    'alias' => 'conversationss',
                    'type' => 'INNER',
                    'conditions' => array(
                        'message.conversation_id = conversation.id'
                    )
                ),
                array(
                    'table' => 'users',
                    'alias' => 'sender',
                    'type' => 'INNER',
                    'conditions' => array(
                        'sender.id = message.sender_id'
                    )
                ),
                array(
                    'table' => 'users',
                    'alias' => 'receiver',
                    'type' => 'INNER',
                    'conditions' => array(
                        'receiver.id = message.receiver_id'
                    )
                )
            ),
            'conditions' => array(
                'message.conversation_id' => $conversation_id
            ),
            'order' => 'message.id DESC',
            'limit' => $limit,
            'offset' => $offset
        ));
        $conversation = array_reverse($conversation);

        $this->response->type('json');
        echo json_encode(['messages' => $conversation, 'currentUserId' => $currentUserId]);
    }

    public function reply()
    {
        $this->autoRender = false;
        $this->loadModel('Message');
        $this->loadModel('Conversation');
        
        if ($this->request->is('ajax')) {
            $data = $this->request->data;

            $existingConversation = $this->Conversation->find('first', [
                'conditions' => [
                    'OR' => [
                        [
                            'user1' => $data['sender_id'],
                            'user2' => $data['receiver_id'],
                        ],
                        [
                            'user1' => $data['receiver_id'],
                            'user2' => $data['sender_id'],
                        ],
                    ],
                ],
            ]);
            // Check if the conversation exists
            if ($existingConversation) {
                $conversationId = $existingConversation['Conversation']['id'];

                $this->Conversation->id = $conversationId;
                $this->Conversation->saveField('modified_ip', $_SERVER['REMOTE_ADDR']);
            } else {
                // Create a new conversation
                $newConversationData = [
                    'user1' => $data['sender_id'],
                    'user2' => $data['receiver_id'],
                ];
                $this->Conversation->create();
                if ($this->Conversation->save($newConversationData)) {
                    $conversationId = $this->Conversation->id;
                } else {
                    echo json_encode(['status' => 'error']);
                    exit;
                }
            }
        
            $this->loadModel('Message');
            $this->loadModel('User');
            $messageData = [
                'message_text' => $data['message_text'],
                'sender_id' => $data['sender_id'],
                'receiver_id' => $data['receiver_id'],
                'conversation_id' => $conversationId,
                'created_ip' => $_SERVER['REMOTE_ADDR'],
            ];
        
            if ($this->Message->save($messageData)) {
                $newMessage = $this->Message->findById($this->Message->id);
                $sender = $this->User->findById($newMessage['Message']['sender_id']);
                $receiver = $this->User->findById($newMessage['Message']['receiver_id']);
                echo json_encode([
                    'status' => 'success',
                    'message' => $newMessage,
                    'sender' => $sender,
                    'receiver' => $receiver
                ]);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }

    public function delete()
    {
        $this->autoRender = false;
        $this->layout = 'ajax';
        
        if ($this->request->is('ajax'))
        {
            $messageID = $this->request->data('messageID');
            
            $message = $this->Message->findById($messageID);
            $currentUserID = $this->Auth->user('id'); // Assuming you're using an authentication component

            if (!$message || $message['Message']['sender_id'] !== $currentUserID) {
                $response = array('success' => false);
            } else {
                if ($this->Message->delete($messageID, true)) {
                    $response = array('success' => true);
                } else {
                    $response = array('success' => false);
                }
            }

            $this->response->type('json');
            echo json_encode(['success' => $response]);
        }
    }

    public function deleteConvo()
    {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel('Conversation');
        if ($this->request->is('ajax'))
        {
            $conversation_id = $this->request->data('conversation_id');
            
            if ($this->Conversation->delete($conversation_id, true)) {
                $response = array('success' => true);
            } else {
                $response = array('success' => false);
            }

            $this->response->type('json');
            echo json_encode(['success' => $response]);
        }
    }

}
