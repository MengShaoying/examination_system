<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>我的试卷</title>
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
          <div class="layui-card-header">我的试卷</div>
          <div class="layui-card-body">
            <table class="layui-hide" id="paper_instance-table" lay-filter="paper_instance-table"></table>

            <script type="text/html" id="paper_instance-table-bar">
              <a class="layui-btn layui-btn-xs" lay-event="look">回顾</a>
              <a class="layui-btn layui-btn-xs" lay-event="start">开始考试</a>
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="reject">罢考</a>
            </script>
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
  }).use(['index', 'table'], function() {
    var admin = layui.admin
    ,table = layui.table;
  
    table.render({
       elem: '#paper_instance-table'
      ,url: '/my_paper_instances/ajax'
      ,height: 'full-100'
      ,cellMinWidth: 80
      ,page: false
      ,cols: 
[
  [
    {
      "field": "id",
      "title": "ID",
      "sort": true,
      "width": 100
    },
    {
        "field": "paper_template_title",
        "title": "考卷标题",
        "sort": true,
        "align": "center"
    },
    {
        "field": "examination_id",
        "title": "考试ID",
        "sort": true,
        "align": "right",
        "width": 100
    },
    {
        "field": "examination_start_time_range",
        "title": "考试开始时间范围",
        "sort": true,
        "align": "center",
        "width": 200
    },
    {
        "field": "status_description",
        "title": "状态",
        "sort": true,
        "align": "center"
    },
    {
      "field": "start_time",
      "title": "开考时间",
      "sort": true,
      "align": "center"
    },
    {
      "field": "total_score",
      "title": "总分",
      "sort": true,
      "align": "right"
    },
    {
      "field": "create_time",
      "title": "添加时间",
      "sort": true
    },
    {
      "fixed": "right",
      "title": "操作",
      "toolbar": "#paper_instance-table-bar",
      "width": 180
    }
  ]
]
    });

    table.on('tool(paper_instance-table)', function(obj) {
      var data = obj.data;
      if (obj.event === 'look') {
          if (data.status === '{{ paper_instance::STATUS_FINISHED }}') {
              window.location.href = '/paper_instances/look/'+data.id;
          } else {
              layer.msg('未完成是不能回顾的');
          }
              console.log(data);
      } else if (obj.event === 'start') {
          layer.confirm('确定开始考试试卷['+data.id+']么', function(i) {
              layui.jquery.post('/paper_instances/start/'+data.id, null, function (res) {
                  if (res.code) {
                      layer.close(i);
                      layer.msg(res.msg);
                  } else {
                      layer.close(i);
                      table.reload('paper_instance-table');
                      window.location.href = '/paper_instances/detail/'+data.id;
                  }
              }, 'json');
        });
      } else if (obj.event === 'reject') {
          layer.confirm('确定要罢考试卷['+data.id+']么', function(i) {
              layui.jquery.post('/paper_instances/reject/'+data.id, null, function (res) {
                  if (res.code) {
                      layer.close(i);
                      layer.msg(res.msg);
                  } else {
                      layer.close(i);
                      table.reload('paper_instance-table');
                  }
              }, 'json');
        });
      }
    });
    
  });
  </script>
</body>
</html>
