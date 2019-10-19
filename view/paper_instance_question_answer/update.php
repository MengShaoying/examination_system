<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>试卷问题答案[{{ $paper_instance_question_answer->id }}]修改</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header"></div>
          <div class="layui-card-body">
            <form class="layui-form" action="" method="POST" lay-filter="component-form-element">


              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">分值：</label>
                  <div class="layui-input-block">
                    <input type="number" name="score" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value='{{ $paper_instance_question_answer->score }}'>
                  </div>
                </div>
              </div>


              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">题号：</label>
                  <div class="layui-input-block">
                    <input type="number" name="sequence" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value='{{ $paper_instance_question_answer->sequence }}'>
                  </div>
                </div>
              </div>


              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">试卷ID：</label>
                  <div class="layui-input-block">
                    <input type="number" name="paper_instance_id" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value='{{ $paper_instance_question_answer->paper_instance_id }}'>
                  </div>
                </div>
              </div>


              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">试卷模版问题关联ID：</label>
                  <div class="layui-input-block">
                    <input type="number" name="paper_template_question_id" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value='{{ $paper_instance_question_answer->paper_template_question_id }}'>
                  </div>
                </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="component-form-element">立即修改</button>
                  <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="/layuiadmin/layui/layui.js"></script>  
  <script>
  layui.config({
    base: '/layuiadmin/'
  }).extend({
    index: 'lib/index'
  }).use(['index', 'form'], function(){
    var $ = layui.$
    ,admin = layui.admin
    ,element = layui.element
    ,form = layui.form;
    
    form.render(null, 'component-form-element');
    element.render('breadcrumb', 'breadcrumb');
    
    form.on('submit(component-form-element)', function(data){
      return true;
    });
  });
  </script>
</body>
</html>
