<?php

namespace Adnduweb\Ci4Front\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Psr\Log\LoggerInterface;
use \Adnduweb\Ci4Front\Libraries\Theme;

abstract class BaseFrontController extends \CodeIgniter\Controller
{

    /**
     * @var back
     */
    protected $isFront = false;

    /**
     * @var helpers
     */

    /**
     * @var helpers
     */
    protected $helpers = ['detect', 'url', 'form', 'lang'];

    /**
     * Set default directory
     */
    protected $directory = ''; // Set default directory

    /**
     *  Set default yield view
     */
    protected $view = null; // Set default yield view

    /**
     * Refactored class-wide data array variable
     * 
     * @var array
     */
    protected $viewData = [];

    /**
     *  Service UUID
     */
    protected $uuid;

    /**
     *  Id ressource 
     */
    protected $id;

    /**
     * @var Authorize
     */
    protected $authorize;
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Db
     */
    protected $db;

    /**
     * @var Pager
     */
    protected $pager;

    public $locale;

    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * @var \CodeIgniter\Services\encrypter
     */
    protected $encrypter;

    /**
     * @var \Config\Services::validation();
     */
    protected $validation;

    /**
     * @array array ;
     */
    protected $rules;

    /**
     * Silent
     */
    public $silent = true;



    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        $this->session   = service('session');
        $this->encrypter = service('encrypter');
        $this->uuid      = service('uuid');

        //Check language
        $this->langue = service('LanguageOverride');
        setlocale(LC_TIME, service('request')->getLocale() . '_' .  service('request')->getLocale());

        //--------------------------------------------------------------------
        // Check for flashdata
        //--------------------------------------------------------------------
        $this->viewData['confirm'] = $this->session->getFlashdata('confirm');
        $this->viewData['errors']  = $this->session->getFlashdata('errors');
        $this->viewData['html']    = detectBrowser(true);

        $this->settings   = service('settings');
        $this->validation = service('validation');
        $this->db         = Database::connect();
       // $this->tableModel = (!is_null($this->tableModel)) ? new $this->tableModel : null;

        // Display theme information
        $this->viewData['theme_front'] = $this->settings->setting_theme_admin;
        $this->viewData['metatitle']   = $this->controller;

    }

    protected function _render(string $view, array $data = [])
    {
        return view($view, $data);
    }


    // try to cache a setting and pass it back
    protected function cache($key, $content)
    {
        if ($content === null) {
            return cache()->delete($key);
        }

        if ($duration = env('cache.cacheDuration')) {
            cache()->save($key, $content, $duration);
        }
        return $content;
    }

    protected function redirect(string $url)
    {
        return service('response')->redirect($url);
    }

    protected function goHome()
    {
        return $this->redirect(route_to('home'));
    }



    /**
     * 
     * --------------------------------------------------------------------------
     * CRUD
     * --------------------------------------------------------------------------
     */

    /**
     * Display view only
     *
     */
    public function index()
    {
    }





    /**
     * Store a newly created resource in storage in ajax.
     *
     */
    public function storeAjax($params = null)
    {
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $id)
    {
    }

    /**
     *
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
    }


    public function edit(string $id)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove($id)
    {

    }

    protected function getToolbar()
    {

        $this->viewData['controller'] = lang('Core.' . $this->controller);
        $this->viewData['addPathController'] = $this->pathcontroller . '/create';
        $this->viewData['toolbarBack'] = $this->toolbarBack;
        $this->viewData['fakedata'] = $this->fakeData;
        $this->viewData['toolbarUpdate'] = $this->toolbarUpdate;
        $this->viewData['toolbarExport'] = $this->toolbarExport;
        $this->viewData['changeCategorie'] = $this->changeCategorie;
        $this->viewData['backPathController'] = $this->pathcontroller . '/' . $this->controller;
        $this->viewData['multilangue'] = (isset($this->multilangue)) ? $this->multilangue : false;
    }

    /**
	 * Handles failures.
	 *
	 * @param int $code
	 * @param string $message
	 * @param boolean|null $isAjax
	 *
	 * @return ResponseInterface|RedirectResponse
	 */
	protected function failure(int $code, string $message, bool $isAjax = null): ResponseInterface
	{
		log_message('debug', $message);

		if ($isAjax ?? $this->request->isAJAX())
		{
			return $this->response
				->setStatusCode($code)
				->setJSON(['error' => $message]);
		}

		return redirect()->back()->with('error', $message);
	}
}
