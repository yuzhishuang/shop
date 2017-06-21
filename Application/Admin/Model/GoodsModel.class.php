<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{
    //在调用create方法时允许接受的字段
    protected $insertFields = array('goods_name','price','goods_desc','is_on_sale','logo');
    //定义表单验证的规则，控制器中的create方法时用
    protected $_validate = array(
        array('goods_name','require','商品名称不能为空！',1),
        array('goods_name','1,45','商品名称必须是1-45个字符',1,'length'),
        array('price','currency','价格必须是货币形式',1),
        array('is_on_sale','0,1','是否上架只能是0，1两个值',1,'in'),
    );
    //说明：如果return false是指控制器中的add方法返回了false
    protected function _before_insert(&$data,$option){
        //获取当前时间
        $data['addtime'] = time();
        //上传logo
        if($_FILES['logo']['error'] == 0){
            $rootPath = C('IMG_rootPath');
            $upload = new \Think\Upload(
                array('rootPath' => $rootPath)
            );// 实例化上传类
            $upload->maxSize   =     (int)C('IMG_maxSize') * 1024 * 1024 ;// 设置附件上传大小
            $upload->exts      =     C('IMG_exts');// 设置附件上传类型
//            $upload->rootPath  =      C('IMG_rootPath'); // 设置附件上传根目录
            $upload->savePath  =      'Goods/'; // 设置附件上传二级目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                //先把上传失败的错误信息存到模型中，由控制器最终在获得这个错误信息并显示
                $this->error = $upload->getError();
                RETURN FALSE; //返回控制器
            }else{// 上传成功
                $logoName = $info['logo']['savepath'] . $info['logo']['savename'];
                //拼出缩略图的文件名
                $smLogoName = $info['logo']['savepath'] . 'thumb_' . $info['logo']['savename'];
                //生成缩略图
                $image = new \Think\Image();
                //打开要处理的图片
                $image->open(C('IMG_rootPath') . $info['logo']['savepath'] .$info['logo']['savename']);
                $image->thumb(150, 150)->save(C('IMG_rootPath') . $smLogoName);
                //把图片信息放在表单中
                $data['logo'] = $logoName;
                $data['sm_logo'] = $smLogoName;
            }
        }
    }

    public function search(){
        /*******搜索**********/
        $where = array();  //默认条件下的搜索条件为空
        //商品名称的搜索
        $goodsName = I('get.goods_name');
        if($goodsName)
            $where['goods_name'] = array('like',"%$goodsName%");
        //价格的搜索
        $startPrice = I('get.start_price');
        $endPrice = I('get.end_price');
        if($startPrice && $endPrice)
            $where['price'] = array('between',array($startPrice,$endPrice));
        elseif($startPrice)
            $where['price'] = array('egt',$startPrice);
        elseif($endPrice)
            $where['price'] = array('elt',$endPrice);
        //上架的搜索
        $isOnsale = I('get.is_on_sale',-1);
        if($isOnsale != -1)
            $where['is_on_sale'] = array('eq',$isOnsale);
        //是否删除的搜索
        $isDelete = I('get.is_delete',-1);
        if($isDelete != -1)
            $where['is_delete'] = array('eq',$isDelete);
        //按时间搜索
        $start_addtime = strtotime(I('get.start_addtime'));
        $end_addtime = strtotime(I('get.end_addtime'));
        if($start_addtime && $end_addtime)
            $where['addtime'] = array('between',array($start_addtime,$end_addtime));
        elseif($start_addtime)
            $where['addtime'] = array('egt',$start_addtime);
        elseif($end_addtime)
            $where['addtime'] = array('elt',$end_addtime);

        /******************排序***********************/
        $orderby = 'id';  //默认排序字段
        $orderway = 'asc';  //默认排序方式
        $odby = I('get.odby');
        if($odby && in_array($odby,array('id_asc','id_desc','price_asc','price_desc'))){
            if($odby == 'id_desc')
                $orderway = 'desc';
            elseif($odby == 'price_asc')
                $orderby = 'price';
            elseif($odby == 'price_desc')
                $orderway = 'desc';
                $orderby = 'price';
        }

        /*************************翻页**********************/
        //总的记录数
        $count = $this->where($where)->count();
        //生成翻页对象
        $page = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $page->show();// 分页显示输出
        $list = $this->where($where)->order("$orderby $orderway")->limit($page->firstRow.','.$page->listRows)->select();
        return array(
            'page' => $show,
            'data' => $list,
        );
    }
}