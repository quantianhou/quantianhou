<script>
    var obj = {
        url : '/api/goods/images',
        type : 'POST',
        data:parent.GIMG,
        callback : function (res) {

            for(var i in res){
                $('#iiimages').append('<image src="/'+res[i]+'"><br />');
            }
        }
    }
    $(this).bjuiajax('doAjax', obj)
</script>
<div id="iiimages">

</div>