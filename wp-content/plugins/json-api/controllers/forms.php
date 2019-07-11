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
            $content .= "Сайт: " .$site. "\n";
        }
        
        if($email) {
            $content .= "Email: " .$email;
        }
    
        $this->mail($title. ' на web/dev', $content);
    
        return  wp_insert_post(array(
            'post_title'=>$title,
            'post_type'=>'forms',
            'post_content'=>$content,
            'post_status' => 'publish'
        ));
    }
    
    private function submit_brief($query) {
        $title = "Бриф";
        $name = $query->name;
        $phone = $query->phone;
        $type = $query->type;
        $budget = $query->budget;
        $task = $query->task;
        $from = $query->from;
        $file = $_FILES["file"];
    
        $content = "";
        $content .= "Имя: " .$name. "\n";
        $content .= "Телефон: " .$phone. "\n";
    
        if($type) {
            $content .= "Тип проекта: " .$type. "\n";
        }
    
        if($budget) {
            $content .= "Бюджет: " .$budget. "\n";
        }
    
        if($task) {
            $content .= "\n\nЗадача: " .$task. "\n\n";
        }
    
        if($from) {
            $content .= "Откуда узнали: " .$from. "\n";
        }
    
        if($file) {
            $filePath = wp_upload_bits(
                time().$file["name"],
                null,
                file_get_contents($file["tmp_name"])
            )["url"];
    
            $content .= "\n\nФайл: " .$filePath;
        }
        
        $this->mail('Заполнен бриф на web/dev', $content);
    
        return  wp_insert_post(array(
            'post_title'=>$title,
            'post_type'=>'forms',
            'post_content'=>$content,
            'post_status' => 'publish'
        ));
    }
    
    private function mail($title, $content) {
        $headers = array(
            'From: Notification service <service@web-dev-studio.ru>'
        );
    
        wp_mail( 'eqbits@gmail.com, web.d3v@yandex.ru, eqbit@yandex.ru', $title, $content, $headers );
    }
}