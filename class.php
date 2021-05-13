<?php

class DB{

    private $sql;

    public static function select($sql)
    {
        $dsn='mysql:dbname=todo;host=localhost;charset=utf8';
        $user='root';
        $password='';
        $dbh=new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $stmt=$dbh->prepare($sql);
        $stmt->execute();
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);

        $count=$dbh->prepare($sql);
        $count->execute();
        $count = $count -> fetch(PDO::FETCH_COLUMN);

        $dbh=null;

        $array_db=[$rec,$count];
        return $array_db ;
    } 
}

class Page{
    private $page;
    public static function getPage($get_page)
    {
       
        if(isset($get_page)){
            $this->page=(int)$get_page;
            }
        else{
            $this->page=1;
            }
        echo $this->page ;
        return $this->page ;
    }
    public static function offset($page,$max)
    {
        if($page>1){
            $offset=($page*$max)-$max;
            }
        else{
            $offset=0;
            }

        return $offset ;
    }

    public static function totalPage($count,$max)
    {
        $totalPage=ceil($count/$max);
        return $totalPage ;
    }
    
    public static function Paging($page)
    {
    if ($page > 1) :
        print "<a href="?page=echo ($page - 1);">前のページへ</a>";
    endif;
        echo $page;
    if ($page < $totalPage) :
        print "<a href="?page=echo ($page + 1);">次のページへ</a>";
    endif; 
    }       
}
?>