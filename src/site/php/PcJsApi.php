<?php

class PCJSAPI {

    public $url;
    protected $System;
    protected $Agent;
    protected $header;

    public function __construct($url) {
        $this->url = $url;
        
        $this->Agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36';
        $this->header = "Content-type: application/x-www-form-urlencoded\r\n" . "Accept-language: en\r\n";
        $this->System = json_decode(
            file_get_contents(
                $url . "?MM1_jc=200",
                false,
                stream_context_create(
                    array(
                        "http" => array(
                            "user-agent" => $this->Agent,
                            "header" => $this->header,
                            "method" => "GET",
                            "content" => http_build_query(
                                array(
                                    "MM1_jc"=>"200"
                                )
                            )
                        )
                    )
                )
            ),
            true
        );
    }

    public function getResolveBySystem($name, $post_data = null) {
        if ($post_data == null) {
            $post_data = array();
        }

        function getUrl($url, $getData) {
            $data_get = array();
            foreach ($getData as $key => $value) {
                $data_get[] = $key . "=" . $value;
            }
            return $url . "?" . implode("&", $data_get);
        }

        return file_get_contents(getUrl($this->url, $this->System[$name]["GET"]), false,
                stream_context_create(array(
            "http" => array(
                "user-agent" => $this->Agent,
                "header" => $this->header,
                'method' => 'POST',
                'content' => http_build_query($post_data)
            )
        )));
    }
    
    public function getJsBySystem($name, $post_data=null) {
        return json_decode($this->getResolveBySystem($name, $post_data), true);
    }

}
