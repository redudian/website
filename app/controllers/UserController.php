<?php

class UserController extends BaseController
{

    /**
     * 添加账号
     * @return mixed
     */
    public function add()
    {
        $result = array('code' => 0, 'msg' => '');
        $user_data['user_name'] = isset($_POST['user_name']) ? trim($_POST['user_name']) : '';
        $user_data['nickname'] = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
        $user_data['email'] = isset($_POST['email']) ? trim($_POST['email']) : '';
        $user_data['password'] = isset($_POST['password']) ? trim($_POST['password']) : '';

        //验证提示信息
        $messages = array(
            'user_name.required' => '用户名不能为空!',
            'user_name.min' => '长度不能少于4个字符!',
            'user_name.max' => '长度不能大于20个字符!',
            'user_name.alpha_dash' => '只允许数字、字母、下划线、中划线!',
            'user_name.unique' => '用户名已经存在!',
            'nickname.required' => '昵称不能为空!',
            'nickname.min' => '长度不能少于2个字符!',
            'nickname.max' => '长度不能大于20个字符!',
            'nickname.unique' => '昵称已经存在!',
            'password.required' => '密码不能为空!',
            'password.min' => '长度不能少于6个字符!',
            'password.max' => '长度不能大于20个字符!',
            'email.required' => '邮箱不能为空!',
            'email.email' => '邮箱地址不正确!!',
            'email.unique' => '邮箱已经存在!',
            'email.max' => '长度不能大于40个字符!',
        );

        //验证规则
        $rules = array(
            'user_name' => 'required|min:4|max:20|alpha_dash|unique:user',
            'nickname' => 'required|min:2|max:20|unique:user',
            'password' => 'required|min:6|max:20',
            'email' => 'required|email|unique:user|max:40'
        );
        $validator = Validator::make($user_data, $rules, $messages);//验证
        if ($validator->fails()) {//验证失败
            $result['msg'] = $validator->messages();
        } else {
            $user_data['password'] = password_hash('secret', PASSWORD_BCRYPT);
            $user = new User;
            $user->user_name = $user_data['user_name'];
            $user->nickname = $user_data['nickname'];
            $user->email = $user_data['email'];
            $user->password = $user_data['password'];
            if ($user->save()) {
                $result['msg'] = 'ok';
                $result['code'] = 1;
            }else{
               $result['msg']='创建账号失败!';
            }
        }
        return Response::json($result);
    }
}