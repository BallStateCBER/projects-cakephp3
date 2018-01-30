<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = [
        'DataCenter.Flash',
        'DataCenter.TagManager'
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('DataCenter.Flash');
        $this->loadComponent(
            'Auth',
            [
                'loginAction' => [
                    'prefix' => false,
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                'logoutRedirect' => [
                    'prefix' => false,
                    'controller' => 'Releases',
                    'action' => 'index'
                ],
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        'passwordHasher' => [
                            'className' => 'Fallback',
                            'hashers' => [
                                'Default',
                                'Weak' => ['hashType' => 'sha1']
                            ]
                        ]
                    ],
                    'Cookie' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ]
                    ]
                ],
                'authError' => 'You are not authorized to view this page',
                'authorize' => 'Controller'
            ]
        );

        if ($this->request->getParam('action') != 'autoComplete') {
            if ($this->request->getParam('action') != 'autoComplete') {
                $this->set([
                    'authUser' => $this->Auth->user('id') ? $this->Users->get($this->Auth->user('id')): null
                ]);
            }
        }

        if (php_sapi_name() != 'cli') {
            $this->loadComponent('Security', [
                'blackHoleCallback' => 'forceSSL',
                'validatePost' => false
            ]);
        }

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * beforeFilter event
     *
     * @param Event $event Event object
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        if (php_sapi_name() != 'cli') {
            $this->Security->requireSecure();
        }

        if (!$this->Auth->user() && $this->request->getCookie('CookieAuth')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
            } else {
                $this->response = $this->response->withExpiredCookie('CookieAuth');
            }
        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        // Note: These defaults are just to get started quickly with development
        // and should not be used in production. You should instead set "_serialize"
        // in each action as required.
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
