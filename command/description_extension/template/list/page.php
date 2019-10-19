<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ $entity_name::$entity_display_name }}</title>
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
          <div class="layui-card-header">{{ $entity_name::$entity_description }}</div>
          <div class="layui-card-body">
            <table class="layui-hide" id="{{ $entity_name }}-table" lay-filter="{{ $entity_name }}-table"></table>

            <script type="text/html" id="{{ $entity_name }}-table-toolbar">
              <div class="layui-btn-container">
                <button class="layui-btn layui-btn-sm" lay-event="add">添加{{ $entity_name::$entity_display_name }}</button>
              </div>
            </script>

            <script type="text/html" id="{{ $entity_name }}-table-bar">
              <a class="layui-btn layui-btn-xs" lay-event="update">修改</a>
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="/layuiadmin/layui/layui.js"></script>  
@php

$table_render_infos = [
    [
        'field' => 'id',
        'title' => 'ID',
        'sort'  => true,
    ],
];

$table_render_infos = array_merge($table_render_infos, array_build($entity_name::$struct_types, function ($struct, $type) use ($entity_name) {
    return [null, [
        'field' => $struct,
        'title' => array_key_exists($struct, $entity_name::$struct_display_names)? $entity_name::$struct_display_names[$struct]: $struct,
        'sort' => true,
        'align' => ($type === 'number'?'right': 'center'),
    ]];
}));

$table_render_infos[] = [
    'field' => 'create_time',
    'title' => '添加时间',
    'sort' => true,
];

$table_render_infos[] = [
    'field' => 'update_time',
    'title' => '修改时间',
    'sort' => true,
];

$table_render_infos[] = [
    'fixed' => 'right',
    'title' => '操作',
    'toolbar' => '#'.$entity_name.'-table-bar',
    'width' => 150,
];
@endphp
  <script>
  layui.config({
      base: '/layuiadmin/'
  }).extend({
    index: 'lib/index'
  }).use(['index', 'table'], function() {
    var admin = layui.admin
    ,table = layui.table;
  
    table.render({
       elem: '#{{ $entity_name }}-table'
      ,url: '/{{ english_word_pluralize($entity_name) }}/ajax'
      ,toolbar: '#{{ $entity_name }}-table-toolbar'
      ,height: 'full-100'
      ,cellMinWidth: 80
      ,page: false
      ,cols: [{{ json($table_render_infos) }}]
    });

    table.on('toolbar({{ $entity_name }}-table)', function(obj) {
      switch (obj.event) {
        case 'add':
            window.location.href = '/{{ english_word_pluralize($entity_name) }}/add';
        break;
      };
    });

    table.on('tool({{ $entity_name }}-table)', function(obj) {
      var data = obj.data;
      if (obj.event === 'del') {
          layer.confirm('确定删除{{ $entity_name::$entity_display_name }}['+data.id+']么', function(i) {
              layui.jquery.post('/{{ english_word_pluralize($entity_name) }}/delete/'+data.id, null, function (res) {
                  if (res.code) {
                      layer.close(i);
                      layer.msg(res.msg);
                  } else {
                      table.reload('{{ $entity_name }}-table');
                      layer.close(i);
                  }
              }, 'json');
        });
      } else if (obj.event === 'update') {
          window.location.href = '/{{ english_word_pluralize($entity_name) }}/update/'+data.id;
      }
    });
    
  });
  </script>
</body>
</html>
