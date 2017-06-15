<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{
    //在调用create方法时允许接受的字段
    protected $insertFields = array('goods_name','price','goods_desc','is_on_sale');
    //定义表单验证的规则，控制器中的create方法时用
    protected $_validate = array(
        array('goods_name','require','商品名称不能为空！',1),
        array('goods_name','1,45','商品名称必须是1-45个字符',1,'length'),
        array('price','currency','价格必须是货币形式',1),
        array('is_on_sale','0,1','是否上架只能是0，1两个值',1,'in'),
    );
    protected function _before_insert(&$data,$option){
        //获取当前时间
        $data['addtime'] = time();
    }
}