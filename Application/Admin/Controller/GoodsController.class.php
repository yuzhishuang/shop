<?php
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends Controller{
    public function add(){
        //2、处理表单
        if(IS_POST){
            //3、生成模型
            $model = D('Goods');
            if($model->create(I('post.'),1))
            {
                //5、插入数据库
                if($model->add())
                {
                    //6、提示信息
                    $this->success('操作成功',U('lst'));
                    //7、停止执行后面的代码
                    exit;
                }
            }
            //8、如果上面失败，获取失败的原因
            $error = $model->getError();
            //9、显示错误信息，并调回到上一个页面
            $this->error($error);
        }
        //1、显示表单
        $this->display();
    }
    //列表
    public function lst(){
        $model = D('Goods');
        //获取带翻页的数据
        $data = $model->search();
        $this->assign(
            array(
                'data' => $data['data'],
                'page' => $data['page'],
            )
        );
        $this->display();
    }

    public function delete(){
        $model = D('Goods');
        $model->delete(I('get.id'));
        $this->success('操作成功',U('lst?p='.I('get.p')));
    }

    public function edit(){
        //处理表单
        if(IS_POST){
            $model = D('Goods');
            if($model->create(I('post.'),2)){
                //save方法的返回值是影响记录条数（mysql_affected_rows）,如果修改时没有修改任何值会返回0，如果失败则返回false
                if(FALSE != $model->save()){
                    $this->success('操作成功!',U('lst?p='.I('get.p')));
                    exit;
                }
            }
            //如果失败则返回失败信息
            $this->error($model->getError());
        }
    }
}