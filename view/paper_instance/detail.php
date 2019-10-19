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
          <div class="layui-card-header">{{ $paper_instance->examination->description }}</div>
          <div class="layui-card-body">
            <blockquote class="layui-elem-quote" id="timedown"></blockquote>
            <form class="layui-form" action="" method="POST" lay-filter="component-form-element">

              @foreach($paper_instance->paper_instance_question_answers as $paper_instance_question_answer)

              @php
              $question = $paper_instance_question_answer->paper_template_question->question;
              @endphp

              <div class="layui-row layui-col-space10 layui-form-item">
                  <div class="layui-col-lg12">
                      <fieldset class="layui-elem-field">
                        <legend>{{ '第'.($paper_instance_question_answer->sequence + 1).'题 ('.$question->get_selection_type_description().', '.$question->score.'分)' }}</legend>
                        <div class="layui-field-box">
                          {{ $question->description }}
                        </div>

                        <div class="layui-input-block">
                        @php
                        $selections = $question->selections;
                        shuffle($selections);
                        @endphp
                        @foreach ($selections as $selection)
                        <div class="layui-input-inline">
                            <input type="checkbox" name="selections[]" title="{{ $selection->description }}" lay-skin="primary" value="{{ $selection->id }}">
                        </div>
                        @endforeach
                        </div>
                      </fieldset>
                </div>
              </div>
                
              @endforeach

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="component-form-element">交卷</button>
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

function TimeDown(id, endDateStr) {
    //结束时间
    var endDate = new Date(endDateStr);
    //当前时间
    var nowDate = new Date();
    //相差的总秒数
    var totalSeconds = parseInt((endDate - nowDate) / 1000);
    //天数
    var days = Math.floor(totalSeconds / (60 * 60 * 24));
    //取模（余数）
    var modulo = totalSeconds % (60 * 60 * 24);
    //小时数
    var hours = Math.floor(modulo / (60 * 60));
    modulo = modulo % (60 * 60);
    //分钟
    var minutes = Math.floor(modulo / 60);
    //秒
    var seconds = modulo % 60;
    //输出到页面
    document.getElementById(id).innerHTML = "还剩: " + days + " 天 " + hours + " 小时 " + minutes + " 分钟 " + seconds + " 秒 ";

    if (days < 0
        || hours < 0
        || minutes < 0
        || seconds < 0
    ) {
        window.location.href = '/my_paper_instances';
        }

    //延迟一秒执行自己
    setTimeout(function () {
        TimeDown(id, endDateStr);
    }, 1000)
}
TimeDown("timedown", "{{ datetime($paper_instance->start_time.' +'.$paper_instance->examination->last_second.' seconds', 'Y/m/d H:i:s') }}");
  </script>
</body>
</html>
