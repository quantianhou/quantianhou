
<script type="text/javascript">
    if(BJUI.URLDATA.hasOwnProperty("shop_store") &&
        BJUI.URLDATA.shop_store.hasOwnProperty("id") &&
        BJUI.URLDATA.shop_store.id > 0){

        $.CurrentNavtab.find('#confirm').on('click',function(event){
            event.preventDefault();
            var post_data = $.CurrentNavtab.find('#store-data-info').serialize();
            post_data = post_data + '&id=' + BJUI.URLDATA.shop_store.id
            var oo = {
                url : '/api/shop_store/signing',
                loadingmask:true,
                data : post_data,
                callback:function(res){
                    if(res.errors) {
                        return $(this).alertmsg('error', res.message)
                    }
                    $(this).alertmsg('info', res.message, {
                        autoClose:false,
                        okCall: function () {
                            $('#shop-store-table').datagrid('refresh');//刷新数据列表
                            $(this).navtab('closeCurrentTab');//成功后关闭当前tab页
                        }
                    });
                },
                failCallback: function (msg, options) {
                    console.log(msg, options, 1)
                },
                errCallback: function (json, options) {
                    console.log(json, options)
                }
            };

            $(document).bjuiajax('doAjax', oo);
        });
    }

</script>

<div class="bjui-pageContent">

    <div style="margin:10px 0px 0px 17px;">
        <form class="formarea" data-toggle="validate" id="store-data-info">
            <table class="table" border="0" width="60%">
                <tr>
                    <td>
                        <label class="label-control"><span style="color:red">*</span>合约编号</label>
                        <input type="text" placeholder="请填写合约编号" name="contract_num" size="30" data-rule="required"><span></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>合同有效日期</label>
                        <input type="text" name="contract_start_time" date="0" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                        -
                        <input type="text" name="contract_end_time" date="0" data-toggle="datepicker" data-pattern="yyyy-MM-dd">
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="2">
                        <button type="submit" id="confirm" class="btn btn-green">签约</button>
                        <button type="button" onclick="$.CurrentNavtab.navtab('refresh');" class="btn btn-green">取消</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
<script>
    // $('#js-role-time-data').datepicker({pattern:'dd/MM/yyyy', minDate:'2016-10-01'})

    //判断是否需要拉取数据
    // console.log(BJUI.URLDATA.shop_store);
    // if(BJUI.URLDATA.hasOwnProperty("shop_store") && BJUI.URLDATA.shop_store.hasOwnProperty("id")){
    //     if(BJUI.URLDATA.shop_store.id >0){
    //         var oo = {
    //             url : '/api/shop_store/signing_info',
    //             loadingmask:true,
    //             data : {id:BJUI.URLDATA.shop_store.id},
    //             callback:function(res){
    //                 console.log(res);
    //                 if(res.error) return $(this).alertmsg('error', res.info), !1;
    //
    //                 for(var i in res.data){
    //                     if(i != 'merchant_logo'){
    //                         $.CurrentNavtab.find('input[name='+i+']').val(res.data[i])
    //                         $.CurrentNavtab.find('select[name='+i+']').val(res.data[i])
    //                         $.CurrentNavtab.find('textarea[name='+i+']').val(res.data[i])
    //                     }
    //                 }
    //             }
    //         };
    //         $(document).bjuiajax('doAjax', oo);
    //     }
    // }
</script>