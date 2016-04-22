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

<div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
    <h3 class="sub-header"><?php echo ($eventtitle1); ?> <?php echo ($eventtitle2); ?></h3>
    <div class="table-responsive col-md-12">
        <table class="table table-hover table-condensed table-bordered">
            <thead>
            <tr>
                <th>抽奖码</th>
                <th>报名时间</th>
                <th >邀请人微信</th>
                <th>邀请人手机号</th>
                <th>邀请人IP</th>
                <th>被邀请人微信</th>
                <th>被邀请人手机号</th>
                <th>被邀请人IP</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($codes)): $i = 0; $__LIST__ = $codes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["lotterycode"]); ?></td>
                    <td><?php echo ($vo["regtime"]); ?></td>
                    <td><?php echo ($vo["referee1"]); ?></td>
                    <td><?php echo ($vo["refereephone1"]); ?></td>
                    <th>255.255.255.255</th>
                    <td ><?php echo ($vo["referee2"]); ?></td>
                    <td><?php echo ($vo["refereephone2"]); ?></td>
                    <th>255.255.255.255</th>
                    <td><a href="./eventDetail?id=<?php echo ($vo["eventid"]); ?>">详细</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<!--<script src="/wechatLottery/Public/js/angular.min.js"></script>-->

<script src="/wechatLottery/Public/js/bootstrap.min.js"></script>
<!--<script src="/wechatLottery/Public/js/categoryController.js"></script>-->

</body>
</html>