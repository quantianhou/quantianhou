var uploadImageParent = null;
var inputField = null;
function vueUpload($obj) {
    uploadImageParent = $obj.parent();
    inputField = $obj.data('field_name');
    window.layerIndex = layer.open({
        type: 2,
        title: '上传文件',
        shadeClose: true,
        shade: 0.8,
        area: ['45%', '50%'],
        content: '/upload_demo?fileType=image&parentId=filename&callBack=showOssImage&isMulti=1' //iframe的url
    });
}

function showOssImage($result) {
    for (var i = 0; i < $result.length; i ++) {
        console.log($result[i]);
        appendHtmlImage($result[i])
    }
}

function appendHtmlImage($result) {
    uploadImageParent.append(
        '<div style="display: inline-block; margin: 5px;">\
              <input type="hidden" value="'+$result.file_name+'" name="' + inputField  +'" />\
              <img width="100" height="100" src="http://vipx-test.oss-cn-beijing.aliyuncs.com/'+$result.file_name+'" />\
              <a onclick="$(this).parent().remove()" style="display: block; text-align: center;">删除</a>\
        </div>'
    )
}