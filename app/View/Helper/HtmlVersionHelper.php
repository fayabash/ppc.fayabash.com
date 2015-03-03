<?php

App::uses('HtmlHelper', 'View/Helper');

class HtmlVersionHelper extends HtmlHelper {

    public $version = '0.0.0';

    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }

    private function _convertUrl($url, $ext) {
        if (strpos($url, $ext) === FALSE) {
            $url .= $ext;
        }
        $url = $url . '?v=' . $this->version;
        return $url;
    }

    private function _convertUrls($urls, $ext) {
        if (is_array($urls)) {
            foreach ($urls as &$url) {
                $url = $this->_convertUrl($url, $ext);
            }
        } else {
            $urls = $this->_convertUrl($urls, $ext);
        }
        
        return $urls;
    }

    public function css($path, $options = array()) {
        $path = $this->_convertUrls($path, '.css');
        return parent::css($path, $options);
    }

    public function script($url, $options = array()) {
        $url = $this->_convertUrls($url, '.js');
        return parent::script($url, $options);
    }

}
