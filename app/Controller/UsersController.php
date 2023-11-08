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
class UsersController extends AppController
{
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'add', 'register');
    }

    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->User->id = $this->Auth->user('id'); // Set the user's ID
                $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));
    
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Invalid email or password!', 'default', array('class' => 'alert alert-danger'));
            }
        }
    }
    
    public function register()
    {
        
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            
            if ($this->User->validates()) {
                if ($this->request->data['User']['password'] === $this->request->data['User']['password_confirmation']) {
                    $this->User->create();
                    if ($this->User->save($this->request->data, false)) {
                        $this->Session->setFlash('Registration successful!', 'default', array('class' => 'alert alert-success'));
                        $this->Auth->login();
                        $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));
                        $this->redirect(array('action' => 'ty'));
                    } else {
                        $this->Session->setFlash('Error saving user data.', 'default', array('class' => 'alert alert-danger'));
                    }
                } else {
                    $this->Session->setFlash('Passwords do not match.', 'default', array('class' => 'alert alert-danger'));
                }
            } else {
                // Set validation errors for display in the view
                $this->set('validationErrors', $this->User->validationErrors);
            }
        }
    }

    public function profile()
    {
        $id = $this->Auth->user('id');

        $userData = $this->User->findById($id);
        $this->set('userData', $userData);
    }

    public function ty()
    {

    }

    public function edit()
    {
        $id = $this->Auth->user('id');

        $userData = $this->User->findById($id);
        $this->set('userData', $userData);
    }

    public function update_profile()
    {
        $id = $this->Auth->user('id');

        $userData = $this->User->findById($id);

        if ($this->request->is('post'))
        {
            if (!empty($this->request->data['User']['profile_img']['name'])) {
                $tmpFile = $this->request->data['User']['profile_img']['tmp_name'];
                $targetDir = WWW_ROOT . 'img' . DS . 'user_images' . DS;
                $targetFile = $targetDir . $id . '_' . $this->request->data['User']['profile_img']['name'];

                if (move_uploaded_file($tmpFile, $targetFile)) {
                    $userData['User']['name'] = $this->request->data['User']['name'];
                    $userData['User']['birth'] = $this->request->data['User']['birth'];
                    $userData['User']['gender'] = $this->request->data['User']['gender'];
                    $userData['User']['hobby'] = $this->request->data['User']['hobby'];
                    $userData['User']['profile_img'] = $id . '_' . $this->request->data['User']['profile_img']['name'];

                    if ($this->User->save($userData, true, ['name', 'birth', 'gender', 'hobby', 'profile_img'])) {
                        $this->Session->setFlash('Profile updated successfully.', 'default', array('class' => 'alert alert-success'));
                        $userData = $this->User->findById($id);
                        $this->Session->write('Auth.User', $userData['User']);
                        $this->redirect(array('controller' => 'users', 'action' => 'profile'));
                    } else {
                        $this->Session->setFlash('Failed to update the profile.', 'default', array('class' => 'alert alert-danger'));
                    }
                } else {
                    $this->Session->setFlash('File upload failed.');
                }
            }
            else
            {
                // Update the fields you want
                $userData['User']['name'] = $this->request->data['User']['name'];
                $userData['User']['birth'] = $this->request->data['User']['birth'];
                $userData['User']['gender'] = $this->request->data['User']['gender'];
                $userData['User']['hobby'] = $this->request->data['User']['hobby'];

                if ($this->User->save($userData, true, ['name', 'birth', 'gender', 'hobby', 'profile_img'])) {
                    $this->Session->setFlash('Profile updated successfully.', 'default', array('class' => 'alert alert-success'));
                    $userData = $this->User->findById($id);
                    $this->Session->write('Auth.User', $userData['User']);
                    $this->redirect(array('controller' => 'users', 'action' => 'profile'));
                } else {
                    $this->Session->setFlash('Failed to update the profile.', 'default', array('class' => 'alert alert-danger'));
                }
            }
        }
        $this->set('userData', $userData);
        $this->render('edit');
    }

    public function edit_email()
    {
        $id = $this->Auth->user('id');
        $userData = $this->User->findById($id);
        $this->set('userData', $userData);
    }

    public function update_email()
    {
        $id = $this->Auth->user('id');
        $userData = $this->User->findById($id);

        if ($this->request->is('post')) {
            $this->User->set($this->request->data); // Set the user data from the form
            $userData['User']['email'] = $this->request->data['User']['email'];

            if ($this->User->validates(array('fieldList' => array('email')))) {
                $existingUser = $this->User->findByEmail($userData['User']['email']); // Check if the email already exists

                if ($existingUser && $existingUser['User']['id'] !== $id) {
                    $this->User->validationErrors['email'][] = 'This email is already in use.';
                } else {
                    if ($this->User->save($userData, true, ['email'])) {
                        $this->Session->setFlash('Email updated successfully.', 'default', array('class' => 'alert alert-success'));
                        $this->redirect(array('controller' => 'users', 'action' => 'profile'));
                    } else {
                        $this->Session->setFlash('Failed to update the email.', 'default', array('class' => 'alert alert-danger'));
                    }
                }
            } else {
                $this->Session->setFlash('Error Email exists.', 'default', array('class' => 'alert alert-danger'));
            }
        }

        $this->set('userData', $userData);
        $this->render('edit_email');
    }



    public function edit_pass()
    {
        $id = $this->Auth->user('id');
        $userData = $this->User->findById($id);
        $this->set('userData', $userData);
    }

    public function update_password()
    {
        $id = $this->Auth->user('id');

        $userData = $this->User->findById($id);

        if($this->request->is('post'))
        {
            $userData['User']['password'] = $this->request->data['User']['password'];
            if ($this->User->save($userData, true, ['password'])) {
                $this->Session->setFlash('Password updated successfully.', 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'users', 'action' => 'profile'));
            } else {
                $this->Session->setFlash('Failed to update the password.', 'default', array('class' => 'alert alert-danger'));
            }
        }

        $this->set('userData', $userData);
    }

    public function logout()
    {
        $this->Session->delete('Auth.User');

        $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

    public function search_user()
    {
        $this->autoRender = false; // Disable rendering the view
        $this->layout = 'ajax'; // Set the layout for the AJAX response

        if ($this->request->is('ajax')) {
            $term = $this->request->query('term'); // Get the search term from the request

            // Query the database to retrieve matching users
            $id = $this->Auth->user('id');

            $users = $this->User->find('all', array(
                'conditions' => array(
                    'User.name LIKE' => '%' . $term . '%',
                    'NOT' => array(
                        'User.id' => $id
                    )
                )
            ));

            $userSuggestions = array();
            $baseUrl = Router::url('/', true);

            foreach ($users as $user) {
                $imagePath = 'img/user_images/' . $user['User']['profile_img'];
                $imageURL = $baseUrl . $imagePath;
                $userSuggestions[] = array(
                    'id' => $user['User']['id'],
                    'text' => $user['User']['name'],
                    'image_url' => $imageURL
                );
            }

            $this->response->type('json');
            echo json_encode($userSuggestions);
        }
    }

}
