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

        // allow everything
        $this->Auth->allow();

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

        $this->loadModel('Authors');
        $this->loadModel('AuthorsReleases');
        $this->loadModel('Graphics');
        $this->loadModel('Partners');
        $this->loadModel('Releases');
        $this->loadModel('ReleasesTags');
        $this->loadModel('Tags');
        $this->loadModel('Users');
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
        
        $tags = $this->Tags->find()
            ->select(['id', 'name', 'slug'])
            ->contain(['Releases'])
            ->order(['name' => 'ASC'])
            ->toArray();
        $tagsSimple = [];
        foreach ($tags as $result) {
            if (!empty($result['releases'])) {
                $tagsSimple[] = $result;
            }
        }

        $releases = $this->Releases->find()
            ->select('released')
            ->order(['released' => 'DESC'])
            ->toArray();
        $years = [];
        foreach ($releases as $release) {
            $date = $release->released;
            $year = date('Y', strtotime($date));
            if (!in_array($year, $years)) {
                $years[] = $year;
            }
        }

        $partners = $this->Partners->find()
            ->contain(['Releases'])
            ->order(['name' => 'ASC'])
            ->toArray();
        foreach ($partners as $k => $partner) {
            if (empty($partner['releases'])) {
                unset($partners[$k]);
            }
        }

        $this->set([
            'sidebarVars' => [
                'partners' => $partners,
                'tags' => $tagsSimple,
                'years' => $years
            ]
        ]);
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
