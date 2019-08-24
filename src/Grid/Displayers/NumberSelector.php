<?php

namespace Ezadev\Admin\Grid\Displayers;

use DB;
class NumberSelector extends AbstractDisplayer
{
    public function display()
    {
        if(count($this->row)>0){
            DB::statement(DB::raw('set @rownum=0'));
            $db = $this->row->select(DB::raw('@rownum := @rownum + 1 AS num'),'id')->orderBy('created_at','ASC')->get()->toArray();
            $test = $this->search($db,$this->getKey());
            return $test;
        }else{
            return null;
        }
    }

    private function search($db,$key){
        $value = '';
        foreach($db as $ky => $vl){
            if($vl['id'] == $key){
                $value = $vl['num'];
            }
        }
        return $value;
    }

}
