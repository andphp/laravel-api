<?php

namespace Andphp\LaravelApi\Abstracts;

use Illuminate\Database\Eloquent\Model;

abstract class ApiModel extends Model
{
    /**
     * 错误信息
     * @var int|string
     */
    protected $error = '';

    /**
     * 当前请求用户id
     * @var string client_id
     */
    public $uid;

    /**
     * 用户类型  0：客户组，1：管理组
     * @var
     */
    public $client_type;

    /**
     * 当前请求用户组id
     * @var
     */
    public $group_id;

    /**
     * 设备
     * @var
     */
    public $platform;

    /**
     * 当前请求用户名
     * @var
     */
    public $username;

    /**
     * 返回模型的错误信息
     * @access public
     * @return string|array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 设置模型错误信息
     * @access public
     * @param int|string $value 错误信息
     * @return bool
     */
    public function setError($value)
    {
        $this->error = $value;
        return false;
    }

    protected function isLogin($params)
    {
        if (!isset($params['tokenData']) || empty($params['tokenData'])) {
            return $this->setError('非注册用户无法访问');
        }
        $this->uid = $params['tokenData']['client_id'];
        $this->group_id = $params['tokenData']['group_id'];
        $this->client_type = $params['tokenData']['client_type'];
        $this->platform = $params['tokenData']['platform'];
        $this->username = $params['tokenData']['username'];
    }
}