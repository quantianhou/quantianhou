<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload to oss</title>
    <style>
        body {
            font-size: 14px;
        }

        [v-cloak] {
            display: none;
        }

        .block-center {
            width: 80%;
            margin: 30px auto;
        }

        .re-upload {
            font-size: 12px;
            display: inline-block;
            margin-left: 22px;
        }

        .re-upload a {
            text-decoration: none;
            cursor: normal;
            color: #ff0012;
        }

        .btn {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            text-decoration: none;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .btn:nth-child(2) {
            margin-left: 50px;
        }

        a.btn:hover {
            background-color: #3366b7;
        }

        .progress {
            margin-top: 20px;
            margin-bottom: 30px;
            width: 400px;
            height: 14px;
            overflow: hidden;
            background-color: #f5f5f5;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        }

        .progress-bar {
            background-color: rgb(92, 184, 92);
            background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.14902) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.14902) 50%, rgba(255, 255, 255, 0.14902) 75%, transparent 75%, transparent);
            background-size: 40px 40px;
            box-shadow: rgba(0, 0, 0, 0.14902) 0px -1px 0px 0px inset;
            box-sizing: border-box;
            color: rgb(255, 255, 255);
            display: block;
            float: left;
            font-size: 12px;
            height: 15px;
            line-height: 20px;
            text-align: center;
            transition-delay: 0s;
            transition-duration: 0.6s;
            transition-property: width;
            transition-timing-function: ease;
            width: 466.188px;
        }
    </style>
</head>
<body>
<div id="upload" class="block-center" v-if="reqData != ''" v-cloak>
    <div class="text-notice">
        <p>文件类型：@{{reqData.data.mime_types}}</p>
        <p>文件大小：@{{reqData.data.file_max_size}}</p>
    </div>
    <div v-if="files.length" v-for="(file, index) in files" :key="file.id">
        <span>文件名称：</span>
        <span>@{{file.rand_name}}</span>
        <span class="re-upload" @click="reupload(index)">
        <a href="#">重新选择</a>
        </span>
        <div class="progress">
            <div class="progress-bar" :style="file.progress"></div>
        </div>
    </div>

    <div id="contanier">
        <a class="btn" id="selectfiles">选择文件</a>
        <a class="btn" @click="startUpload(0)">上传文件</a>
    </div>
</div>

