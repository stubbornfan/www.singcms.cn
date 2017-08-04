/**
 * 前端登录业务
 * Created by frank on 2017-08-04.
 */
var login = {
    check :function(){
        //获取登录页面中的 用户名和密码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();

        if(!username){
            dialog.error('用户名不能为空!');
        }
        if(!password){
            dialog.error('密码不能为空!');
        }
        var url = "/admin.php?m=admin&c=login&a=check";
        var data ={'username':username,'password':password};

        //执行异步请求
        $.post(url,data,function (res) {
            if(res.status == 0){
                return dialog.error(res.message);
            }
            if( res.status == 1 ){
                return dialog.success(res.message,"/admin.php?m=admin&c=index");
            }

        },'JSON');

    }

}