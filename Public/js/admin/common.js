/**
 * 添加按钮操作
 * Created by frank on 2017-08-04.
 */
$("#button-add").click(function(){
    var url = SCOPE.add_url;
    window.location.href =url;
});

/**
 * 提交form表单操作
 *
 */
$("#singcms-button-submit").click(function(){
    var data =$("#singcms-form").serializeArray();
    postData ={};
    $(data).each(function(i){
        postData[this.name]= this.value;
    });

    var url = SCOPE.jump_url;

    $.post(url,postData,function(result){
        if(result.status ==1 ){

        }
        if(result.status ==0 ){

        }


    },'JSON');

});

