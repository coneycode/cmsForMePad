<?php
namespace DuxCms\Controller;
use Admin\Controller\AdminController;
/**
 * 分类管理
 */
class AdminSpecialController extends AdminController
{
    /**
     * 当前模块参数
     */
    public function _infoModule()
    {
        $data = array('info' => array('name' => '专题管理',
                'description' => '管理网站全部专题',
                ),
            'menu' => array(
                array('name' => '专题列表',
                    'url' => U('DuxCms/AdminSpecial/index'),
                    'icon' => 'list',
                    ),
                $contentMenu
                )
            );
        $modelList = getAllService('SpecialModel', '');

        $contentMenu = array();
        if (!empty($modelList))
        {
            $i = 0;
            foreach ($modelList as $key => $value)
            {
                $i++;
                $data['menu'][$i]['name'] = '添加' . $value['name'];
                $data['menu'][$i]['url'] = U($key . '/AdminSpecial/add');
               
                $data['menu'][$i]['icon'] = 'plus';
            }
        }
        return $data;
    }
    /**
     * 列表
     */
    public function index()
    {
        $breadCrumb = array('专题列表' => U());
        $this->assign('breadCrumb', $breadCrumb);
        $this->assign('list', D('Special')->loadList());
        $this->adminDisplay();
    }
}

