<?php
class Index extends Controller {


    public $error = array();
    public $items;

    public function __construct()
    {
        parent::__construct();


    }
    public function route()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')$this->add();
        elseif(!empty($_GET['sort']))$this->sort();
        elseif(!empty($_GET['page']))$this->pagination();
        else $this->index();
    }

    public function index()
    {

        $this->items = $this->model->find1();
        $this->view->items =  $this->items;
        if($this-> pagination()) $this->view->render('Index');
    }

    public function add()
    {
       $user_name=$this->validate($_POST['user_name']);
       if(!$this->validName($user_name)) $this->error[] = "Введите коректное имя(латиница и /или цифры";

       $user_email = $this->validate($_POST['user_email']);
       if(!$this->validEmail($user_email))$this->error[]= "Введите коректный email";

       $user_page = $this->validUrl($this->validate($_POST['user_page']));

       if(!$user_text= $this->validate($_POST['user_text']))$this->error[]= "Введите текст";

       $user_ip = $this->getIp();

       $user_browser = $this->getBrowser();

       if(!$this->kaptcha($_POST['kaptcha']))$this->error[]= "Введите корректную капчу";

       $this->view->error = $this->error;

       if($this->error && !$this-> pagination()) $this->view->render('Index');
       else  $this->model->add($user_name,$user_email,$user_text,$user_page,$user_ip,$user_browser);  header('Location: ' . PATH);exit;

    }

    public function sort()
    {
        $sort=$_GET['sort'];
        $this->items = $this->model->sort($sort);


        $this->view->items =  $this->items;
        $this->view->render('Index');
      //  header('Location: ' . PATH);exit;
    }

   public function validate($value)
   {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    public function kaptcha($val)
    {

        if(Session::get('rand_code')=== $val) return true;

    }


     public function validEmail($val)
     {

    if (filter_var($val, FILTER_VALIDATE_EMAIL) || $val='') return true;

     }

     public function validName($val)
     {

    if(ctype_alnum($val) && $val) return true;

     }

    public function validUrl($val)
    {

        if (filter_var($val, FILTER_VALIDATE_URL)) return true;

    }

    public function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function getBrowser()
    {

        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
        elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
        elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
        elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
        elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
        else $browser = "Неизвестный";

        return $browser;

    }

    public function pagination()
    {
        $item_page=2;
        $count = $this->model->count();
        $quantity_page=$count/$item_page;
        if(is_float($quantity_page)) $quantity_page=intval($quantity_page)+1;

        $page_count = $count%$item_page; //одинаковое количество записей на странице

        if($_GET['page'] == 11)$start = false;
        else $start = ($_GET['page']*$item_page);

        if($count > $item_page){
        $this->items = $this->model->pagin($start,$item_page);
        $this->view->pagin =  $quantity_page;
        $this->view->items =  $this->items;
        $this->view->render('Index');
        } else {
        return true;
        }


    }

}