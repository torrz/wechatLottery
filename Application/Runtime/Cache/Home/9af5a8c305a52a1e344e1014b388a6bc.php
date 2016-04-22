<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>和盟精选后台</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/wechatLottery/Public/css/signin.css" rel="stylesheet">
    <link href="/wechatLottery/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/wechatLottery/Public/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="/wechatLottery/Public/js/jquery.min.js"></script>
    <!--<script src="/wechatLottery/Public/js/angular.min.js"></script>-->
</head>
<body>
<link href="/wechatLottery/Public/css/dashboard.css" rel="stylesheet">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"><?php echo ($category); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/wechatLottery/Home/Admin/overview">和盟精选后台</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="indexCategory"><a href="/wechatLottery/Home/Admin/overview">精选信息<span class="sr-only">(current)</span></a></li>
                <li class="productCategory"><a href="/wechatLottery/Home/Admin/addEventIndex">新建精选</a></li>
                <li class="settingCategory"><a href="/wechatLottery/Home/Admin/addWechatIndex">公众号配置</a></li>
                <li><a href="/wechatLottery/Home/Admin/exitHeme">退出</a></li>
            </ul>
            <!--<form class="navbar-form navbar-right">-->
                <!--<input type="text" class="form-control" placeholder="搜索参与者...">-->
            <!--</form>-->
        </div>
    </div>
</nav>

<link href="/wechatLottery/Public/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
    <h2 class="sub-header ">配置新的公众号</h2>
    <form class="form-horizontal" action="/wechatLottery/Home/Admin/addWechat" method="post">
        <div class="form-group">
            <label for="AppID" class="col-sm-2 control-label">AppID</label>
            <div class="col-sm-8 input-group">
                <input type="text" class="form-control" id="AppID" name="AppID" placeholder="" value="<?php echo ($event["eventtitle1"]); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="AppSecret" class="col-sm-2 control-label">AppSecret</label>
            <div class="col-sm-8 input-group">
                <input type="text" class="form-control" id="AppSecret" name="AppSecret" placeholder="" value="<?php echo ($event["eventtitle2"]); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="wechatName" class="col-sm-2 control-label">公众号名称</label>
            <div class="col-sm-8 input-group">
                <input type="text" class="form-control" id="wechatName" name="wechatName" placeholder="" value="<?php echo ($event["eventtitle2"]); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="wechatID" class="col-sm-2 control-label">公众号微信号</label>
            <div class="col-sm-8 input-group">
                <input type="text" class="form-control" id="wechatID" name="wechatID" placeholder="" value="<?php echo ($event["eventtitle2"]); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-1 col-sm-offset-2">
                <button type="button" class="btn btn-default">取消</button>
            </div>
            <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">创建</button>
            </div>
        </div>

    </form>
</div>
<div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
    <h2 class="sub-header">公众号一览</h2>
    <div class="table-responsive col-md-12">
        <table class="table table-hover table-condensed table-bordered">
            <thead>
            <tr>
                <th>公众号名称</th>
                <th>公众号微信号</th>
                <th>公众号AppID</th>
                <th>公众号AppSecret(加密处理)</th>
                <th>是否使用中</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($wechats)): $i = 0; $__LIST__ = $wechats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["wechatname"]); ?></td>
                    <td><?php echo ($vo["wechatid"]); ?></td>
                    <td><?php echo ($vo["appid"]); ?></td>
                    <td><?php echo (md5($vo["appsecret"])); ?></td>
                    <td class="<?php echo ($vo["status"]); ?>"><?php echo (str_replace("info","否",str_replace("success","是",$vo["status"]))); ?></td>
                    <td> <a class=" btn <?php echo (str_replace('info','notdisabled',str_replace('success','disabled',$vo["status"]))); ?>" data-toggle="modal" style="cursor: pointer;color: red;" data-target=".bs-example-modal-sm-<?php echo ($vo["appid"]); ?>">删除</a></td>
                    <div class="modal fade bs-example-modal-sm-<?php echo ($vo["appid"]); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">确定删除?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>将删除 <mark><?php echo ($vo["wechatname"]); ?></mark> 全部信息,确定删除？</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <a href="/wechatLottery/Home/Admin/delWechat?id=<?php echo ($vo["appid"]); ?>" type="button" class="btn btn-danger">确定删除</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript" src="/wechatLottery/Public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/wechatLottery/Public/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
</script>
</div>
<!--<script src="/wechatLottery/Public/js/angular.min.js"></script>-->

<script src="/wechatLottery/Public/js/bootstrap.min.js"></script>
<!--<script src="/wechatLottery/Public/js/categoryController.js"></script>-->

</body>
</html>