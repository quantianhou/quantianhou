<script>
    var obj = {
        url : '/api/goods/images',
        type : 'POST',
        data:parent.GIMG,
        callback : function (res) {
console.log(res);
            for(var i in res.images){
                $('#iiimages').append('<image src="/'+res.images[i]+'"><br />');
            }
        }
    }
    $(this).bjuiajax('doAjax', obj)
</script>
<div id="iiimages" style="height:100%; overflow:scroll;">

</div>