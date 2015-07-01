<?php
namespace Kirill\VK;

/**
 * Description of Pagination
 *
 * @author Кирилл
 */
class Pagination implements \Iterator{
    private $offset;
    private $limit;
    private $total;
    
    private $api;
    private $method;
    private $params;

    public function __construct(Api $api, $method, array $params){
        $this->api = $api;
        $this->method = $method;
        $this->params = $params;
        
        $this->offset = $params['offset'];
        $this->limit = $params['count'];
    }
    
    public function getTotal(){
        if($this->total === null){
            $this->total = $this->getCurrent()['count'];
        }

        return $this->total;
    }
    
    public function getCurrent(){
        $params = $this->params;
        $params['count'] = $this->limit;
        $params['offset'] = $this->offset;
        
        return $this->api->call($this->method, $params);
    }
    
    public function getItems(){
        return $this->getCurrent()['items'];
    }
    
    public function updateOffset(){
        $this->offset += $this->limit;
    }
    
    public function getPages(){
        $total = $this->getTotal();
        return ceil($total / $this->limit);
    }

    public function current() {
        return $this->getCurrent();
    }

    public function key() {
        return null;
    }

    public function next() {
        $this->updateOffset();
    }

    public function rewind() {
        $this->offset = 0;
    }

    public function valid() {
        return true;
    }

}