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
    <h2 class="sub-header ">新增精选</h2>
    <form class="form-horizontal" action="/wechatLottery/Home/Admin/addEvent" method="post">
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
            <label for="eventOfficialAccountId" class="col-sm-2 control-label">活动微信公众号</label>
            <mark>注意:创建后不能再修改公众号,如果没有公众号选择,请点击页面右上方"公众号配置"配置新的公众号</mark>
            <div class="col-sm-2 input-group">
                <select class="form-control" name="eventOfficialAccountId" id="eventOfficialAccountId">
                    <?php if(is_array($wechats)): $i = 0; $__LIST__ = $wechats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["appid"]); ?>"><?php echo ($vo["wechatname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
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