<script src="/js/vue.js"></script>
<script src="/js/moxie.min.js"></script>
<script src="/js/plupload.min.js"></script>
<script>
    new Vue({
        el: '#upload',
        data: {
            reqData: '',
            files: [],
            fileType: 'image',
            parentId: 'filename',
            isMulti: false,
            fileIndex: 0,
        },
        methods: {
            reupload: function (index) {
                this.files.splice(index, 1);
            },
            //发送请求，获取凭据
            sendRequest: function (fileType) {
                var xmlHttp = new XMLHttpRequest();
                var serverUrl = '/upload/policy?file_type=' + fileType;
                xmlHttp.open('GET', serverUrl, false);
                xmlHttp.send(null);
                this.reqData = JSON.parse(xmlHttp.responseText);
                return Promise.resolve();
            },

            randomFileName: function (filename, len) {
                var index = filename.lastIndexOf(".");
                var ext = filename.substr(index+1);
                len = len || 24;
                var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
                var maxPos = chars.length;
                var randStr = '';
                for (i = 0; i < len; i++) {
                    randStr += chars.charAt(Math.floor(Math.random() * maxPos));
                }
                return randStr + '.' + ext;
            },
            prepareForUpload: function (up, data, file_name) {
                new_multipart_params = {
                    'key': file_name,
                    'policy': data.policy,
                    'OSSAccessKeyId': data.accessid,
                    'success_action_status': '200', //让服务端返回200,不然，默认会返回204
                    'callback': data.callback,
                    'signature': data.signature,
                };
                up.setOption({
                    'url': data.host,
                    'multipart_params': new_multipart_params
                });

                up.start();
            },
            startUpload: function (index) {
                if (this.files.length == 1 && !this.isMulti) {
                    this.prepareForUpload(this.uploader, this.reqData.data, this.files[0].file_name);
                } else {
                    if (this.fileIndex >= this.files.length) {
                        var res = new Array();
                        this.files.map((item) => {
                            res.push({
                                file_name: item.file_name,
                                origin_name: item.origin_name,
                                file_size: item.file_size
                            });
                        });
                        console.log(parent);
                        parent[this.userFunc](res);
                        parent.layer.close(parent.layer.getFrameIndex(window.name));
                        parent.toastr.success('上传成功！');
                    } else {
                        this.prepareForUpload(this.uploader, this.reqData.data, this.files[index].file_name);
                    }
                }
            },
        },
        mounted: function () {
            var reg = /\?fileType=(\w+).+parentId=(\w+).+callBack=(\w*)?/;
            var execRes = reg.exec(location.search);
            this.fileType = execRes[1];
            this.parentId = execRes[2];
            this.userFunc = execRes[3];
            if (/isMulti/.test(location.search)) {
                this.isMulti = true;
            }
            this.sendRequest(this.fileType).then(() => {
                if (this.reqData.error == 0) {
                    var vm = this;
                    this.uploader = new plupload.Uploader({
                        //后台使用，暂时只支持使用html5
                        runtimes: 'html5',
                        browse_button: vm.files.length == 0 ? 'selectfiles' : '',
                        container: document.getElementById('contanier'),
                        url: 'http://oss.aliyuncs.com',
                        multi_selection: vm.isMulti,
                        filters: {
                            mime_types: [{
                                title: vm.reqData.data.file_type,
                                extensions: vm.reqData.data.mime_types,
                            }],
                            max_file_size: vm.reqData.data.file_max_size,
                            prevent_duplicates: true,
                        },
                        init: {
                            PostInit: function () {
                            },
                            FilesAdded: function (up, files) {
                                plupload.each(files, function (file) {
                                    let item = {
                                        file_id: file.id,
                                        file_name: vm.reqData.data.dir + vm.randomFileName(file.name),
                                        rand_name: vm.randomFileName(file.name),
                                        file_size: file.size,
                                        progress: {width: '0%'},
                                        uploaded: false,
                                        origin_name: file.name,
                                    };
                                    vm.isMulti ? vm.files.push(item) : vm.files = new Array(item)
                                });
                            },
                            BeforeUpload: function (up, file) {
                            },
                            UploadProgress: function (up, file) {
                                vm.files[vm.fileIndex].progress.width = file.percent + '%';
                            },
                            FileUploaded: function (up, file, info) {
                                if (info.status !== 200) {
                                    window.alert('文件上传失败， 请重试！');
                                    return false;
                                }
                                //单文件上传
                                if (!vm.isMulti) {
                                    // 给父页面对应ID的input赋值
                                    parent.$('#' + vm.parentId).val(vm.files[0].file_name).trigger('input');
                                    // // 调用父页面方法
                                    if (vm.userFunc && parent[vm.userFunc]) {
                                        var res = {
                                            file_name: vm.files[0].file_name,
                                            file_size: vm.files[0].file_size,
                                            origin_name: vm.files[0].origin_name,
                                        };
                                        parent[vm.userFunc](res);
                                    }
                                    parent.layer.close(parent.layer.getFrameIndex(window.name));
                                    parent.toastr.success('上传成功！');
                                } else { //多文件上传
                                    vm.fileIndex++;
                                    vm.startUpload(vm.fileIndex);
                                }
                            },
                            Error: function (up, err) {
                                var errMsg = '上传失败，请重试！';
                                if (err.code == -600) {
                                    errMsg = '选择的文件太大了';
                                } else if (err.code == -601) {
                                    errMsg = '上传文件类型错误！';
                                } else if (err.code == -602) {
                                    errMsg = '请勿重复上传！';
                                } else {
                                    errMsg = err.message;
                                }
                                window.alert(errMsg);
                            }
                        },
                    });
                    this.uploader.init();
                }
            })
        }
    });
</script>
</body>
</html>
