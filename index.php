<?php

 require 'sys/DB.php';
 
 use App\Sys\DB;
 //connection db
 try {
  $db=DB::getInstance();
  
    // inserció d'usuaris
    $db->query("INSERT INTO users (username, password, roles) VALUES (:nombre, :pass, 2)");
    
    $db->bind("nombre", "user5");
    
    $db->bind("pass", "linuxlinux");
    
     //ejecutar sentencia
    //el post
        $db->execute();
        
        $usuarioid = $db->lastInsertId();
    
      //creación de la sentencia
    // inserció de posts
    $db->query("INSERT INTO posts (title, conte, fecha_creacion, userid) VALUES (:title, :conte, NOW(), :usuario)");
     
    //parametros 
    $db->bind("title", "linux");
    
    $db->bind("conte", "M7 linuxlinux");
    
    $db->bind("userid", $userid);
    
        $db->execute();
        //$usuarioid = $db->lastInsertId();
        $postid = $db->lastInsertId();
    
    // inserció comentario
    $db->query("INSERT INTO comentari (conte, fecha_creacion, user, post) VALUES (:comentario, :usuario, :post, NOW())");
   
    //parametros 
    $db->bind("comentario", "m7 linuxlinux");
    
    $db->bind("usuario", $userid);
    
    $db->bind("post", $postId);   
    
   $db->execute();
    
    // inserció
    $db->query("INSERT INTO tags (tagss) VALUES (:tagss_name)");
    
    $db->bind("tagss_name", "m7");
    
    $db->execute();
    
    $tagsid = $db->lastInsertId();
    
    // consulta de los posts
    $db->query("SELECT * FROM posts");
    
    $db->execute();
    
    $posts = $db->resultSet();
    
    var_dump($posts);
    
    // consulta de los posts por usuario
    $db->query("SELECT * FROM posts WHERE userid = :usuario");
    
    $db->bind("usuario", $userid);
    
    $db->execute();
    
    $posts = $db->resultSet();
    
    var_dump($posts);
        
 } catch (PDOException $Exception) {
    echo $Exception->getMessage();
}
