<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CommentModel extends RelationModel{
    protected $_link = array(
        'Userinfo'=>array(
            'mapping_type'      => self::HAS_ONE,
                        'foreign_key'=>"uid",//关联表的外键
                        'mapping_key'=>'uid',//自己表的外键
                        'as_fields' => 'pic',
                        ),
        );
}
