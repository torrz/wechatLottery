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
    <h2 class="sub-header "><?php echo ($event["eventtitle1"]); ?>+<?php echo ($event["eventtitle2"]); ?></h2>
    <form class="form-horizontal" action="/wechatLottery/Home/Admin/edit?id=<?php echo ($event["eventid"]); ?>" method="post">
        <div class="form-group">
            <label for="eventTitle1" class="col-sm-2 control-label">活动标题一</label>
            <div class="col-sm-8 input-group">
                <input type="text" class="form-control" id="eventTitle1" name="eventTitle1" placeholder="" value="<?php echo ($event["eventtitle1"]); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="eventTitle2" class="col-sm-2 control-label">活动标题二</label>
            <div class="col-sm-8 input-group">
                <input type="text" class="form-control" id="eventTitle2" name="eventTitle2" placeholder="" value="<?php echo ($event["eventtitle2"]); ?>">
            </div>
        </div>
            <div class="form-group">
                <label for="eventStartTime" class="col-sm-2 control-label">开始报名时间</label>
                <div class="input-group date form_datetime col-md-4" data-date="<?php echo ($event["eventstarttime"]); ?>" data-date-format="yyyy-mm-dd hh:ii:ss">
                    <input class="form-control" id="eventStartTime" name="eventStartTime" size="16" type="text" value="<?php echo ($event["eventstarttime"]); ?>">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
            </div>
        <div class="form-group">
            <label for="eventEndTime" class="col-sm-2 control-label">截止报名时间</label>
            <div class="input-group date form_datetime col-md-4" data-date="<?php echo ($event["eventstarttime"]); ?>" data-date-format="yyyy-mm-dd hh:ii:ss">
                <input class="form-control" id="eventEndTime" name="eventEndTime" size="16" type="text" value="<?php echo ($event["eventendtime"]); ?>">
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
            </div>
        </div>
        <!--<div class="form-group">-->
            <!--<label for="eventLotteryTime" class="col-sm-2 control-label">抽奖时间</label>-->
            <!--<div class="input-group date form_datetime col-md-4" data-date="<?php echo ($event["eventstarttime"]); ?>" data-date-format="yyyy-mm-dd hh:ii:ss">-->
                <!--<input class="form-control" id="eventLotteryTime" name="eventLotteryTime" size="16" type="text" value="<?php echo ($event["eventlotterytime"]); ?>">-->
                <!--<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>-->
                <!--<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>-->
            <!--</div>-->
        <!--</div>-->
        <div class="form-group">
            <label for="eventDetail" class="col-sm-2 control-label">活动简要描述</label>
            <div class="col-sm-8 input-group">
                <textarea class="form-control" rows="3" id="eventDetail" name="eventDetail"><?php echo ($event["eventdetail"]); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="wechatname" class="col-sm-2 control-label">活动微信公众号</label>
            <div class="col-sm-8 input-group">
                <input class="form-control" id="wechatname" name="wechatname" size="16" type="text" value="<?php echo ($wechat["wechatname"]); ?> （<?php echo ($wechat["wechatid"]); ?>）" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">生成活动链接</label>
            <div class="col-sm-8 input-group">
                <a class="form-control" href="/wechatLottery/Home/Index/index">/wechatLottery/Home/Index/index</a>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-1">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">删除精选</button>


            </div>
            <div class="col-sm-1 col-sm-offset-2">
                <button type="button" class="btn btn-default">取消</button>
            </div>
            <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">修改</button>
            </div>
        </div>

    </form>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">确定删除?</h4>
                </div>
                <div class="modal-body">
                    <p>删除后将不能找回精选信息，而进行中的精选也不能恢复！</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a href="/wechatLottery/Home/Admin/delEvent?id=<?php echo ($event["eventid"]); ?>" type="button" class="btn btn-danger">确定删除</a>
                </div>
            </div>
        </div>
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