<?php
namespace Special\Model;
use Think\Model;
/**
 * 推荐位表操作
 */
class SpecialModel extends Model {
       //完成
       protected $_auto = array (
           array('update_time','strtotime',3,'function'),
    //     array('special_id','intval',2,'function'),
        );
    // //验证
    // protected $_validate = array(
    //     array('name','require', '推荐位名称不能为空', 1),
    // );

    /**
     * 获取列表
     * @return array 列表
     */
    public function loadList(){
        return  $this->select();
    }

    /**
     * 获取信息
     * @param int $specialId ID
     * @return array 信息
     */
    public function getInfo($specialId = 1)
    {
        $map = array();
        $map['special_id'] = $specialId;
        return $this->where($map)->find();
    }

    /**
     * 更新信息
     * @param string $type 更新类型
     * @return bool 更新状态
     */
    public function saveData($type = 'add'){
        $data = $this->create();
        if(!$data){
            return false;
        }
        if($type == 'add'){
            return $this->add();
        }
        if($type == 'edit'){
            if(empty($data['special_id'])){
                return false;
            }
            $status = $this->save();
            if($status === false){
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * 删除信息
     * @param int $specialId ID
     * @return bool 删除状态
     */
    public function delData($specialId)
    {
        $map = array();
        $map['special_id'] = $specialId;
        return $this->where($map)->delete();
    }

}
