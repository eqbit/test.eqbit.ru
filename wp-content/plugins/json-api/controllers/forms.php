<?php

/*
Controller name: Forms
Controller description: Обработка форм
*/

class JSON_API_Forms_Controller {
    private $hash = "ldsk@mfsSmfdLmdsASle31Dd";
    
    public function get_hash() {
        return [
            "hash" => $this->hash
        ];
    }
    
    public function submit_form() {
        global $json_api;
        
        $method = $json_api->query->method;
        
        $id = $this->$method($json_api->query);
        
        return [
            "id" => $id
        ];
    }
    
    private function submit_recall($query) {
        $name = $query->name;
        $phone = $query->phone;
        $site = $query->site;
        $email = $query->email;
        $title = $query->title;
        
        $content = "";
        $content .= "Имя: " .$name. "\n";
        $content .= "Телефон: " .$phone. "\n";
        
        if($site) {
            $content .= "Сайт: " .$site;
        }
        
        if($email) {
            $content .= "Email: " .$email;
        }
    
        return  wp_insert_post(array(
            'post_title'=>$title,
            'post_type'=>'forms',
            'post_content'=>$content,
            'post_status' => 'publish'
        ));
    }
}