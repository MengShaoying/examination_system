<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>考试添加</title>
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
                  <label class="layui-form-label">试卷模版：</label>
                  <div class="layui-input-block">

                    <select name="paper_template_id" lay-verify="required" lay-filter="aihao" lay-search>
                    @foreach ($paper_templates as $paper_template)
                        <option value="{{ $paper_template->id }}">{{ '[ID:'.$paper_template->id.'] '.$paper_template->title }}</option>
                    @endforeach
                    </select>

                  </div>
                </div>
              </div>

              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">开考时间：</label>
                  <div class="layui-input-block">
                    <input type="text" class="layui-input" name="examination_start_time_range" id="examination_start_time_range" placeholder=" ~ ">
                  </div>
                </div>
              </div>

              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">持续秒数：</label>
                  <div class="layui-input-block">
                    <input type="number" name="last_second" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
              </div>

              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">考试说明：</label>
                  <div class="layui-input-block">
                    <textarea name="description" placeholder="" class="layui-textarea"></textarea>
                  </div>
                </div>
              </div>

              <div class="layui-row layui-col-space10 layui-form-item">
                 <div class="layui-col-lg6">
                  <label class="layui-form-label">发卷：</label>
                   @foreach ($student_accounts as $account)
                   <div class="layui-input-block">
                   <input type="checkbox" name="accounts[]" title="{{ '[ID:'.$account->id.']'.$account->name }}" lay-skin="primary" value="{{ $account->id }}">
                  </div>
                   @endforeach
                 </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="component-form-element">立即添加</button>
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
  }).use(['index', 'form', 'laydate'], function(){
    var $ = layui.$
    ,admin = layui.admin
    ,element = layui.element
    ,laydate = layui.laydate
    ,form = layui.form;
    
    form.render(null, 'component-form-element');
    element.render('breadcrumb', 'breadcrumb');
    
    form.on('submit(component-form-element)', function(data){
      return true;
    });

    laydate.render({
    elem: '#examination_start_time_range'
        ,range: '~'
    });
  });
  </script>
</body>
</html>
