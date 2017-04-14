/**
 * JonyGuan 公共方法封装 For Homer Theme
 * /
 /**
 * 批量操作公共ajax处理方法&弹窗参数设置
 * ids:记录id @array (ids)
 * megTxt:提示消息 @string (删除)
 * action:处理方法路径 @string (/backhome/post/del)
 * 示例：swalAlert(ids,'删除','/backhome/post/del');
 * 用于 博文列表
 */
function swalAlert(ids,megTxt,action){
    swal({
            title: "确定要"+megTxt+"吗",
            text: "",
            type: "warning",
            confirmButtonColor: "#e74c3c",
            cancelButtonColor: "#ccc",
            confirmButtonText: "确定！",
            cancelButtonText: "取消",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },
        function(){
            $.ajax({
                type: "post",
                url: action,
                data:{'ids':ids,'_token':$('meta[name=_token]').attr('content')},
                dataType: "json",
                success: function(data) {
                    swal({
                        title: megTxt+"成功!",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    },function(){
                        location.reload();
                    });
                },error: function(){
                    swal({
                        title: megTxt+"失败!",
                        text: "",
                        type: "error",
                        timer: 2000,
                        showConfirmButton: false
                    },function(){
                        location.reload();
                    });
                }
            });
        });
}
 /**
 * 批量操作公共ajax处理方法&弹窗参数设置
 * ids:记录id @array (ids)
 * megTxt:提示消息 @string (删除)
 * action:处理方法路径 @string (/backhome/post/del)
 * 示例：swalAlert(ids,'删除','/backhome/post/del');
 * 用于 博文列表
 */
function simpleAlert(megTxt,status,urlhash){
     swal({
         title: megTxt,
         text: "",
         type: status,
         timer: 2000,
         showConfirmButton: false
     },function(){
         var url = getUrl();
         if(urlhash!=''){
             window.location.href = urlhash;
         }else{
             window.location.href = url['url'];
         }
     });
}
/**
 * 菜单定位
 * char string #user
 */
function menu(char){
    $(char).parent().children('li').removeClass();
    $(char).addClass('active');
    $(char+' > ul > li > a').each(function(){
        if($(this).attr('href').indexOf(window.location.pathname)>-1){
            $(this).parent().siblings().removeClass();
            $(this).parent().addClass('active');
        }
    });
}
/**
 * 全选-取消全选操作
 * 全选按钮 设置 id="btnCheckAll"
 * Item项的复选框按钮 设置 name="chkItem"
 * 用户博文列表
 */
$("#btnCheckAll").bind("click", function () {
    if($(this).is(':checked')){
        $("[name = chkItem]:checkbox").each(function(e){
            if(!$(this).is(':checked')){
                $(this).click();
            }
        });
    }else{
        $("[name = chkItem]:checkbox").each(function(e){
            if($(this).is(':checked')){
                $(this).click();
            }
        });
    }
});
/**
 * 获取数据列表所有选中项目数组
 * return array;
 * 用于 博文列表
 */
function getChecks(){
    var ids = new Array();
    $("[name = chkItem]:checkbox").each(function(index){
        if($(this).is(':checked')){
            ids.push($(this).val());
        }
    });
    return ids;
}
/**
 * 获取URL参数方法-解决中文乱码问题
 * 用于 博文列表页面
 * */
function GetQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = decodeURI(window.location.search.substr(1)).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}
/**
 * 获取当前Url参数方法
 * 用于 博文列表页面
 * */
function getUrl(){
    var arrUrl=new Array();
    arrUrl['status'] = GetQueryString('status');
    arrUrl['key'] = GetQueryString('key');
    arrUrl['page'] = GetQueryString('page');
    arrUrl['url']='http://'+window.location.hostname+window.location.pathname;
    return arrUrl;
}
/**
 * 当前Url发生变化后根据原有参数重新拼接URL方法
 * 用于 博文列表页面(搜索相关)
 * */
function changeUrl(url){
    if(url['status']!=null && url['key']!=null && url['key']!='' && url['page']!=null){
        window.location.href = url['url']+'?status='+url['status']+'&key='+url['key']+'&page='+url['page'];
    }else{
        if(url['status']!=null){
            window.location.href = url['url']+'?status='+url['status'];
        }
        if(url['key']!=null && url['key']!=''){
            window.location.href = url['url']+'?key='+url['key'];
        }
    }
}
