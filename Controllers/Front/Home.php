<?php namespace Adnduweb\Ci4Front\Controllers\Front;

Use Adnduweb\Ci4Admin\Models\UserModel;

class Home extends \Adnduweb\Ci4Front\Controllers\BaseFrontController
{
    /**
     * 
     */
    public $controller = 'home';

    public function __construct()
	{
		 $this->user = new UserModel();
    }
    

	public function index()
	{
        ///return view('welcome_message');
        return $this->_render('Adnduweb\Ci4Front\Views\front\themes\/'. $this->settings->setting_theme_front.'/\home', $this->viewData);
	}

    //--------------------------------------------------------------------
    
    public function test()
	{
		$data = $this->user->findAll();
		return json_encode($data);
    }
    
    // add function for list 
  public function list()
  {
    try {
      $datas = $this->user->findAll();
      foreach($datas as $d){
        $data[] = $d->toArray(false, true, true);
      }
     
      //print_r($data); exit;
      $response['data'] = $data;
      $response['success'] = true;
      $response['message'] = "Successful load";
      return json_encode($response);
    } catch (\Exception $e) {
      $response['success'] = false;
      $response['message'] = $e->getMessage();
      return json_encode($response);
    }
  }

}
