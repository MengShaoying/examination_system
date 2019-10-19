<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>问题分类</title>
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
          <div class="layui-card-header">管理问题分类</div>
          <div class="layui-card-body">
            <table class="layui-hide" id="question_category-table" lay-filter="question_category-table"></table>

            <script type="text/html" id="question_category-table-toolbar">
              <div class="layui-btn-container">
                <button class="layui-btn layui-btn-sm" lay-event="add">添加问题分类</button>
              </div>
            </script>

            <script type="text/html" id="question_category-table-bar">
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
       elem: '#question_category-table'
      ,url: '/question_categories/ajax'
      ,toolbar: '#question_category-table-toolbar'
      ,height: 'full-100'
      ,cellMinWidth: 80
      ,page: false
      ,cols: [[{"field":"id","title":"ID","sort":true},{"field":"name","title":"名称","sort":true,"align":"center"},{"field":"create_time","title":"添加时间","sort":true},{"field":"update_time","title":"修改时间","sort":true},{"fixed":"right","title":"操作","toolbar":"#question_category-table-bar","width":150}]]
    });

    table.on('toolbar(question_category-table)', function(obj) {
      switch (obj.event) {
        case 'add':
            window.location.href = '/question_categories/add';
        break;
      };
    });

    table.on('tool(question_category-table)', function(obj) {
      var data = obj.data;
      if (obj.event === 'del') {
          layer.confirm('确定删除问题分类['+data.id+']么', function(i) {
              layui.jquery.post('/question_categories/delete/'+data.id, null, function (res) {
                  if (res.code) {
                      layer.close(i);
                      layer.msg(res.msg);
                  } else {
                      table.reload('question_category-table');
                      layer.close(i);
                  }
              }, 'json');
        });
      } else if (obj.event === 'update') {
          window.location.href = '/question_categories/update/'+data.id;
      }
    });
    
  });
  </script>
</body>
</html>
