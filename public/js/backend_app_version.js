$(document).ready(function() {
    $("[name='app_file']").on('change', function() {
        var uploadUrl = "http://up.qiniu.com";

        var qiniuUpload = function(file, token, key) {
            var xmlHttpRequest = new XMLHttpRequest();
            xmlHttpRequest.open('POST', uploadUrl, true);
            var formData;
            formData = new FormData();
            formData.append('file', file);//upload file
            formData.append('token', token);
            formData.append('key', 'version/' + key); //file name

            xmlHttpRequest.addEventListener('progress', function(e) {
                var done = e.loaded || e.loaded, total = e.total || e.total;
                $("#progress").hide();
                $("#progressSpan").text('上传成功');
            }, false);

            if ( xmlHttpRequest.upload ) {
                xmlHttpRequest.upload.onprogress = function(e) {
                    $("progress").show();
                    var done = e.loaded || e.loaded, total = e.total || e.total;
                    $("#progressSpan").text('上传进度: ' + done + ' / ' + total + ' = ' + (Math.floor(done/total*1000)/10) + '%');
                    if((Math.floor(done/total*1000)/10) == 100){
                    }
                    document.getElementById("progress").value = Math.floor(done/total*1000)/10;
                };
            }
            xmlHttpRequest.onreadystatechange = function(response) {
                if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200 && xmlHttpRequest.responseText != "") {
                    var response = JSON.parse(xmlHttpRequest.responseText);
                    $("[name='app_url']").val(response.key);
                } else if (xmlHttpRequest.status != 200 && xmlHttpRequest.responseText) {
                    alert('上传失败');
                }
            };
            xmlHttpRequest.send(formData);
        };

        var fileName = this.value.replace(/^.*\\/, "");

        qiniuUpload(this.files[0], token, fileName);
    });
});