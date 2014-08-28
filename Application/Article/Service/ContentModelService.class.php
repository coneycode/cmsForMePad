<?php
namespace Article\Service;
/**
 * 内容模型接口
 */
class ContentModelService{
    /**
     * 获取模型信息
     */
    public function getContentModel(){
        return array(
            'name'=>'分类',
            'listType'=>1,
            'order'=>0,
            );
    }
    


}
