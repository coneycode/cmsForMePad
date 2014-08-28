<?php
namespace DuxCms\Controller;
use Admin\Controller\AdminController;
/**
 * App推荐状态管理
 */

class AdminPositionController extends AdminController {
    /**
     * 当前模块参数
     */
    protected function _infoModule(){
        return array(
            'info'  => array(
                'name' => '应用推荐状态管理',
                'description' => '管理网站调用自定义变量',
                ),
            'menu' => array(
                    array(
                        'name' => '推荐状态列表',
                        'url' => U('index'),
                        'icon' => 'list',
                    ),
                    array(
                        'name' => '添加推荐状态',
                        'url' => U('add'),
                        'icon' => 'plus',
                    ),
                )
            );
    }
	/**
     * 列表
     */
    public function index(){
        $breadCrumb = array('推荐类别列表'=>U());
        $this->assign('breadCrumb',$breadCrumb);
        $this->assign('list',D('Position')->loadList());
        $this->adminDisplay();
    }

    /**
     * 增加
     */
    public function add(){
        if(!IS_POST){
            $breadCrumb = array('推荐类别列表'=>U('index'),'添加'=>U());
            $this->assign('breadCrumb',$breadCrumb);
            $this->assign('name','添加');
            $this->adminDisplay('info');
        }else{
            $model = D('Position');
            if($model->saveData('add')){
                $this->success('推荐状态添加成功！');
            }else{
                $msg = $model->getError();
                if(empty($msg)){
                    $this->error('推荐状态添加失败');
                }else{
                    $this->error($msg);
                }
            }
        }
    }

    /**
     * 修改
     */
    public function edit(){
        $model = D('Position');
        if(!IS_POST){
            $positionId = I('get.position_id','','intval');
            if(empty($positionId)){
                $this->error('参数不能为空！');
            }
            //获取记录
            $info = $model->getInfo($positionId);
            if(!$info){
                $this->error($model->getError());
            }
            $breadCrumb = array('分类列表'=>U('index'),'修改'=>U('',array('position_id'=>$positionId)));
            $this->assign('breadCrumb',$breadCrumb);
            $this->assign('name','修改');
            $this->assign('info',$info);
            $this->adminDisplay('info');
        }else{
            if($model->saveData('edit')){
                $this->success('分类修改成功！');
            }else{
                $msg = $model->getError();
                if(empty($msg)){
                    $this->error('分类修改失败');
                }else{
                    $this->error($msg);
                }
            }
        }
    }

    /**
     * 删除
     */
    public function del(){
        $positionId = I('post.data');
        if(empty($positionId)){
            $this->error('参数不能为空！');
        }
        //获取用户数量
        $map = array();
        $map['A.position_id'] = $positionId;
        if(D('Position')->delData($positionId)){
            $this->success('分类删除成功！');
        }else{
            $this->error('分类删除失败！');
        }
    }


}

