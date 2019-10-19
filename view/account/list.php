<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>账号</title>
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
          <div class="layui-card-header">管理登录所使用的账户</div>
          <div class="layui-card-body">
            <table class="layui-hide" id="account-table" lay-filter="account-table"></table>

            <script type="text/html" id="account-table-toolbar">
              <div class="layui-btn-container">
                <button class="layui-btn layui-btn-sm" lay-event="add">添加账号</button>
              </div>
            </script>

            <script type="text/html" id="account-table-bar">
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
       elem: '#account-table'
      ,url: '/accounts/ajax'
      ,toolbar: '#account-table-toolbar'
      ,height: 'full-100'
      ,cellMinWidth: 80
      ,page: false
      ,cols: [[{"field":"id","title":"ID","sort":true},{"field":"name","title":"姓名","sort":true,"align":"center"},{"field":"password","title":"密码","sort":true,"align":"center"},{"field":"create_time","title":"添加时间","sort":true},{"field":"update_time","title":"修改时间","sort":true},{"fixed":"right","title":"操作","toolbar":"#account-table-bar","width":150}]]
    });

    table.on('toolbar(account-table)', function(obj) {
      switch (obj.event) {
        case 'add':
            window.location.href = '/accounts/add';
        break;
      };
    });

    table.on('tool(account-table)', function(obj) {
      var data = obj.data;
      if (obj.event === 'del') {
          layer.confirm('确定删除账号['+data.id+']么', function(i) {
              layui.jquery.post('/accounts/delete/'+data.id, null, function (res) {
                  if (res.code) {
                      layer.close(i);
                      layer.msg(res.msg);
                  } else {
                      table.reload('account-table');
                      layer.close(i);
                  }
              }, 'json');
        });
      } else if (obj.event === 'update') {
          window.location.href = '/accounts/update/'+data.id;
      }
    });
    
  });
  </script>
</body>
</html>
