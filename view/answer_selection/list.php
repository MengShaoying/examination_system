<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>答题选项</title>
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
          <div class="layui-card-header">管理答题选项</div>
          <div class="layui-card-body">
            <table class="layui-hide" id="answer_selection-table" lay-filter="answer_selection-table"></table>

            <script type="text/html" id="answer_selection-table-toolbar">
              <div class="layui-btn-container">
                <button class="layui-btn layui-btn-sm" lay-event="add">添加答题选项</button>
              </div>
            </script>

            <script type="text/html" id="answer_selection-table-bar">
              <a class="layui-btn layui-btn-xs" lay-event="update">修改</a>
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
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
       elem: '#answer_selection-table'
      ,url: '/answer_selections/ajax'
      ,toolbar: '#answer_selection-table-toolbar'
      ,height: 'full-100'
      ,cellMinWidth: 80
      ,page: false
      ,cols: [[{"field":"id","title":"ID","sort":true},{"field":"paper_instance_question_answer_id","title":"试卷问题答案ID","sort":true,"align":"right"},{"field":"selection_id","title":"选项ID","sort":true,"align":"right"},{"field":"create_time","title":"添加时间","sort":true},{"field":"update_time","title":"修改时间","sort":true},{"fixed":"right","title":"操作","toolbar":"#answer_selection-table-bar","width":150}]]
    });

    table.on('toolbar(answer_selection-table)', function(obj) {
      switch (obj.event) {
        case 'add':
            window.location.href = '/answer_selections/add';
        break;
      };
    });

    table.on('tool(answer_selection-table)', function(obj) {
      var data = obj.data;
      if (obj.event === 'del') {
          layer.confirm('确定删除答题选项['+data.id+']么', function(i) {
              layui.jquery.post('/answer_selections/delete/'+data.id, null, function (res) {
                  if (res.code) {
                      layer.close(i);
                      layer.msg(res.msg);
                  } else {
                      table.reload('answer_selection-table');
                      layer.close(i);
                  }
              }, 'json');
        });
      } else if (obj.event === 'update') {
          window.location.href = '/answer_selections/update/'+data.id;
      }
    });
    
  });
  </script>
</body>
</html>
