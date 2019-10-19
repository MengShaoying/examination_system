<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>试卷[{{ $paper_instance->id }}]考试</title>
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
          <div class="layui-card-header" id="timedown">总得分 {{ $paper_instance->total_score }} 分</div>
          <div class="layui-card-body">
            <form class="layui-form" action="" method="POST" lay-filter="component-form-element">

              @foreach($paper_instance->paper_instance_question_answers as $paper_instance_question_answer)

              @php
              $question = $paper_instance_question_answer->paper_template_question->question;
              @endphp

              <div class="layui-row layui-col-space10 layui-form-item">
                  <div class="layui-col-lg12">
                      <fieldset class="layui-elem-field">
                        <legend>{{ '第'.($paper_instance_question_answer->sequence + 1).'题 ('.$question->get_selection_type_description().', '.$question->score.'分, 你的得分 '.$paper_instance_question_answer->score.' 分)' }}</legend>
                        <div class="layui-field-box">
                          {{ $question->description }}
                        </div>

                        <div class="layui-input-block">
                            @foreach ($question->selections as $selection)
                            <div class="layui-input-inline">
                                <input type="checkbox" name="selections[]" title="{{ $selection->description }}" lay-skin="primary" value="{{ $selection->id }}" {{ isset($checked_selection_infos[$selection->id])?'checked':'' }}>
                            </div>
                            @endforeach
                        </div>

                        <label class="layui-form-label">正确答案：</label>
                        <div class="layui-input-block">
                            @foreach ($question->selections as $selection)
                            <div class="layui-input-inline">
                                <input type="checkbox" name="selections[]" title="{{ $selection->description }}" lay-skin="primary" value="{{ $selection->id }}" {{ $selection->is_right_yes()?'checked':'' }}>
                            </div>
                            @endforeach
                        </div>
                      </fieldset>
                </div>
              </div>
                
              @endforeach
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
