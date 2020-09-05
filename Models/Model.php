<?php
class Model
{

    public $id;
    protected $db;


    public function __construct()
    {
        $this->db = new Database();

    }

    public function count()// количество записей
    {
        $sql='SELECT count(*) FROM messages';
        $coun=$this->db->query($sql);
        $coun=@implode($coun->fetch(PDO::FETCH_ASSOC));
        return $coun;
    }

    public function sort($column)//сортировка
    {

        $sql = "SELECT * FROM messages ORDER BY $column ASC";
        return $this->db->query($sql);

    }

    public function find1() //получение всех записей
    {
        $sql = "SELECT * FROM messages";
        return $this->db->query($sql)->fetchAll();

    }
    public function add($username, $email, $text,$page,$ip,$browser)// запись в БД
    {

        $data = $this->db->prepare('INSERT INTO `messages` (`user_name`,`e-mail`,`message`,`page`,`user_ip`,`user_browser`,`time`) VALUES (:username,:email,:message,:page,:userip,:userbrowser,:time)');
        $data->execute(array(
            ':username' => $username,
            ':email'=> $email,
            ':message'=>$text,
            ':page'=>$page,
            ':userip'=> $ip,
            ':userbrowser'=> $browser,
            ':time'=> date("Y-m-d H:i:s")
        ));


    }

    public function pagin($start,$rows)
    {
if($start)$sql = "SELECT * FROM messages LIMIT $start,$rows";
        else $sql = "SELECT * FROM messages LIMIT $rows";

        return $this->db->query($sql);

    }
}