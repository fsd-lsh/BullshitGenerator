# 狗屁不通文章生成器
# BullshitGenerator

偶尔需要一些中文文字用于GUI开发时测试文本渲染. __本项目只做这一项, 请勿用于其他任何用途__.
Needs to generate some texts to test if my GUI rendering codes good or not. so I made this.

#### 声明，本项目参考自https://github.com/menzi11/BullshitGenerator 思路开发的PHP版本狗屁不通文章生成器。
后续该版本优化和维护可能和原作者不同步，请须知。

----

### 说明
1. 将`index.php`和`data.json`集成到您的PHP项目中
2. `index.php`可以抽象为您的webAPI接口对js做响应服务
3. `data.json`可直接以文件形式读取亦可存为数据库中

### 演示地址
访问 https://www.easybhu.cn/tools.html ，找到文章生成器

### 使用示例
```html
<div class="col-md-4 item">
    <div class="tools-btn">
        <div class="pull-left logo"><i class="fa fa-eye"></i></div>
        <div class="pull-left title">
            <p>文章生成器</p>
            <p>输入一句话自动生成文章</p>
        </div>
        <a href="#bullshit-generator" class="dialog" data-toggle="modal">打开</a>
    </div>
    <div class="modal fade" id="bullshit-generator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title" id="myModalLabel">文章生成器</h4>
               </div>
               <form class="modal-body">
                   <div class="form-group">
                       <label for="bullshit-generator-subject">输入主题（一句话、词组都可）
                           <button id="bullshit-generator-g" class="btn btn-info btn-sm" type="button">生成</button>
                           <button id="bullshit-generator-r" class="btn btn-default btn-sm" type="button">重置</button>
                       </label>
                       <input type="text" class="form-control" id="bullshit-generator-subject" autocomplete="off">
                   </div>
                   <div class="form-group">
                       <label for="bullshit-generator-article">生成正文</label>
                       <textarea class="form-control" id="bullshit-generator-article" style="height:350px; overflow-y:scroll;" autocomplete="off"></textarea>
                   </div>
               </form>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">关闭</button>
               </div>
           </div>
       </div>
    </div>
    <script>
        (function () {
            $(document).on('click', '#bullshit-generator-g', function () {

                if(!$('#bullshit-generator-subject').val()) {
                    alert('主题不能为空');
                    return false;
                }
                $.ajax({
                    url: '/tools/bullshit_generator/',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        subject: $('#bullshit-generator-subject').val(),
                    },
                    success: function (res) {
                        if(res.code === 1 && res.data) {
                            $('#bullshit-generator-article').val(res.data);
                        }else {
                            alert(res.info);
                        }
                    },
                });
            });
            $(document).on('click', '#bullshit-generator-r', function () {
                $('#bullshit-generator-subject').val('');
                $('#bullshit-generator-article').val('');
               setTimeout(function () {
                   alert('重置完成');
               }, 300);
            });
       })();
    </script>
```
