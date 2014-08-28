<?php
namespace Special\Controller;
use Admin\Controller\AdminController;
/**
 * 栏目管理
 */
class AdminSpecialController extends AdminController {
    /**
     * 当前模块参数
     */
    protected function _infoModule(){
        $menu = A('DuxCms/AdminSpecial');
        return $menu->infoModule;
    }

    /**
     * 增加
     */
    public function add(){
        if(!IS_POST){
            $breadCrumb = array('栏目列表'=>U('DuxCms/AdminSpecial/index'),'文章栏目添加'=>U());
            $this->assign('breadCrumb',$breadCrumb);
            $this->assign('name','添加');
            $this->assign('specialList',D('DuxCms/Special')->loadList());
            $this->assign('tplList',D('Admin/Config')->tplList());
            $this->assign('expandList',D('DuxCms/FieldsetExpand')->loadList());
            $this->adminDisplay('info');
        }else{
            if(D('Special')->saveData('add')){
                $this->success('栏目添加成功！');
            }else{
                $msg = D('Special')->getError();
                if(empty($msg)){
                    $this->error('栏目添加失败');
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
        if(!IS_POST){
            $specialId = I('get.special_id','','intval');
            if(empty($specialId)){
                $this->error('参数不能为空！');
            }
            $model = D('Special');
            $info = $model->getInfo($specialId);
            if(!$info){
                $this->error($model->getError());
            }
            $breadCrumb = array('专题列表'=>U('DuxCms/AdminSpecial/index'),'专题修改'=>U('',array('special_id'=>$specialId)));
            $this->assign('breadCrumb',$breadCrumb);
            $this->assign('name','专题修改');
            $this->assign('specialList',D('DuxCms/Special')->loadList());
            $this->assign('tplList',D('Admin/Config')->tplList());

            $this->assign('expandList',D('DuxCms/FieldsetExpand')->loadList());
            $this->assign('info',$info);
            $this->adminDisplay('info');
        }else{
            if(D('Special')->saveData('edit')){
                $this->success('栏目修改成功！');
            }else{
                $msg = D('Special')->getError();
                if(empty($msg)){
            exit();
                    $this->error('栏目修改失败');
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
        $classId = I('post.data');
        if(empty($classId)){
            $this->error('参数不能为空！');
        }
        //判断子栏目
        if(D('DuxCms/Category')->loadList('', $classId)){
            $this->error('请先删除子栏目！');
        }
        //判断栏目下内容
        $where = array();
        $where['A.class_id'] = $classId;
        $contentNum = D('ContentArticle')->countList($where);
        if(!empty($contentNum)){
            $this->error('请先删除该栏目下的内容！');
        }
        //删除栏目操作
        if(D('CategoryArticle')->delData($classId)){
            $this->success('栏目删除成功！');
        }else{
            $msg = D('CategoryArticle')->getError();
            if(empty($msg)){
                $this->error('栏目删除失败！');
            }else{
                $this->error($msg);
            }
        }
    }

}

