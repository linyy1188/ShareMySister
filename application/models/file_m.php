<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of file
 *
 * @author HacRi
 */
class file_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('mongo_db');
    }
   /**
	*根据文件id获取文件信息
    *
    *@param type $fileid
    *@return array
    */

    function get_by_id($fileid = null) {
        if (is_null($fileid))
            return null;
        $result=$this->mongo_db
                ->where($array('_id' => $fileid))
                ->get('file')
        if (count($result)>0)
            return $result[0];
        else
            return null;
    }
	/**
	*根据文件名获取文件信息
	*
	*@param type $name
	*@return array
	*/

    function get_by_name($name) {
        if (is_null($name))
            return null;
        $result=$this->mongo_db
                ->where($array('file_name' => $name))
                ->get('file')
        if (count($result)>0)
            return $result;
        else
            return null;
        
    }
	/**
	*创建文件记录,同时会在tag里创建索引。
	*
    *@param $file_name string
    *@param $file_status 1:passed,0:tobechecked,-1:useless
	*@param $file_class 
    *@param $file_type
    *
	*/

    function create_file($file_name, $file_class, $file_type, $file_location, $file_info, $file_tags, $upload_user){
        $id = new MongoId();
        $file = array('file_name' => $file_name,
                '_id' => $id,
                'file_class' => $file_class,
                'file_type' => $file_type,
                'file_location' => $file_location,
                'file_info' => $file_info,
                'file_tags' => $file_tags,
                'upload_user' => $upload_user,
                'view_times' => 0,
                'down_times' => 0,
                'vote_like' => 0,
                'vote_dislike' => 0,
                'status' => 10);//file data to insert
        $this->mongo_db->insert('file',$file);
        $data_for_tag = array('_id' => $id,
                            'file_name' => $file_name 
                            );//just insert the id and name fileids into tags as index
        if (!is_array($file_tags))
            $file_tags = array($file_tags);
        foreach ($file_tags as $file_tag) {//start insert data to tags index
            $query = $this->mongo_db
            ->where(array('tags_name' => $file_tag))
            ->get('tags');
            if (count($query)!=0){//if the tag already exists ,then just add to the tags array 
                $this->mongo_db
                ->where(array('tags_name'=>$file_tag))
                ->addtoset('tags_file', $data_for_tag)
                ->update('tags');
            }
            else
                $this->mongo_db->insert('tags',array('tags_name' => $file_tag, 'tags_file' =>$data_for_tag));
        }
    }

    /**
    *删除文件，同时会删除tag中的索引信息。
    *
    *@param $fileid type
    *@return 1 
    *
    */
    function delete_file($fileids){
		if (!is_array($fileids))
			$fileids = array($fileids);
        foreach ($fileids as $fileid) {
                $query=get_by_id($fileid);
                $file_tags=$query['file_tags'];
                foreach ($file_tags as $tagname) {//process every tag of the file
                    $result = $this->mongo_db
                    ->where(array('tags_name' => $tagname));
                    ->get('tags');
                    $tags=$result[0];
                    if (count($tags['tags_file']==1))
                        $this->mongo_db
                        ->where(array('tags_name' => $tagname))
                        ->delete($tags_name);
                    else{
                        foreach ($tags['tags_file'] as $file) {
                            if ($file['_id'] == $fileid)
                                unset($file);
                        }//delete this file from source
                        $this->mongo_db
                        ->where(array('tags_name' => $tagname))
                        ->update('tags',$tags);//submit the updated info
                    }
                        $this->mongo_db
                        ->where(array('_id' => $fileid))
                        ->delete('file');//last step delete file
                }
            }
        }

    /**
    *投票对一份资料喜欢或不喜欢
    *
    *@param $fileid
    *@param $like True dislike False
    *
    */
    function vote($fileid, $like){
        if ($like)
            $this->mongo_db
            ->where(array('_id' => $fileid))
            ->inc(array('vote_like' => 1))
            ->update('file');
        else
            $this->mongo_db
            ->where(array('_id' => $fileid))
            ->inc(array('vote_dislike' => 1))
            ->update('file');
    }

    /**
    *增加文件阅览次数
    *@param $fileid file to be viewed
    *
    *
    */
    function view($fileid){
            $this->mongo_db
            ->where(array('_id' => $fileid))                           
            ->inc(array('view_times' => 1))
            ->update('file');
    }

    /**
    *增加下载次数。
	*
    *@param $fileid
    *
    *@return $location_addr
    */
    function download($fileid){
            $this->mongo_db
            ->where(array('_id' => $fileid))
            ->inc(array('down_times' => 1))
            ->update('file');
    }

    /**
    *改变资料审核状态。
    *
	*@param $fileids  array or num
	*
    *
    */
    function change_files_status($fileids,$status){
        if (!is_array($fileids))
            $fileids = array($fileids);
        foreach ($fileids as $fieid) {
            $this->mongo_db->set('status',$status)
            ->where(array('_id' => $fileid))
            ->update('file');               
            }
    }

    /**
    *更改资料名称
	*
	*@param $fileids 文件id
	*@param $name 文件名称
    *
    */
    function change_file_name($fileid,$name){
        $this->mongo_db
        ->set('file_name',$name)
        ->where(array('_id' => $fileid))
        ->update('file');
    }

    /**
    *更改文件信息，包括版权信息和描述。
	*
	*@param $copyright 版权信息
	*@param $Description 描述
    *
	*
    */
    function change_file_info($fileid, $copyright = null, $Description = null){
        if (is_null($copyright)&&is_null($Description))
            return null;
        else if (is_null($copyright)){
            $file = get_by_id($fileid);
            $file['file_info']['info_description'] = $Description;
            $this->mongo_db
            ->where(array('_id' => $file['_id']))
            ->update('file',$file);
        }
        else if (is_null($Description)){
            $file = get_by_id($fileid);
            $file['file_info']['info_copyright'] = $copyright;
            $this->mongo_db
            ->where(array('_id' => $file['_id']))
            ->update('file',$file);
        }
        else{
            $file = get_by_id($fileid);
            $file['file_info']['info_copyright'] = $copyright;
            $file['file_info']['info_description'] = $Description;
            $this->mongo_db
            ->where(array('_id' => $file['_id']))
            ->update('file',$file);
        }           
    }

    /**
    *通过标签名称获取文件
	*
	*@param $tagname 标签名称
	*
	*@return 文件数组,
    */
    function get_files_by_tagname($tagname){
        $query = $this->mongo_db
        ->where(array('tags_name' => $tagname))
        ->get('tags');
        return $query['tags_file'];
    }

	/**
	*获取标签列表
	*
	*@return 标签数组
	*
	*/

    function get_tags(){
        $query = $this->mongo_db
        ->get('tags');
        return $query;
    }

	/**
	*获取文件集合的总文件数
	*
	*
	*/

    function get_files_num(){
        $query = $this->mongo_db
        ->count('file');
        return $query;
    }

	/**
	*获取tags集合的总tag数
	*
	*
	*/
    function get_tags_num(){
        $query = $this->mongo_db
        ->count('tags');
        return $query;
    }

	/**
	*搜索匹配的文件名称
	*
	*@param $filename 在文件名称中查找的字符串
	*@param $filetype 文件类型
	*@param $limit 返回的结果数量
	*@param $offset 偏移量
    *@param $order Sort the documents based on the parameters passed. To set values to descending order,
    *   you must pass values of either -1, FALSE, 'desc', or 'DESC', else they will be
    *   set to 1 (ASC).
	*/
    function search_file_name($filename, $filetype = null, $limit = 99999, $offset = 0, $order = array()){
        if (is_null($filetype))
            $query = $this->mongo_db
            ->like('file_name', $filename, 'u')
            ->offset($offset)
            ->limit($limit)
            ->order_by($order)
            ->get('file');
        else
            $query = $this->mongo_db
            ->like('file_name', $filename, 'u')
            ->where(array('file_type' => $filetype))
            ->offset($offset)
            ->limit($limit)
            ->order_by($order)
            ->get('file');
        return $query;
    }

    /**
    *
    *
    */
    function get_files_by($order_by, $order, $num){
        $query = $this->mongo_db
        ->order_by(array($order_by -> $order))
        ->limit($num)
        ->get('file');
        return $query;
    }

}

?>
