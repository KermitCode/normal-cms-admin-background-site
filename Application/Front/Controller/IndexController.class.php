<?php
namespace Front\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('front','utf-8');
    }
}