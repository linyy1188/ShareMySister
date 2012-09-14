<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php if (isset($title)): ?>
            <title><?php echo $title; ?></title>
        <?php else: ?>
            <title>ShareMySister</title>
        <?php endif; ?>
            
        <link href="<?php echo base_url("css/reset.css"); ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url("css/header.css"); ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url("css/footer.css"); ?>" type="text/css" rel="stylesheet" />
        
        <?php if (is_array($csses)): ?>
            <?php foreach ($csses as $css): ?>
                <link href="<?php echo base_url("css/$css"); ?>" type="text/css" rel="stylesheet" />
            <?php endforeach; ?>
        <?php else: ?>
            <link href="<?php echo base_url("css/$csses"); ?>" type="text/css" rel="stylesheet" />
        <?php endif; ?>

        <?php if (isset($jses)): ?>
            <?php if (is_array($jses)): ?>
                <?php foreach ($jses as $js): ?>
                    <script src="<?php echo base_url("js/$js"); ?>" type="text/javascript"></script>
                <?php endforeach; ?>
            <?php else: ?>
                <script src="<?php echo base_url("js/$jses"); ?>" type="text/javascript"></script>
            <?php endif; ?>
        <?php endif; ?>
    </head>
    <body>
        <div class="head">
            <div class="barword">
                <ul class="bar-left">
                    <li class="bar-left-item bar-left-start">
                        <a href="index.html" class="bar-a" target="">资料查询</a>
                    </li>
                    <li class="bar-left-item">
                        <a href="share.html" class="bar-a">资料分享</a>
                    </li>
                    <li class="bar-left-item">
                        <a href="item.html" class="bar-a">资料目录</a>
                    </li>
                    <li class="bar-left-item bar-left-end">
                        <a href="home.html" class="bar-a">个人中心</a>
                    </li>
                </ul>
                <ul class="bar-right">
                    <li class="bar-right-item bar-right-login">
                        <a href="#" class="bar-a">登录</a>
                    </li>
                    <li class="bar-right-item bar-right-signup">
                        <a href="#" class="bar-a">注册</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="wrap">