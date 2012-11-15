<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user_class_m
 *
 * @author HacRi
 */
class file_class_m extends CI_Model {

    private $current_class = null;

    function __construct() {
        parent::__construct();
        $this->load->library('mongo_db');
    }

    /**
     * 根据id返回文件分类信息
     * @param type $id
     * @param type $change_current 是否修改当前分类指向
     * @return null
     */
    function get_by_id($id, $change_current = true) {
        $result = $this->mongo_db
                ->where(array('_id' => $id))
                ->get('file_class');

        if (count($result) > 0) {
            if ($change_current)
                $this->current_class = $result[0];
            return $result[0];
        }
        else {
            if ($change_current)
                $this->current_class = null;
            return null;
        }
    }

    /**
     * 根据名称返回分类
     * @param type $name
     * @param type $change_current
     * @return null
     */
    function get_by_name($name, $change_current = true) {
        $result = $this->mongo_db
                ->where(array('class_name' => $name))
                ->get('file_class');

        if (count($result) > 0) {
            if ($change_current)
                $this->current_class = $result[0];
            return $result[0];
        } else {
            if ($change_current)
                $this->current_class = null;
            return null;
        }
    }

    /**
     * 返回当前指向分类的子分类
     * @return null
     */
    function get_children_class() {
        if ($this->current_class == null)
            return null;
        $result = array();
        foreach ($this->current_class['children_id'] as $children_id) {
            $result[$children_id] = $this->get_by_id($children_id, false);
        }
        return $result;
    }

    /**
     * 将当前指向分类的修改写回数据库
     */
    function update_file_class() {
        $this->mongo_db
                ->where(array('_id' => $this->current_class['_id']))
                ->update('file_class', $this->current_class);
    }

    /**
     * 增加子分类指向
     * 
     * parent_id如果为0，则添加到当前指向分类
     * @param type $child_id
     * @param type $parent_id
     * @return boolean
     */
    function add_child($child_id, $parent_id = 0) {
        if ($parent_id != 0)
            $this->get_by_id($parent_id);

        if ($this->current_class == null)
            return false;
        array($this->current_class['children_id'], new MongoId($child_id));
        $this->update_file_class();
    }

    /**
     * 创建分类
     * 
     * 如果parent_id为0，则创建为当前指向分类的子分类
     * 如果parent_id为-1，则创建顶级分类
     * @param type $name
     * @param type $parent_id
     * @param type $change_current
     */
    function create_class($name, $parent_id = 0, $change_current = false) {
        $tmpcurrent = $this->current_class;

        $post = array(
            'class_name' => $name,
            'status' => 1
        );

        if ($parent_id == 0) {
            if ($this->current_class == null)
                return false;
            $post['parent_id'] = $this->current_class['parent_id'];
        } else if ($parent_id == -1) {
            $post['parent_id'] = -1;
        } else {
            $post['parent_id'] = new MongoId($parent_id);
        }

        $res = $this->mongo_db
                ->insert('file_class', $post);

        if ($parent_id != -1)
            $this->add_child($res, $parent_id);

        if (!$change_current)
            $this->current_class = $tmpcurrent;
        else
            $this->get_by_id($res);
    }

    /**
     * 创建为当前指向分类的子分类
     * @param type $name
     * @return null
     */
    function create_child($name) {
        $this->create_class($name, 0);
    }

}
