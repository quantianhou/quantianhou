<script type="text/javascript">
    function doc_upload_success(file, data) {

    }
</script>
<div style="margin: 10px;">
    <div id="goods_detail_up" data-toggle="upload" data-uploader="api/goods/import"
         data-file-size-limit="1024000000"
         data-file-type-exts="*.xls"
         data-button-text="请上传商品详情"
         data-multi="true"
         data-on-upload-success="doc_upload_success"
         data-icon="cloud-upload"></div>
    <input type="hidden" name="doc.pic" value="" id="doc_pic">
</div>

<div style="margin: 10px;">
    <div id="goods_detail_up" data-toggle="upload" data-uploader="api/goods/import/extra"
         data-file-size-limit="1024000000"
         data-file-type-exts="*.xls"
         data-button-text="请上传商品辅助属性"
         data-multi="true"
         data-on-upload-success="doc_upload_success"
         data-icon="cloud-upload"></div>
    <input type="hidden" name="doc.pic" value="" id="doc_pic">
</div>


<div style="margin: 10px;">
    <div id="goods_detail_up" data-toggle="upload" data-uploader="api/goods/import/category"
         data-file-size-limit="1024000000"
         data-file-type-exts="*.xls,*.xlsx"
         data-button-text="请上传分类"
         data-multi="true"
         data-on-upload-success="doc_upload_success"
         data-icon="cloud-upload"></div>
    <input type="hidden" name="doc.pic" value="" id="doc_pic">
</div>
